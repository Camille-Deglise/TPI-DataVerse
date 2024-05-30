@php
    $user = Auth::user();
    $user->is_admin;
    $users = app\Models\User::all();
@endphp
@auth

    <div class="flex space-x-4 items-center">
        <a href="{{route('home', $user->id)}}"class="text-gray-300 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Accueil</a>
        <a href="{{route('setting.edit')}}"class="text-gray-300 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Gérer mon profil</a>
        <div class="relative ">
            <a href="#" class="text-gray-300 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" >Gestion Contributeurs</a>
                <div class=" absolute hidden bg-gray-500 rounded-md shadow-md">
                    <ul>
                        @foreach ($users as $user)
                        @if($user->is_activ)
                            <li>
                                <a href="{{ route('user.setting', ['id' => $user->id]) }}" class="bg-gray text-black w-48 px-3 py-2 rounded-md text-sm font-medium flex items-center">{{$user->lastname}} {{$user->firstname}}</a>
                            </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
        </div>
    </div>

    <div class="ml-auto flex items-center">
        <span class="text-gray-300 text-base font-semibold mr-4">
            {{ Auth::user()->fullName() }}
        </span> 
        <form class="nav-item" action="{{route('logout')}}" method="POST">
            @method('delete') 
            @csrf
            <button class="nav-link text-gray-300 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Se déconnecter</button>
        </form>
    </div>

@endauth
{{--  --}}