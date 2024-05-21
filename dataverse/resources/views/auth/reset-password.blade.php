@extends('base')
@section('title', 'Mot de passe oublié')
@section('page-title', 'Réinitialisation du mot de passe')
@section('content')
@guest
        <form class="w-full max-w-sm mx-auto" action="{{route('password.update')}}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{$token}}">
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
                    id="password" name="password" type="password" placeholder="Entrez un nouveau mot de passe">
            </div>
            <div class="mb-6 flex items-center">
                <label class="block text-gray-500 font-bold mr-4" for="password" style="min-width: 100px;">
                    Confirmation du mot de passe
                </label>
                <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
                    id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirmez votre mot de passe">
            </div>

            <div class="md:flex md:items-center">
                <div class="md:w-1/3"></div>
                <div class="md:w-2/3">
                    <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
                        Modifier mon mot de passe
                    </button>
                </div>
            </div>
            
        </form>
@endguest
@endsection