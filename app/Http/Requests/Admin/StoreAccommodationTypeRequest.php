<?php

namespace App\Http\Requests\Admin;

use App\Services\LucideIconService;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccommodationTypeRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:50'],
            'icon_class' => [
                'nullable',
                'string',
                'max:255',
                function (string $attribute, mixed $value, \Closure $fail) {
                    if ($value === null || $value === '') {
                        return;
                    }

                    $icons = app(LucideIconService::class);
                    $normalized = $icons->normalize(is_string($value) ? $value : null);

                    if ($normalized === null || ! $icons->exists($normalized)) {
                        $fail('El icono Lucide indicado no existe.');
                    }
                },
            ],
            'active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no debe superar los 50 caracteres.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $icons = app(LucideIconService::class);

        $this->merge([
            'active' => $this->boolean('active'),
            'icon_class' => $icons->normalize($this->input('icon_class')),
        ]);
    }
}
