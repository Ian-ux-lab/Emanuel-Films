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

Route::get('/', function () {
    return view('inicio');
});



Route::get('/servicios', function () {
    return view('servicios');
});

Route::get('/proyectos', function () {
    return view('proyectos');
});
Route::get('/contacto', function () {
    return view('contacto');
});