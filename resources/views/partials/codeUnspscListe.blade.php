@foreach($categorieCode as $section1 => $codeUnspscs)
    <h3>{{ $section1 }}</h3>
        @foreach($classCategorie as $section2 => $codeUnspscs)
            <h5>{{ $section2 }}</h5>
                <ul>
                    @foreach($codeUnspscs as $codeUnspsc)
                        <li>
                            <input type="checkbox" value="{{ $codeUnspsc->id_code_unspsc }}" id="{{ $codeUnspsc->code_unspsc }}" class="entry-select"> {{ $codeUnspsc->precision_categorie }}
                        </li>
                    @endforeach
                </ul>
        @endforeach
@endforeach