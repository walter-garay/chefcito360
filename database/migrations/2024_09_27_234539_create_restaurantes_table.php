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
        /* PERFIL DE LA EMPRESA */
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('ruc');
            $table->string('logo');
            //$table->string('celular')->nullable();
            $table->string('link_web')->nullable();
            //$table->string('whastapp')->nullable();
            $table->string('email')->nullable();
            $table->string('nombre_facebook')->nullable();
            $table->string('nombre_instagram')->nullable();
            $table->string('nombre_twitter')->nullable();
            $table->string('nombre_youtube')->nullable();
            $table->string('nombre_tiktok')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurantes');
    }
};
