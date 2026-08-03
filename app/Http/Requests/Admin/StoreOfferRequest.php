<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'link' => ['nullable', 'string', 'max:2048', 'url'],
            'active' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:10240'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre de la oferta es obligatorio.',
            'link.url' => 'El enlace debe ser una URL válida.',
            'image.required' => 'La imagen es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser JPG, PNG o WEBP.',
            'image.max' => 'La imagen no debe superar los 10 MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $link = $this->input('link');

        $this->merge([
            'active' => $this->boolean('active'),
            'sort_order' => $this->input('sort_order', 0),
            'link' => filled($link) ? $link : null,
        ]);
    }
}
