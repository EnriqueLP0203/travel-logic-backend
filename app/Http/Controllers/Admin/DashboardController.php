<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccommodationType;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\HotelGroup;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Dashboard admin con KPIs del catálogo.
     */
    public function index(): View
    {
        $stats = [
            'hotels' => Hotel::count(),
            'destinations' => Destination::count(),
            'hotel_groups' => HotelGroup::count(),
            'accommodation_types' => AccommodationType::count(),
            'hotels_published' => Hotel::where('is_published', true)->count(),
            'hotels_featured' => Hotel::where('featured', true)->count(),
            'hotels_active' => Hotel::where('active', true)->count(),
            'hotels_without_groups' => Hotel::whereDoesntHave('hotelGroups')->count(),
            'hotels_without_types' => Hotel::whereDoesntHave('accommodationTypes')->count(),
            'hotels_unpublished' => Hotel::where('is_published', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
