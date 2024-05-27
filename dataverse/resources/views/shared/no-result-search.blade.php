@if(!empty($search))
    <h2>Résultats pour "{{ $search }}"</h2>

    @if($locations->isNotEmpty())
        <ul>
            @foreach($locations as $location)
            <li><a href="{{ route('combi', ['id' => $location->id]) }}">{{ $location->name }}</a></li>
            @endforeach
        </ul>
    @else
        <p>Aucune ville correspondante trouvée.</p>
    @endif
@endif