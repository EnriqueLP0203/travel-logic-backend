<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterestedClientRequest extends FormRequest
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
            'is_attended' => ['required', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'is_attended.required' => 'Indica si el cliente ya fue atendido.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_attended' => $this->boolean('is_attended'),
        ]);
    }
}
