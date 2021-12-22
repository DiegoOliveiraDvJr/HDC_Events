<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
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

Route::get('/', [EventController::class, 'index'])->name('home');
Route::middleware('auth')->get('/events/create', [EventController::class, 'create'])->name('event.create');
Route::get('/events/{id}', [EventController::class, 'show'])->name('eventShow');
Route::post('/events', [EventController::class, 'store'])->name('events');
Route::middleware('auth')->delete('/events/{id}', [EventController::class, 'destroy'])->name('event.delete');
Route::middleware('auth')->get('/event/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
Route::middleware('auth')->put('/events/update/{id}', [EventController::class, 'update'])->name('event.update');
Route::middleware('auth')->post('/events/join/{id}', [EventController::class, 'joinEvent'])->name('event.join');
Route::middleware('auth')->delete('/events/leave/{id}', [EventController::class, 'leaveEvent'])->name('event.leave');
Route::middleware('auth')->get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard');
