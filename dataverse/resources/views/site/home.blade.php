@extends('site.base')
@section('title', 'Page d\'accueil')
@section('page-title', 'Bienvenue sur DataVerse')

@section('content')

@include('shared.search-bar')



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