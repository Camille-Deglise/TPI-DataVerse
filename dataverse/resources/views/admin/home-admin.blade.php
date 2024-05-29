@extends('site.base')
@section('title', 'Page d\'accueil')
@section('page-title', 'Bienvenue')

@section('content')

<div class="mt-8 mb-8">
    <a href="{{route('import.showForm')}}"class="text-gray-700 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Importer des données</a>
    <a href="{{route('settData')}}"class="text-gray-700 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Gérer  mes données</a>
    
</div>





@include('admin.search-bar-users')
@include('admin.result-search')


<div class="border-2 rounded-md px-6 inline-flex space-x-8 mb-10">
    <p>Présence de données erronnées ?</p>
    <a href="http://localhost:8081/index.php?route=/" target="_blank" class=" m-4 border-2 text-gray-700 hover:bg-cyan-700 hover:text-white px-3 py-2  text-sm font-medium">phpMyAdmin</a>
</div>






















@endsection