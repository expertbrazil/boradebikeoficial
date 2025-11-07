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
            if (Schema::hasColumn('registrations', 'food_quantity')) {
                $table->dropColumn('food_quantity');
            }

            if (!Schema::hasColumn('registrations', 'food_kg')) {
                $table->decimal('food_kg', 8, 2)->nullable()->after('kit_delivered_at');
            }

            if (!Schema::hasColumn('registrations', 'food_liters')) {
                $table->decimal('food_liters', 8, 2)->nullable()->after('food_kg');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            if (Schema::hasColumn('registrations', 'food_liters')) {
                $table->dropColumn('food_liters');
            }

            if (Schema::hasColumn('registrations', 'food_kg')) {
                $table->dropColumn('food_kg');
            }

            if (!Schema::hasColumn('registrations', 'food_quantity')) {
                $table->unsignedInteger('food_quantity')->nullable()->after('kit_delivered_at');
            }
        });
    }
};

