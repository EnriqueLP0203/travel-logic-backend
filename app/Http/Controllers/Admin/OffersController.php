<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOfferRequest;
use App\Http\Requests\Admin\UpdateOfferRequest;
use App\Models\Offer;
use App\Services\OfferImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OffersController extends Controller
{
    /**
     * Listado de ofertas promocionales para el panel admin.
     */
    public function index(): View
    {
        $offers = Offer::orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.offers.index', compact('offers'));
    }

    /**
     * Guarda una nueva oferta promocional.
     */
    public function store(StoreOfferRequest $request, OfferImageService $images): RedirectResponse
    {
        $data = $request->validated();
        $imageData = $images->store($request->file('image'), $data['name']);

        Offer::create([
            'name' => $data['name'],
            'link' => $data['link'] ?? null,
            'active' => $request->boolean('active'),
            'sort_order' => (int) ($data['sort_order'] ?? 0),
            ...$imageData,
        ]);

        return redirect()
            ->route('admin.offers.index')
            ->with('success', 'Oferta creada correctamente.');
    }

    /**
     * Actualiza una oferta promocional existente.
     */
    public function update(
        UpdateOfferRequest $request,
        Offer $offer,
        OfferImageService $images
    ): RedirectResponse {
        $data = $request->validated();
        $payload = [
            'name' => $data['name'],
            'link' => $data['link'] ?? null,
            'active' => $request->boolean('active'),
            'sort_order' => (int) ($data['sort_order'] ?? 0),
        ];

        if ($request->hasFile('image')) {
            $oldCompound = $offer->img_compound_name;
            $payload = [
                ...$payload,
                ...$images->store($request->file('image'), $data['name']),
            ];
            $images->delete($oldCompound);
        }

        $offer->update($payload);

        return redirect()
            ->route('admin.offers.index')
            ->with('success', 'Oferta actualizada correctamente.');
    }

    /**
     * Elimina una oferta y su imagen del storage.
     */
    public function destroy(Offer $offer, OfferImageService $images): RedirectResponse
    {
        $images->delete($offer->img_compound_name);
        $offer->delete();

        return redirect()
            ->route('admin.offers.index')
            ->with('success', 'Oferta eliminada correctamente.');
    }
}
