<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\GestionConnection;

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {return view('views/index');}); //dump page
Route::get('/Accueil', function () {return view('views/pageAccueil');})->name("Accueil");
Route::get('/inscription', function () {return view('views/pageInscription');})->name("Inscription");
Route::get('/pageInscriptionsLicences', function () {return view('views/pageInscriptionsLicences');});
Route::get('/MenuFournisseur', function () {return view('views/pageMenuFournisseur');})->name("MenuFournisseur");
Route::get('/AjoutFinances', function () {return view('views/pageAjoutFinancesFournisseur');})->name("AjoutFinances");
Route::get('/Inscription',
[InscriptionController::class, 'index'])->name('Inscription');

Route::get('/Inscription/search',
[InscriptionController::class, 'search'])->name('Inscription.search');

Route::get('/PageInscriptionsLicences', function () {return view('views/pageInscriptionsLicences');})->name("InscriptionLicences");
Route::get('/MenuFournisseur', function () {return view('views/pageMenuFournisseur');})->name("MenuFournisseur");


Route::get('/ConnexionFournisseur', function () {return view('views/pageConnexionFournisseur');})->name("ConnexionFournisseur");
Route::post('/Login', [GestionConnection::class, 'Login'])->name('Login');

Route::group(['middleware' => ['auth:sanctum']], function () {







});