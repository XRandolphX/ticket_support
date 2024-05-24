<?php

use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SeguimientoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
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
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/logout', [LogoutController::class, 'logout']);

// Direccionamiento de Registrar Usuario
Route::get('/register', [RegisterController::class, 'show']);

Route::post(
    '/register',
    [RegisterController::class, 'register']
);

// Routes de Login 
Route::get('/login', [LoginController::class, 'show']);

Route::post(
    '/login',
    [LoginController::class, 'login']
);




// CRUD TICKET
Route::get('/tickets', [TicketController::class, 'index']);

Route::post('/registrar-tickets', [TicketController::class, 'create'])->name('create-ticket');

// Seguimiento
Route::get('/seguimiento', [SeguimientoController::class, 'index']);

// Admin
Route::get('/admin-view', [AdminViewController::class, 'index']);
