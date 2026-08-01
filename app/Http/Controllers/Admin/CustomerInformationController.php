<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateCustomerInformationRequest;
use App\Models\CustomerInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerInformationController extends Controller
{
    /**
     * Listado de solicitudes de registro de agencias.
     */
    public function index(Request $request): View
    {
        $status = $request->input('status');

        $registros = CustomerInformation::query()
            ->when($status === 'pending', fn ($q) => $q->pendingReview())
            ->when($status === 'accepted', fn ($q) => $q->accepted())
            ->when($status === 'rejected', fn ($q) => $q->rejected())
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

        $total = CustomerInformation::count();
        $pendingCount = CustomerInformation::pendingReview()->count();
        $acceptedCount = CustomerInformation::accepted()->count();
        $rejectedCount = CustomerInformation::rejected()->count();

        return view('admin.customer_information.index', compact(
            'registros',
            'total',
            'pendingCount',
            'acceptedCount',
            'rejectedCount',
            'status',
        ));
    }

    /**
     * Actualiza el estado de revisión de una solicitud.
     */
    public function update(
        UpdateCustomerInformationRequest $request,
        CustomerInformation $customerInformation
    ): RedirectResponse {
        $data = $request->validated();

        $customerInformation->update([
            'is_reviewed' => $data['is_reviewed'],
            'is_accepted' => $data['is_reviewed'] ? $data['is_accepted'] : null,
            'updated_by' => 0,
        ]);

        return redirect()
            ->route('admin.customer-information.index', $request->only('status'))
            ->with('success', 'Solicitud actualizada correctamente.');
    }

    /**
     * Elimina una solicitud de registro.
     */
    public function destroy(Request $request, CustomerInformation $customerInformation): RedirectResponse
    {
        $customerInformation->delete();

        return redirect()
            ->route('admin.customer-information.index', $request->only('status'))
            ->with('success', 'Solicitud eliminada correctamente.');
    }
}
