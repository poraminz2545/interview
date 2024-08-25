<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('holiday_request_form');
});

Route::get('/alldata', function () {
    return view('alldata');
});
Route::post('regis_data',[DataController::class, 'regis_data'])->name('regis_data');
Route::post('search_data',[DataController::class, 'search_data'])->name('search_data');
Route::post('delete_data',[DataController::class, 'delete_data'])->name('delete_data');
Route::post('update_status',[DataController::class, 'update_status'])->name('update_status');
