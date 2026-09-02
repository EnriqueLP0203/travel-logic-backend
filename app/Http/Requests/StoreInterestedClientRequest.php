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
            'agency_name'  => ['required', 'string', 'max:250'],
            'agent_name'   => ['required', 'string', 'max:250'],
            'email'        => ['required', 'email:rfc,dns', 'max:150'],
            'phone'        => ['required', new NumericPhone],
            'country'      => ['required', 'string', 'max:250'],
            'city'         => ['required', 'string', 'max:250'],
            'service_type' => ['required', 'string', 'max:250'],
            'terms'        => ['accepted'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'agency_name.required'  => 'El nombre de la agencia es obligatorio.',
            'agency_name.max'       => 'El nombre de la agencia no puede superar 250 caracteres.',
            'agent_name.required'   => 'El nombre del agente es obligatorio.',
            'agent_name.max'        => 'El nombre del agente no puede superar 250 caracteres.',
            'email.required'        => 'El correo electrónico es obligatorio.',
            'email.email'           => 'Ingresa un correo electrónico válido.',
            'email.max'             => 'El correo no puede superar 150 caracteres.',
            'phone.required'        => 'El teléfono es obligatorio.',
            'country.required'      => 'El país es obligatorio.',
            'city.required'         => 'La ciudad es obligatoria.',
            'service_type.required' => 'El tipo de servicio es obligatorio.',
            'terms.accepted'        => 'Debes aceptar los términos y condiciones.',
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
