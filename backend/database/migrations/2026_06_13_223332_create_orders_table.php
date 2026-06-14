<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('driver_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->double('delivery_latitude');
            $table->double('delivery_longitude');
            
            $table->double('base_latitude')->default(-33.45000);
            $table->double('base_longitude')->default(-70.64000);
            
            // Status states: pendiente, asignado, pedido_en_camino, llegando, entregado, cancelado
            $table->string('status')->default('pendiente');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
