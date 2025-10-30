<?php

namespace App\Rules;

use App\Models\Registration;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueCpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove caracteres não numéricos (pontos e hífen)
        $cpfClean = preg_replace('/[^0-9]/', '', $value);
        
        // Verifica se o CPF (apenas dígitos) já existe no banco
        if (Registration::where('cpf', $cpfClean)->exists()) {
            $fail('Este CPF já está cadastrado.');
        }
    }
}

        // Verifica se o CPF (apenas dígitos) já existe no banco
        if (Registration::where('cpf', $cpfClean)->exists()) {
            $fail('Este CPF já está cadastrado.');
        }
    }
}
