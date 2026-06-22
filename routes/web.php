<?php

use App\Models\Hotel;
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

Route::get('/hotels', function () {
    $hotels = Hotel::where('active', true)
        ->where('is_published', true)
        ->with(['destination', 'principalImage'])
        ->orderBy('featured', 'desc')
        ->orderBy('star_rating', 'desc')
        ->get();

    return view('hotels', compact('hotels'));
})->name('hotels');

Route::get('/hotel_detail', function () {
    return view('hotel_detail');
})->name('hotel_detail');
