<?php

use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReclamationController as AdminReclamationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Routes Authentification (Laravel UI)
|--------------------------------------------------------------------------
*/

// Routes d'authentification générées par Laravel UI
Auth::routes();

/*
|--------------------------------------------------------------------------
| Routes Utilisateur Authentifié
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Dashboard utilisateur (redirige vers les réclamations)
    Route::get('/home', function () {
        return redirect()->route('reclamations.index');
    })->name('home');
    
    // Routes pour les réclamations (utilisateur)
    Route::resource('reclamations', ReclamationController::class)
        ->except(['edit', 'update', 'destroy']);
    
    // Routes pour les commentaires
    Route::post('reclamations/{reclamation}/commentaires', 
        [CommentaireController::class, 'store'])
        ->name('commentaires.store');
});

/*
|--------------------------------------------------------------------------
| Routes Administrateur
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    // Gestion des réclamations (admin)
    Route::resource('reclamations', AdminReclamationController::class)
        ->only(['index', 'show', 'update']);
    
    // Gestion des catégories
    Route::resource('categories', CategorieController::class);
});
