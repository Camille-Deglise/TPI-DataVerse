@extends('site.base')
@section('title', 'Page d\'accueil')
@section('page-title', 'Bienvenue sur DataVerse')

@section('content')

<div>
    Salut à vous, chers curieux de la météo ! <br>
    Ce petit site web vous permet de visualiser des graphiques ! <br>
    En choissant un lieu, vous pouvez choisir des catégories de données météos 
    et une durée dans le temps.  <br> Cela générera un graphique. Facile non ? <br>

    Vous avez la possibilité de vous inscrire afin d'apporter vos propres
    données, d'ajouter des lieux qui n'existent pas encore. 
    <br>
    Bonne visite et n'hésitez pas à nous contacter en cas de questions ! <br>

    <a href="mailto:camille.deglise@eduvaud.ch" class= "hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md">Contact</a>

</div>

@include('shared.search-bar')
@include('shared.no-result-search')
<div class="mt-8">
    <h2 class="text-gray-700 text-center text-xl">Graphique Aléatoire</h2>

    @if($randomChartData instanceof \App\Charts\NoChartData)
        <p>
            {{$randomChartData->message}}
        </p>
    @else
        {!! $randomChartData->container() !!}
        {!! $randomChartData->script() !!}
    @endif
</div>
@endsection