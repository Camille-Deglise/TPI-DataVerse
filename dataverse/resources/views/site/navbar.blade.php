<div class="max-w-7xl mx-auto px-4 flex justify-between items-center h-16">
    <div class="flex items-center space-x-4">
        <div class="flex-shrink-0 mr-4">
                <a href="{{route('home')}}">
                <img src="{{ asset('img/meteo.png') }}" alt="Logo DataVerse" class="h-20 w-auto">
                <span class="text-gray-300 text-lg font-semibold">DataVerse</span>
            </a>
        </div>
        @guest
            <div class="flex space-x-6">
                <a href="{{route('home')}}"class="text-gray-300 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Accueil</a>
                <a href="{{ route('login') }}" class="text-gray-300 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Se connecter</a>
            </div>
        @endguest
    </div>
    @include('site.nav-auth')
</div>