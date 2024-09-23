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
        <h1 id="statusText">Status : Maidenless</h1>
    </div>

    <div style="text-align:center">
        <a href="{{url('/ConnexionFournisseur')}}"> <button type="button" class="button" id="btMaFiche">Ma fiche</button>
    </div>

    <div style="text-align:center">
        <a href="{{url('/ConnexionFournisseur')}}"> <button type="button" class="button" id="btAjouterFinance">Ajouter ou voir mes finances</button>
    </div>

    <div style="text-align:center">
        <a href="{{url('/ConnexionFournisseur')}}"> <button type="button" class="button" id="btModifierFiche">Modifier ma fiche</button>
    </div>

    <div style="text-align:center">
        <a href="{{url('/ConnexionFournisseur')}}"> <button type="button" class="button" id="btSupprimerFiche">Supprimer ma fiche</button>
    </div>


@endsection