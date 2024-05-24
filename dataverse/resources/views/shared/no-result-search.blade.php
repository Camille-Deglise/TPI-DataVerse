
@if(!empty($search))
    <h2>Résultats pour "{{ $search }}"</h2>
    <p>Aucun résultat trouvé.</p>
@endif

@if(!empty($locationsContaining))
<p>Votre recherche se trouve peut-être dans cette liste</p>
<ul>
    @foreach($locationsContaining as $location)
        <li>{{ $location->name }} ({{ $location->zipcode }})</li>
    @endforeach
</ul> 
@endif