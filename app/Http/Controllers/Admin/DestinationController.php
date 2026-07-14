<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDestinationRequest;
use App\Models\Destination;
use App\Services\DestinationImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DestinationController extends Controller
{
    /**
     * Listado de destinos para el panel admin.
     */
    public function index(): View
    {
        $destinos = Destination::orderBy('city')
            ->paginate(15);

        return view('admin.destinations.index', compact('destinos'));
    }

    /**
     * Guarda un nuevo destino.
     */
    public function store(StoreDestinationRequest $request, DestinationImageService $images): RedirectResponse
    {
        $data = $request->validated();

        $imageData = [
            'img_original_name' => null,
            'img_new_name' => null,
            'img_compound_name' => null,
            'img_extension' => null,
            'img_hash_name' => null,
            'img_file_size' => 0,
        ];

        if ($request->hasFile('image')) {
            $imageData = $images->store($request->file('image'), $data['city']);
        }

        Destination::create([
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'slug' => $this->uniqueSlug($data['city']),
            'active' => $request->boolean('active'),
            'created_by' => 0,
            'updated_by' => 0,
            ...$imageData,
        ]);

        return redirect()
            ->route('admin.destinations.index')
            ->with('success', 'Destino creado correctamente.');
    }

    private function uniqueSlug(string $city): string
    {
        $base = Str::slug($city) ?: 'destino';
        $slug = $base;
        $suffix = 2;

        while (Destination::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
