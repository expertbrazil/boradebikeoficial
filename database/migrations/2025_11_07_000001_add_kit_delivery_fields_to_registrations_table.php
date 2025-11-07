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
        Schema::table('registrations', function (Blueprint $table) {
            $table->timestamp('kit_delivered_at')->nullable()->after('is_active');
            $table->decimal('food_kg', 8, 2)->nullable()->after('kit_delivered_at');
            $table->decimal('food_liters', 8, 2)->nullable()->after('food_kg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['kit_delivered_at', 'food_kg', 'food_liters']);
        });
    }
};

