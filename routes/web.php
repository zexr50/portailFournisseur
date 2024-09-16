<?php

use Illuminate\Support\Facades\Route;

/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {return view('views/index');}); //dump page
Route::get('/Accueil', function () {return view('views/pageAccueil');})->name("Accueil");
Route::get('/ConnexionFournisseurCourriel', function () {return view('views/pageConnexionFournisseurCourriel');});
Route::get('/ConnexionFournisseurNEQ', function () {return view('views/pageConnexionFournisseurNEQ');});
Route::get('/inscription', function () {return view('views/pageInscription');});


