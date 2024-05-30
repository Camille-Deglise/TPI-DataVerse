@extends('site.base')
@section('title', 'Combinaison')
@section('page-title', 'Chercher un lieu et créer vos combinaisons graphiques')

@section('content')
    @include('shared.search-bar', ['fromCombi' => true])

    @if (!empty($location))
        <h1>{{ $location->name }}</h1>
    @endif

    <p>Graphique</p>

    @include('site.formChart', [
        'location' => $location,
        'availableYears' => $availableYears ?? [],
        'availableMonths' => $availableMonths ?? [],
        'beginYear' => $beginYear ?? null,
        'beginMonth' => $beginMonth ?? null,
        'endYear' => $endYear ?? null,
        'endMonth' => $endMonth ?? null,
        'category' => $category ?? null
    ])

    @include('shared.no-result-search', ['search' => $search, 'locations' => $locations])

    @if (isset($noChartData))
        <p>{{ $noChartData->message }}</p>
    @elseif (isset($combiChart))
        @include('site.charts')
    @endif
@endsection
