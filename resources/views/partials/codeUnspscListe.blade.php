@foreach($categorieCode as $section2 => $codeUnspscs)
    <h3>{{ $section2 }}</h3>
    <ul>
        @foreach($codeUnspscs as $codeUnspsc)
            <li>
                <input type="checkbox" value="{{ $codeUnspsc->id_code_unspsc }}" id="{{ $codeUnspsc->code_unspsc }}" class="entry-select"> {{ $codeUnspsc->code_unspsc }} - {{ $codeUnspsc->categorie }} / {{ $codeUnspsc->classe_categorie }} / {{ $codeUnspsc->precision_categorie }}
            </li>
        @endforeach
    </ul>
@endforeach