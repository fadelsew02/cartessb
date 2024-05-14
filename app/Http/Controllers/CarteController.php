<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use App\Models\Client;
use Illuminate\Http\Request;

class CarteController extends Controller
{
    public function index()
    {
        $cartes = Carte::where('num', '!=', 'Nan')->orderBy('updated_at', 'desc')->with('client')->get();


        return view('carte', compact('cartes'));
    }

    public function recup(Request $request)
    {
        $data = collect();

        $carte = Carte::where('num', $request['num'])->first();
        $data->push(['carte' => $carte]);

        $clients = Client::get();

        $data->push(['clients' => $clients]);

        return response()->json($data);
    }

    public function manage(Request $request)
    {
        //récupérer la carte la carte de fidélité est déjà enregistrer
        $carte = Carte::where('num', $request->num)->first();

        if (!$carte) {

            $existCarte = Carte::where('idclient', $request->idclient)->orderBy('updated_at', 'desc')->first();
            // dd($existCarte);
            if ($existCarte != null) {
                $plus5mois = $existCarte->created_at->addMonths(5);
                $now = now();

                if ($plus5mois->diff($now)->invert == 1 && $existCarte->nbreAchat < 10) {
                    return redirect()->route('carte')->with(['error' => 'Ce client a une carte encore valide!!']);
                }
            }

            $carte = new Carte();
            $carte->num = $request->num;
            $carte->idclient = $request->idclient;
            $carte->nbreAchat = 0;

            $carte->save();
            return redirect()->route('carte')->with(['success' => 'Enregistrement de la carte n°' . $request->num . '.']);
        } else {
            return redirect()->route('carte')->with(['error' => 'La carte n°' . $request->num . ' est déjà enregistrée.']);
        }
    }
}
