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
            // Remove índice unique existente se houver
            $table->dropUnique(['cpf']);
            
            // Altera o tamanho do campo CPF para 11 (apenas dígitos, sem formatação)
            $table->string('cpf', 11)->change();
            
            // Adiciona constraint unique novamente
            $table->unique('cpf');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Remove o índice unique
            $table->dropUnique(['cpf']);
            
            // Reverte o tamanho do campo para 14
            $table->string('cpf', 14)->change();
            
            // Restaura o índice unique antigo
            $table->unique('cpf');
        });
    }
};

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Remove o índice unique
            $table->dropUnique(['cpf']);
            
            // Reverte o tamanho do campo para 14
            $table->string('cpf', 14)->change();
            
            // Restaura o índice unique antigo
            $table->unique('cpf');
        });
    }
};
