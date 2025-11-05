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
        // Adicionar configuração para URL do trajeto do Google Earth
        \App\Models\SiteSetting::create([
            'key' => 'google_earth_route',
            'value' => null,
            'type' => 'text',
            'description' => 'URL do trajeto do evento no Google Earth'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\SiteSetting::where('key', 'google_earth_route')->delete();
    }
};
