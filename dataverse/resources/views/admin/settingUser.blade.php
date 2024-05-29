@extends('base')
@section('title', 'Gestion utilisateur')
@section('page-title', 'Gestion utilisateur :' . $user->fullName())

<div class="inline-flex space-x-8 mb-10">
    <div class="border-2 rounded-md px-6">
        <h2>Info Contributeur</h2>
        Nom : {{$user->lastname}}
        Prénom : {{$user->firstname}}
        Email : {{$user->email}}
        Actif depuis : {{$user->email_verified_at}}
    </div>
    <div class="flex mt-10 mb-3 ">
        <form action="#" method="GET">
            <button type="submit" class="shadow bg-red-300 hover:bg-red-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded">Rendre inactif</button>
        </form>
    </div>
    Envoyer un lien de récupération d'email :
    <a href="{{route('password.request')}}" class="text-gray-600 hover:text-cyan-700 px-3 py-2 rounded-md text-sm font-medium">Réinitialiser le mot de passe</a>
</div>
{{-- {{ route('disable', ['user' => $user->id]) }} --}}