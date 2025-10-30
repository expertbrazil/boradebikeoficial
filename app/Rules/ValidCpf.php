<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidCpf implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $value);
        
        // Verifica se tem 11 dígitos
        if (strlen($cpf) != 11) {
            $fail('O CPF deve conter 11 dígitos.');
            return;
        }
        
        // Verifica se todos os dígitos são iguais (CPFs inválidos)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $fail('O CPF informado é inválido.');
            return;
        }
        
        // Valida primeiro dígito verificador
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $cpf[$i] * (10 - $i);
        }
        $remainder = ($sum * 10) % 11;
        if ($remainder == 10 || $remainder == 11) {
            $remainder = 0;
        }
        if ($remainder != (int) $cpf[9]) {
            $fail('O CPF informado é inválido.');
            return;
        }
        
        // Valida segundo dígito verificador
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += (int) $cpf[$i] * (11 - $i);
        }
        $remainder = ($sum * 10) % 11;
        if ($remainder == 10 || $remainder == 11) {
            $remainder = 0;
        }
        if ($remainder != (int) $cpf[10]) {
            $fail('O CPF informado é inválido.');
        }
    }
}

        if (strlen($cpf) != 11) {
            $fail('O CPF deve conter 11 dígitos.');
            return;
        }
        
        // Verifica se todos os dígitos são iguais (CPFs inválidos)
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            $fail('O CPF informado é inválido.');
            return;
        }
        
        // Valida primeiro dígito verificador
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int) $cpf[$i] * (10 - $i);
        }
        $remainder = ($sum * 10) % 11;
        if ($remainder == 10 || $remainder == 11) {
            $remainder = 0;
        }
        if ($remainder != (int) $cpf[9]) {
            $fail('O CPF informado é inválido.');
            return;
        }
        
        // Valida segundo dígito verificador
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += (int) $cpf[$i] * (11 - $i);
        }
        $remainder = ($sum * 10) % 11;
        if ($remainder == 10 || $remainder == 11) {
            $remainder = 0;
        }
        if ($remainder != (int) $cpf[10]) {
            $fail('O CPF informado é inválido.');
        }
    }
}
