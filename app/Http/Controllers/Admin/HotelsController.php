<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHotelsRequest;
use App\Http\Requests\Admin\UpdateHotelsRequest;
use App\Models\AccommodationType;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\HotelGallery;
use App\Models\HotelGroup;
use App\Services\HotelImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class HotelsController extends Controller
{
    /**
     * Listado de hoteles.
     */
    public function index(Request $request): View
    {
        $allowedSorts = [
            'name',
            'created_at',
            'updated_at',
            'star_category',
            'star_rating',
            'slug',
            'destination',
        ];

        $sort = in_array($request->input('sort'), $allowedSorts, true)
            ? $request->input('sort')
            : 'name';
        $dir = $request->input('dir') === 'desc' ? 'desc' : 'asc';

        $query = Hotel::query()
            ->with([
                'destination',
                'principalImage',
                'gallery' => fn ($q) => $q->where('is_principal', false)->where('active', true),
                'translations' => fn ($q) => $q->where('language_code', 'es-MX'),
                'hotelGroups',
                'accommodationTypes',
            ]);

        $query->when($request->filled('name'), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->input('name') . '%');
        });

        $query->when($request->boolean('without_groups'), function ($q) {
            $q->whereDoesntHave('hotelGroups');
        });

        $query->when($request->boolean('without_types'), function ($q) {
            $q->whereDoesntHave('accommodationTypes');
        });

        if ($request->filled('published') && in_array($request->input('published'), ['0', '1'], true)) {
            $query->where('is_published', (bool) $request->input('published'));
        }

        if ($request->filled('featured') && in_array($request->input('featured'), ['0', '1'], true)) {
            $query->where('featured', (bool) $request->input('featured'));
        }

        if ($sort === 'destination') {
            $query
                ->leftJoin('destinations', 'hotels.destination_id', '=', 'destinations.id')
                ->select('hotels.*')
                ->orderBy('destinations.city', $dir)
                ->orderBy('hotels.name', 'asc');
        } else {
            $query->orderBy($sort, $dir);
            if ($sort !== 'name') {
                $query->orderBy('name', 'asc');
            }
        }

        $hotels = $query->paginate(15)->withQueryString();

        $destinations = Destination::query()
            ->where('active', true)
            ->orderBy('city')
            ->get();

        $hotelGroups = HotelGroup::query()
            ->with(['translations' => fn ($q) => $q->where('language_code', 'es-MX')])
            ->where('active', true)
            ->orderBy('id')
            ->get();

        $accommodationTypes = AccommodationType::query()
            ->with(['translations' => fn ($q) => $q->where('language_code', 'es-MX')])
            ->where('active', true)
            ->orderBy('id')
            ->get();

        return view('admin.hotels.index', compact(
            'hotels',
            'destinations',
            'hotelGroups',
            'accommodationTypes'
        ));
    }

    /**
     * Guarda un nuevo hotel.
     */
    public function store(
        StoreHotelsRequest $request,
        HotelImageService $images
    ): RedirectResponse {
        $data = $request->validated();
        $now = now();
        $slug = $this->uniqueSlug($data['slug'] ?? $data['name']);

        DB::transaction(function () use ($data, $now, $slug, $request, $images) {
            $hotel = Hotel::create([
                'destination_id' => $data['destination_id'] ?? null,
                'name' => $data['name'],
                'star_category' => $data['star_category'] ?? 1,
                'address' => $data['address'] ?? null,
                'postal_code' => $data['postal_code'] ?? null,
                'latitude' => $data['latitude'] ?? null,
                'longitude' => $data['longitude'] ?? null,
                'phone' => $data['phone'] ?? null,
                'email' => $data['email'] ?? null,
                'website' => $data['website'] ?? null,
                'star_rating' => $data['star_rating'] ?? 0,
                'price_range' => $data['price_range'] ?? null,
                'featured' => $data['featured'] ?? false,
                'is_published' => $data['is_published'] ?? false,
                'hotel_detail_id' => $data['hotel_detail_id'] ?? null,
                'hotel_code' => $data['hotel_code'] ?? null,
                'supplier_id' => $data['supplier_id'] ?? null,
                'supplier_name' => $data['supplier_name'] ?? null,
                'slug' => $slug,
                'active' => $data['active'] ?? true,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $hotel->translations()->create([
                'language_code' => 'es-MX',
                'short_description' => $data['short_description'] ?? '',
                'description' => $data['description'] ?? '',
                'amenities' => $data['amenities'] ?? '',
                'meta_title' => $data['meta_title'] ?? '',
                'meta_description' => $data['meta_description'] ?? '',
                'meta_keywords' => $data['meta_keywords'] ?? '',
            ]);

            $hotel->hotelGroups()->sync($data['hotel_group_ids'] ?? []);
            $hotel->accommodationTypes()->sync($data['accommodation_type_ids'] ?? []);

            if ($request->hasFile('image')) {
                $this->createGalleryImage(
                    $hotel,
                    $images->store($request->file('image'), $hotel->name),
                    true,
                    $now
                );
            }

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $this->createGalleryImage(
                        $hotel,
                        $images->store($file, $hotel->name),
                        false,
                        $now
                    );
                }
            }
        });

        return redirect()
            ->route('admin.hotels.index')
            ->with('success', 'Hotel creado correctamente.');
    }

    /**
     * Actualiza un hotel existente.
     */
    public function update(
        UpdateHotelsRequest $request,
        Hotel $hotel,
        HotelImageService $images
    ): RedirectResponse {
        $data = $request->validated();
        $now = now();
        $slug = $this->uniqueSlug($data['slug'] ?? $data['name'], $hotel->id);

        DB::transaction(function () use ($data, $hotel, $request, $images, $slug, $now) {
            $hotel->update([
                'destination_id' => $data['destination_id'] ?? null,
                'name' => $data['name'],
                'star_category' => $data['star_category'] ?? 1,
                'address' => $data['address'] ?? null,
                'postal_code' => $data['postal_code'] ?? null,
                'latitude' => $data['latitude'] ?? null,
                'longitude' => $data['longitude'] ?? null,
                'phone' => $data['phone'] ?? null,
                'email' => $data['email'] ?? null,
                'website' => $data['website'] ?? null,
                'star_rating' => $data['star_rating'] ?? $hotel->star_rating,
                'price_range' => $data['price_range'] ?? null,
                'featured' => $data['featured'] ?? false,
                'is_published' => $data['is_published'] ?? false,
                'hotel_detail_id' => $data['hotel_detail_id'] ?? $hotel->hotel_detail_id,
                'hotel_code' => $data['hotel_code'] ?? $hotel->hotel_code,
                'supplier_id' => $data['supplier_id'] ?? $hotel->supplier_id,
                'supplier_name' => $data['supplier_name'] ?? $hotel->supplier_name,
                'slug' => $slug,
                'active' => $data['active'] ?? true,
                'updated_by' => 0,
                'updated_at' => $now,
            ]);

            $translation = $hotel->translations()
                ->where('language_code', 'es-MX')
                ->first();

            $translationPayload = [
                'short_description' => $data['short_description'] ?? '',
                'description' => $data['description'] ?? '',
                'amenities' => $data['amenities'] ?? '',
                'meta_title' => $data['meta_title'] ?? '',
                'meta_description' => $data['meta_description'] ?? '',
                'meta_keywords' => $data['meta_keywords'] ?? '',
            ];

            if ($translation) {
                $translation->update($translationPayload);
            } else {
                $hotel->translations()->create([
                    'language_code' => 'es-MX',
                    ...$translationPayload,
                ]);
            }

            $hotel->hotelGroups()->sync($data['hotel_group_ids'] ?? []);
            $hotel->accommodationTypes()->sync($data['accommodation_type_ids'] ?? []);

            if (! empty($data['remove_gallery_ids'])) {
                $toRemove = $hotel->gallery()
                    ->whereIn('id', $data['remove_gallery_ids'])
                    ->where('is_principal', false)
                    ->get();

                foreach ($toRemove as $galleryItem) {
                    $images->delete($galleryItem->compound_name);
                    $galleryItem->delete();
                }
            }

            if ($request->hasFile('image')) {
                $oldPrincipal = $hotel->principalImage;
                if ($oldPrincipal) {
                    $images->delete($oldPrincipal->compound_name);
                    $oldPrincipal->delete();
                }

                $this->createGalleryImage(
                    $hotel,
                    $images->store($request->file('image'), $hotel->name),
                    true,
                    $now
                );
            }

            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $file) {
                    $this->createGalleryImage(
                        $hotel,
                        $images->store($file, $hotel->name),
                        false,
                        $now
                    );
                }
            }
        });

        return redirect()
            ->route('admin.hotels.index')
            ->with('success', 'Hotel actualizado correctamente.');
    }

    /**
     * Elimina un hotel.
     */
    public function destroy(Hotel $hotel, HotelImageService $images): RedirectResponse
    {
        if ($hotel->reviews()->exists()) {
            return redirect()
                ->route('admin.hotels.index')
                ->with('error', 'No se puede eliminar porque tiene reseñas asociadas.');
        }

        $compoundNames = $hotel->gallery()->pluck('compound_name');
        $images->deleteMany($compoundNames);
        $hotel->delete();

        return redirect()
            ->route('admin.hotels.index')
            ->with('success', 'Hotel eliminado correctamente.');
    }

    /**
     * @param  array{
     *     original_name: string,
     *     new_name: string,
     *     compound_name: string,
     *     mime_type: string|null,
     *     extension: string,
     *     hash_name: string,
     *     file_size: int
     * }  $imageData
     */
    private function createGalleryImage(
        Hotel $hotel,
        array $imageData,
        bool $isPrincipal,
        $now
    ): HotelGallery {
        return $hotel->gallery()->create([
            'original_name' => $imageData['original_name'],
            'new_name' => $imageData['new_name'],
            'compound_name' => $imageData['compound_name'],
            'mime_type' => $imageData['mime_type'],
            'extension' => $imageData['extension'],
            'hash_name' => $imageData['hash_name'],
            'file_size' => $imageData['file_size'],
            'is_principal' => $isPrincipal,
            'active' => true,
            'created_by' => 0,
            'updated_by' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    private function uniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'hotel';
        $slug = $base;
        $suffix = 2;

        while (
            Hotel::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
