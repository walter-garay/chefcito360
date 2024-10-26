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
        Schema::create('sucursales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('tipo_sucursal',['central','secundaria']);
            $table->integer('celular')->nullable();
            $table->string('direccion');
            $table->integer('whatsapp')->nullable();
            $table->string('serie');
            $table->tinyInteger('suc_estado')->unsigned()->default(1);
            //$table->unsignedBigInteger('gerente_id');
            //$table->foreign('gerente_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sucursales');
    }
};
