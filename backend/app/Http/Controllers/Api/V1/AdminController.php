<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * GET /api/v1/admin/dashboard
     * Retrieve statistics and active drivers' location.
     */
    public function dashboard()
    {
        // Active drivers are drivers who have current active deliveries (status is: asignado, pedido_en_camino, llegando)
        $drivers = User::where('role', 'driver')->get();

        $activeDrivers = [];
        foreach ($drivers as $driver) {
            // Find active order for this driver
            $activeOrder = Order::where('driver_id', $driver->id)
                ->whereIn('status', ['asignado', 'pedido_en_camino', 'llegando'])
                ->first();

            // Only report location if driver has coordinates, or we report default/null
            $activeDrivers[] = [
                'driver_id' => $driver->id,
                'name' => $driver->name,
                'current_latitude' => $driver->current_latitude ?? -33.45000,
                'current_longitude' => $driver->current_longitude ?? -70.64000,
                'current_order_id' => $activeOrder ? $activeOrder->id : null,
                'status' => $activeOrder ? ($activeOrder->status === 'pedido_en_camino' ? 'en_ruta' : $activeOrder->status) : 'libre',
            ];
        }

        $pendingCount = Order::where('status', 'pendiente')->count();

        return response()->json([
            'active_drivers' => $activeDrivers,
            'pending_orders_count' => $pendingCount
        ], 200);
    }

    /**
     * PUT /api/v1/admin/orders/{id}
     * Modify order details before it is delivered/cancelled.
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Pedido no encontrado.'], 404);
        }

        if (in_array($order->status, ['entregado', 'cancelado'])) {
            return response()->json(['error' => 'No se puede modificar un pedido finalizado o cancelado.'], 422);
        }

        $request->validate([
            'sacos_harina_cantidad' => 'integer|min:1',
            'delivery_latitude' => 'numeric',
            'delivery_longitude' => 'numeric',
        ]);

        DB::transaction(function () use ($request, $order) {
            if ($request->has('delivery_latitude')) {
                $order->delivery_latitude = $request->delivery_latitude;
            }
            if ($request->has('delivery_longitude')) {
                $order->delivery_longitude = $request->delivery_longitude;
            }
            $order->save();

            if ($request->has('sacos_harina_cantidad')) {
                // Update the quantity of the first item in the order, or create one if none exists
                $item = OrderItem::where('order_id', $order->id)->first();
                if ($item) {
                    $item->quantity = $request->sacos_harina_cantidad;
                    $item->save();
                } else {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => 1, // default to first product
                        'quantity' => $request->sacos_harina_cantidad,
                    ]);
                }
            }
        });

        return response()->json(['message' => 'Pedido actualizado con éxito'], 200);
    }

    /**
     * DELETE /api/v1/admin/orders/{id}
     * Delete or cancel an order.
     */
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Pedido no encontrado.'], 404);
        }

        // We physically delete it as requested
        $order->delete();

        return response()->json(['message' => 'Pedido eliminado correctamente'], 200);
    }

    /**
     * POST /api/v1/admin/orders/{id}/assign
     * Assign a driver to a pending order.
     */
    public function assign(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Pedido no encontrado.'], 404);
        }

        $request->validate([
            'driver_id' => 'required|integer|exists:users,id',
        ]);

        $driver = User::find($request->driver_id);

        if ($driver->role !== 'driver') {
            return response()->json(['error' => 'El usuario asignado debe tener el rol de repartidor.'], 422);
        }

        if (!$order->canTransitionTo('asignado')) {
            return response()->json(['error' => 'Transición de estado a asignado no permitida.'], 422);
        }

        $order->driver_id = $driver->id;
        $order->status = 'asignado';
        $order->save();

        return response()->json(['message' => 'Repartidor asignado exitosamente'], 200);
    }
}
