@extends('layouts.app')
    @section('title',"V3R Fournisseur Page Connexion C")
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pageMenuModifierFournisseur.css') }}">
    @show
    @section('js')
    @endsection
    @section('content')

    <div class="row" style="text-align:center">
        <div class="col-md-6">
            <a href="{{url('MenuFournisseur')}}"> 
                <button type="button" class="button" id="btMaFiche">Retour</button>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{url('')}}"> 
                <button type="button" class="button" id="btAjouterFinance">Modifier finances</button>
            </a>
        </div>
    </div>

    <div class="row" style="text-align:center">
        <div class="col-md-6">
            <a href="{{url('ChangeInfoPage')}}">
                <button type="button" class="button" id="btModifierFiche">Modifier fiche</button>
            </a>

        </div>
        <div class="col-md-6">
            <a href="{{url('ChangerContactForm')}}"> 
                <button type="button" class="button" id="btModifierContact">Modifier les personnes contactes</button>
            </a>
        </div>
    </div>
@endsection