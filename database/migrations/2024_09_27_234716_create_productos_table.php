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
    Schema::create('productos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('descripcion')->nullable();
        $table->decimal('precio_c', 6, 2)->nullable(); // Precio de compra nulleable
        $table->decimal('precio_v', 6, 2)->nullable(); // Precio de venta nulleable
        $table->tinyInteger('prod_estado')->unsigned()->default(1);
        $table->integer('stock')->unsigned()->default(0);
        $table->string('categoria')->nullable(); // Categoría del producto

        $table->foreignId('sucursal_id')->constrained('sucursales');
        $table->foreignId('cocinero_id')->nullable()->constrained('users');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
