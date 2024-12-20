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


    <script>
        const limit = 50;
    </script>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li id='liNoir'>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('Inscription.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm" onsubmit="logToConsole()">
        @csrf
            <div class="container-xxl main-bx">
                <div class="container-xxl sub-bx">
                    <h1>Identification</h1>

                    <label for="NEQ">Numéro d'entreprise du Québec :</label>

                    <img loading="lazy" class="infobubble-img" src="{{ asset('img/info.svg') }}" alt="info" onmouseover="javascript: show_info(document.getElementById('info-NEQ'));" onmouseout="javascript: show_info(document.getElementById('info-NEQ'));">
                    <div class="infobubble">
                        <div class="infobubble-txt" id="info-NEQ" style="display: none;">
                        Le NEQ doit commencer par le chiffre 1, 2, 3, ou 8.</br>
                        Le deuxième chiffre doit être le même que le premier.</br>
                        Au total, il doit y avoir 10 chiffres.</br>
                        Exemple: 3387654321 
                        </div>
                    </div>

                    <input type="text" class="form-control {{ $errors->has('fournisseur.NEQ') ? 'failure' : (old('fournisseur.NEQ') ? 'success' : '') }}" id="NEQ" name="fournisseur[NEQ]" value="{{ old('fournisseur.NEQ') }}">
                    

                    <label for="nom_entreprise">*Nom de l'entreprise:</label>
                    <input type="text" class="form-control {{ $errors->has('fournisseur.nom_entreprise') ? 'failure' : (old('fournisseur.nom_entreprise') ? 'success' : '') }}" id="nom_entreprise" name="fournisseur[nom_entreprise]" value="{{ old('fournisseur.nom_entreprise') }}" required>

                    <div class="container-xxl">
                        <label for="email">*Adresse courriel:</label>
                        <input type="text" class="form-control {{ $errors->has('fournisseur.email') ? 'failure' : (old('fournisseur.email') ? 'success' : '') }}" id="email" name="fournisseur[email]" autocomplete="on" value="{{ old('fournisseur.email') }}" >

                        <label for="mdp">*Mot de passe:</label>

                        <img loading="lazy" class="infobubble-img" src="{{ asset('img/info.svg') }}" alt="info" onmouseover="javascript: show_info(document.getElementById('info-pswd'));" onmouseout="javascript: show_info(document.getElementById('info-pswd'));">
                        <div class="infobubble">
                            <div class="infobubble-txt" id="info-pswd" style="display: none;">
                            Minimum une lettre minuscule</br> 
                            une lettre majuscule</br> 
                            un chiffre</br> 
                            et un caractère spécial parmi @$!%*?&.</br> 
                            Le mot de passe doit contenir entre 7 et 12 caractères.
                            </div>
                        </div>

                        <input type="password" class="form-control {{ $errors->has('fournisseur.mdp') ? 'failure' : (old('fournisseur.mdp') ? 'success' : '') }}" id="mdp" name="fournisseur[mdp]" value="{{ old('fournisseur.mdp') }}" required>

                        <label for="mdp_confirmation">*Ressaisir mot de passe:</label>
                        <input type="password" class="form-control {{ $errors->has('fournisseur.mdp_confirmation') ? 'failure' : (old('fournisseur.mdp_confirmation') ? 'success' : '') }}" id="mdp_confirmation" name="fournisseur[mdp_confirmation]" value="{{ old('fournisseur.mdp_confirmation') }}" required>
                    </div>  
                    
                </div>
                <div class="container-xxl sub-bx">
                    <h1>Coordonnées</h1>
                    <div class="container-xxl">
                        <h1>Adresse</h1>
                        <div class="row">

                            <div class="col-sm-3">
                                <label for="no_rue">*No. civique:</label> 
                                <input type="text" class="form-control {{ $errors->has('fournisseur.no_rue') ? 'failure' : (old('fournisseur.no_rue') ? 'success' : '') }}" id="no_rue" name="fournisseur[no_rue]" value="{{ old('fournisseur.no_rue') }}" required >
                            </div>

                            <div class="col-sm-6">
                                <label for="rue">*Rue:</label>
                                <input type="text" class="form-control {{ $errors->has('fournisseur.rue') ? 'failure' : (old('fournisseur.rue') ? 'success' : '') }}" id="rue" name="fournisseur[rue]" value="{{ old('fournisseur.rue') }}" required>
                            </div>

                            <div class="col-sm-3">
                                <label for="no_bureau">Bureau:</label>
                                <input type="text" class="form-control {{ $errors->has('fournisseur.no_bureau') ? 'failure' : (old('fournisseur.no_bureau') ? 'success' : '') }}" id="no_bureau" name="fournisseur[no_bureau]" value="{{ old('fournisseur.no_bureau') }}">
                            </div>

                            <div class="col-lg-12">
                                <label for="ville">*Ville:</label>
                                <input type="text" class="form-control {{ $errors->has('fournisseur.ville') ? 'failure' : (old('fournisseur.ville') ? 'success' : '') }}" id="ville" name="fournisseur[ville]" value="{{ old('fournisseur.ville') }}" >
                            </div>

                            <div class="col-md-5">
                                <label for="province">*Province:</label>
                                <select id="province" name="fournisseur[province]" class="form-select {{ $errors->has('fournisseur.province') ? 'failure' : (old('fournisseur.province') ? 'success' : '') }}" value="{{ old('fournisseur.province') }}" required>
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
                                <label for="region_admin">*Regions administratives:</label>
                                <select id="region_admin" name="fournisseur[no_region_admin]" class="form-select {{ $errors->has('fournisseur.no_region_admin') ? 'failure' : (old('fournisseur.no_region_admin') ? 'success' : '') }}" value="{{ old('fournisseur.no_region_admin') }}" required>
                                    <option value="00">Extérieur du Québec</option>
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
                                <label for="code_postal">*Code postal:</label>
                                <input type="text" class="form-control {{ $errors->has('fournisseur.code_postal') ? 'failure' : (old('fournisseur.code_postal') ? 'success' : '') }}" id="code_postal" name="fournisseur[code_postal]" value="{{ old('fournisseur.code_postal') }}" required>
                            </div>
                        </div>
                    </div> 
                    <div class="container-xxl">
                        <label for="site_internet">Site internet:</label>
                        <input type="text" class="form-control {{ $errors->has('fournisseur.site_internet') ? 'failure' : (old('fournisseur.site_internet') ? 'success' : '') }}" id="site_internet" name="fournisseur[site_internet]" value="{{ old('fournisseur.site_internet') }}" >
                    </div>  

                    <div class="container-xxl">
                        <div id="telephone">
                            <div class="row phone-number-group">
                                <div class="col-md-3">
                                    <label for="type_tel1">*Type de Téléphones</label>
                                    <select id="type_tel1" name="type_tels[fournisseur]" class="form-select {{ $errors->has('type_tels.fournisseur') ? 'failure' : (old('type_tels.fournisseur') ? 'success' : '') }}" value="{{ old('type_tels.fournisseur') }}" required>
                                        <option value="bureau">Bureau</option>
                                        <option value="cellulaire">Célulaire</option>
                                        <option value="fax">Fax</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="no_tel1">*Téléphones:</label>
                                    <input type="text" class="form-control {{ $errors->has('no_tel.fournisseur') ? 'failure' : (old('no_tel.fournisseur') ? 'success' : '') }}" id="no_tel1" name="no_tel[fournisseur]" value="{{ old('no_tel.fournisseur') }}" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="poste_tel1">Poste:</label>
                                    <input type="text" class="form-control {{ $errors->has('poste_tel.fournisseur') ? 'failure' : (old('poste_tel.fournisseur') ? 'success' : '') }}" id="poste_tel1" name="poste_tel[fournisseur]" value="{{ old('poste_tel.fournisseur') }}" >
                                </div>
                                    
                            </div> 
                            <p id="p_bleu"> Il est possible d'ajouter un numéro de téléphone plus tard, en utilisant le menu </p>
                        </div>
                            
                    </div> 

                </div> 
                
                <div class="container-xxl sub-bx">
                    <h1>Contacts</h1>
                    <div id="contact">
                        <div class="row contact-group">
                            <div class="col-lg-12">
                                <label for="prenom_contact">*Prénom</label>
                                <input type="text" class="form-control {{ $errors->has('prenom.personne_ressource') ? 'failure' : (old('prenom.personne_ressource') ? 'success' : '') }}" id="prenom_contact" name="prenom[personne_ressource]" value="{{ old('prenom.personne_ressource') }}" required>
                            </div>

                            <div class="col-lg-12">
                                <label for="nom_contact">*Nom:</label>
                                <input type="text" class="form-control {{ $errors->has('nom.personne_ressource') ? 'failure' : (old('nom.personne_ressource') ? 'success' : '') }}" id="nom_contact" name="nom[personne_ressource]" value="{{ old('nom.personne_ressource') }}" required>
                            </div>

                            <div class="col-lg-12">
                                <label for="fonction">Fonction:</label>
                                <input type="text" class="form-control {{ $errors->has('fonction.personne_ressource') ? 'failure' : (old('fonction.personne_ressource') ? 'success' : '') }}" id="fonction" name="fonction[personne_ressource]" value="{{ old('fonction.personne_ressource') }}" >
                            </div>

                            <div class="col-lg-12">
                                <label for="email_contact">*Adresse courriel:</label>
                                <input type="text" class="form-control {{ $errors->has('email_contact.personne_ressource') ? 'failure' : (old('email_contact.personne_ressource') ? 'success' : '') }}" id="email_contact" name="email_contact[personne_ressource]" value="{{ old('email_contact.personne_ressource') }}" >
                            </div>
                        </div>
                    
                        <div class="container-xxl">
                            <div class="row contact-group-tel">
                                <div class="col-md-3">
                                    <label for="type_tel2">*Type de Téléphones</label>
                                    <select id="type_tel2" name="type_tels[personne_ressource]" class="form-select {{ $errors->has('type_tels.personne_ressource') ? 'failure' : (old('type_tels.personne_ressource') ? 'success' : '') }}" value="{{ old('type_tels.personne_ressource') }}" required>
                                        <option value="bureau">Bureau</option>
                                        <option value="cellulaire">Célulaire</option>
                                        <option value="fax">Fax</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="no_tel1">*Téléphones:</label>
                                    <input type="text" class="form-control {{ $errors->has('no_tel.personne_ressource') ? 'failure' : (old('no_tel.personne_ressource') ? 'success' : '') }}" id="no_tel_contact1" name="no_tel[personne_ressource]" value="{{ old('no_tel.personne_ressource') }}" required>
                                </div>

                                <div class="col-md-3">
                                    <label for="poste_tel1">Poste:</label>
                                    <input type="text" class="form-control {{ $errors->has('poste_tel.personne_ressource') ? 'failure' : (old('poste_tel.personne_ressource') ? 'success' : '') }}" id="poste_tel_contact1" name="poste_tel[personne_ressource]" value="{{ old('poste_tel.personne_ressource') }}">
                                </div>
                                    
                            </div> 
                        </div>
                        <p id="p_bleu"> Il est possible d'ajouter une autre personne contacte plus tard, en utilisant le menu </p>
                    </div>
                    
                </div>
            
            
                <div class="sub-bx">
                    <div class="row">
                        <div class=" col-md-9">  
                            <input type="text" id="searchFieldRBQ" placeholder="recherche de catégorie de licences rbq">
                            <button type="button" class="button" id="searchButtonRBQ">Rechercher</button>
                            <div id="listeRBQ">
                                @foreach($categorie as $section => $licences_rbqs)
                                    <h3>{{ $section }}</h3>
                                    <ul>
                                        @foreach($licences_rbqs as $licences_rbq)
                                            <li class="licence-item" id="hoverable" data-id="{{ $licences_rbq->id_licence_rbq }}">
                                                + {{ $licences_rbq->sous_categorie }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                           
                        
                        <div class="col-md-3">
                              <h3> Liste des licences prises </h3>
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
                                    $('#listeRBQ').html(data);
                                }
                                
                            });
                        });

                        document.addEventListener('DOMContentLoaded', function () {
                            const selectedLicencesList = document.getElementById('selectedLicencesList');

                            document.getElementById('listeRBQ').addEventListener('click', function (e) {
                                if (e.target.classList.contains('licence-item')) {
                                    const licenceId = e.target.getAttribute('data-id');

                                    // Check if item already exists in the second list
                                    const alreadySelected = Array.from(selectedLicencesList.children)
                                        .some(item => item.getAttribute('data-id') === licenceId);

                                    if (!alreadySelected) {
                                        const newItem = document.createElement('li');
                                        newItem.setAttribute('data-id', licenceId);
                                        newItem.setAttribute('id', 'hoverable');

                                        // Clean the "+" symbol and add "-" dynamically
                                        const originalText = e.target.textContent.trim();
                                        const cleanedText = originalText.replace(/^\+\s*/, ''); // Remove leading "+ "
                                        newItem.textContent = '- ' + cleanedText;

                                        newItem.classList.add('selected-item');
                                        selectedLicencesList.appendChild(newItem);
                                    }
                                }
                            });

                            selectedLicencesList.addEventListener('click', function (e) {
                                if (e.target.classList.contains('selected-item')) {
                                    selectedLicencesList.removeChild(e.target);
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
                                <p> faite une recherche pour voir les services possible </p>
                            </div>
                        </div>
                            
                        <div class="col-md-3">
                            <h3> Liste des catégories UNSPSC sélectionnées </h3>
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
                                    $('#listeCodes').html(data);
                                }
                                
                            });
                        });

                        document.addEventListener('DOMContentLoaded', function () {
                            const selectedCodeList = document.getElementById('selectedCodeList');

                            document.getElementById('listeCodes').addEventListener('click', function (e) {
                                if (e.target.classList.contains('licence-item')) {
                                    const Codes = e.target.getAttribute('data-id');

                                    const alreadySelected = Array.from(selectedCodeList.children)
                                        .some(item => item.getAttribute('data-id') === Codes);

                                    /*
                                    if (!alreadySelected) {
                                        const newItem = document.createElement('li');
                                        newItem.setAttribute('data-id', Codes);
                                        newItem.setAttribute('id', 'hoverable');
                                        newItem.textContent = e.target.textContent;
                                        newItem.classList.add('selected-item');
                                        selectedCodeList.appendChild(newItem);
                                    } 
                                    */
                                    if (!alreadySelected) {
                                        const newItem = document.createElement('li');
                                        newItem.setAttribute('data-id', Codes);
                                        newItem.setAttribute('id', 'hoverable');

                                        // Clean the "+" symbol and add "-" dynamically
                                        const originalText = e.target.textContent.trim();
                                        const cleanedText = originalText.replace(/^\+\s*/, ''); // Remove leading "+ "
                                        newItem.textContent = '- ' + cleanedText;

                                        newItem.classList.add('selected-item');
                                        selectedCodeList.appendChild(newItem);
                                    }
                                }
                            });
                            selectedCodeList.addEventListener('click', function (e) {
                                if (e.target.classList.contains('selected-item')) {
                                    selectedCodeList.removeChild(e.target);
                                }
                            });
                        });
                    </script>
                </div>
                
                <input type="hidden" name="licences_rbq" id="licences_rbq_input">
                <input type="hidden" name="codeUnspsc" id="code_input">


                <div class="container-xxl sub-bx">
                    <h1>Commentaires</h1>

                    <label for="commentaire">Commentaires et informations importantes :</label><br>
                    <textarea id="commentaire" name="fournisseur[commentaire]" rows="5" cols="100" placeholder="Commentaire..." style="resize: vertical;"></textarea><br>

                    <h1>Document</h1>
                    <input type="file" id="fichiers" name="fichiers">

                    <ul id="listeFichiers"></ul>
                    <p id="p_bleu"> Il est possible d'ajouter d'autre documents plus tard, en utilisant le menu</p>
                </div>
            </div>

        

            <div id="bt-center">
                <button type="submit" class="button" id="bt_submit" onclick="confirmAction(event)" >Envoyer le formulaire</button>
            </div>
        </form>

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

            document.getElementById('uploadForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);
            formData.forEach((value, key) => {
                console.log(key, value);
            });

            this.submit();
        });
        </script>

        <div>
            <button type="button" class="button" onclick="prevForm()" id="buttonLeft">Prev</button>
            <div id="whatForm"></div>
            <button type="button" class="button" onclick="nextForm()" id="buttonRight">Next</button>
        </div>

    @endsection