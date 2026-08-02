<?php

namespace App\Http\Requests;

use App\Rules\NumericPhone;
use Illuminate\Foundation\Http\FormRequest;

class StoreInterestedClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:250'],
            'email' => ['required', 'email:rfc,dns', 'max:150'],
            'phone' => ['required', new NumericPhone],
            'terms' => ['accepted'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede superar 250 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'email.max' => 'El correo no puede superar 150 caracteres.',
            'phone.required' => 'El teléfono es obligatorio.',
            'terms.accepted' => 'Debes aceptar los términos y condiciones.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('phone')) {
            $this->merge([
                'phone' => NumericPhone::normalize($this->input('phone')),
            ]);
        }
    }
}
