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
        // Adicionar configuração para código KML do trajeto
        \App\Models\SiteSetting::create([
            'key' => 'kml_route_code',
            'value' => null,
            'type' => 'text',
            'description' => 'Código KML do trajeto do evento'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \App\Models\SiteSetting::where('key', 'kml_route_code')->delete();
    }
};
