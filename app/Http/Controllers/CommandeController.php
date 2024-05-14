<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::orderBy('created_at', 'desc')->with(['carte.client'])->get();
        $produits = Produit::get();
        // dd($commandes);
        return view('commande', compact('commandes', 'produits'));
    }

    public function create()
    {
        $produits = Produit::get();
        return view('creer-commande', compact('produits'));
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

    public function qte(Request $request)
    {

        $produits = $request['produits'];
        $qtes =  explode(' ', $request['qtes']);

        if (count($produits) != count($qtes)) {
            $data = 0;
        } else {
            $data = 0;
            foreach ($produits as $key => $prod) {
                if($qtes[$key] == 0){
                    $data = 0;
                    continue;
                }else {
                    $data += Produit::where("id", $prod)->first()->prix * $qtes[$key];
                }
                
            }
            
        }

        return response()->json($data);
    }

    public function manage(Request $request)
    {

        // dd($request);
        $produits = $request->produits;
        $qtes = explode(' ', $request->qtes);

        

        $carte = Carte::where('num', $request->num)->first();

        if (!$carte) {
            return redirect()->route('commande')->with(['error' => 'La carte n°' . $request->num . 'n\'est pas enregistrée.']);
        } else {
            if ($carte->num == 'Nan') {
                $commande = new Commande();
                $commande->idcarte = $carte->id;
                $commande->montant = $request->montant;
                $commande->produits = json_encode($produits);
                $commande->qte = json_encode($qtes);
                $commande->save();
                return redirect()->route('commande')->with(['success' => 'Nouvelle commande enregistrée sans carte de fidélité.']);
            } else {
                $plus5mois = $carte->created_at->addMonths(5);
                $now = now();
                if ($plus5mois->diff($now)->invert != 1) {
                    return redirect()->route('commande')->with(['error' => 'La carte n°' . $request->num . ' n\'est plus utilisable. Le délai est passé.']);
                } elseif ($carte->nbreAchat == 10) {
                    return redirect()->route('commande')->with(['error' => 'La carte n°' . $request->num . ' n\'est plus utilisable. La limite de commande atteinte.']);
                } else {
                    $commande = new Commande();
                    $commande->idcarte = $carte->id;
                    $commande->montant = $request->montant;
                    $commande->produits = json_encode($produits);
                    $commande->qte = json_encode($qtes);
                    $commande->save();

                    $carte->nbreAchat++;
                    $carte->save();
                    return redirect()->route('commande')->with(['success' => 'Nouvelle commande enregistrée avec la carte n°' . $request->num . '.']);
                }
            }
        }
    }
}
