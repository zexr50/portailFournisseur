<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    @yield('css')
    @yield('js')
</head>
<body>
<div>
<header>
        <nav class="navbar  fixed-top navbar-light bg-light">
            <a class="navbar-brand" href="#"><img id="logo" src="{{ asset('img/V3R_Logo.svg') }}" alt="Logo V3R"></a>
            
            <div class="dropdown">
                <button class="navbar-toggler" type="button" data-bs-toggle="dropdown">
                    <img src="{{ asset('img/menu.svg') }}" alt="menu">
                    Menu
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </nav>
    </header>
    @yield('content')
</div>
</body>
</html>