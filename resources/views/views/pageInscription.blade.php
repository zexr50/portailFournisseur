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

        <form method="post" action="" enctype="multipart/form-data">
        @csrf
        <div class="container-xxl">
            <div class="container-xxl">
                <h1>identification</h1>

                <label for="neq">Numéro d'entreprise du Québec:</label>
                <input type="text" class="form-control" id="neq" name="neq">

                <label for="nom_entreprise">Nom de l'entreprise:</label>
                <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise" required>

                <div class="container-xxl">
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
                <div class="container-xxl">
                    <h1>Adresse</h1>
                    <div class="row">

                        <div class="col-sm-3">
                            <label for="no_rue">No. civique:</label>
                            <input type="text" class="form-control" id="no_rue" name="no_rue">
                        </div>

                        <div class="col-sm-6">
                            <label for="rue">Rue:</label>
                            <input type="text" class="form-control" id="rue" name="rue">
                        </div>

                        <div class="col-sm-3">
                            <label for="no_bureau">Bureau:</label>
                            <input type="text" class="form-control" id="no_bureau" name="no_bureau">
                        </div>

                        <div class="col-lg-12">
                            <label for="ville">Ville:</label>
                            <input type="text" class="form-control" id="ville" name="ville">
                        </div>

                        <div class="col-sm-9">
                            <label for="province">Province:</label>
                            <select id="no_tel" name="type_tels[]" class="form-select" required>
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
                            <datalist id="provinces">
                                
                            </datalist>
                        </div>

                        <div class="col-sm-3">
                            <label for="code_postal">Code postal:</label>
                            <input type="text" class="form-control" id="code_postal" name="code_postal">
                        </div>
                    </div>
                </div> 
                <div class="container-xxl">
                    <label for="site_internet">Site internet:</label>
                    <input type="text" class="form-control" id="site_internet" name="site_internet">
                </div>  

                <div class="container-xxl">
                    <div id="telephone">
                        <div class="row phone-number-group">
                            <div class="col-md-3">
                                <label for="type_tel">type de Téléphones</label>
                                <select id="no_tel" name="type_tels[]" class="form-select" required>
                                    <option value="bureau">Bureau</option>
                                    <option value="cellulaire">Célulaire</option>
                                    <option value="fax">Fax</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="no_tel">Téléphones:</label>
                                <input type="text" class="form-control" id="no_tel" name="no_tel">
                            </div>

                            <div class="col-md-3">
                                <label for="poste_tel">Poste:</label>
                                <input type="text" class="form-control" id="poste_tel" name="poste_tel">
                            </div>
                                
                        </div> 
                    </div>
                    <div id="bt-center">
                        <button type="button" onclick="addPhoneNumber()" class="button" id="btAddTelephone">Ajouter un téléphone</button>
                    </div>
                        
                </div> 

            </div> 
            
            <div class="container-xxl">
                <h1>Contacts</h1>
                <div id="contact">
                    <div class="row contact-group">
                        <div class="col-lg-12">
                            <label for="prenom_contact">Prénom</label>
                            <input type="text" class="form-control" id="prenom_contact" name="prenom_contacts[]">
                        </div>

                        <div class="col-lg-12">
                            <label for="nom_contact">Nom:</label>
                            <input type="text" class="form-control" id="nom_contact" name="nom_contact" required>
                        </div>

                        <div class="col-lg-12">
                            <label for="fonction">Fonction:</label>
                            <input type="text" class="form-control" id="fonction" name="fonction">
                        </div>

                        <div class="col-lg-12">
                            <label for="email_contact">Adresse courriel:</label>
                            <input type="text" class="form-control" id="email_contact" name="email_contact" required>
                        </div>
                    </div>
                
                    <div class="container-xxl">
                        <div class="row contact-group-tel">
                            <div class="col-md-3">
                                <label for="type_tel">type de Téléphones</label>
                                <select id="type_tel" name="type_tels[]" class="form-select" required>
                                    <option value="bureau">Bureau</option>
                                    <option value="cellulaire">Célulaire</option>
                                    <option value="fax">Fax</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="no_tel">Téléphones:</label>
                                <input type="text" class="form-control" id="no_tel" name="no_tel">
                            </div>

                            <div class="col-md-3">
                                <label for="poste_tel">Poste:</label>
                                <input type="text" class="form-control" id="poste_tel" name="poste_tel">
                            </div>
                                
                        </div> 
                    </div>
                </div>
                <div id="bt-center">
                <button type="button" onclick="addContactPerson()" class="button" id="btAddTelephone">Ajouter une personne contact</button>
                </div>
            </div>
        </div>
        
        <div id="bt-center">
        <button type="submit" class="button">envoyer le formulaire</button>
        </div>
    </form>
@endsection