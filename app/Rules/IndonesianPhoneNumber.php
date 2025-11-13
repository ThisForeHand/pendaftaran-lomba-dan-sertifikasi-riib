<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IndonesianPhoneNumber implements ValidationRule
{
    /**
     * Validate the attribute.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value === null || $value === '') {
            return;
        }

        $normalized = preg_replace('/[\s\-()]/', '', trim((string) $value));

        if ($normalized === null || ! preg_match('/^(?:\+?62|0)[0-9]{8,15}$/', $normalized)) {
            $fail('Format ' . $this->attributeLabel($attribute) . ' harus diawali dengan 0 atau +62 dan hanya berisi angka.');
        }
    }

    private function attributeLabel(string $attribute): string
    {
        return str_replace(['_', '.'], ' ', $attribute);
    }
}
