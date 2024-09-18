<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {return view('views/index');}); //dump page
Route::get('/Accueil', function () {return view('views/pageAccueil');})->name("Accueil");
Route::get('/ConnexionFournisseur', function () {return view('views/pageConnexionFournisseur');})->name("ConnexionFournisseur");
Route::get('/inscription', function () {return view('views/pageInscription');})->name("Inscription");
Route::get('/pageInscriptionsLicences', function () {return view('views/pageInscriptionsLicences');});
Route::get('/MenuFournisseur', function () {return view('views/pageMenuFournisseur');})->name("MenuFournisseur");


