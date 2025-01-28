<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('items', function () {
    return view('items');
});

Route::get('contact', function () {
    return view('contact');
});
