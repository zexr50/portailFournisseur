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
        <h1 id="statusText">Status : {{ $demandefournisseur->etat_demande }}</h1>
    </div>

    <div class="row" style="text-align:center">
        <div class="col-md-6">
            <a href="{{url('/VoirFiche')}}"> 
                <button type="button" class="button" id="btMaFiche">Ma fiche</button>
            </a>
        </div>
        @if($demandefournisseur->etat_demande == "actif")
        <div class="col-md-6">
            <a href="{{url('/AjoutFinances')}}"> 
                <button type="button" class="button" id="btAjouterFinance">Ajouter ou voir mes finances</button>
            </a>
        </div>
        @else
        <div class="col-md-6">
                <button type="button" class="button" id="btAjouterFinance">mes finances (disponible après être accepté)</button>
        </div>
        @endif
    </div>

    <div class="row" style="text-align:center">
        <div class="col-md-6">
            <a href="{{url('/choixModifierFournisseur')}}">
                <button type="button" class="button" id="btModifierFiche">Modifier ma fiche</button>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{url('/AjouterTelephoneForm')}}"> 
                <button type="button" class="button" id="btAjouterTelephone">Ajouter un telephone</button>
            </a>
        </div>
    </div>

    <div class="row" style="text-align:center">
        <div class="col-md-6">
            <a href="{{url('/AjouterContacteForm')}}"> 
                <button type="button" class="button" id="btAjouterContact">Ajouter une personne contacte</button>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{url('/ConnexionFournisseur')}}"> 
                <button type="button" class="button" id="btSupprimerFiche">Supprimer ma fiche</button>
            </a>
        </div>
    </div>

    <div class="row" style="text-align:center">

        <form action="{{ route('AjouterFichier') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="container-xxl">
                <h1>Document</h1>
                <input type="file" id="fichiers" name="fichiers">

                <ul id="listeFichiers"></ul>
            </div>

            <div id="bt-center">
                <button type="submit" class="button" id="bt_submit">Ajouter le fichier</button>
            </div>
        </form>
    </div>

    <script>
            const fileInput = document.getElementById('fichiers');
            const fileList = document.getElementById('listeFichiers');

            function formatFileSize(size) {
                if (size < 1024) return size + ' bytes';
                else if (size < 1024 * 1024) return (size / 1024).toFixed(2) + ' KB';
                else return (size / (1024 * 1024)).toFixed(2) + ' MB';
            }

            fileInput.addEventListener('change', function() {
                let totalSize = 0;

                Array.from(fileInput.files).forEach(file => {
                    totalSize += file.size;
                    fileList.innerHTML = '';
                    
                    const li = document.createElement('li');
                    li.innerHTML = `${file.name} (${formatFileSize(file.size)})`;
                    fileList.appendChild(li);
                });

                if (totalSize > 70 * 1024 * 1024) {
                    alert('La taille total des fichiers est trop grande.');
                    fileInput.value = '';
                    fileList.innerHTML = '';
                }
            });
        </script>
@endsection