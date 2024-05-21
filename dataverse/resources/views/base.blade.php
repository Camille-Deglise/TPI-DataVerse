<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <link href="{{asset('style.css')}}" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body class="flex flex-col justify-between min-h-screen">
    <div class="wrapper ">
        <!--Navigation -->
        <nav class="bg-cyan-800 p-6">
           @include('site.navbar')
        </nav>

        <!--Contenu -->
        <div class="text-center py-4">
            <h1 class="text-4xl font-semibold mb-6">@yield('page-title')</h1>
        </div>
        
        <div class="content container mx-auto px-2 py-2">
            @include('site.errors-user')
    
            @yield('content')
        </div>
    </div>
    <!--Footer-->
    <footer class="bg-cyan-800 p-6 ">
        <div class="max-w-7xl mx-auto px-4">
            <p class="text-gray-200 text-center text-sm font-medium">
                <a href="mailto:camille.deglise@eduvaud.ch" class= "hover:bg-cyan-700 hover:text-white px-3 py-2 rounded-md">Camille Déglise</a> - TPI DataVerse - Mai 2024 
            </p>
        </div>
    </footer> 
</body>
</html>