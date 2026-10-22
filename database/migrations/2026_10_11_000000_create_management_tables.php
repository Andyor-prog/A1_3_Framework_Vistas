<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('telefono', 30)->nullable();
            $table->string('direccion')->nullable();
            $table->timestamps();
        });

        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->cascadeOnDelete();
            $table->string('estado')->default('activo');
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('carrito_detalles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carrito_id')->constrained('carritos')->cascadeOnDelete();
            $table->string('producto');
            $table->unsignedInteger('cantidad')->default(1);
            $table->decimal('precio_unitario', 10, 2);
            $table->timestamps();
        });

        Schema::create('historial_transacciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->nullOnDelete();
            $table->foreignId('carrito_id')->nullable()->constrained('carritos')->nullOnDelete();
            $table->string('tipo');
            $table->string('estado')->default('pendiente');
            $table->decimal('monto', 10, 2);
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_transacciones');
        Schema::dropIfExists('carrito_detalles');
        Schema::dropIfExists('carritos');
        Schema::dropIfExists('usuarios');
    }
};