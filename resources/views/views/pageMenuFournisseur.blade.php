@extends('layouts.app')
    @section('title',"V3R Fournisseur Page Connexion C")
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pageMenuFournisseur.css') }}">
    @show
    @section('js')
        <script src=""></script>
    @endsection
    @section('content')

    <div style="text-align:center" id="statusDiv">
        <h1 id="statusText">Status : {{ $demandefournisseur->etat_demande }}</h1>
    </div>

    <div class="row" style="text-align:center">
        <div class="col-md-6">
            <a href="{{url('/VoirFiche')}}"> 
                <button type="button" class="button" id="btMaFiche">Ma fiche</button>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{url('/AjoutFinances')}}"> 
                <button type="button" class="button" id="btAjouterFinance">Ajouter ou voir mes finances</button>
            </a>
        </div>
    </div>

    <div class="row" style="text-align:center">
        <div class="col-md-6">
            <a href="{{url('/ConnexionFournisseur')}}"> 
                <button type="button" class="button" id="btModifierFiche">Modifier ma fiche</button>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{url('/AjouterTelephoneForm')}}"> 
                <button type="button" class="button" id="btAjouterTelephone">Ajouter un telephone</button>
            </a>
        </div>
    </div>

    <div class="row" style="text-align:center">
        <div class="col-md-6">
            <a href="{{url('/AjouterContacteForm')}}"> 
                <button type="button" class="button" id="btAjouterContact">Ajouter une personne contacte</button>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{url('/ConnexionFournisseur')}}"> 
                <button type="button" class="button" id="btSupprimerFiche">Supprimer ma fiche</button>
            </a>
        </div>
    </div>


@endsection