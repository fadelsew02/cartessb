<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if(!$user){
            return redirect()->route('login')->with(['error' => 'Vous n\'êtes pas un admin!!!']); 
        }elseif (Hash::check($request->password,$user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/');  
        }else{
            return redirect()->route('login')->with(['error' => 'Mot de passe incorrect. Réessayez!!!']); 
        }

    }

    public function destroy(){
        auth()->logout();
        return redirect()->route('login');
    }

    public function change(Request $request){

        $this->validate($request, [
            "mot_de_passe_actuel" => "required|string",
            "nouveau_mot_de_passe" => "required|string",
            "confirmer_le_nouveau_mot_de_passe" => "required|same:nouveau_mot_de_passe"
        ]);
        if (Hash::check($request->input("mot_de_passe_actuel"), auth()->user()->getAuthPassword())) {
            User::find(auth()->user()->id)->update(["password" => Hash::make($request->input("nouveau_mot_de_passe"))]);
            Auth::setUser(User::find(auth()->user()->id));
            return back()->with("success", "Mot de passe changé avec succès");
        } else {
            return back()->with("rror", "Mot de passe incorrect");
        }
        
    }

}
