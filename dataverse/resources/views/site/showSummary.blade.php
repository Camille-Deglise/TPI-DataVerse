@extends('site.base')
@section('title', 'Résumé des données')
@section('page-title', 'Résumé des données')

@section('content')
<div>
    <strong>Lieu : </strong>{{$weatherData->locations->name}} <br>
    <strong>Date d'import: </strong> {{ $weatherData->imported_at }} <br>
        <ul>
            <li>Précipitations: {{$weatherData->precipitation}} mm</li>
            <li>Ensoleillement: {{$weatherData->sunshine}} heures par jour</li>
            <li>Neige: {{$weatherData->snow}} cm</li>
            <li>Température: {{$weatherData->temperature}} C°</li>
            <li>Humidité: {{$weatherData->humidity}} %</li>
            <li>Vent {{$weatherData->wind}} km/h</li>
            <li>Date du relevé {{$weatherData->statement_date}}</li>
        </ul>
    <br>
    
    <p class="first-letter:text-xl font-semibold mb-2">Ré-importer un autre fichier pour ce lieu</p>
    <form action="{{route('reimport', ['id' => $weatherData->id])}}" method="POST" class="mt-10 mb-10" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mb-4">
            <label for="csv_file" class="font-bold underline block mb-6">Sélectionner un fichier de type "CSV"</label>
            <input type="file" name="csv_file" id="csv_file" class="form-control-file">
        </div>
        <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded mt-4" type="submit">Importer</button>
    </form>
</div>
@endsection

