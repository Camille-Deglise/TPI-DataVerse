@extends('site.base')
@section('title', 'Gestion des données ')
@section('page-title', 'Gérer toutes les données')

@section('content')


<form action="">
    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="locations" style="min-width: 100px;">
            Lieux 
        </label>
        <select id="locations" name="locations" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500">
            <option value="" disabled selected>Lieux disponibles</option>
            @foreach($allLocations as $location)
            <option value="{{ $location->id }}">
                {{ $location->name }} {{$location->zipcode}}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="locations" style="min-width: 100px;">
            Utilisateurs
        </label>
        <select id="users" name="users" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500">
            <option value="" disabled selected>Utilisateurs ayant importés des données</option>
            @foreach($allUsers as $user)
            <option value="{{ $user->id }}">
                {{ $user->lastname }} {{$user->firstname}}
            </option>
            @endforeach
        </select>
    </div>
</form>
@endsection