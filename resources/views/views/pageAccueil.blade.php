@extends('layouts.app')
    @section('title',"V3R Fournisseur Accueil")
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pageAccueil.css') }}">
    @show
    
    
    @section('content')

    <h1>Votre Portail Fournisseur</h1>
    <div>
        <button type="submit" class="button" id="buttonLeftSS" onclick="showPrevSlide()"><</button>
        
        <div id="slideShow">
            <img src="{{ asset('img/user.svg') }}" alt="Utilisateur" id="slide1" style="">
            <img src="{{ asset('img/moon.svg') }}" alt="Lune"        id="slide2" style="display:none;">
            <img src="{{ asset('img/sun.svg') }}"  alt="Soleil"      id="slide3" style="display:none;">
        </div>

        <button type="button" class="button" id="buttonRightSS" onclick="showNextSlide()">></button>
    </div>

    
    @section('js')
        <script src="{{ asset('js/slideShow.js') }}"></script>
    @endsection
@endsection