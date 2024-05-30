@extends('site.base')
@section('title', 'Gestion utilisateur')
@section('page-title', 'Gestion utilisateur : ' . $user->fullName())

@section('content')

<div class="row-auto space-x-8 mb-10">
    <div class="border-2 rounded-md px-6">
        <h2>Info Contributeur</h2>
        Nom : {{$user->lastname}}
        Prénom : {{$user->firstname}}
        Email : {{$user->email}}
        Actif {{$user->is_activ}} depuis : {{$user->email_verified_at}}
    
        
    <div class="flex mt-10 mb-3 ">
        @if ($user->is_activ)
        <form action="{{ route('deactivate.user', ['id' => $user->id]) }}" method="POST">
            @csrf
            <button type="submit" class="shadow bg-red-300 hover:bg-red-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded">Rendre inactif</button>
        </form>
        @else
        <form action="{{route('reactivate.user', ['id' => $user->id])}}" method="POST">
            @csrf
            <button type="submit" class="shadow bg-green-300 hover:bg-green-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded">Réactiver</button>
        </form>
        @endif
    </div>
</div>
<div class="flex mt-10 mb-3">
    <form action="{{ route('send.reset.link', ['id' => $user->id]) }}" method="POST">
        @csrf
        <button type="submit" class="shadow bg-blue-300 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-gray-800 font-bold py-2 px-4 rounded">Envoyer un lien de réinitialisation</button>
    </form>
</div>
</div>

@endsection