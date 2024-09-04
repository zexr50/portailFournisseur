@extends('layouts.app')
    @section('title',"V3R Fournisseur Login")
    @section('css')
        <link rel="stylesheet" href="">
    @show
    @section('js')
        <script src=""></script>
    @endsection
    @section('content')

    <!-- Add content here!
         https://tablericons.com/ for icons
    -->

    <nav class="fixed-top">

    </nav>

    <img src="{{ asset('img/V3R_Logo.svg') }}" alt="Logo V3R">
    <img src="{{ asset('img/sun.svg') }}" alt="Soleil">
    <img src="{{ asset('img/moon.svg') }}" alt="Lune">
    <img src="{{ asset('img/user.svg') }}" alt="Utilisateur">

    <form method="post" action="" enctype="multipart/form-data">
    @csrf
        <div class="main-container">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" class="form-control" id="password" name="password" required>

            </br>

            <button type="submit" class="button">Se connecter</button>
            
            </br>

            <a href="">Nouveau Fournisseur ?</a>
        </div>
        
    </form>



@endsection