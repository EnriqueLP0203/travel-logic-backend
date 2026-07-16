<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAccommodationTypeRequest;
use App\Http\Requests\Admin\UpdateAccommodationTypeRequest;
use App\Models\AccommodationType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AccommodationTypeController extends Controller
{
    /**
     * Listado de tipos de alojamiento.
     */
    public function index(): View
    {
        $types = AccommodationType::query()
            ->with(['translations' => fn ($q) => $q->where('language_code', 'es-MX')])
            ->orderBy('id')
            ->paginate(15);

        return view('admin.accommodation-types.index', compact('types'));
    }

    /**
     * Guarda un nuevo tipo de alojamiento.
     */
    public function store(StoreAccommodationTypeRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $now = now();

        DB::transaction(function () use ($data, $now) {
            $type = AccommodationType::create([
                'icon_class' => $data['icon_class'] ?? null,
                'active' => $data['active'] ?? true,
                'created_at' => $now,
                'updated_at' => $now,
                'created_by' => 0,
                'updated_by' => 0,
            ]);

            $type->translations()->create([
                'language_code' => 'es-MX',
                'name' => $data['name'],
            ]);
        });

        return redirect()
            ->route('admin.accommodation-types.index')
            ->with('success', 'Tipo de alojamiento creado correctamente.');
    }

    /**
     * Actualiza un tipo de alojamiento existente.
     */
    public function update(
        UpdateAccommodationTypeRequest $request,
        AccommodationType $accommodationType
    ): RedirectResponse {
        $data = $request->validated();

        DB::transaction(function () use ($data, $accommodationType) {
            $accommodationType->update([
                'icon_class' => $data['icon_class'] ?? null,
                'active' => $data['active'] ?? true,
                'updated_at' => now(),
                'updated_by' => 0,
            ]);

            $translation = $accommodationType->translations()
                ->where('language_code', 'es-MX')
                ->first();

            if ($translation) {
                $translation->update(['name' => $data['name']]);
            } else {
                $accommodationType->translations()->create([
                    'language_code' => 'es-MX',
                    'name' => $data['name'],
                ]);
            }
        });

        return redirect()
            ->route('admin.accommodation-types.index')
            ->with('success', 'Tipo de alojamiento actualizado correctamente.');
    }

    /**
     * Elimina un tipo de alojamiento.
     */
    public function destroy(AccommodationType $accommodationType): RedirectResponse
    {
        if ($accommodationType->hotels()->exists()) {
            return redirect()
                ->route('admin.accommodation-types.index')
                ->with('error', 'No se puede eliminar porque tiene hoteles asociados.');
        }

        $accommodationType->delete();

        return redirect()
            ->route('admin.accommodation-types.index')
            ->with('success', 'Tipo de alojamiento eliminado correctamente.');
    }
}
