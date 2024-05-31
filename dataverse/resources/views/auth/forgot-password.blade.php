@extends('site.base')
@section('title', 'Mot de passe oublié')
@section('page-title', 'Réinitialisation du mot de passe')
@section('content')

<form class="w-full max-w-sm mx-auto pt-2" action="{{route('password.email')}}" method="POST">
    @csrf
    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="email" style="min-width: 100px;">Entrez votre adresse email</label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" id="email" name="email" type="email" 
        placeholder="" value="{{ old('email') }}" required>
    </div>
    <div class="md:w-2/3">
        <button class="shadow bg-gray-300 hover:bg-cyan-700 hover:text-gray-200 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
          Réinitialiser mon mot de passe
        </button>
      </div>
</form>

@endsection