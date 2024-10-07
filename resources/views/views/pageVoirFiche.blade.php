@extends('layouts.app')
    @section('title',"V3R Fournisseur Login")
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pageInscription.css') }}">
    @show
    @section('js')
        <script src="{{ asset('js/pageInscription.js') }}"></script>
    @endsection
    @section('content')

    <!-- Add content here!
         https://tablericons.com/ for icons
    -->

    <div class="container-xxl">
        <div class="container-xxl" id="containerWithBorder">
            <h1>Information</h1>

            <p>Numéro d'entreprise du Québec: {{ $fournisseur->NEQ }} </p>
            
            <p>Nom de l'entreprise: {{ $fournisseur->nom_entreprise }} </p>
            
            <p>Adresse courriel: {{ $fournisseur->email }} </p>
      
        </div>

        <div class="container-xxl">
            <h1>Coordonnées</h1>
            <div class="container-xxl" id="containerWithBorder">
                <h1>Adresse</h1>
                <div class="row">
                    <p class="col-sm-3">No. civique: {{ $fournisseur->no_rue }} </p>

                    <p class="col-sm-6">Rue: {{ $fournisseur->rue }} </p>

                    <p class="col-sm-3">Bureau:{{ $fournisseur->no_bureau }} </p>
                        
                    <p class="col-lg-12">Ville: {{ $fournisseur->ville }} </p>
                        
                    <p class="col-md-5">Province: {{ $fournisseur->province }} </p>

                    <p class="col-md-5">Regions administratives: 
                        {{ $fournisseur->region ? $fournisseur->region->no_region : 'N/A' }} - 
                        {{ $fournisseur->region ? $fournisseur->region->nom_region : 'N/A' }} </p>
                        
                    <p class="col-md-2">Code postal: {{ $fournisseur->code_postal }} </p>
                </div>

                <p>Site internet: {{ $fournisseur->site_internet }} </p>
                
                <h2>téléphone</h2>
                <div class="row">
                    @foreach($fournisseur->telephones as $phone)
                        <p class="col-md-3">Type de Téléphones: {{ $phone->type_tel }}</p> 
                        <p class="col-md-6">Téléphones: {{ $phone->no_tel }}</p>
                        <p class="col-md-3">Poste: {{ $phone->poste_tel }}</p>
                    @endforeach
                </div>
            </div> 
        </div> 
        

        <div class="container-xxl">
            <h2>Contact Persons</h2>
            <div class="container-xxl" id="containerWithBorder">
                <div class="contact-info">
                    @foreach($fournisseur->personne_ressources as $contact)
                        <div class="contact">
                            <p><strong>Contact Name:</strong> {{ $contact->nom }}</p>

                            <p><strong>Phone Numbers:</strong></p>
                            <ul>
                                @foreach($contact->telephones as $phone)
                                    <li>{{ $phone->no_tel }}</li>
                                @endforeach
                            </ul>

                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="">
            <div class="row">
                <div class=" col-md-9">  
                    <input type="text" id="searchFieldRBQ" placeholder="recherche de catégorie de licences rbq">
                    <button type="button" class="button" id="searchButtonRBQ">Rechercher</button>
                    <div id="listeRBQ">
                       
                    </div>
                </div>
                    
                <div class="col-md-3">
                      <h3> liste des licences prises </h3>
                      <ul id="selectedLicencesList"> </ul>
                </div>
            </div>

        </div>

        <div class="">
            <div class="row">
                <div class=" col-md-9">    
                    <input type="text" id="searchFieldCode" placeholder="recherche de catégorie de licences rbq">
                    <button type="button" class="button" id="searchButtonCode">Rechercher</button>
                    <div id="listeCodes">

                    </div>
                </div>
                    
                <div class="col-md-3">
                    <h3> liste des catégorie UNSPSC sélectionner </h3>
                    <ul id="selectedCodeList"> </ul>
                    
                </div>
            </div>

        </div>
    </div>

@endsection