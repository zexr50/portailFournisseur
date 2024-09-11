@extends('layouts.app')
    @section('title',"V3R Fournisseur Login")
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pageInscription.css') }}">
    @show
    @section('js')
        <script src=""></script>
    @endsection
    @section('content')

    <!-- Add content here!
         https://tablericons.com/ for icons
    -->

   
       
        <form method="post" action="" enctype="multipart/form-data">
        @csrf
        <div class="main-container">
            <div class="container-xxl">
            <h1>identification</h1>
                <label for="neq">Numéro d'entreprise du Québec:</label>
                <input type="text" class="form-control" id="neq" name="neq">

                <label for="nom_entreprise">Nom de l'entreprise:</label>
                <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise" required>

                <div class="container-lg">
                    <label for="email">Adresse courriel:</label>
                    <input type="text" class="form-control" id="email" name="email">

                    <label for="mdp">Choisir son mot de passe:</label>
                    <input type="password" class="form-control" id="mdp" name="mdp" required>

                    <label for="mdp2">Ressaisir son mot de passe:</label>
                    <input type="password" class="form-control" id="mdp2" name="mdp2">
                </div>  
            </div>
            <div class="container-xxl">
            <h1>Coordonnées</h1>
                <div class="container-lg">
                <h1>Adresse</h1>
                    <label for="no_rue">No. civique:</label>
                    <input type="text" class="form-control" id="no_rue" name="no_rue">

                    <label for="rue">Rue:</label>
                    <input type="text" class="form-control" id="rue" name="rue">

                    <label for="no_bureau">Bureau:</label>
                    <input type="text" class="form-control" id="no_bureau" name="no_bureau">

                    <label for="ville">Ville:</label>
                    <input type="text" class="form-control" id="ville" name="ville">

                    <label for="province">Province:</label>
                    <input type="text" class="form-control" id="province" name="province">

                    <label for="code_postal">Code postal:</label>
                    <input type="text" class="form-control" id="code_postal" name="code_postal">

                    
                </div>  

                <label for="neq">Numéro d'entreprise du Québec:</label>
                <input type="text" class="form-control" id="neq" name="neq">

                <label for="nom_entreprise">Nom de l'entreprise:</label>
                <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise" required>

                <div class="container-lg">
                    <label for="email">Adresse courriel:</label>
                    <input type="text" class="form-control" id="email" name="email">

                    <label for="mdp">Choisir son mot de passe:</label>
                    <input type="password" class="form-control" id="mdp" name="mdp" required>

                    <label for="mdp2">Ressaisir son mot de passe:</label>
                    <input type="password" class="form-control" id="mdp2" name="mdp2">
                </div>  
            </div>
        </div>
        
    </form>
    


    
<!--
    <img src="{{ asset('img/V3R_Logo.svg') }}" width="50" height="50" alt="Logo V3R">
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

    <p style="background-color:rgb(120,198,224);">couleur principale</p>
    <p style="background-color:rgb(0,118,213);">couleur principale</p>
    <p style="background-color:rgb(11,35,65); color:white;">couleur principale</p>
    <p style="background-color:rgb(197,216,0);">couleur principale</p>
    <p style="background-color:rgb(99,188,85);">couleur principale</p>
    <p style="background-color:rgb(30,73,45);">couleur principale</p>

    <p style="background-color:rgb(243,231,0);">couleur accent</p>
    <p style="background-color:rgb(249,159,215);">couleur accent</p>
    <p style="background-color:rgb(229,0,77);">couleur accent</p>
    <p style="background-color:rgb(237,140,0);">couleur accent</p>

-->
@endsection