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
            // Adicionar campos que faltam
            $table->boolean('accepted_regulations')->default(false)->after('terms_accepted');
            $table->boolean('is_active')->default(true)->after('accepted_regulations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['accepted_regulations', 'is_active']);
        });
    }
};

        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn(['accepted_regulations', 'is_active']);
        });
    }
};
