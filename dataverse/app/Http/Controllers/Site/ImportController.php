<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//------------------------------
// ETML - TPI
// Auteur : Camille Déglise
// Date : 28.05.2024
// Modification :  selon commit de git
//-------------------------------

/**
 * Classe de type Controller
 * Gére les méthodes d'import de fichier CSV
 */

class ImportController extends Controller
{
    public function showForm()
    {
        return view('site.import');
    }


    public function process(Request $request)
    {
        $file = $request->file('csv_file');

        // Validez que le fichier a été téléchargé et est un fichier CSV
        if ($file && $file->getClientOriginalExtension() == 'csv') {
            // Lisez le contenu du fichier CSV
            $contents = file_get_contents($file->getRealPath());

            // Traitement des données CSV et insertion dans la base de données
            $rows = explode("\n", $contents);
        

            // Ignorer la première ligne (en-têtes de colonnes)
            $dataRows = array_slice($rows, 1);

            //Ignorer les lignes vides
            $nonEmptyRows = array_filter($dataRows, 'strlen');
            if(!empty($nonEmptyRows))
            {
                foreach ($nonEmptyRows as $row) 
                {
                    $data = str_getcsv($row);
                   
                    // Validez et transformez les données si nécessaire
                 

                    
                    /// Récupérer le service associé à l'utilisateur
                    
                    // Insérez les données dans la base de données
                   

                    // Assurez-vous de gérer correctement les relations entre les modèles et la table pivot
                   
                }
                return redirect()->route('home')->with('success', 'Importation réussie.');
            } else{
                return redirect()->back()->with('error', 'Le fichier CSV est vide.');
            }
               
        }

        return redirect()->back()->with('error', 'Veuillez sélectionner un fichier CSV.');
    }
}
