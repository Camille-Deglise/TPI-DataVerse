@extends('site.base')
@section('title', 'Page d\'accueil')
@section('page-title', 'Bienvenue sur DataVerse')

@section('content')

@include('shared.search-bar')

<div class="mt-8 mb-8">
    <a href="{{route('import.showForm')}}"class="text-gray-700 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Importer des données</a>
    <a href="{{route('settData')}}"class="text-gray-700 hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Gérer  mes données</a>
</div>

@include('shared.no-result-search')



@endsection