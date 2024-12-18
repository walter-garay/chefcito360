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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->decimal('total', 8,2);
            $table->tinyInteger('ord_estado')->unsigned()->default(1);
            $table->unsignedBigInteger('mesa_id');
            $table->foreign('mesa_id')->references('id')->on('mesas');
            $table->unsignedBigInteger('mesero_id');
            $table->foreign('mesero_id')->references('id')->on('users');
            $table->enum('estado', ['Pedido', 'Servido', 'Cancelado', 'Pagado'])->default('Pedido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
