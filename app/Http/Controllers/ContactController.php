<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInterestedClientRequest;
use App\Models\InterestedClient;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    /**
     * Guarda un cliente interesado desde el formulario de contacto.
     */
    public function store(StoreInterestedClientRequest $request): RedirectResponse
    {
        InterestedClient::create($request->only('name', 'email', 'phone'));

        return back()
            ->with('success', 'Tu mensaje fue enviado correctamente. Te contactaremos pronto.');
    }
}
