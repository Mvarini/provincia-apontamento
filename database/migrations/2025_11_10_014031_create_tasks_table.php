<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('machine_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->integer('production_minute')->nullable(); //Produção em minutos
            $table->integer('piece_second')->nullable(); //Peças por segundo
            $table->integer('amount_carried')->nullable(); // Quantidade realizada
            $table->integer('expected_quantity')->nullable(); // Quantidade prevista
            $table->decimal('productivity', 10, 2)->nullable(); // Produtividade %
            $table->integer('discard_quantity')->nullable(); // Quantidade descartada
            $table->string('batch_number'); // Número do lote
            $table->integer('missing_quantity')->nullable(); // Quantidade em falta
            $table->decimal('script_time', 10, 2)->nullable(); // Tempo de roteiro
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
