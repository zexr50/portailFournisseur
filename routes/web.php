<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\GestionConnection;
use App\Http\Controllers\FicheController;

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/',
 function () {return view('views/index');}); //dump page

Route::get('/Accueil',
 function () {return view('views/pageAccueil');})->name("Accueil");

Route::get('/PageInscriptionsLicences',
 function () {return view('views/pageInscriptionsLicences');})->name("InscriptionLicences");

Route::get('/ConnexionFournisseur',
 function () {return view('views/pageConnexionFournisseur');})->name("ConnexionFournisseur");

 Route::get('/VoirFiche',
[InscriptionController::class, 'index'])->name("VoirFiche");

 Route::get('/VoirFiche/{id}',
[InscriptionController::class, 'show'])->name("VoirFiche");

Route::post('/Login',
 [GestionConnection::class, 'Login'])->name('Login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/Logout', [GestionConnection::class, 'Logout'])->name('Logout');
    
    Route::get('/MenuFournisseur', function () {return view('views/pageMenuFournisseur');})->name("MenuFournisseur");

    Route::get('/AjoutFinances',
    [FinanceController::class, 'index'])->name("AjoutFinances");
    Route::post('/AjoutFinances',
    [FinanceController::class, 'store'])->name('Finance.store');

    

});


// début section pour les routes inscriptions

Route::get('/Inscription',
[InscriptionController::class, 'index'])->name('Inscription');

Route::post('/Inscription',
[InscriptionController::class, 'store'])->name('Inscription.store');

Route::get('/Inscription/search',
[InscriptionController::class, 'search'])->name('Inscription.search');

Route::get('/Inscription/searchLicencesRBQ', 
[InscriptionController::class, 'searchRBQ'])->name('inscriptions.search_rbq');

Route::get('/Inscription/searchCodeUNSPSC', 
[InscriptionController::class, 'searchUNSPSC'])->name('inscriptions.search_unspsc');

// fin section pour les routes inscriptions
