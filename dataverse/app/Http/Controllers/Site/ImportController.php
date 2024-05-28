<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportRequest;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\WeatherData;

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
        $locationsImport = Location::all();
        //dd($locationsImport);
        return view('site.import', ['locationsImport' => $locationsImport]);
    }

    public function process(ImportRequest $request)
    {
        // Récupérer les données du formulaire
        $newLocationName = $request->input('newLocationName');
        $newLocationZip = $request->input('newLocationZip');
        $selectedLocationId = $request->input('locationImport');

        // Si les champs pour le nouveau lieu sont remplis, créer un nouveau lieu dans la db
        if ($newLocationName && $newLocationZip) {
            $location = Location::create([
                'name' => $newLocationName,
                'zipcode' => $newLocationZip
            ]);

            // Récupérer l'ID du nouveau lieu créé
            $selectedLocationId = $location->id;
        }

        //Récuperer id de l'utilisateur
        $user = auth()->user();
        $userId = $user->id;
        
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
                   
                    // Insérer directement dans la base de données
                 
                    $newWData = WeatherData::create(
                    [
                        'precipitation' =>$data[0],
                        'sunshine' =>$data[1],
                        'snow' =>$data[2],
                        'temperature'=> $data[3],
                        'humidity' =>$data[4],
                        'wind' =>$data[5],
                        'statement_date' => $data[6],
                        'user_id' =>$userId,
                        'location_id' => $selectedLocationId
                    ]);
 
                }
                return redirect()->route('import.showForm')->with('success', 'Importation réussie.');
            } else{
                return redirect()->back()->withErrors('Le fichier CSV est vide.');
            }   
        }
        return redirect()->back()->withErrors('Veuillez sélectionner un fichier de format CSV.');
    }
}
