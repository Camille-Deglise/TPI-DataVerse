@extends('base')
@section('title', 'Page d\'accueil')
@section('page-title', 'Bienvenue sur DataVerse')

@section('content')
<p>
    A venir 
</p>

<div class="mt-8">
    <h2 class="text-gray-700 text-center text-xl">Chercher un lieu</h2>
    <input type="search" name="search_bar" id="search_bar" aria-autocomplete="list" placeholder="NPA, Ville, Pays" 
    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500">
    <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded" type="submit">
        Chercher
      </button>
</div>



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