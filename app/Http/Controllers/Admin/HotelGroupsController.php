<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHotelGroupsRequest;
use App\Http\Requests\Admin\UpdateHotelGroupsRequest;
use App\Models\HotelGroup;
use App\Services\HotelGroupImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HotelGroupsController extends Controller
{
    /**
     * Listado de grupos de hotel.
     */
    public function index(): View
    {
        $hotelGroups = HotelGroup::query()
            ->with(['translations' => fn ($q) => $q->where('language_code', 'es-MX')])
            ->orderBy('id')
            ->paginate(15);

        return view('admin.hotel-groups.index', compact('hotelGroups'));
    }

    /**
     * Guarda un nuevo grupo de hotel.
     */
    public function store(
        StoreHotelGroupsRequest $request,
        HotelGroupImageService $images
    ): RedirectResponse {
        $data = $request->validated();
        $now = now();

        $imageData = [
            'img_original_name' => null,
            'img_new_name' => null,
            'img_compound_name' => null,
            'img_extension' => null,
            'img_hash_name' => null,
            'img_file_size' => 0,
        ];

        if ($request->hasFile('image')) {
            $imageData = $images->store($request->file('image'), $data['name']);
        }

        DB::transaction(function () use ($data, $now, $imageData) {
            $hotelGroup = HotelGroup::create([
                'active' => $data['active'] ?? true,
                'created_at' => $now,
                'updated_at' => $now,
                'created_by' => 0,
                'updated_by' => 0,
                ...$imageData,
            ]);

            $hotelGroup->translations()->create([
                'language_code' => 'es-MX',
                'name' => $data['name'],
            ]);
        });

        return redirect()
            ->route('admin.hotel-groups.index')
            ->with('success', 'Grupo de hotel creado correctamente.');
    }

    /**
     * Actualiza un grupo de hotel existente.
     */
    public function update(
        UpdateHotelGroupsRequest $request,
        HotelGroup $hotelGroup,
        HotelGroupImageService $images
    ): RedirectResponse {
        $data = $request->validated();

        DB::transaction(function () use ($data, $hotelGroup, $request, $images) {
            $payload = [
                'active' => $data['active'] ?? true,
                'updated_at' => now(),
                'updated_by' => 0,
            ];

            if ($request->hasFile('image')) {
                $oldCompound = $hotelGroup->img_compound_name;
                $payload = [
                    ...$payload,
                    ...$images->store($request->file('image'), $data['name']),
                ];
                $images->delete($oldCompound);
            }

            $hotelGroup->update($payload);

            $translation = $hotelGroup->translations()
                ->where('language_code', 'es-MX')
                ->first();

            if ($translation) {
                $translation->update(['name' => $data['name']]);
            } else {
                $hotelGroup->translations()->create([
                    'language_code' => 'es-MX',
                    'name' => $data['name'],
                ]);
            }
        });

        return redirect()
            ->route('admin.hotel-groups.index')
            ->with('success', 'Grupo de hotel actualizado correctamente.');
    }

    /**
     * Elimina un grupo de hotel.
     */
    public function destroy(
        HotelGroup $hotelGroup,
        HotelGroupImageService $images
    ): RedirectResponse {
        if ($hotelGroup->hotels()->exists()) {
            return redirect()
                ->route('admin.hotel-groups.index')
                ->with('error', 'No se puede eliminar porque tiene hoteles asociados.');
        }

        $images->delete($hotelGroup->img_compound_name);
        $hotelGroup->delete();

        return redirect()
            ->route('admin.hotel-groups.index')
            ->with('success', 'Grupo de hotel eliminado correctamente.');
    }
}
