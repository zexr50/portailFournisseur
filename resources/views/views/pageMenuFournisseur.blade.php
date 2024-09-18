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

    <div style="text-align:center" id="btDiv">
        <a href="{{ route('ConnexionFournisseurCourriel') }}" class="button" id="btMaFiche">Se connecter avec une adresse courriel</a>
    </div>

    <div style="text-align:center" id="btDiv">
        <a href="{{ route('ConnexionFournisseurCourriel') }}" class="button" id="btAjouterFinance">Se connecter avec une adresse courriel</a>
    </div>

    <div style="text-align:center" id="btDiv">
        <a href="{{ route('ConnexionFournisseurCourriel') }}" class="button" id="btModifierFiche">Se connecter avec une adresse courriel</a>
    </div>

    <div style="text-align:center" id="btDiv">
        <a href="{{ route('ConnexionFournisseurCourriel') }}" class="button" id="btSupprimerFiche">Se connecter avec une adresse courriel</a>
    </div>


@endsection