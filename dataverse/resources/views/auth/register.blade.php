@extends('base')
@section('title', 'S\'inscrire')

@section('page-title', 'Inscription')
    
@section('content')
<form class="w-full max-w-sm mx-auto" action="{{ route('register') }}" method="POST">
  @csrf
    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="lastname" style="min-width: 100px;">Nom</label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" id="lastname" name="lastname" type="text" 
        placeholder="Entrer un nom" value="{{ old('lastname') }}" required>
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="firstname" style="min-width: 100px;">Prénom</label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" id="firstname" name="firstname" type="text" 
        placeholder="Entrer un prénom" value="{{ old('firstname') }}" required>
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="email" style="min-width: 100px;">Email</label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" id="email" name="email" type="email" 
        placeholder="Entrer un email valide" value="{{ old('email') }}" required>
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="password" style="min-width: 100px;">Mot de passe</label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" id="password" name="password" type="password" 
        placeholder="Mot de passe" required>
    </div>

    <div class="md:w-2/3">
      <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
        S'inscrire
      </button>
    </div>
</form>


@endsection