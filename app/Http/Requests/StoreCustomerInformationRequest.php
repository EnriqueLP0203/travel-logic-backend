<?php

namespace App\Http\Requests;

use App\Rules\NumericPhone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreCustomerInformationRequest extends FormRequest
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
        $sameAsContact = $this->boolean('billing_same_as_contact');

        return [
            'username' => ['required', 'string', 'max:100', 'unique:customer_information,username'],
            'agency_name' => ['required', 'string', 'max:250'],
            'legal_name' => ['required', 'string', 'max:250'],
            'logo_url' => ['nullable', 'url', 'max:500'],
            'password' => ['required', 'confirmed', Password::defaults()],

            'contact_person' => ['required', 'string', 'max:250'],
            'email' => ['required', 'email:rfc,dns', 'max:150', 'unique:customer_information,email'],
            'country' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'phone' => ['nullable', new NumericPhone],
            'mobile' => ['nullable', new NumericPhone],

            'billing_manager' => ['nullable', 'string', 'max:250'],
            'billing_address' => ['required', 'string', 'max:250'],
            'billing_zip_code' => ['required', 'string', 'max:20'],
            'billing_phone_2' => ['nullable', new NumericPhone],
            'billing_tax_id' => ['required', 'string', 'max:100'],
            'billing_same_as_contact' => ['sometimes', 'boolean'],

            'billing_email' => [Rule::requiredIf(! $sameAsContact), 'nullable', 'email:rfc,dns', 'max:150'],
            'billing_country' => [Rule::requiredIf(! $sameAsContact), 'nullable', 'string', 'max:100'],
            'billing_state' => [Rule::requiredIf(! $sameAsContact), 'nullable', 'string', 'max:100'],
            'billing_city' => [Rule::requiredIf(! $sameAsContact), 'nullable', 'string', 'max:100'],
            'billing_phone' => [Rule::requiredIf(! $sameAsContact), 'nullable', new NumericPhone],
            'billing_mobile' => [Rule::requiredIf(! $sameAsContact), 'nullable', new NumericPhone],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.unique' => 'Este nombre de usuario ya está registrado.',
            'agency_name.required' => 'El nombre de la agencia es obligatorio.',
            'legal_name.required' => 'El nombre fiscal es obligatorio.',
            'logo_url.url' => 'El enlace del logotipo debe ser una URL válida.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'contact_person.required' => 'La persona de contacto es obligatoria.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'country.required' => 'El país es obligatorio.',
            'state.required' => 'El estado es obligatorio.',
            'city.required' => 'La ciudad es obligatoria.',
            'billing_address.required' => 'La dirección de facturación es obligatoria.',
            'billing_zip_code.required' => 'El código postal es obligatorio.',
            'billing_tax_id.required' => 'El código fiscal es obligatorio.',
            'billing_email.required' => 'El correo de facturación es obligatorio.',
            'billing_country.required' => 'El país de facturación es obligatorio.',
            'billing_state.required' => 'El estado de facturación es obligatorio.',
            'billing_city.required' => 'La ciudad de facturación es obligatorio.',
            'billing_phone.required' => 'El teléfono de facturación es obligatorio.',
            'billing_mobile.required' => 'El teléfono móvil de facturación es obligatorio.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $payload = [
            'billing_same_as_contact' => $this->boolean('billing_same_as_contact'),
        ];

        foreach (['phone', 'mobile', 'billing_phone', 'billing_phone_2', 'billing_mobile'] as $field) {
            if ($this->has($field)) {
                $payload[$field] = NumericPhone::normalize($this->input($field));
            }
        }

        $this->merge($payload);
    }
}
