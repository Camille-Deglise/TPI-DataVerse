@extends('site.base')
@section('title', 'Page d\'accueil')
@section('page-title', 'Bienvenue sur DataVerse')

@section('content')

@include('shared.search-bar')
@if(!empty($search))
    @include('shared.no-result-search')
@endif

@endsection