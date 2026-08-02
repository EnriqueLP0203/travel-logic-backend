<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NumericPhone implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! preg_match('/^\d{7,15}$/', $value)) {
            $fail('El teléfono debe tener entre 7 y 15 dígitos numéricos, sin espacios.');
        }
    }

    public static function normalize(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        if ($value === '') {
            return '';
        }

        return preg_replace('/\D/', '', (string) $value);
    }
}
