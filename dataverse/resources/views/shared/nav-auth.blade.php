@php
    $user = Auth::user();
@endphp
@auth

    <div class="flex space-x-4 items-center">
        <a href="{{route('home-auth', $user->id)}}"class="text-gray-300 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Accueil</a>
        <a href="{{route('setting.edit')}}"class="text-gray-300 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Gérer mon profil</a>
        
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
