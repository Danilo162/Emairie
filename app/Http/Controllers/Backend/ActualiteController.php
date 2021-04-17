<?php

// GENERER DANS LE REPERTOIRE "Backend" VIA: "php artisan make:controller \\Backend\AgentController -r"
// Ce Controller combine avec "public/js/console/agent.js" qui gère le CRUD de façon asynchrone (AJAX) via VueJS:

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Mairies;
use App\Models\actualites;
use App\Models\TypeActualite;
use App\Models\User\User;
use App\Rules\ChangePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class ActualiteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return\Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';



        $result = self::queryFor($from,$order,$limit,$search,$mairie);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }

    /**
     * @param $from
     * @param $order
     * @param $limit
     * @param $search
     * @return mixed
     */
    public static function queryFor($from, $order, $limit, $search,$mairie =null){

        $query = DB::table("actualites")
                    // ON LIE la Table "mairies" à la Table "actualites" sélectionné ci-dessus avec "leftJoin()":
                    ->leftJoin("type_actualites","actualites.type_actualite_id","=","type_actualites.id")
                    ->leftJoin("mairies","actualites.mairie_id","=","mairies.id")

					->whereNull("actualites.deleted_at")
                    ->orderBy("actualites.id",$order)
                    /* RECUPERATION CI-DESSOUS DE CHAQUE COLONNES DE LA TABLE "actualites" et CELLE DE "name"
                        DE LA COLONNE "mairies": */
                    ->selectRaw("actualites.*,type_actualites.name as type,mairies.nom as mairie");

            if($search && !empty($search)){
                $query->where('name', 'LIKE', "%{$search}%");
            }
            if($mairie && !empty($mairie)){
                $query->where('actualites.mairie_id', '=', $mairie);
            }

//            ADMINISTRATEUR SYSTEME ET FONCTIONNEL

                //            ADMINISTRATEUR FONCTIONNEL  , AGENT PERCEPTEUR ET AGENT
                if(auth()->user()->isAdmin()){
                    if(mairies()){
                        // LISTE DES COMPTES DES DE LA MAIRIES
                        $query->where("actualites.mairie_id","=",mairies()->id);
                    }
                }


        $total = count($query->get());

        if($limit && !empty($limit)) {
            $query->take($limit)->skip($from);
        }
        $rows = $query->get();


        $jsonData["total"] = $total;
        $jsonData["rows"] =$rows;
        return $jsonData;
    }

    public function lists()
    {
        $types = TypeActualite::all();
        $mairies = Mairies::all();
        return view('actualite.index', compact('types','mairies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param\Illuminate\Http\Request  $request
     * @return\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = null;
        $action = "create";
        /* EFFECTUER DES VERIFICATIONS SUR LES CHAMPS SEULEMENT SI L'ID DES CHAMPS DE REQUEST DU FORMULAIRE "HTML"
            EST NULL. TRES IMPORTANT POUR EFFECTER LES VALIDATIONS A CHAQUE CHAMPS DU FORMULAIRE LORS DES
            MODIFICATIONS VU QU'ON UTILISE LA METHODE "updateOrCreate()" ET PLUSIEURS CHAMPS A CREER ET METTRE
            A JOUR A LA FOIS LES DONNEES: */




//        try {
            if ($request->get('id') == "") {
                $request->validate([
                    'appel' => 'required'
                    ,'type' => 'required'
                ]);
            }
            else {
                $request->validate([
                    'id' => 'required|exists:actualites,id',
                ]);

                $agentImage = Actualite::findOrFail($request->get('id'));
                $image = $agentImage->picture;
                $action = "update";

            }

            if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                // $image = $request->get('picture')->store('/agent');
                $image = $request->picture->store('/actualites');


            }

            // actualites::updateOrCreate(['id' => $request->get('id')], ['name' => $request->agent]);
            $save =  Actualite::updateOrCreate(['id' => $request->get('id')],
                [
                'appel' => $request->appel,
                'resume' => $request->resume,
                'description' => $request->description,
                'type_actualite_id' => $request->type,
                'picture' => $image,
                'mairie_id' => $request->mairie,
                'source' => $request->source,
                'source_link' => $request->source_link,
                'register_user_id' => auth()->user()->id,
            ]);



            if(!$save){
                return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);

            }
            return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);




    }

    public function edit(Request $request)
    {

        $id = $request->get('id');

        $data = Actualite::findOrFail($id);

  /*      DB::table("actualites")
            ->leftJoin("users","users.agent_id","=","actualites.id")
            ->whereNull("actualites.deleted_at")
            ->where("actualites.id","=",$id)
            ->selectRaw("actualites.id, actualites.firstname, actualites.lastname, actualites.picture,
                                actualites.job, users.role_id, actualites.email, actualites.phone,actualites.mairie_id")
        ->first();*/
//        actualites::findOrFail($id);

        if(!$data) {

             return response()->json(['success' => false, 'message' => "Erreur survenue !"]);
        }

        return response()->json(['success' => true, 'data' => $data]);
    }


    public function destroy(Request $request)
    {
        $data = Actualite::findOrFail($request->get('id'));
        $destroy = $data->delete();

		if (!$destroy) {
            return response()->json(array('success' => false, 'message' => Lang::get("message.delete_error")), 400);
        }

        return response()->json(['success'=>true,'message'=> Lang::get("message.delete_success")]);
    }

}
