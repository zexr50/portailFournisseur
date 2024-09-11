@extends('layouts.app')
    @section('title',"V3R Fournisseur Accueil")
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pageAccueil.css') }}">
    @show
    @section('js')
        <script src=""></script>
    @endsection
    @section('content')

    <h1>Votre Portail Fournisseur</h1>
    <div>
        <button type="submit" class="button" id="buttonLeftSS" onclick="buttonLeftSS()"><</button>
        
        <div>
            <img src="{{ asset('img/user.svg') }}" alt="Utilisateur" style="">
            <img src="{{ asset('img/moon.svg') }}" alt="Lune" style="display:none;">
            <img src="{{ asset('img/sun.svg') }}" alt="Soleil" style="display:none;">
        </div>

        <button type="button" class="button" id="buttonRightSS" onclick="buttonRightSS()">></button>
    </div>

</div>

@endsection