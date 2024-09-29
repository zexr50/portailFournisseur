@foreach($categorie as $section => $licences_rbqs)
    <h3>{{ $section }}</h3> <!-- Display the section title -->
    <ul>
        @foreach($licences_rbqs as $licences_rbq)
            <li>
                <input type="checkbox" value="{{ $licences_rbq->id_licence_rbq }}" id="{{ $licences_rbq->sous_categorie }}" class="entry-select"> {{ $licences_rbq->sous_categorie }}
            </li>
        @endforeach
    </ul>
@endforeach