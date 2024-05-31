@extends('site.base')
@section('title', 'Page d\'accueil')
@section('page-title', 'Bienvenue sur DataVerse')

@section('content')

<div class="inline-flex mt-2 ">
    <div class="ml-12">
        @include('shared.search-bar')
        @include('shared.no-result-search')
    </div>
    
    <div class="shadow-lg mx-48 w-96 ">
        <div class="border-2 border-cyan-600 border-solid rounded-md mx-8 ">
            <h2 class="text-gray-700 text-center text-xl first-letter:text-2xl mt-4"> Mes cinq derniers imports </h2>
            @foreach($weatherDatas as $weatherData)
                <div class=" mt-2 mx-6 mb-4 font-cali">
                    <p class="first-letter:text-lg">Date d'import: {{ $weatherData->imported_at }}</p>
                    <p class="first-letter:text-lg">Lieu : {{$weatherData->name}}</p> 
                    <a href="{{route('showSummary', ['id' => $weatherData->id]) }}">
                        <button class="hover:bg-cyan-700 hover:text-gray-200 hover:font-bold border-2 border-gray-200 rounded-s-md px-2" type="button"> 
                            Résumé des données</button>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    
</div>


@endsection