<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {return view('views/index');}); //dump page
Route::get('/Accueil', function () {return view('views/pageAccueil');})->name("Accueil");
Route::get('/ConnexionFournisseurCourriel', function () {return view('views/pageConnexionFournisseurCourriel');})->name("ConnexionFournisseurCourriel");
Route::get('/ConnexionFournisseurNEQ', function () {return view('views/pageConnexionFournisseurNEQ');})->name("ConnexionFournisseurNEQ");
<<<<<<< Updated upstream
Route::get('/inscription', function () {return view('views/pageInscription');})->name("Inscription");

=======
Route::get('/inscription', function () {return view('views/pageInscription');});
<<<<<<< Updated upstream
Route::get('/pageInscriptionsLicences', function () {return view('views/pageInscriptionsLicences');});
>>>>>>> Stashed changes
=======
Route::get('/MenuFournisseur', function () {return view('views/pageMenuFournisseur');})->name("MenuFournisseur");

>>>>>>> Stashed changes

