<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateInterestedClientRequest;
use App\Models\InterestedClient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InterestedClientController extends Controller
{
    /**
     * Listado de clientes interesados del formulario de contacto.
     */
    public function index(Request $request): View
    {
        $status = $request->input('status');

        $registros = InterestedClient::query()
            ->when($status === 'pending', fn ($q) => $q->pending())
            ->when($status === 'attended', fn ($q) => $q->attended())
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        $total = InterestedClient::count();
        $pendingCount = InterestedClient::pending()->count();
        $attendedCount = InterestedClient::attended()->count();

        return view('admin.interested_clients.index', compact(
            'registros',
            'total',
            'pendingCount',
            'attendedCount',
            'status',
        ));
    }

    /**
     * Actualiza el estado de atención de un cliente interesado.
     */
    public function update(
        UpdateInterestedClientRequest $request,
        InterestedClient $interestedClient
    ): RedirectResponse {
        $interestedClient->update([
            'is_attended' => $request->boolean('is_attended'),
        ]);

        return redirect()
            ->route('admin.interested-clients.index', $request->only('status'))
            ->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Elimina un cliente interesado.
     */
    public function destroy(Request $request, InterestedClient $interestedClient): RedirectResponse
    {
        $interestedClient->delete();

        return redirect()
            ->route('admin.interested-clients.index', $request->only('status'))
            ->with('success', 'Cliente eliminado correctamente.');
    }
}
