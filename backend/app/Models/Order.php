<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['client_id', 'driver_id', 'delivery_latitude', 'delivery_longitude', 'base_latitude', 'base_longitude', 'status'])]
class Order extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'client_id' => 'integer',
            'driver_id' => 'integer',
            'delivery_latitude' => 'double',
            'delivery_longitude' => 'double',
            'base_latitude' => 'double',
            'base_longitude' => 'double',
        ];
    }

    /**
     * Define valid transitions.
     */
    public static function getValidTransitions(): array
    {
        return [
            'pendiente' => ['asignado', 'cancelado'],
            'asignado' => ['pedido_en_camino', 'cancelado'],
            'pedido_en_camino' => ['llegando', 'cancelado'],
            'llegando' => ['entregado', 'cancelado'],
            'entregado' => [],
            'cancelado' => [],
        ];
    }

    /**
     * Checks if a transition is valid.
     */
    public function canTransitionTo(string $newStatus): bool
    {
        if ($this->status === $newStatus) {
            return true;
        }

        $allowed = self::getValidTransitions()[$this->status] ?? [];
        return in_array($newStatus, $allowed);
    }

    /**
     * Transition the order to a new status.
     */
    public function transitionTo(string $newStatus): bool
    {
        if (!$this->canTransitionTo($newStatus)) {
            return false;
        }

        $this->status = $newStatus;
        return $this->save();
    }

    /**
     * Calculate Haversine distance in kilometers.
     */
    public function getDistanceTo(float $latitude, float $longitude, string $target = 'delivery'): float
    {
        $targetLat = $target === 'base' ? $this->base_latitude : $this->delivery_latitude;
        $targetLng = $target === 'base' ? $this->base_longitude : $this->delivery_longitude;

        $earthRadius = 6371.0; // km

        $dLat = deg2rad($latitude - $targetLat);
        $dLon = deg2rad($longitude - $targetLng);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($targetLat)) * cos(deg2rad($latitude)) *
             sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    /**
     * Relationship: client who placed the order.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /**
     * Relationship: driver assigned to deliver the order.
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    /**
     * Relationship: items in the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
