<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
            'is_accepted' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $hasDecision = $this->has('is_accepted') && $this->input('is_accepted') !== '';

        $this->merge([
            'is_reviewed' => $hasDecision,
            'is_accepted' => $hasDecision ? $this->boolean('is_accepted') : null,
        ]);
    }
}
