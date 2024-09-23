<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>@yield('title')</title>
    <script src="{{ asset('js/navbarMenu.js') }}"></script>
    @yield('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    @yield('js')
</head>
<body>
<div>
    <header>
        <nav class="navbar  fixed-top navbar-light">
            <a class="navbar-brand" href="{{ route('Accueil') }}">
                <p id="brandName">fournisseur.v3r.net</p>
            </a>
            <div id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="sidebar">
                            <button onclick="openMenu()" class="navbar-toggler" type="button">
                                <img src="{{ asset('img/menu.svg') }}" alt="menuButton">
                            </button>
                            
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="" style="display:none;right:0;" id="Menu">
        <button onclick="closeMenu()">Fermer &times;</button>
        <a href="{{ route('ConnexionFournisseur') }}" class="">Se connecter</a>
        <a href="{{ route('Inscription') }}" class="">Inscription</a>
        <a href="#" class="">Link 3</a>
    </div>



    @yield('content')
</div>
</body>
</html>