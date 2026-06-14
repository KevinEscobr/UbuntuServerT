<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * GET /api/v1/driver/orders
     * List active orders assigned to the authenticated driver.
     */
    public function index(Request $request)
    {
        $driver = $request->user();

        if ($driver->role !== 'driver') {
            return response()->json(['error' => 'Solo los repartidores pueden acceder a esta lista.'], 403);
        }

        // Active orders are: asignado, pedido_en_camino, llegando
        $orders = Order::with('items')
            ->where('driver_id', $driver->id)
            ->whereIn('status', ['asignado', 'pedido_en_camino', 'llegando'])
            ->get();

        $response = $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'status' => $order->status,
                'sacos_total' => (int) $order->items->sum('quantity'),
                'client_latitude' => $order->delivery_latitude,
                'client_longitude' => $order->delivery_longitude,
                'base_latitude' => $order->base_latitude,
                'base_longitude' => $order->base_longitude,
            ];
        });

        return response()->json($response, 200);
    }

    /**
     * GET /api/v1/driver/orders/history
     * List completed orders history for the authenticated driver.
     */
    public function history(Request $request)
    {
        $driver = $request->user();

        if ($driver->role !== 'driver') {
            return response()->json(['error' => 'Solo los repartidores pueden acceder al historial.'], 403);
        }

        $orders = Order::with('items')
            ->where('driver_id', $driver->id)
            ->where('status', 'entregado')
            ->get();

        $response = $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'status' => $order->status,
                'sacos_total' => (int) $order->items->sum('quantity'),
                'client_latitude' => $order->delivery_latitude,
                'client_longitude' => $order->delivery_longitude,
                'base_latitude' => $order->base_latitude,
                'base_longitude' => $order->base_longitude,
            ];
        });

        return response()->json($response, 200);
    }

    /**
     * POST /api/v1/driver/location
     * Process GPS location updates and execute automatic state machine transitions.
     */
    public function updateLocation(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $driver = $request->user();

        if ($driver->role !== 'driver') {
            return response()->json(['error' => 'Solo los repartidores pueden reportar ubicación.'], 403);
        }

        // Update driver's last coordinates
        $driver->current_latitude = $request->latitude;
        $driver->current_longitude = $request->longitude;
        $driver->save();

        $order = Order::where('id', $request->order_id)
            ->where('driver_id', $driver->id)
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Pedido no encontrado o no asignado a este repartidor.'], 404);
        }

        // If the order is already in a final state, do not change status but confirm coordinates processed
        if (in_array($order->status, ['entregado', 'cancelado'])) {
            return response()->json([
                'status_updated_to' => $order->status,
                'message' => 'El pedido ya se encuentra finalizado o cancelado.'
            ], 200);
        }

        $distanceToBase = $order->getDistanceTo($request->latitude, $request->longitude, 'base');
        $distanceToClient = $order->getDistanceTo($request->latitude, $request->longitude, 'delivery');

        $currentStatus = $order->status;

        // Transition 1: If distance to base > 1km and status is 'asignado' -> transition to 'pedido_en_camino'
        if ($currentStatus === 'asignado' && $distanceToBase > 1.0) {
            $order->status = 'pedido_en_camino';
            $order->save();
            $currentStatus = 'pedido_en_camino';
        }

        // Transition 2: If distance to client <= 3km and status is 'pedido_en_camino' -> transition to 'llegando'
        if ($currentStatus === 'pedido_en_camino' && $distanceToClient <= 3.0) {
            $order->status = 'llegando';
            $order->save();
            $currentStatus = 'llegando';
        }

        return response()->json([
            'status_updated_to' => $currentStatus,
            'message' => 'Coordenadas procesadas correctamente'
        ], 200);
    }

    /**
     * POST /api/v1/driver/orders/{id}/complete
     * Formally complete/finalize the delivery when arriving.
     */
    public function complete(Request $request, $id)
    {
        $driver = $request->user();

        if ($driver->role !== 'driver') {
            return response()->json(['error' => 'Solo los repartidores pueden finalizar entregas.'], 403);
        }

        $order = Order::where('id', $id)
            ->where('driver_id', $driver->id)
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Pedido no encontrado.'], 404);
        }

        // State Machine validation: unidirectional/irreversible
        if (in_array($order->status, ['entregado', 'cancelado'])) {
            return response()->json(['error' => 'Transición de estado no permitida.'], 422);
        }

        if (!$order->canTransitionTo('entregado')) {
            return response()->json(['error' => 'Transición de estado no permitida.'], 422);
        }

        $order->status = 'entregado';
        $order->save();

        return response()->json(['message' => 'Pedido finalizado y archivado correctamente'], 200);
    }
}
