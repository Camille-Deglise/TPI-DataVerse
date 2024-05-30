@extends('site.base')
@section('title', 'Page d\'accueil')
@section('page-title', 'Bienvenue sur DataVerse')

@section('content')

<div class="inline-flex ">
    <div class="shadow-lg w-80 ">
        <article class="border-2 px-10 py-6 mb-3 text-gray-500 dark:text-gray-400 first-line:uppercase first-line:tracking-widest first-letter:text-5xl first-letter:font-bold first-letter:text-gray-900 dark:first-letter:text-gray-100 first-letter:me-3 first-letter:float-start">
        Bonjour à vous, chers curieux de la météo ! <br>
        Ce petit site vous permet de visualiser des graphiques de données métérologiques. <br>
        En sélectionnant un lieu, vous pouvez choisir des catégories de données météos 
        et une durée dans le temps.  <br> Cela générera un graphique. Facile non ? <br>
    
        Vous avez la possibilité de vous inscrire afin d'apporter vos propres
        données, d'ajouter des lieux qui n'existent pas encore. 
        <br>
        Bonne visite et n'hésitez pas à nous contacter en cas de questions ! <br>
        <div class="relative my-2 h-10 ">
        <a href="mailto:camille.deglise@eduvaud.ch" class= "border-blue-200 border-2 rounded-md absolute place-items-end first-letter:text-xl hover:text-cyan-800 hover:font-semibold px-3 py-2">Contact</a>
        </div>
        </article>
    </div>
    <div class="mx-12">
        @include('shared.search-bar')
        @include('shared.no-result-search')
    </div>
  
</div>

<div class="mt-8">
    <h2 class="text-gray-700 text-center text-xl">Graphique Aléatoire</h2>
        @if($location)
        <h2>Lieu : {{ $location->name }}</h2>
        @endif
    @if($randomChartData instanceof \App\Charts\NoChartData)
            <p>{{ $randomChartData->message }}</p>
        @else
            <div class="chart-container">
                {!! $randomChartData->container() !!}
            </div>
            {!! $randomChartData->script() !!}
        @endif
</div>
@endsection