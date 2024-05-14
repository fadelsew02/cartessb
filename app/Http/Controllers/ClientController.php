<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\View\ViewName;

class ClientController extends Controller
{
    public function index(){
        $clients = Client::where('nom_prenoms','!=','Anonyme')->get();

        // $client = Client::first();
        $date = now();
        // dd($client->anniv, $date, $date->diff($client->anniv));

        return view('clients',compact('clients','date'));
    }

    public function create(Request $request){
        // dd($request);
        $existClient = Client::where('tel',$request['tel'])->first();

        if($existClient){
            return redirect()->route('client')->with(['error' => 'Ce tel est déjà utilisé!!!']);
        }

        $client = new Client();

        $client->nom_prenoms = $request->nom_prenoms;
        $client->tel = $request->tel;
        $client->profession = $request->profession;
        $client->residence = $request->residence;
        $client->genre = $request->genre;
        $client->anniv = $request->anniv;
        
        $client->save();

        return redirect()->route('client')->with(['success' => 'Ajout avec succès!!!']);
    }

    public function update(Request $request,$id){
        // dd($request);
        $existClient = Client::where('tel',$request['tel'])->first();

        if(!($existClient->id == $id)){
            return redirect()->route('client')->with(['error' => 'Ce tel est déjà utilisé!!!']);
        }

        $client = Client::findOrFail($id);

        $client->nom_prenoms = $request->nom_prenoms;
        $client->tel = $request->tel;
        $client->profession = $request->profession;
        $client->residence = $request->residence;
        $client->genre = $request->genre;
        $client->anniv = $request->anniv;
        
        $client->save();

        return redirect()->route('client')->with(['success' => 'Modif avec succès!!!']);
    }

    public function delete($id){
        $client = Client::findOrFail($id);

        $cartes = Carte::where('idclient',$id)->get();
        foreach ($cartes as $key => $carte) {
            $carte->delete();
        }

        $client->delete();
        return redirect()->route('client')->with(['success' => 'Suppression d\'un utilisateur avec succès!!!']);
    }
}
