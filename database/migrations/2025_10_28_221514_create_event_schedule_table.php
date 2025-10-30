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
        Schema::create('event_schedule', function (Blueprint $table) {
            $table->id();
            $table->time('time'); // Horário do evento (ex: 07:00:00)
            $table->string('title'); // Título do evento
            $table->text('description')->nullable(); // Descrição detalhada
            $table->integer('sort_order')->default(0); // Ordem de exibição
            $table->boolean('is_active')->default(true); // Se está ativo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_schedule');
    }
};
