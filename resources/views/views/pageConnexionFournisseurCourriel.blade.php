@extends('layouts.app')
    @section('title',"V3R Fournisseur Accueil")
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pageAccueil.css') }}">
    @show
    @section('js')
        <script src=""></script>
    @endsection
    @section('content')

    <form method="post" action="" enctype="multipart/form-data">
    @csrf
        <div class="main-container">
            <label for="email">Courriel:</label>
            <input type="text" class="form-control" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" class="form-control" id="password" name="password" required>

            </br>

            <button type="submit" class="button">Se connecter</button>
            
            </br>

        </div>
        
    </form>

    <button href="" class="button">Se connecter avec un NEQ</button>
    
</div>

@endsection