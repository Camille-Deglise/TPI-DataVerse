@extends('site.base')
@section('title', 'Combinaison')
@section('page-title', 'Chercher un lieu et créer vos combinaisons graphiques')

@section('content')
<div class="inline-flex mt-2">
    <div class="mr-12">
        @include('shared.search-bar', ['fromCombi' => true])
        @include('shared.no-result-search', ['search' => $search, 'locations' => $locations])
    </div>
    
    <div class="ml-48 mb-10 shadow-lg w-96 border-2 rounded-lg font-cali">
        <h2 class="text-gray-700 text-center text-xl first-letter:text-2xl mt-4">Créer un graphique</h2>
        <div class>
            @if (!empty($location))
            <p class="first-letter:text-lg text-center">{{ $location->name }}</p>
            @endif
        </div>

            
        @include('site.formChart', [
        'location' => $location,
        'availableYears' => $availableYears ?? [],
        'availableMonths' => $availableMonths ?? [],
        'beginYear' => $beginYear ?? null,
        'beginMonth' => $beginMonth ?? null,
        'endYear' => $endYear ?? null,
        'endMonth' => $endMonth ?? null,
        'category' => $category ?? null])
                                            
    </div>

    <div class="ml-12 border-2 rounded-lg shadow-lg">
        @if (isset($noChartData))
            <p>{{ $noChartData->message }}</p>
         @elseif (isset($combiChart))
            @include('site.charts')
        @endif
    </div>
   
</div>
    
@endsection
