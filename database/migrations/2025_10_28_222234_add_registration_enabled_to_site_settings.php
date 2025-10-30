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
        // Adicionar configuração para habilitar/desabilitar inscrições
        \App\Models\SiteSetting::create([
            'key' => 'registration_enabled',
            'value' => 'true',
            'type' => 'boolean',
            'description' => 'Habilitar/desabilitar formulário de inscrições'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\SiteSetting::where('key', 'registration_enabled')->delete();
    }
};
