<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Retourne la vue de la vue home de base du site 
     * Ne tient pas compte de si l'utilisateur est connecté ou non
     */
    public function home()
    {
        //Graphique aléatoire
        //.......

        
        return view('site.home');
    }
}
