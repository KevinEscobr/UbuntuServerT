<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlourTrackingTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private User $client;
    private User $driver;
    private Product $product1;
    private Product $product2;

    protected function setUp(): void
    {
        parent::setUp();

        // Create Users
        $this->admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->client = User::create([
            'name' => 'Client User',
            'email' => 'client@test.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        $this->driver = User::create([
            'name' => 'Driver User',
            'email' => 'driver@test.com',
            'password' => bcrypt('password'),
            'role' => 'driver',
            'current_latitude' => -33.45000,
            'current_longitude' => -70.64000, // starting at base
        ]);

        // Create Products
        $this->product1 = Product::create([
            'name' => 'Flour Sack A',
            'stock' => 100,
            'price' => 1000,
        ]);

        $this->product2 = Product::create([
            'name' => 'Flour Sack B',
            'stock' => 50,
            'price' => 1200,
        ]);
    }

    /**
     * Test full lifecycle of an order: client places it, admin assigns driver, GPS transitions, privacy check, completion.
     */
    public function test_full_order_lifecycle_and_state_machine()
    {
        // 1. Client creates an order
        $orderData = [
            'delivery_latitude' => -33.46890,
            'delivery_longitude' => -70.67120,
            'items' => [
                ['product_id' => $this->product1->id, 'quantity' => 5],
                ['product_id' => $this->product2->id, 'quantity' => 2],
            ]
        ];

        $response = $this->actingAs($this->client)
            ->postJson('/api/v1/orders', $orderData);

        $response->assertStatus(201);
        $orderId = $response->json('order_id');
        $this->assertDatabaseHas('orders', [
            'id' => $orderId,
            'status' => 'pendiente',
            'client_id' => $this->client->id
        ]);

        // 2. Admin assigns driver
        $assignResponse = $this->actingAs($this->admin)
            ->postJson("/api/v1/admin/orders/{$orderId}/assign", [
                'driver_id' => $this->driver->id
            ]);

        $assignResponse->assertStatus(200);
        $this->assertDatabaseHas('orders', [
            'id' => $orderId,
            'status' => 'asignado',
            'driver_id' => $this->driver->id
        ]);

        // 3. Driver reports location far from base (> 1km) and far from client (> 3km)
        // Coords: -33.44000, -70.62000 is ~2.1km from base and ~5.8km from client
        $locationResponse1 = $this->actingAs($this->driver)
            ->postJson('/api/v1/driver/location', [
                'order_id' => $orderId,
                'latitude' => -33.44000,
                'longitude' => -70.62000
            ]);

        $locationResponse1->assertStatus(200);
        $locationResponse1->assertJsonPath('status_updated_to', 'pedido_en_camino');

        // 4. Client tracks the order. Driver location is far (> 2km from client: driver is at -33.44000, -70.62000)
        // Check distance to client: ~5.8 km
        $trackResponse1 = $this->actingAs($this->client)
            ->getJson("/api/v1/orders/{$orderId}/track");

        $trackResponse1->assertStatus(200);
        $trackResponse1->assertJsonPath('order_status', 'pedido_en_camino');
        $trackResponse1->assertJsonPath('driver_latitude', null);
        $trackResponse1->assertJsonPath('driver_longitude', null);
        $this->assertEquals(5.7, round($trackResponse1->json('distance_km'), 1));

        // 5. Driver updates coordinates closer to client (<= 3km but > 2km, e.g. -33.46000, -70.65000 which is ~2.2 km to client)
        $locationResponse2 = $this->actingAs($this->driver)
            ->postJson('/api/v1/driver/location', [
                'order_id' => $orderId,
                'latitude' => -33.46000,
                'longitude' => -70.65000
            ]);

        $locationResponse2->assertStatus(200);
        $locationResponse2->assertJsonPath('status_updated_to', 'llegando');

        // 5b. Client tracks again. Since distance is ~2.2 km (> 2km), coordinates must still be null.
        $trackResponseIntermediate = $this->actingAs($this->client)
            ->getJson("/api/v1/orders/{$orderId}/track");
        $trackResponseIntermediate->assertStatus(200);
        $trackResponseIntermediate->assertJsonPath('order_status', 'llegando');
        $trackResponseIntermediate->assertJsonPath('driver_latitude', null);
        $trackResponseIntermediate->assertJsonPath('driver_longitude', null);
        $this->assertEquals(2.2, round($trackResponseIntermediate->json('distance_km'), 1));

        // 6. Driver updates coordinates even closer (<= 2km, e.g. -33.46500, -70.66500 which is ~1.1 km to client)
        $locationResponse3 = $this->actingAs($this->driver)
            ->postJson('/api/v1/driver/location', [
                'order_id' => $orderId,
                'latitude' => -33.46500,
                'longitude' => -70.66500
            ]);
        $locationResponse3->assertStatus(200);
        $locationResponse3->assertJsonPath('status_updated_to', 'llegando');

        // 6b. Client tracks again. Since distance is now ~1.1 km (<= 2km), coordinates must be visible.
        $trackResponse2 = $this->actingAs($this->client)
            ->getJson("/api/v1/orders/{$orderId}/track");

        $trackResponse2->assertStatus(200);
        $trackResponse2->assertJsonPath('order_status', 'llegando');
        $trackResponse2->assertJsonPath('driver_latitude', -33.46500);
        $trackResponse2->assertJsonPath('driver_longitude', -70.66500);
        $this->assertEquals(0.7, round($trackResponse2->json('distance_km'), 1));

        // 7. Driver completes order manually
        $completeResponse = $this->actingAs($this->driver)
            ->postJson("/api/v1/driver/orders/{$orderId}/complete");

        $completeResponse->assertStatus(200);
        $this->assertDatabaseHas('orders', [
            'id' => $orderId,
            'status' => 'entregado'
        ]);

        // 8. Attempting to transition back to assigned or pending must fail (State Machine validation)
        $revertResponse = $this->actingAs($this->admin)
            ->postJson("/api/v1/admin/orders/{$orderId}/assign", [
                'driver_id' => $this->driver->id
            ]);

        $revertResponse->assertStatus(422);

        // 9. Further location updates on a final state must not change the status
        $finalLocationResponse = $this->actingAs($this->driver)
            ->postJson('/api/v1/driver/location', [
                'order_id' => $orderId,
                'latitude' => -33.46890,
                'longitude' => -70.67120
            ]);
        $finalLocationResponse->assertStatus(200);
        $finalLocationResponse->assertJsonPath('status_updated_to', 'entregado');
    }

    /**
     * Test admin actions on orders (update and delete).
     */
    public function test_admin_modifies_and_deletes_order()
    {
        // Place order
        $order = Order::create([
            'client_id' => $this->client->id,
            'delivery_latitude' => -33.45000,
            'delivery_longitude' => -70.64000,
            'status' => 'pendiente',
        ]);

        // 1. Admin updates order quantity and coords
        $updateResponse = $this->actingAs($this->admin)
            ->putJson("/api/v1/admin/orders/{$order->id}", [
                'sacos_harina_cantidad' => 15,
                'delivery_latitude' => -33.46123,
                'delivery_longitude' => -70.66234
            ]);

        $updateResponse->assertStatus(200);
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'delivery_latitude' => -33.46123,
            'delivery_longitude' => -70.66234
        ]);

        // 2. Admin deletes order
        $deleteResponse = $this->actingAs($this->admin)
            ->deleteJson("/api/v1/admin/orders/{$order->id}");

        $deleteResponse->assertStatus(200);
        $this->assertDatabaseMissing('orders', [
            'id' => $order->id
        ]);
    }
}
