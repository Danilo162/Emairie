<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend\MairieController;
use App\Http\Controllers\Controller;


use App\Models\ThemeMairie;
use App\Models\Themes;
use App\Models\Qualite;
use App\Models\Demande;

use App\Models\Mairies;
use App\Models\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

use Auth;


class EtatCivilController extends Controller
{

    public function index(){

        return view("frontend.etatcivil.etatcivil");

    }

    
    public function mariage(){

        $qualites = Qualite::get()->sortBy('qualite_libelle');

        return view("frontend.etatcivil.mariage", compact('qualites'));

    }

    
    public function deces(){

        $qualites = Qualite::get()->sortBy('qualite_libelle');

        return view("frontend.etatcivil.deces", compact('qualites'));

    }

    
    public function naissance(){

        $qualites = Qualite::get()->sortBy('qualite_libelle');

        return view("frontend.etatcivil.naissance", compact('qualites'));

    }



    public function SaveDemandeActeNaissance(Request $request){


        $dan = new Demande();
        $dan->user_id                   =   Auth::user()->id;
        $dan->service_id                =   1;
        $dan->titulaire_nom				=	$request->titulaire_nom;
        $dan->titulaire_prenoms			=	$request->titulaire_prenoms;
        $dan->titulaire_date_naissance	=	$request->titulaire_date_naissance;
        $dan->titulaire_lieu_naissance	=	$request->titulaire_lieu_naissance;
        $dan->titulaire_nom_pere		=	$request->titulaire_nom_pere;
        $dan->titulaire_nom_mere		=	$request->titulaire_nom_mere;
        $dan->numero_acte				=	$request->numero_acte;
        $dan->nombre_copies				=	$request->nombre_copies;
        $dan->qualite_demandeur			=	$request->qualite_demandeur;
        $dan->motif                     =   $request->motif;
        $dan->date_creation             =   gmdate('Y-m-d H:i:s');


        $dan->save();

        return back()->with('success','ENREGISTREMENT EFFECTUÉ AVEC SUCCÈS');

    }



    public function SaveDemandeActeMariage(Request $request){


        $dan = new Demande();
        $dan->user_id                   =   Auth::user()->id;
        $dan->service_id                =   100;
        $dan->nom_marie             	=   $request->nom_marie;
        $dan->prenoms_marie         	=   $request->prenoms_marie;
        $dan->nom_mariee             	=   $request->nom_mariee;
        $dan->prenoms_mariee         	=   $request->prenoms_mariee;
        $dan->date_mariage 	 			=   $request->date_mariage;
        $dan->numero_acte    			=   $request->numero_acte;
        $dan->nombre_copies             =   $request->nombre_copies;
        $dan->qualite_demandeur         =   $request->qualite_demandeur;
        $dan->motif                     =   $request->motif;
        $dan->date_creation             =   gmdate('Y-m-d H:i:s');


        $dan->save();

        return back()->with('success','ENREGISTREMENT EFFECTUÉ AVEC SUCCÈS');

    }



    public function SaveDemandeActeDeces(Request $request){


        $dan = new Demande();
        $dan->user_id                   =   Auth::user()->id;
        $dan->service_id                =   101;
        $dan->titulaire_nom             =   $request->titulaire_nom;
        $dan->titulaire_prenoms         =   $request->titulaire_prenoms;
        $dan->titulaire_date_naissance  =   $request->titulaire_date_naissance;
        $dan->titulaire_lieu_naissance  =   $request->titulaire_lieu_naissance;
        $dan->titulaire_nom_pere        =   $request->titulaire_nom_pere;
        $dan->titulaire_nom_mere        =   $request->titulaire_nom_mere;
        $dan->numero_acte     			=   $request->numero_acte_naissance;
        $dan->nombre_copies             =   $request->nombre_copies;
        $dan->qualite_demandeur         =   $request->qualite_demandeur;
        $dan->motif                     =   $request->motif;
        $dan->date_creation             =   gmdate('Y-m-d H:i:s');


        $dan->save();

        return back()->with('success','ENREGISTREMENT EFFECTUÉ AVEC SUCCÈS');

    }



    
    public function mesdemandes(){

        $mesdemandes = Demande::where(['user_id'=>Auth::user()->id])->get()->sortByDesc('id');

        $data = $mesdemandes;

        return view("frontend.etatcivil.mesdemandes", compact('mesdemandes'));

    }

    


}
