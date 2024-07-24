<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SeguimientoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Mail\MailSend;
use App\Mail\MyTestEmail;
use Illuminate\Support\Facades\Mail;

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

// Lo primero que se va a mostrar, en este caso es lo de laravel
Route::get('/', function () {
    return view('home/index');
});

// Navegar a la vista principal
Route::get('/home', [HomeController::class, 'index']);

// ROUTES DE LOGIN
// Mostrar la Interfaz Login
Route::get('/login', [LoginController::class, 'show']);
// Validar e Ingresar
Route::post(
    '/login',
    [LoginController::class, 'login']
);
// Cerrar Sesión
Route::get('/logout', [LogoutController::class, 'logout']);

// Registro de Usuario
Route::get('/register', [RegisterController::class, 'show']);
Route::post(
    '/register',
    [RegisterController::class, 'register']
);

// ROUTES TICKET
Route::get('/tickets', [TicketController::class, 'show']);
// Registrar
Route::post('/registrar-tickets', [TicketController::class, 'store'])->name('registrar-tickets');
// Actualizar
Route::post('/actualizar-tickets', [TicketController::class, 'update'])->name('actualizar-tickets');
// Eliminar
Route::delete('/eliminar-ticket/{id}', [TicketController::class, 'destroy'])->name('eliminar-ticket');


// ROUTE TRACK
Route::get('/seguimiento', [SeguimientoController::class, 'show']);
// Admin View
Route::get('/admin-view', [AdminController::class, 'show']);
// Para crear el documento Word
Route::get('/word-export', [TicketController::class, 'wordExport']);

Route::get('/pdf-export', [TicketController::class, 'pdfExport']);

// Ruta para ver la tabla mediante QR
Route::get('/table-qr', [TicketController::class, 'showTableQr'])->name('table.qr');

// Ruta para ver la vista QR
Route::get('/export-qr', [TicketController::class, 'generateQRCode'])->name('export.qr');

// Rutas para el envío del email(don't work umu)
Route::get('contactanos', function () {
    Mail::to('informatica@ugelsullana.com')->send(new MailSend);
    return "Mensaje Enviado";
})->name('contactanos');

//Ruta para buscar tickets
Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');


