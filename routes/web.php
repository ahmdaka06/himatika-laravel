<?php

use App\Http\Controllers\Guest\Seminar\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', function () {
//     return view('guest.index');
// });

Route::get('/', [HomeController::class, 'index'])->withoutMiddleware(['auth']);


Route::get('/seminar/register', [RegisterController::class, 'index'])->withoutMiddleware(['auth'])->name('guest.seminar.registerGET');
Route::post('/seminar/register', [RegisterController::class, 'store'])->withoutMiddleware(['auth'])->name('guest.seminar.registerPOST');
Route::get('/seminar/invoice/{invoice?}', [RegisterController::class, 'invoiceGET'])->withoutMiddleware(['auth'])->name('guest.seminar.invoiceGET');
Route::post('/seminar/invoice', [RegisterController::class, 'invoicePOST'])->withoutMiddleware(['auth'])->name('guest.seminar.invoicePOST');
