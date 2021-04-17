<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend\MairieController;
use App\Http\Controllers\Controller;


use App\Models\ThemeMairie;
use App\Models\Themes;
use App\Models\Qualite;
use App\Models\DemandeActeNaissance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class EtatCivilController extends Controller
{

    public function index(){

        return view("frontend.etatcivil.etatcivil");

    }

    
    public function naissance(){

        $qualites = Qualite::get()->sortBy('qualite_libelle');

        return view("frontend.etatcivil.naissance", compact('qualites'));

    }

    public function SaveNaissance(Request $request){


        $dan = new DemandeActeNaissance();
        $dan->user_nom					=	$request->user_nom;
        $dan->user_prenoms				=	$request->user_prenoms;
        $dan->user_date_naissance		=	$request->user_date_naissance;
        $dan->user_lieu_naissance		=	$request->user_lieu_naissance;
        $dan->user_pays_residence		=	$request->user_pays_residence;
        $dan->user_commune				=	$request->user_commune;
        $dan->user_quartier				=	$request->user_quartier;
        $dan->user_adresse_postale		=	$request->user_adresse_postale;
        $dan->user_email				=	$request->user_email;
        $dan->user_telephone			=	$request->user_telephone;
        $dan->titulaire_nom				=	$request->titulaire_nom;
        $dan->titulaire_prenoms			=	$request->titulaire_prenoms;
        $dan->titulaire_date_naissance	=	$request->titulaire_date_naissance;
        $dan->titulaire_lieu_naissance	=	$request->titulaire_lieu_naissance;
        $dan->titulaire_nom_pere		=	$request->titulaire_nom_pere;
        $dan->titulaire_nom_mere		=	$request->titulaire_nom_mere;
        $dan->numero_acte_naissance		=	$request->numero_acte_naissance;
        $dan->nombre_copies				=	$request->nombre_copies;
        $dan->qualite_demandeur			=	$request->qualite_demandeur;
        $dan->motif						=	$request->motif;


        $dan->save();

        return back()->with('success','ENREGISTREMENT EFFECTUÉ AVEC SUCCÈS');

    }



}
