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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('cpf', 14)->unique();
            $table->string('email');
            $table->string('phone');
            $table->date('birth_date');
            $table->enum('gender', ['masculino', 'feminino', 'outro']);
            $table->enum('shirt_size', ['PP', 'P', 'M', 'G', 'GG', 'XG']);
            $table->string('zip_code', 9);
            $table->string('address');
            $table->string('number');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state', 2);
            $table->string('country')->default('Brasil');
            $table->boolean('has_kit')->default(false);
            $table->boolean('terms_accepted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};

            $table->string('country')->default('Brasil');
            $table->boolean('has_kit')->default(false);
            $table->boolean('terms_accepted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
