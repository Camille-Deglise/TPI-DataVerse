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
        // Récuperer id de l'utilisateur
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
            $header = array_shift($rows);
            $expectedHeaders = ['precipitation', 'sunshine', 'snow', 'temperature', 'humidity', 'wind', 'statement_date'];
            $headerColumns = str_getcsv($header);
    
            // Valider les en-têtes
            if ($headerColumns !== $expectedHeaders) {
                return redirect()->back()->withErrors('Les en-têtes du fichier CSV ne sont pas corrects.');
            }
    
            // Ignorer les lignes vides
            $nonEmptyRows = array_filter($rows, 'strlen');
            if (!empty($nonEmptyRows)) {
                foreach ($nonEmptyRows as $row) {
                    $data = str_getcsv($row);
    
                    // Validation du nombre de colonnes
                    if (count($data) !== 7) {
                        return redirect()->back()->withErrors('Le fichier CSV doit contenir exactement 7 colonnes.');
                    }
    
                    // Validation des types de données
                    if (!is_numeric(trim($data[0])) || !is_numeric(trim($data[1])) || !is_numeric(trim($data[2])) ||
                        !is_numeric(trim($data[3])) || !is_numeric(trim($data[4])) || !is_numeric(trim($data[5])) ||
                        !strtotime(trim($data[6]))) {
                        return redirect()->back()->withErrors('Les données du fichier CSV ne sont pas du bon type. Veuillez vérifier les colonnes.');
                    }
    
                    // Insérer directement dans la base de données
                    WeatherData::create([
                        'precipitation' => trim($data[0]),
                        'sunshine' => trim($data[1]),
                        'snow' => trim($data[2]),
                        'temperature' => trim($data[3]),
                        'humidity' => trim($data[4]),
                        'wind' => trim($data[5]),
                        'statement_date' => trim($data[6]),
                        'user_id' => $userId,
                        'location_id' => $selectedLocationId
                    ]);
                }
                return redirect()->route('import.showForm')->with('success', 'Importation réussie.');
            } else {
                return redirect()->back()->withErrors('Le fichier CSV est vide.');
            }
        }
        return redirect()->back()->withErrors('Veuillez sélectionner un fichier de format CSV.');
    }
    


    public function reimport(Request $request, $id)
    {
        // Récupérer l'ID de la location associée aux données météo
        $weatherData = WeatherData::find($id);

        $file = $request->file('csv_file');

        // Valider que le fichier a été téléchargé et est un fichier CSV
        if ($file && $file->getClientOriginalExtension() == 'csv') {
            // Lire le contenu du fichier CSV
            $contents = file_get_contents($file->getRealPath());

            // Traitement des données CSV et insertion dans la base de données
            $rows = explode("\n", $contents);

            // Ignorer la première ligne (en-têtes de colonnes)
            $header = array_shift($rows);
            $expectedHeaders = ['precipitation', 'sunshine', 'snow', 'temperature', 'humidity', 'wind', 'statement_date'];
            $headerColumns = str_getcsv($header);

            // Valider les en-têtes
            if ($headerColumns !== $expectedHeaders) {
                return redirect()->back()->withErrors('Les en-têtes du fichier CSV ne sont pas corrects.');
            }

            // Ignorer les lignes vides
            $nonEmptyRows = array_filter($rows, 'strlen');
            if (!empty($nonEmptyRows)) {
                foreach ($nonEmptyRows as $row) {
                    $data = str_getcsv($row);

                    // Validation du nombre de colonnes
                    if (count($data) !== 7) {
                        return redirect()->back()->withErrors('Le fichier CSV doit contenir exactement 7 colonnes.');
                    }

                    // Validation des types de données
                    if (!is_numeric(trim($data[0])) || !is_numeric(trim($data[1])) || !is_numeric(trim($data[2])) ||
                        !is_numeric(trim($data[3])) || !is_numeric(trim($data[4])) || !is_numeric(trim($data[5])) ||
                        !strtotime(trim($data[6]))) {
                        return redirect()->back()->withErrors('Les données du fichier CSV ne sont pas du bon type. Veuillez vérifier les colonnes.');
                    }

                    // Mettre à jour l'enregistrement existant
                    $weatherData->update([
                        'precipitation' => trim($data[0]),
                        'sunshine' => trim($data[1]),
                        'snow' => trim($data[2]),
                        'temperature' => trim($data[3]),
                        'humidity' => trim($data[4]),
                        'wind' => trim($data[5]),
                        'statement_date' => trim($data[6]),
                    ]);
                }
                return redirect()->route('showSummary', ['id' => $id])->with('success', 'Ré-importation réussie.');
            } else {
                return redirect()->back()->withErrors('Le fichier CSV est vide.');
            }
        }
        return redirect()->back()->withErrors('Veuillez sélectionner un fichier de format CSV.');
    }
}


