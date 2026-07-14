<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
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
}
