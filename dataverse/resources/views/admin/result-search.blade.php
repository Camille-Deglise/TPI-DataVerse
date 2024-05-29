@if(!empty($search))
    <h2>Résultats pour "{{ $search }}"</h2>

    @if(!empty($exactUser))
    <p><a href="{{route('user.setting', ['id'=>$exactUser->id])}}" class="underline">{{ $exactUser->lastname }} {{ $exactUser->firstname }} - {{ $exactUser->email }}</a></p>
    @endif

    @if($users->isNotEmpty())
    <h3>Utilisateurs similaires : </h3>
        <ul>
            @foreach($users as $user)
                <li>* {{ $user->lastname }} {{ $user->firstname }}</li>
            @endforeach
        </ul>
    @else
        <p>Aucun utilisateur trouvé.</p>
    @endif
@endif

{{-- {{route('user.setting', ['id'=>$exactUser->id])}} --}}