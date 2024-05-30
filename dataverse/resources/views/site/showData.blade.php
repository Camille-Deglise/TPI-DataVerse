@extends('site.base')
@section('title', 'Gestion des données ')
@section('page-title', 'Gérer mes données importées')

@section('content')

<div class="inline-flex">
    <!-- Liste des données gérées -->
    <div class="  border border-solid border-gray-400 rounded-md mx-8 ">
        <h1 class="mx-4 text-xl">Liste de mes données</h1>
        @foreach($weatherDatas as $weatherData)
            <div class=" mt-2 mx-6">
                <strong>Date d'import:</strong> {{ $weatherData->imported_at }} <br>
                <strong>Lieu :</strong>{{$weatherData->name}} <br>
                <a href="{{route('showSummary', ['id' => $weatherData->id]) }}">
                    <button type="button">Résumé des données</button>
                </a>
            </div>
        @endforeach
    </div>
@endsection
{{-- overflow-auto max-h-96 w-96 --}}