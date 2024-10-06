@extends('layouts.app')
    @section('title',"V3R Fournisseur Login")
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pageInscription.css') }}">
    @show
    @section('js')
        <script src="{{ asset('js/pageInscription.js') }}"></script>
        <script src="{{ asset('js/form.js') }}"></script>
    @endsection
    @section('content')

    <!-- Add content here!
         https://tablericons.com/ for icons
    -->

    <script>
        const limit = 50; // Set your desired limit
    </script>

       
            <div class="container-xxl main-bx">
                <div class="container-xxl sub-bx">
                    <h1>identification</h1>

                    <label for="NEQ">Numéro d'entreprise du Québec:</label>
                    <input type="text" class="form-control" id="NEQ" name="fournisseur[NEQ]">

                    <label for="nom_entreprise">Nom de l'entreprise:</label>
                    <input type="text" class="form-control" id="nom_entreprise" name="fournisseur[nom_entreprise]" required>

                    <div class="container-xxl">
                        <label for="email">Adresse courriel:</label>
                        <input type="text" class="form-control" id="email" name="fournisseur[email]" autocomplete="on">

                        <label for="mdp">Choisir son mot de passe:</label>
                        <input type="password" class="form-control" id="mdp" name="fournisseur[mdp]" required>

                        <label for="mdp2">Ressaisir son mot de passe:</label>
                        <input type="password" class="form-control" id="mdp_confirmation" name="fournisseur[mdp2]">
                    </div>  
                    
                </div>
                <div class="container-xxl sub-bx">
                    <h1>Coordonnées</h1>
                    <div class="container-xxl">
                        <h1>Adresse</h1>
                        <div class="row">

                            <div class="col-sm-3">
                                <label for="no_rue">No. civique:</label>
                                <input type="text" class="form-control" id="no_rue" name="fournisseur[no_rue]">
                            </div>

                            <div class="col-sm-6">
                                <label for="rue">Rue:</label>
                                <input type="text" class="form-control" id="rue" name="fournisseur[rue]">
                            </div>

                            <div class="col-sm-3">
                                <label for="no_bureau">Bureau:</label>
                                <input type="text" class="form-control" id="no_bureau" name="fournisseur[no_bureau]">
                            </div>

                            <div class="col-lg-12">
                                <label for="ville">Ville:</label>
                                <input type="text" class="form-control" id="ville" name="fournisseur[ville]">
                            </div>

                            <div class="col-md-5">
                                <label for="province">Province:</label>
                                <select id="province" name="fournisseur[province]" class="form-select" required>
                                    <option value="Quebec">Québec</option>
                                    <option value="Alberta">Alberta</option>
                                    <option value="Colombie-Britannique">Colombie-Britannique</option>
                                    <option value="Ile-du-Prince-Édouard">Île-du-Prince-Édouard</option>
                                    <option value="Manitoba">Manitoba</option>
                                    <option value="Nouveau-Brunswick">Nouveau-Brunswick</option>
                                    <option value="Nouvelle-Ecosse">Nouvelle-Écosse</option>
                                    <option value="Ontario">Ontario</option>
                                    <option value="Saskatchewan">Saskatchewan</option>
                                    <option value="Terre-Neuve-et-Labrador">Terre-Neuve-et-Labrador</option>
                                    <option value="Territoires du Nord-Ouest">Territoires du Nord-Ouest</option>
                                    <option value="Nunavut">Nunavut</option>
                                    <option value="Yukon">Yukon</option>
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label for="region_admin">Regions administratives:</label>
                                <select id="region_admin" name="fournisseur[no_region_admin]" class="form-select" required>
                                    <option value="01">01 - Bas-Saint-Laurent</option>
                                    <option value="02">02 - Saguenay-Lac-Saint-Jean</option>
                                    <option value="03">03 - Capitale-Nationale</option>
                                    <option value="04">04 - Mauricie</option>
                                    <option value="05">05 - Estrie</option>
                                    <option value="06">06 - Montréal</option>
                                    <option value="07">07 - Outaouais</option>
                                    <option value="08">08 - Abitibi-Témiscamingue</option>
                                    <option value="09">09 - Côte-Nord</option>
                                    <option value="10">10 - Nord-du-Québec</option>
                                    <option value="11">11 - Gaspésie-Îles-de-la-Madeleine</option>
                                    <option value="12">12 - Chaudière-Appalaches</option>
                                    <option value="13">13 - Laval</option>
                                    <option value="14">14 - Lanaudière</option>
                                    <option value="15">15 - Laurentides</option>
                                    <option value="16">16 - Montérégie</option>
                                    <option value="17">17 - Centre-du-Québec</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="code_postal">Code postal:</label>
                                <input type="text" class="form-control" id="code_postal" name="fournisseur[code_postal]">
                            </div>
                        </div>
                    </div> 
                    <div class="container-xxl">
                        <label for="site_internet">Site internet:</label>
                        <input type="text" class="form-control" id="site_internet" name="fournisseur[site_internet]">
                    </div>  

                    <div class="container-xxl">
                        <div id="telephone">
                            <div class="row phone-number-group">
                                <div class="col-md-3">
                                    <label for="type_tel1">type de Téléphones</label>
                                    <select id="type_tel1" name="type_tels[fournisseur][]" class="form-select" required>
                                        <option value="bureau">Bureau</option>
                                        <option value="cellulaire">Célulaire</option>
                                        <option value="fax">Fax</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="no_tel1">Téléphones:</label>
                                    <input type="text" class="form-control" id="no_tel1" name="no_tel[fournisseur][]">
                                </div>

                                <div class="col-md-3">
                                    <label for="poste_tel1">Poste:</label>
                                    <input type="text" class="form-control" id="poste_tel1" name="poste_tel[fournisseur][]">
                                </div>
                                    
                            </div> 
                        </div>
                        <div id="bt-center">
                            <button type="button" onclick="addPhoneNumber()" class="button" id="btAddTelephone">Ajouter un téléphone</button>
                        </div>
                            
                    </div> 

                </div> 
                
                <div class="container-xxl sub-bx">
                    <h1>Contacts</h1>
                    <div id="contact">
                        <div class="row contact-group">
                            <div class="col-lg-12">
                                <label for="prenom_contact">Prénom</label>
                                <input type="text" class="form-control" id="prenom_contact" name="prenom[personne_ressource][]">
                            </div>

                            <div class="col-lg-12">
                                <label for="nom_contact">Nom:</label>
                                <input type="text" class="form-control" id="nom_contact" name="nom[personne_ressource][]">
                            </div>

                            <div class="col-lg-12">
                                <label for="fonction">Fonction:</label>
                                <input type="text" class="form-control" id="fonction" name="fonction[personne_ressource][]">
                            </div>

                            <div class="col-lg-12">
                                <label for="email_contact">Adresse courriel:</label>
                                <input type="text" class="form-control" id="email_contact" name="email_contact[personne_ressource][]">
                            </div>
                        </div>
                    
                        <div class="container-xxl">
                            <div class="row contact-group-tel">
                                <div class="col-md-3">
                                    <label for="type_tel2">type de Téléphones</label>
                                    <select id="type_tel2" name="type_tels[personne_ressource][]" class="form-select" required>
                                        <option value="bureau">Bureau</option>
                                        <option value="cellulaire">Célulaire</option>
                                        <option value="fax">Fax</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="no_tel1">Téléphones:</label>
                                    <input type="text" class="form-control" id="no_tel_contact1" name="no_tel[personne_ressource][]">
                                </div>

                                <div class="col-md-3">
                                    <label for="poste_tel1">Poste:</label>
                                    <input type="text" class="form-control" id="poste_tel_contact1" name="poste_tel[personne_ressource][]">
                                </div>
                                    
                            </div> 
                        </div>
                    </div>
                    <div id="bt-center">
                    <button type="button" onclick="addContactPerson()" class="button" id="btAddContact">Ajouter une personne contact</button>
                    </div>
                </div>
            
            
                <div class="sub-bx">
                    <div class="row">
                        <div class=" col-md-9">  
                            <input type="text" id="searchFieldRBQ" placeholder="recherche de catégorie de licences rbq">
                            <button type="button" class="button" id="searchButtonRBQ">Rechercher</button>
                            <div id="listeRBQ">
                                @foreach($categorie as $section => $licences_rbqs)
                                    <h3>{{ $section }}</h3> <!-- Display the section title -->
                                    <ul>
                                        @foreach($licences_rbqs as $licences_rbq)
                                            <li class="licence-item" data-id="{{ $licences_rbq->id_licence_rbq }}">
                                                {{ $licences_rbq->sous_categorie }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                            
                        <div class="col-md-3">
                              <h3> liste des licences prises </h3>
                              <ul id="selectedLicencesList"> </ul>
                        </div>
                    </div>

                    <script>
                        $('#searchButtonRBQ').on('click', function() {
                            console.log('button clicked');
                            const searchField2 = $('#searchFieldRBQ').val();
                            console.log('search value : ', searchField2);

                            $.ajax({
                                url: "{{ route('inscriptions.search_rbq') }}",
                                method: 'GET',
                                data: {
                                    search2: searchField2,
                                    limit: limit,
                                },
                                success: function(data) {
                                    //console.log(data);
                                    //console.log(searchField2);
                                    $('#listeRBQ').html(data);
                                }
                                
                            });
                        });

                        document.addEventListener('DOMContentLoaded', function () {
                            const selectedLicencesList = document.getElementById('selectedLicencesList');

                            // Event delegation for adding/removing licences
                            document.getElementById('listeRBQ').addEventListener('click', function (e) {
                                if (e.target.classList.contains('licence-item')) {
                                    const licenceId = e.target.getAttribute('data-id');

                                    // Check if the item is already selected
                                    const alreadySelected = Array.from(selectedLicencesList.children)
                                        .some(item => item.getAttribute('data-id') === licenceId);

                                    if (alreadySelected) {
                                        // Remove from selected list
                                        const itemToRemove = [...selectedLicencesList.children].find(item => item.getAttribute('data-id') === licenceId);
                                        selectedLicencesList.removeChild(itemToRemove);
                                    } else {
                                        // Add to selected list
                                        const newItem = document.createElement('li');
                                        newItem.setAttribute('data-id', licenceId);
                                        newItem.textContent = e.target.textContent;
                                        newItem.classList.add('selected-item');
                                        selectedLicencesList.appendChild(newItem);
                                    }
                                }
                            });
                        });

                    </script>
                </div>

                <div class="sub-bx">
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

                    <script>
                        $('#searchButtonCode').on('click', function() {
                            console.log('button clicked');
                            const searchFieldCode = $('#searchFieldCode').val();
                            console.log('search value : ', searchFieldCode);

                            $.ajax({
                                url: "{{ route('inscriptions.search_unspsc') }}",
                                method: 'GET',
                                data: {
                                    search2: searchFieldCode,
                                    limit: limit,
                                },
                                success: function(data) {
                                    //console.log(data);
                                    //console.log(searchField);
                                    $('#listeCodes').html(data);
                                }
                                
                            });
                        });

                        document.addEventListener('DOMContentLoaded', function () {
                            const selectedCodeList = document.getElementById('selectedCodeList');

                            // Event delegation for adding/removing licences
                            document.getElementById('listeCodes').addEventListener('click', function (e) {
                                if (e.target.classList.contains('licence-item')) {
                                    const Codes = e.target.getAttribute('data-id');

                                    // Check if the item is already selected
                                    const alreadySelected = Array.from(selectedCodeList.children)
                                        .some(item => item.getAttribute('data-id') === Codes);

                                    if (alreadySelected) {
                                        // Remove from selected list
                                        const itemToRemove = [...selectedCodeList.children].find(item => item.getAttribute('data-id') === Codes);
                                        selectedCodeList.removeChild(itemToRemove);
                                    } else {
                                        // Add to selected list
                                        const newItem = document.createElement('li');
                                        newItem.setAttribute('data-id', Codes);
                                        newItem.textContent = e.target.textContent;
                                        newItem.classList.add('selected-item');
                                        selectedCodeList.appendChild(newItem);
                                    }
                                }
                            });
                        });
                    </script>
                </div>
        </div>

    <script>
        document.querySelector('form').addEventListener('submit', function () {
            const selectedIdsLicences = Array.from(document.querySelectorAll('#selectedLicencesList li'))
                .map(item => item.getAttribute('data-id'));
            document.getElementById('licences_rbq_input').value = JSON.stringify(selectedIdsLicences);

            const selectedIdsCode = Array.from(document.querySelectorAll('#selectedCodeList li'))
                .map(item => item.getAttribute('data-id'));
            document.getElementById('code_input').value = JSON.stringify(selectedIdsCode);
        });
    </script>


    <script>
        function logToConsole() {
            console.log('boutton \'envoyer formulaire\' cliquer ');
        }
    </script>

    <div>
        <button type="button" class="button" onclick="prevForm()" id="buttonLeft">Prev</button>
        <div id="whatForm"></div>
        <button type="button" class="button" onclick="nextForm()" id="buttonRight">Next</button>
    </div>

@endsection