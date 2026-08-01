<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerInformationRequest extends FormRequest
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
            'is_reviewed' => ['required', 'boolean'],
            'is_accepted' => [
                'nullable',
                'boolean',
                Rule::requiredIf(fn () => $this->boolean('is_reviewed')),
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'is_reviewed.required' => 'Indica si el registro fue revisado.',
            'is_accepted.required' => 'Selecciona si el registro fue aceptado o rechazado.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $isReviewed = $this->boolean('is_reviewed');

        $payload = [
            'is_reviewed' => $isReviewed,
        ];

        if (! $isReviewed) {
            $payload['is_accepted'] = null;
        } elseif ($this->has('is_accepted') && $this->input('is_accepted') !== '') {
            $payload['is_accepted'] = $this->boolean('is_accepted');
        }

        $this->merge($payload);
    }
}
