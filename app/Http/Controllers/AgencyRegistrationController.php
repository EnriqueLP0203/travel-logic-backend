<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerInformationRequest;
use App\Models\CustomerInformation;
use Illuminate\Http\RedirectResponse;

class AgencyRegistrationController extends Controller
{
    /**
     * Guarda una solicitud de registro de agencia.
     */
    public function store(StoreCustomerInformationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $sameAsContact = $request->boolean('billing_same_as_contact');

        CustomerInformation::create([
            'username' => $data['username'],
            'agency_name' => $data['agency_name'],
            'legal_name' => $data['legal_name'],
            'logo_url' => $data['logo_url'] ?? null,
            'password' => $data['password'],
            'contact_person' => $data['contact_person'],
            'email' => $data['email'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'phone' => $data['phone'] ?? null,
            'mobile' => $data['mobile'] ?? null,
            'billing_manager' => $data['billing_manager'] ?? $data['contact_person'],
            'billing_address' => $data['billing_address'],
            'billing_zip_code' => $data['billing_zip_code'],
            'billing_phone_2' => $data['billing_phone_2'] ?? null,
            'billing_tax_id' => $data['billing_tax_id'],
            'billing_same_as_contact' => $sameAsContact,
            'billing_email' => $sameAsContact ? $data['email'] : ($data['billing_email'] ?? null),
            'billing_country' => $sameAsContact ? $data['country'] : ($data['billing_country'] ?? null),
            'billing_state' => $sameAsContact ? $data['state'] : ($data['billing_state'] ?? null),
            'billing_city' => $sameAsContact ? $data['city'] : ($data['billing_city'] ?? null),
            'billing_phone' => $sameAsContact ? ($data['phone'] ?? null) : ($data['billing_phone'] ?? null),
            'billing_mobile' => $sameAsContact ? ($data['mobile'] ?? null) : ($data['billing_mobile'] ?? null),
            'is_reviewed' => false,
            'is_accepted' => null,
            'active' => true,
            'created_by' => 0,
            'updated_by' => 0,
        ]);

        return redirect()
            ->route('register-agency')
            ->with('success', 'Tu solicitud de registro fue enviada correctamente. Te contactaremos cuando sea revisada.');
    }
}
