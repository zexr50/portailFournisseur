@extends('layouts.app')
    @section('title',"V3R Fournisseur Page Connexion N")
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pageConnexionFournisseur.css') }}">
    @show
    @section('js')
        <script src=""></script>
    @endsection
    @section('content')

    <form method="post" action="" enctype="multipart/form-data">
    @csrf
    <div class="main-container">
            <div class="container-xxl">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" required>

            </div> 

            <div class="container-xxl">    

                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" required>

            </div> 

            </br>

            <div style="text-align:center">
                <button type="submit" class="button" id="btConnexion">Se connecter</button>
            </div>
            
            </br>

        </div>
        
    </form>

    <div style="text-align:center">
        <a href="{{ route('ConnexionFournisseurNEQ') }}" class="button" id="btNEQPage">Se connecter avec un NEQ</a>
    </div>
</div>

@endsection