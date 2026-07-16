<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAccommodationTypeRequest;
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
}
