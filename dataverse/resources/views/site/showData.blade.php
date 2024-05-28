@extends('site.base')
@section('title', 'Gestion des données ')
@section('page-title', 'Gérer mes données importées')

@section('content')

<div class="inline-flex">
    <!-- Liste des données gérées -->
    <div class=" overflow-auto max-h-96 w-96 border border-solid border-gray-400 rounded-md mx-8 ">
        <h1 class="mx-4 text-xl">Liste de mes données</h1>
        @foreach($weatherDatas as $weatherData)
            <div class=" mt-2 mx-6">
                <strong>Date d'import:</strong> {{ $weatherData->imported_at }} <br>
                <strong>Lieu :</strong>{{$weatherData->name}} <br>
                <form action="{{route('showSummary', ['id' => $weatherData->id])}}" method="POST">
                    @csrf
                <button for="summaryData" type="submit">Résumé des données</button>
                </form>
            </div>
        @endforeach
    @if (isset($weatherData))
    @include('site.showSummary')
    @endif
    </div>
@endsection