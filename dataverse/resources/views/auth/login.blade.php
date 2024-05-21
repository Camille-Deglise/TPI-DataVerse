@extends('base')
@section('title', 'Connexion')
@section('page-title', 'Connexion')
@section('content')

    @guest
        <form class="w-full max-w-sm mx-auto" action="{{route('login')}}" method="POST">
            @csrf
            <div class="mb-6 flex items-center">
                <label class="block text-gray-500 font-bold mr-4" for="email" style="min-width: 100px;">
                    Email
                </label>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
                    id="email" name="email" type="email" 
                    placeholder="Entrer votre email validé" value="{{ old('email')}}">

            </div>
            <div class="mb-6 flex items-center">
                <label class="block text-gray-500 font-bold mr-4" for="password" style="min-width: 100px;">
                    Mot de passe
                </label>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
                    id="password" name="password" type="password" placeholder="Entrez votre mot de passe">
            </div>
            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
                        Se connecter
                    </button>
                </div>
            </div>
            
        </form>
        <div class="col-span-1">
            <a href="{{route('password.request')}}" class="text-gray-600 hover:text-cyan-700 px-3 py-2 rounded-md text-sm font-medium">Mot de passe oublié ?</a>
            <a href="{{ route('register') }}" class="text-gray-600 hover:text-cyan-700 px-3 py-2 rounded-md text-sm font-medium">Pas encore inscrit ?</a>
        </div>
        
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('userNotFound') }}</div>
        @endif

        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
        @else
        <div class="text-center py-4">
            <p class="text-2xl font-semibold">Vous êtes déjà connecté en tant que {{ Auth::user()->fullName() }}</p>
            <p class="mt-4"><a href="{{ route('home') }}" class="text-cyan-500 hover:underline">Accéder à la page d'accueil</a></p>
        </div>
    @endguest

    
    

@endsection
