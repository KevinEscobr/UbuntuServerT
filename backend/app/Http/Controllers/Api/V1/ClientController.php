<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * GET /api/v1/products
     * List available flour sacks in catalog.
     */
    public function products()
    {
        $products = Product::all(['id', 'name', 'stock', 'price']);
        return response()->json($products, 200);
    }

    /**
     * POST /api/v1/orders
     * Place a new order with items and delivery coordinates.
     */
    public function store(Request $request)
    {
        $request->validate([
            'delivery_latitude' => 'required|numeric',
            'delivery_longitude' => 'required|numeric',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        // Client is the authenticated user
        $client = $request->user();

        if ($client->role !== 'client') {
            return response()->json(['error' => 'Solo los clientes pueden registrar pedidos.'], 403);
        }

        $order = DB::transaction(function () use ($request, $client) {
            $order = Order::create([
                'client_id' => $client->id,
                'delivery_latitude' => $request->delivery_latitude,
                'delivery_longitude' => $request->delivery_longitude,
                'status' => 'pendiente',
            ]);

            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            return $order;
        });

        return response()->json([
            'order_id' => $order->id,
            'status' => $order->status,
        ], 201);
    }

    /**
     * GET /api/v1/orders/{id}/track
     * Tracks the order. Coordinates are only shown if the driver is within 2km.
     */
    public function track($id)
    {
        $order = Order::with('driver')->find($id);

        if (!$order) {
            return response()->json(['error' => 'Pedido no encontrado.'], 404);
        }

        $driver = $order->driver;

        // If no driver is assigned, or driver has no recorded coordinates
        if (!$driver || is_null($driver->current_latitude) || is_null($driver->current_longitude)) {
            return response()->json([
                'order_status' => $order->status,
                'driver_latitude' => null,
                'driver_longitude' => null,
                'distance_km' => null
            ], 200);
        }

        // Calculate distance in km from driver coordinates to delivery coordinates
        $distance = $order->getDistanceTo($driver->current_latitude, $driver->current_longitude, 'delivery');

        if ($distance <= 2.0) {
            return response()->json([
                'order_status' => $order->status,
                'driver_latitude' => round($driver->current_latitude, 5),
                'driver_longitude' => round($driver->current_longitude, 5),
                'distance_km' => round($distance, 2)
            ], 200);
        } else {
            return response()->json([
                'order_status' => $order->status,
                'driver_latitude' => null,
                'driver_longitude' => null,
                'distance_km' => round($distance, 2)
            ], 200);
        }
    }
}
