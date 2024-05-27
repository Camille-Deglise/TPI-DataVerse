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

<form action="{{route('combinaison')}}" method="POST">
    @csrf
<p>Choisissez une catégorie</p>
    <label for="precipitations">Précipitations</label> <input type="radio" name="category" value="precipitations">
    <label for="sunshine">Ensoleillement</label> <input type="radio" name="category" value="sunshine">
    <label for="snow">Neige</label> <input type="radio" name="category" value="snow">
    <label for="wind">Vent</label> <input type="radio" name="category" value="wind">
    <label for="temperature">Température</label> <input type="radio" name="category" value="temperature">
    <label for="humidity">Humidité</label> <input type="radio" name="category" value="humidity">

<p>Choisir des dates</p>
    <label for="begin_date">Date de début :</label>
    <input type="date" name="begin_date">
    <label for="end_date">Date de fin :</label>
    <input type="date" name="end_date">

    <button type="submit">Créer</button>
</form>

@endsection