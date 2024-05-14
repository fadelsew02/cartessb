<?php

use App\Http\Controllers\CarteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
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
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login-post', [UserController::class, 'create']);

Route::middleware(['auth'])->group(function () {

    //user
    Route::put('/change', [UserController::class, 'change'])->name("change");
    Route::get('/logout', [UserController::class, 'destroy']);
    Route::post('/unlock', [UserController::class, 'unlock']);

    //dashboard
    
    Route::get('/', [DashController::class, 'index'])->name('home');
    
    Route::get('/clients', [ClientController::class, 'index'])->name('client');
    Route::post('/client', [ClientController::class, 'create']);
    Route::post('/update-client/{id}', [ClientController::class, 'update']);
    Route::get('/delete-client/{id}', [ClientController::class, 'delete']);

    Route::get('/cartes', [CarteController::class, 'index'])->name('carte');
    Route::get('/recupCarte', [CarteController::class, 'recup']);
    Route::post('/carte', [CarteController::class, 'manage']);

    Route::get('/commandes', [CommandeController::class, 'index'])->name('commande');
    Route::get('/creer-commande', [CommandeController::class, 'create']);
    Route::get('/recup', [CommandeController::class, 'recup']);
    Route::get('/qtes', [CommandeController::class, 'qte']);
    Route::post('/commande', [CommandeController::class, 'manage']);

    Route::get('/produits', [ProduitController::class, 'index'])->name('produit');
    Route::post('/produit', [ProduitController::class, 'create']);
    Route::post('/update-produit/{id}', [ProduitController::class, 'update']);
    Route::get('/delete-produit/{id}', [ProduitController::class, 'delete']);
});
