<?php

use App\Models\Destination;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/quoter', function () {
    return view('quoter');
})->name('quoter');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/destinations', function () {
    return view('destinations');
})->name('destinations');

Route::get('/hotels', function (Request $request) {
    $hotels = Hotel::where('active', true)
        ->where('is_published', true)
        ->with(['destination', 'principalImage'])
        ->when($request->filled('destination_id'), function ($query) use ($request) {
            $query->where('destination_id', $request->input('destination_id'));
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

    return view('hotels', compact('hotels', 'destinations'));
})->name('hotels');

Route::get('/hotel_detail', function () {
    return view('hotel_detail');
})->name('hotel_detail');
