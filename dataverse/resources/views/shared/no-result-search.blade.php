@if (!empty($search))
    <h2 class=" mt-3 text-gray-700 text-center text-xl pb-3 first-letter:text-2xl">Résultats pour "{{ $search }}"</h2>

    @if($locations->isNotEmpty())
        <ul class="px-12">
            @foreach($locations as $location)
                <li class="text-gray-700 text-justify list-disc hover:bg-cyan-600 hover:text-gray-200 hover:font-semibold rounded-md" >
                    <a href="{{ route('combi', ['id' => $location->id]) }}">{{ $location->name }}</a></li>
            @endforeach
        </ul>
    @else
        <p  class=" mt-3 text-gray-700 text-center text-xl pb-3 first-letter:text-2xl">Aucun lieu correspondant trouvé.</p>
    @endif
@endif