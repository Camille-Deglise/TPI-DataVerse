@extends('site.base')
@section('title', 'Gestion des données ')
@section('page-title', 'Gérer toutes les données')

@section('content')

<div class="inline-flex space-x-8 mb-10">
    <!-- Liste des données gérées -->
    <div class="shadow-lg h-96 w-96 ">
        <div class=" overflow-auto h-96 w-auto border-2 border-cyan-600 border-solid rounded-md mx-8 " >
            <h1 class="text-gray-700 text-center text-xl first-letter:text-2xl mt-4">Liste des données</h1>
            @foreach($allDatas as $data)
                <div class=" mt-2 mx-6 mb-4 font-cali">
                    <p class="first-letter:text-lg">Date d'import: {{ $data->imported_at}}</p>
                    <p class="first-letter:text-lg">Lieu : {{$data->name}}</p> 
                    {{-- <p class="first-letter:text-lg">Utilisaeur : {{$data->user->lastname}} {{$data->user->firstname}}</p> --}}
                    <a href="#">
                        <button class="hover:bg-cyan-700 hover:text-gray-200 hover:font-bold border-2 border-gray-200 rounded-s-md px-2" type="button">Résumé des données</button>
                    </a>
                </div>
            @endforeach
        </div>
    </div>    
   
</div>
@endsection