<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index(){
        $produits = Produit::get();

        return view('produit',compact('produits'));
    }

    public function create(Request $request){
       
    
        $produit = new Produit();

        $produit->libelle = $request->libelle;
        $produit->prix = $request->prix;
        
        $produit->save();

        return redirect()->route('produit')->with(['success' => 'Ajout avec succès!!!']);
    }

    public function update(Request $request,$id){
        $produit = Produit::findOrFail($id);

        $produit->libelle = $request->libelle;
        $produit->prix = $request->prix;
        
        $produit->save();

        return redirect()->route('produit')->with(['success' => 'Modif avec succès!!!']);
    }

    public function delete($id){
        $produit = Produit::findOrFail($id);

        $produit->delete();
        return redirect()->route('produit')->with(['success' => 'Suppression du produit avec succès!!!']);
    }
}
