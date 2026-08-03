<?php

use App\Http\Controllers\Admin\AccommodationTypeController as AdminAccommodationTypeController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CustomerInformationController as AdminCustomerInformationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\HotelGroupsController as AdminHotelGroupsController;
use App\Http\Controllers\Admin\HotelsController as AdminHotelsController;
use App\Http\Controllers\Admin\InterestedClientController as AdminInterestedClientController;
use App\Http\Controllers\Admin\LucideIconController as AdminLucideIconController;
use App\Http\Controllers\Admin\OffersController as AdminOffersController;
use App\Http\Controllers\AgencyRegistrationController;
use App\Http\Controllers\ContactController;
use App\Models\AccommodationType;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\HotelGroup;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $destinations = Destination::where('active', true)
        ->orderBy('city')
        ->get();

    return view('home', compact('destinations'));
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/offers', function () {
    $featuredHotels = Hotel::where('active', true)
        ->where('is_published', true)
        ->where('featured', true)
        ->with(['destination', 'principalImage'])
        ->orderBy('star_rating', 'desc')
        ->get();

    $promotionalOffers = Offer::where('active', true)
        ->orderBy('sort_order')
        ->orderBy('id')
        ->get();

    return view('offers', compact('featuredHotels', 'promotionalOffers'));
})->name('offers');

Route::get('/register-agency', function () {
    return view('register-agency');
})->name('register-agency');

Route::post('/register-agency', [AgencyRegistrationController::class, 'store'])->name('register-agency.store');

Route::redirect('/billing', '/register-agency')->name('billing');

Route::get('/media/hotels/{filename}', function (string $filename) {
    $path = storage_path('travel_media/hotels/' . $filename);
    abort_unless(is_file($path), 404);

    return response()->file($path);
})->where('filename', '[A-Za-z0-9._-]+')->name('media.hotels');

Route::get('/media/destinations/{filename}', function (string $filename) {
    $path = storage_path('travel_media/destinations/' . $filename);
    abort_unless(is_file($path), 404);

    return response()->file($path);
})->where('filename', '[A-Za-z0-9._-]+')->name('media.destinations');

Route::get('/media/hotel-groups/{filename}', function (string $filename) {
    $path = storage_path('travel_media/hotel_groups/' . $filename);
    abort_unless(is_file($path), 404);

    return response()->file($path);
})->where('filename', '[A-Za-z0-9._-]+')->name('media.hotel-groups');

Route::get('/media/offers/{filename}', function (string $filename) {
    $path = storage_path('travel_media/offers/' . $filename);
    abort_unless(is_file($path), 404);

    return response()->file($path);
})->where('filename', '[A-Za-z0-9._-]+')->name('media.offers');

Route::get('/hotels', function (Request $request) {
    $hotels = Hotel::where('active', true)
        ->where('is_published', true)
        ->with(['destination', 'principalImage'])
        ->when($request->filled('destination_id'), function ($query) use ($request) {
            $query->where('destination_id', $request->input('destination_id'));
        })
        ->when($request->filled('hotel_group_id'), function ($query) use ($request) {
            $query->whereHas(
                'hotelGroups',
                fn ($q) => $q->where('hotel_groups.id', $request->integer('hotel_group_id'))
            );
        })
        ->when($request->filled('accommodation_type'), function ($query) use ($request) {
            $query->whereHas(
                'accommodationTypes',
                fn ($q) => $q->where('accommodation_types.id', $request->integer('accommodation_type'))
            );
        })
        ->when($request->input('star_category') !== null && $request->input('star_category') !== '', function ($query) use ($request) {
            $query->where('star_category', $request->input('star_category'));
        })
        ->when($request->filled('name'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        })
        ->orderBy('featured', 'desc')
        ->orderBy('star_rating', 'desc')
        ->paginate(30)
        ->withQueryString();

    $destinations = Destination::where('active', true)
        ->orderBy('city')
        ->get();

    $hotelGroups = HotelGroup::where('active', true)
        ->with(['translations' => fn ($q) => $q->where('language_code', 'es-MX')])
        ->orderBy('id')
        ->get();

    $accommodationTypes = AccommodationType::where('active', true)
        ->with(['translations' => fn ($q) => $q->where('language_code', 'es-MX')])
        ->orderBy('id')
        ->get();

    return view('hotels', compact('hotels', 'destinations', 'hotelGroups', 'accommodationTypes'));
})->name('hotels');

Route::get('/hotels/{slug}', function (string $slug) {
    $hotel = Hotel::where('slug', $slug)
        ->where('active', true)
        ->where('is_published', true)
        ->with([
            'destination',
            'translations' => fn ($q) => $q->where('language_code', 'es-MX'),
            'gallery' => fn ($q) => $q->where('active', true),
            'principalImage',
            'hotelGroups.translations' => fn ($q) => $q->where('language_code', 'es-MX'),
            'accommodationTypes.translations' => fn ($q) => $q->where('language_code', 'es-MX'),
        ])
        ->firstOrFail();

    return view('hotel_details', compact('hotel'));
})->name('hotel.show');

Route::get('/hotel_detail', function () {
    return view('hotel_detail');
})->name('hotel_detail');

Route::get('/auth-traveler', function () {
    $previous = url()->previous();

    if (! str_contains($previous, '/auth-traveler')) {
        session(['url.intended' => $previous]);
    }

    return view('auth-traveler');
})->name('auth-traveler');

Route::redirect('/admin-dashboard-auth', '/admin/login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->middleware('auth:admin')
        ->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/hotels', [AdminHotelsController::class, 'index'])->name('hotels.index');
        Route::post('/hotels', [AdminHotelsController::class, 'store'])->name('hotels.store');
        Route::put('/hotels/{hotel}', [AdminHotelsController::class, 'update'])->name('hotels.update');
        Route::delete('/hotels/{hotel}', [AdminHotelsController::class, 'destroy'])->name('hotels.destroy');
        Route::get('/destinations', [AdminDestinationController::class, 'index'])->name('destinations.index');
        Route::post('/destinations', [AdminDestinationController::class, 'store'])->name('destinations.store');
        Route::put('/destinations/{destination}', [AdminDestinationController::class, 'update'])->name('destinations.update');
        Route::delete('/destinations/{destination}', [AdminDestinationController::class, 'destroy'])->name('destinations.destroy');
        Route::get('/offers', [AdminOffersController::class, 'index'])->name('offers.index');
        Route::post('/offers', [AdminOffersController::class, 'store'])->name('offers.store');
        Route::put('/offers/{offer}', [AdminOffersController::class, 'update'])->name('offers.update');
        Route::delete('/offers/{offer}', [AdminOffersController::class, 'destroy'])->name('offers.destroy');
        Route::get('/hotel-groups', [AdminHotelGroupsController::class, 'index'])->name('hotel-groups.index');
        Route::post('/hotel-groups', [AdminHotelGroupsController::class, 'store'])->name('hotel-groups.store');
        Route::put('/hotel-groups/{hotel_group}', [AdminHotelGroupsController::class, 'update'])->name('hotel-groups.update');
        Route::delete('/hotel-groups/{hotel_group}', [AdminHotelGroupsController::class, 'destroy'])->name('hotel-groups.destroy');

        Route::get('/accommodation-types', [AdminAccommodationTypeController::class, 'index'])->name('accommodation-types.index');
        Route::post('/accommodation-types', [AdminAccommodationTypeController::class, 'store'])->name('accommodation-types.store');
        Route::put('/accommodation-types/{accommodation_type}', [AdminAccommodationTypeController::class, 'update'])->name('accommodation-types.update');
        Route::delete('/accommodation-types/{accommodation_type}', [AdminAccommodationTypeController::class, 'destroy'])->name('accommodation-types.destroy');

        Route::get('/icons/catalog', [AdminLucideIconController::class, 'catalog'])->name('icons.catalog');
        Route::get('/icons/preview', [AdminLucideIconController::class, 'preview'])->name('icons.preview');
        Route::get('/icons/previews', [AdminLucideIconController::class, 'previews'])->name('icons.previews');

        Route::get('/reviews', fn () => view('admin.reviews.index'))->name('reviews.index');
        Route::get('/customer-information', [AdminCustomerInformationController::class, 'index'])->name('customer-information.index');
        Route::put('/customer-information/{customerInformation}', [AdminCustomerInformationController::class, 'update'])->name('customer-information.update');
        Route::delete('/customer-information/{customerInformation}', [AdminCustomerInformationController::class, 'destroy'])->name('customer-information.destroy');
        Route::get('/interested-clients', [AdminInterestedClientController::class, 'index'])->name('interested-clients.index');
        Route::put('/interested-clients/{interestedClient}', [AdminInterestedClientController::class, 'update'])->name('interested-clients.update');
        Route::delete('/interested-clients/{interestedClient}', [AdminInterestedClientController::class, 'destroy'])->name('interested-clients.destroy');
    });
});
