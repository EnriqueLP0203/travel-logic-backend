<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateHotelsRequest extends FormRequest
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
            'slug' => ['required', 'string', 'max:150'],
            'destination_id' => ['nullable', 'integer', 'exists:destinations,id'],
            'star_category' => ['nullable', 'integer', 'min:1', 'max:5'],
            'address' => ['nullable', 'string', 'max:500'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:250'],
            'website' => ['nullable', 'string', 'max:250'],
            'star_rating' => ['nullable', 'numeric', 'min:0', 'max:9.9'],
            'price_range' => ['nullable', 'string', 'max:50'],
            'featured' => ['sometimes', 'boolean'],
            'is_published' => ['sometimes', 'boolean'],
            'active' => ['sometimes', 'boolean'],
            'hotel_detail_id' => ['nullable', 'string', 'max:50'],
            'hotel_code' => ['nullable', 'string', 'max:50'],
            'supplier_id' => ['nullable', 'string', 'max:50'],
            'supplier_name' => ['nullable', 'string', 'max:150'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'amenities' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'hotel_group_ids' => ['nullable', 'array'],
            'hotel_group_ids.*' => ['integer', 'exists:hotel_groups,id'],
            'accommodation_type_ids' => ['nullable', 'array'],
            'accommodation_type_ids.*' => ['integer', 'exists:accommodation_types,id'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
            'remove_gallery_ids' => ['nullable', 'array'],
            'remove_gallery_ids.*' => ['integer', 'exists:hotel_gallery,id'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'slug.required' => 'El slug es obligatorio.',
            'destination_id.exists' => 'El destino seleccionado no es válido.',
            'email.email' => 'El correo no es válido.',
            'image.image' => 'El archivo principal debe ser una imagen.',
            'gallery.*.image' => 'Cada archivo de galería debe ser una imagen.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $slug = $this->input('slug');
        if (empty($slug) && $this->filled('name')) {
            $slug = Str::slug((string) $this->input('name'));
        }

        $this->merge([
            'featured' => $this->boolean('featured'),
            'is_published' => $this->boolean('is_published'),
            'active' => $this->boolean('active'),
            'slug' => $slug ?: null,
            'destination_id' => $this->filled('destination_id') ? $this->input('destination_id') : null,
            'address' => $this->filled('address') ? $this->input('address') : null,
            'postal_code' => $this->filled('postal_code') ? $this->input('postal_code') : null,
            'latitude' => $this->filled('latitude') ? $this->input('latitude') : null,
            'longitude' => $this->filled('longitude') ? $this->input('longitude') : null,
        ]);
    }
}
