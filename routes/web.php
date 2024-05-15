<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::permanentRedirect('/', '/login');

Route::get('/console', function () {
    return view('console');
})->middleware(['auth'])->name('console');

Route::get('/console/exportdb', function () {
    $headers = array(
        "Content-type"        => "text/json",
        "Content-Disposition" => "attachment; filename=database.json",
        "Pragma"              => "no-cache",
        "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        "Expires"             => "0"
    );
    return response(\App\Services\SDKFetch::getData(), '200')->withHeaders($headers);
})->middleware(['auth'])->name('exportdb');

require __DIR__.'/auth.php';
