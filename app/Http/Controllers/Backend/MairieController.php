<?php

// GENERER DANS LE REPERTOIRE "Backend" VIA: "php artisan make:controller \\Backend\MairieController -r"
// Ce Controller combine avec "public/js/console/mairie.js" qui gère le CRUD de façon asynchrone (AJAX) via VueJS:

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Actualite;
use App\Models\Communes;
use App\Models\Mairies;
use App\Models\MairieService;
use App\Models\TypeOrgane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class MairieController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $type_organe = ($request->get('type_organe')) ? $request->get('type_organe') : '';


        $result = self::queryFor($from,$order,$limit,$search,$type_organe);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }

    public static function queryFor($from,$order,$limit,$search,$type_organe){
        $query = DB::table("mairies")
                    // ON LIE la Table "communes" à la Table "mairies" sélectionné ci-dessus avec "leftJoin()":
                    ->leftJoin("communes","mairies.commune_id","=","communes.id")
					->whereNull("mairies.deleted_at")
                    ->orderBy("mairies.id",$order)
                    /* RECUPERATION CI-DESSOUS DE CHAQUE COLONNES DE LA TABLE "mairies" et CELLE DE "name"
                        DE LA COLONNE "communes": */
                    ->selectRaw("mairies.id, mairies.nom, mairies.picture, communes.name as commune,
                                    mairies.localisation, mairies.email, mairies.phone");

            if($search && !empty($search)){
                $query->where('mairies.nom', 'LIKE', "%{$search}%");
            }
            if($type_organe && !empty($type_organe)){
                $query->where('mairies.type_organe_id', '=', $type_organe);
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

    public function lists(Request $request)
    {
        if($request->type && $request->type=="ministere" ){
          return  self::ministere();
        }else{
            $communes = Communes::all();
            $type = TypeOrgane::whereName("Mairie")->first();
            return view('mairie.index', compact('communes','type'));
        }

    }
    public function ministere()
    {
        $communes = Communes::all();
        $type = TypeOrgane::whereName("Ministère")->first();
        return view('mairie.index', compact('communes','type'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = null;
        /* EFFECTUER DES VERIFICATIONS SUR LES CHAMPS SEULEMENT SI L'ID DES CHAMPS DE REQUEST DU FORMULAIRE "HTML"
            EST NULL. TRES IMPORTANT POUR EFFECTER LES VALIDATIONS A CHAQUE CHAMPS DU FORMULAIRE LORS DES
            MODIFICATIONS VU QU'ON UTILISE LA METHODE "updateOrCreate()" ET PLUSIEURS CHAMPS A CREER ET METTRE
            A JOUR A LA FOIS LES DONNEES: */
        if ($request->get('id') == "") {
            $request->validate([
                'name' => 'required|min:1|unique:mairies,nom,NULL,id,deleted_at,NULL',
                'phone' => 'required|min:1|unique:mairies,phone,NULL,id,deleted_at,NULL',
                'email' => 'required|min:1|email:filter',
                'picture' => 'image|mimes:jpeg,png,jpg|max:2048|unique:mairies,picture,NULL,id,deleted_at,NULL',
                'commune' => 'required',
                'type_organe' => 'required',
            ]);
        } else {
            $request->validate([
                'id' => 'required|exists:mairies,id',
            ]);
            $mairieImage = Mairies::findOrFail($request->get('id'));
            $image = $mairieImage->picture;

            }

            if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                // $image = $request->get('picture')->store('/mairie');
                $image = $request->picture->store('/mairies');


        }

        // Mairies::updateOrCreate(['id' => $request->get('id')], ['name' => $request->mairie]);
     $save =   Mairies::updateOrCreate(['id' => $request->get('id')], [
            'nom' => $request->name,
            'localisation' => $request->localisation,
            'type_organe_id' => $request->type_organe,
            'phone' => replace($request->phone),
            'email' => $request->email,
            'picture' => $image,
            'commune_id' => $request->commune
        ]);

        if(!$save){
            return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);

        }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);


    }
    public function store_etape(Request $request)
    {


     $destroy = DB::table("mairie_services")->where("mairie_id","=",$request->mairie)->delete();

     $services = $request->service;

     $save = null;
     foreach ($services as $service){
         $save =   MairieService::create( [
             'service_id' => $service,
             'mairie_id' => $request->mairie,
             'register_user_id' => auth()->user()->id,
         ]);

     }

        if(!$save){
            return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);

        }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $id = $request->get('id');

        $mairie = Mairies::findOrFail($id);

        if(!$mairie) {

             return response()->json(['success' => false, 'message' => "Erreur survenue !"]);
        }

        return response()->json(['success' => true, 'data' => $mairie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $mairie = Mairies::findOrFail($request->get('id'));
        $destroy = $mairie->delete();

        if (!$destroy) {
            return response()->json(array('success' => false, 'message' => Lang::get("message.delete_error")), 400);
        }
        return response()->json(['success'=>true,'message'=> Lang::get("message.delete_success")]);
    }


    public function detail($id){
        $data = Mairies::findOrFail($id);
        $allServices = self::getServiceMairie($id);
        if(!$data){
            return back();
        }
        return view("mairie.detail",compact('data','allServices'));
    }

    public static function getServiceMairie($mairie){

        $query = DB::table("services")
            ->leftJoin("mairie_services","mairie_services.service_id","=","services.id")
            ->where('mairie_services.mairie_id', '=', $mairie)
            ->whereNull('services.deleted_at')
            ->whereNull('mairie_services.deleted_at')
     /*       ->leftJoin('mairie_services', function ($join) use ($mairie){
                $join->on('mairie_services.service_id', '=', 'services.id')
                    ->where('mairie_services.mairie_id', '=', $mairie)->select("mairie_id");
            })*/
            ->selectRaw("services.*,mairie_id")->get();

return $query;
    }

    public static function getMairie($limit=null,$type=null,$offset=null){
        $query = $query = DB::table("mairies")
            // ON LIE la Table "communes" à la Table "mairies" sélectionné ci-dessus avec "leftJoin()":
            ->leftJoin("communes","mairies.commune_id","=","communes.id")
            ->whereNull("mairies.deleted_at")
            ->selectRaw("mairies.id, mairies.nom, mairies.picture, communes.name as commune,
                                    mairies.localisation, mairies.email, mairies.phone");

        if($limit){
            $query->limit($limit);
        } if($limit){
            $query->offset($offset);
        }
        if($type){
            $query->where("type_organe_id","=",$type);
        }
        $datas = $query->get();

        return $datas;

    }
}
