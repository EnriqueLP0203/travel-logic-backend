<?php

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
    return view('hotels');
})->name('hotels');

Route::get('/hotel_detail', function () {
    return view('hotel_detail');
})->name('hotel_detail');
