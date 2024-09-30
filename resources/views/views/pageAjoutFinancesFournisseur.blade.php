@extends('layouts.app')
    @section('title',"V3R Fournisseur Login")
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/pageAjoutFinances.css') }}">
    @show
    @section('js')
        <script src="{{ asset('js/pageInscription.js') }}"></script>
    @endsection
    @section('content')

    <form method="post" action="{{ route('Finance.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="container-xxl">
                <h1>Finances</h1>

                <label for="numTPS">Numéro de TPS :</label>
                <input type="text" class="form-control" id="numTPS" name="numTPS" required>

                <label for="numTVQ">Numéro de TVQ :</label>
                <input type="text" class="form-control" id="numTVQ" name="numTVQ" required>    
    </div>

    <div class="container-xxl">
                        <label for="conditions">Conditions de paiement</label>
                        <select id="conditionPaiement" name="conditionPaiement" class="form-select" required>
                            <option value="Option1">Option1</option>
                            <option value="Option2">Option2</option>
                            <option value="Option3">Option3</option>
                        </select>
    </div>

    <div class="container-xxl">
            <label for="methodes">Méthode de paiement</label>

                <div class="container-xl">
                    <label for="conditions">Devise</label><br>

                    <input type="radio" id="cad" name="devise" value="cad">
                    <label for="cad">CAD - Dollar Canadien</label><br>
                    <input type="radio" id="usd" name="devise" value="usd">
                    <label for="usd">USD - Dollar des États-Unis</label><br>
                </div>

                <div class="container-xl">
                    <label for="conditions">Mode de communication :</label><br>

                    <input type="radio" id="courriel" name="modeCom" value="courriel">
                    <label for="courriel">Courriel</label><br>
                    <input type="radio" id="courrielReg" name="modeCom" value="courrielReg">
                    <label for="courrielReg">Courriel Régulier</label><br>
                </div>

                <div style="text-align:center">
                    <button type="submit" class="button">Ajouter</button>
                </div>

    </div>

    </div>

    </form>

        
@endsection