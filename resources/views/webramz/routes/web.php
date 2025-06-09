<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/date/{days}',[DateController::class,'delivery'])->name('date');
