@extends('site.base')
@section('title', 'Page d\'accueil')
@section('page-title', 'Bienvenue')

@section('content')
<div class="inline-flex mt-2 ">
    <div class="ml-12">
        @include('admin.search-bar-users')
        @include('admin.result-search')
    </div>

    <div class="mt-8 ml-60 px-12   w-full md:w-auto ">
        <div class=" shadow-lg border-2 rounded-md px-6 inline-flex space-x-8 mb-10">
        <p>Présence de données erronnées ?</p>
        <a href="http://localhost:8081/index.php?route=/" target="_blank" class=" m-4 border-2 rounded-lg text-gray-700 hover:bg-cyan-700 hover:text-white px-3 py-2  text-sm font-medium">phpMyAdmin</a>
        </div>
    </div>
</div>


@endsection