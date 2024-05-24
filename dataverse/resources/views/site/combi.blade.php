@extends('site.base')
@section('title', 'Combinaison')
@section('page-title', 'Chercher et créer vos combinaisons graphiques')

@section('content')
@include('shared.search-bar')

@if (!empty($location))
   <h1>{{$location->name}}</h1>

    <p>Choissiez une catégorie</p>
    <label for="precipitations">Précipitations</label> <input type="radiobutton" value="">
    <label for="sunshine">Ensoleillement</label> <input type="radiobutton" value="">
    <label for="snow">Neige</label> <input type="radiobutton" value="">
    <label for="wind">Vent</label> <input type="radiobutton" value="">
    <label for="temperature">Température</label> <input type="radiobutton" value="">
    <label for="humidity">Humidité</label> <input type="radiobutton" value="">

    <p>Choisir des dates</p>
    <label for="date_begin">Date de début</label><input type="date" name="date_begin">
    <label for="date_end">Date de fin</label><input type="date" name="date_end">

    <p>Graphique</p> 

@else
@include('shared.no-result-search')
@endif




@endsection