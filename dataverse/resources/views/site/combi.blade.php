@extends('site.base')
@section('title', 'Combinaison')
@section('page-title', 'Chercher un lieu et créer vos combinaisons graphiques')

@section('content')
@include('shared.search-bar')

@if (!empty($location))
    <h1>{{ $location->name }}</h1>

@else
    @include('shared.no-result-search')
@endif

<p>Graphique</p> 

<form action="{{route('combinaison', ['id' =>$location->id])}}" method="POST">
    @csrf
    <p>Choisissez une catégorie</p>
    <label for="precipitations">Précipitations</label> 
    <input type="radio" name="category" value="precipitations">
    
    <label for="sunshine">Ensoleillement</label> 
    <input type="radio" name="category" value="sunshine">
    
    <label for="snow">Neige</label> 
    <input type="radio" name="category" value="snow">
    
    <label for="wind">Vent</label> 
    <input type="radio" name="category" value="wind">
    
    <label for="temperature">Température</label> 
    <input type="radio" name="category" value="temperature">
    
    <label for="humidity">Humidité</label> 
    <input type="radio" name="category" value="humidity">

    <p>Choisir des dates</p>
    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="begin_date" style="min-width: 100px;">
            Date de début
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
            id="begin_date" name="begin_date" type="date">
    </div>

    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="end_date" style="min-width: 100px;">
            Date de fin
        </label>
        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
            id="end_date" name="end_date" type="date">
    </div>

    <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
        Créer
    </button>
</form>

@if (isset($combiChart))
    @include('site.charts')
@endif
@endsection