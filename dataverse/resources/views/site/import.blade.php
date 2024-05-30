@extends('site.base')
@section('title', 'Importer des données')
@section('page-title', 'Importer des données météorologiques')

@section('content')
Pour importer un fichier, veuillez vous assurer que le type est <strong>CSV</strong>.
<br>Il doit comporter des colonnes précises et dans l'odre ci-dessous : 
<ul>
    <li>* precipitation</li>
    <li>* sunshine</li>
    <li>* snow</li>
    <li>* temperature</li>
    <li>* humidity</li>
    <li>* wind</li>
    <li>* statement_date</li>
</ul>
Ces colonnes comprennent les différentes données que vous pouvez importer. La seule obligatoire est <strong>statement_date</strong>.
<form action="{{route('import.process')}}" method="POST" class="mt-10 mb-10" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="mb-6 flex items-center">
        <label class="block text-gray-500 font-bold mr-4" for="locationImport" style="min-width: 100px;">
            Veuillez choisir un lieu 
        </label>
        <select name="locationImport" id="locationImport" class="form-control">
            <option value="" disabled selected>Lieux disponibles</option>
            @foreach($locationsImport as $location)
                <option value="{{ $location->id }}">
                    {{ $location->name }}
                </option>
            @endforeach
        </select>
        <div class="ml-20 mb-6 flex items-center">
            <p>Si le lieu désiré ne se trouve pas dans la liste, vous pouvez l'ajouter</p>
            <label class="block text-gray-500 font-bold mr-4" for="newLocationName">Ajouter un nom de lieu</label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
            type="text" name="newLocationName" id="newLocationName" value="{{ old('newLocationName')}}">
        </div>

        <div class="ml-20 mb-6 flex items-center">
            <label class="block text-gray-500 font-bold mr-4" for="newLocationZip">Ajouter un code postal</label>
            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-grey-500" 
            type="text" name="newLocationZip" id="newLocationZip" value="{{ old('newLocationZip')}}">
        </div>

    </div>
    <div class="mb-4">
        <label for="csv_file" class="font-bold underline block mb-6">Sélectionner un fichier de type "CSV"</label>
        <input type="file" name="csv_file" id="csv_file" class="form-control-file">
    </div>
    <button class="shadow bg-gray-300 hover:bg-gray-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded mt-4" type="submit">Importer</button>
</form>

@endsection

