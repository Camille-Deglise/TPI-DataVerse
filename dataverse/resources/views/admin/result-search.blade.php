@if(!empty($search))
    <h2 class=" mt-3 text-gray-700 text-xl pb-3 first-letter:text-2xl">Résultats pour "{{ $search }}"</h2>

    @if(!empty($exactUser))
    <p><a href="{{route('user.setting', ['id'=>$exactUser->id])}}" class="underline">{{ $exactUser->lastname }} {{ $exactUser->firstname }} - {{ $exactUser->email }}</a></p>
    @endif

    @if($users->isNotEmpty())
    <h3 class=" mt-1 text-gray-700 text-xl pb-3 first-letter:text-2xl">Utilisateurs similaires : </h3>
        <ul>
            @foreach($users as $user)
                <li class="text-gray-700 text-justify list-disc hover:bg-cyan-600 hover:text-gray-200 hover:font-semibold rounded-md">
                    <a href="{{route('user.setting', ['id'=>$user->id])}}"></a> {{ $user->lastname }} {{ $user->firstname }}</li>
            @endforeach
        </ul>
    @else
        <p class=" mt-3 text-gray-700 text-center text-xl pb-3 first-letter:text-2xl>Aucun utilisateur trouvé.</p>
    @endif
@endif

