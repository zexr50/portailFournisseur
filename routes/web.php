<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\GestionConnection;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\MenuFournisseurController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ModContactController;



/*Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/dmp',
 function () {return view('views/dmp');})->name("dmp"); //dump page

Route::get('/',
 function () {return view('views/pageAccueil');})->name("Accueil");

Route::get('/PageInscriptionsLicences',
 function () {return view('views/pageInscriptionsLicences');})->name("InscriptionLicences");

Route::get('/ConnexionFournisseur',
 function () {return view('views/pageConnexionFournisseur');})->name("ConnexionFournisseur");


 Route::get('/login',function () {return view('views/pageConnexionEmployer');})->name("ConnexionEmployerUhOh"); //don`t touch the tape
Route::post('/Login',
 [GestionConnection::class, 'Login'])->name('Login');



Route::group(['middleware' => [\App\Http\Middleware\PreventBackHistory::class,'auth:sanctum', \App\Http\Middleware\RoleMiddleware::class.':Fournisseur']], function () {
    Route::get('/Logout', [GestionConnection::class, 'Logout'])->name('Logout');

     Route::get('/VoirFiche',
    [InscriptionController::class, 'show'])->name("VoirFiche");

    Route::get('/AjouterTelephoneForm',
    [InscriptionController::class, 'formAddPhone'])->name("AjouterTelephoneForm");
    Route::post('/AjouterTelephone',
    [InscriptionController::class, 'addPhone'])->name("AjouterTelephone");

    Route::get('/AjouterContacteForm',
    [InscriptionController::class, 'formAddPerson'])->name("AjouterContacteForm");

    Route::post('/AjouterContacte',
    [InscriptionController::class, 'addPerson'])->name("AjouterContacte");


    Route::get('/ChangerContactForm',
    [ModContactController::class, 'index'])->name("ChangerContactForm");

    Route::post('/ChangerContact', 
    [ModContactController::class, 'ChangeContact'])->name("ChangerContact");

    Route::post('/AjouterFichier',
    [InscriptionController::class, 'storeFile'])->name("AjouterFichier");

    Route::get('/choixModifierFournisseur',
    function () {return view('views/pageChoixModifierFournisseur');})->name('choixModifierFournisseur');

    //Route::get('/MenuFournisseur', function () {return view('views/pageMenuFournisseur');})->name("MenuFournisseur");

    Route::get('/MenuFournisseur',
    [MenuFournisseurController::class, 'index'])->name("MenuFournisseur");

    Route::get('/AjoutFinances',
    [FinanceController::class, 'index'])->name("AjoutFinances");
    Route::post('/AjoutFinances',
    [FinanceController::class, 'store'])->name('Finance.store');

    Route::get('/Inscription/download/{id_document}',
    [InscriptionController::class, 'download'])->name('Inscription.download');


    

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

//début route tests

Route::get('/test/index',
[TestController::class, 'index'])->name('test.index');

Route::post('/test/files',
[TestController::class, 'testFile'])->name('testFiles');
