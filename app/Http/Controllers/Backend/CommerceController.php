<?php

// GENERER DANS LE REPERTOIRE "Backend" VIA: "php artisan make:controller \\Backend\MairieController -r"
// Ce Controller combine avec "public/js/console/mairie.js" qui gère le CRUD de façon asynchrone (AJAX) via VueJS:

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Agents;
use App\Models\Commerces;
use App\Models\Typecommerce;
use App\Models\TypeForfaitCommerceSeleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class CommerceController extends Controller
{

    public function lists()
    {
        $communes = UtilsController::getMyCommune();
        $mairies = UtilsController::getMyMairie();
        $zones = UtilsController::getMyZone();
        $administreds = UtilsController::getMyAdministreds();
        $types = Typecommerce::all();

        return view('commerce.index', compact('communes','mairies','zones','administreds','types'));
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
        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';
        $commune = ($request->get('commune')) ? $request->get('commune') : '';
        $type = ($request->get('type')) ? $request->get('type') : '';
        $zone = ($request->get('zone')) ? $request->get('zone') : '';


        $result = self::queryFor($from,$order,$limit,$search,$mairie,$commune,$type,$zone);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }

    public static function queryFor($from,$order,$limit,$search,$mairie,$commune,$type,$zone){

        $query = DB::table("commerces")
            ->leftJoin("typecommerces","commerces.type_commerce_id","=","typecommerces.id")
             ->leftJoin("zone_commerces","zone_commerces.commerce_id","=","commerces.id")
             ->leftJoin("zones","zones.id","=","zone_commerces.zone_id")
             ->leftJoin("administreds","commerces.administred_id","administreds.id")
             ->leftJoin("mairies","administreds.mairie_id","mairies.id")
             ->leftJoin("communes","commerces.commune_id","communes.id")


                    ->orderBy("commerces.raison_social",$order)
                    ->selectRaw("commerces.*,
                    typecommerces.name as type_commerce,zones.name as zone,
                    CONCAT_WS('',administreds.lastname,administreds.firstname) as administred,
                    commerces.quartier,communes.name as commune,mairies.nom as mairie");

            if($search && !empty($search)){
                $query->where('commerces.raison_social', 'LIKE', "%{$search}%");
            }

        if($mairie){
            $query->where("commerces.mairie_id","=",$mairie);
        } if($commune){
            $query->where("commerces.commune_id","=",$commune);
        }
        if($zone){
            $query->where("zone_commerces.zone_id","=",$zone);
       }
      if($type){
                $query->where("commerces.type_commerce_id","=",$type);
           }

        if(auth()->check()){
            // SUPER ADMIN
            if(!auth()->user()->isSuperAdmin()){
                // MAIRIE
                if(mairies()){
                    //  ADMIN FONCTIONNEL
                    if(auth()->user()->isAdmin()){
                        $query->where("commerces.mairie_id","=",mairies()->id);
                    }
                    if(auth()->user()->isAgent()){
                        $query->where("zone_commerces.agent_id","=",auth()->user()->agent_id);
                    }

                }

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

    public function searchForUse(Request $request){
        $search = ($request->q)?$request->q:"";
        $zone = ($request->zone)?$request->zone:"";

        $query = DB::table("commerces")
            ->leftJoin("typecommerces","commerces.type_commerce_id","=","typecommerces.id")
            ->orderBy("commerces.raison_social","asc")
            ->selectRaw("commerces.id,commerces.raison_social as name,typecommerces.name as type");
        if($search && !empty($search)){
            $query->where('commerces.raison_social', 'LIKE', "%{$search}%");
        }
        if($zone){
            $query->leftJoin("zone_commerces","zone_commerces.commerce_id","=","commerces.id");
            $query->whereNotIn("zone_commerces.zone_id",[$zone]);
            $query->whereNull("zone_commerces.zone_id");
        }


        $query->take(20);
        $result = $query->get();
        return response()->json($result);
    }

    public function commerceNoAttachToZone(Request $request){
        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $zone = ($request->get('zone')) ? $request->get('zone') : '';
        $commune = ($request->get('commune')) ? $request->get('commune') : '';

        $query = DB::table("commerces")
            ->leftJoin("typecommerces","commerces.type_commerce_id","=","typecommerces.id")
            ->leftJoin("communes","commerces.commune_id","=","communes.id")
            ->orderBy("commerces.raison_social",$order)
            ->selectRaw("commerces.id,commerces.raison_social,
            typecommerces.name as type,communes.name as commune");


        if($search && !empty($search)){
            $query->where('commerces.raison_social', 'LIKE', "%{$search}%");
        }

        if($commune){
            $query->leftJoin("mairies","administreds.mairie_id","mairies.id");
            $query->where("mairies.commune_id","=",$commune);
        }


        if($search && !empty($search)){
            $query->where('commerces.raison_social', 'LIKE', "%{$search}%");
        }
        if($zone){
            $query->leftJoin("zone_commerces","zone_commerces.commerce_id","=","commerces.id");
            $query->whereNull("zone_commerces.zone_id");

//            $query->whereNotIn('zones.id', function($query) use ($zone)
//            {
//                $query->select("zone_commerces.zone_id")
//                    ->from('zone_commerces')
//                    ->whereRaw("zone_commerces.zone_id = $zone");
//            });

        }


        $total = count($query->get());

        if($limit && !empty($limit)) {
            $query->take($limit)->skip($from);
        }
        $rows = $query->get();

        $jsonData["total"] = $total;
        $jsonData["rows"] =$rows;
        return response()->json($jsonData);
    }

    public function detail($id){

        $data = self::getCommerceBy($id);
        if(!$data){
            return back();
        }
        $taxeInfos = UtilsController::getCommerceTaxeInfors($id);
        $allForfaits = UtilsController::getAllTaxes();
        return view("commerce.detail",compact('data','taxeInfos','allForfaits'));
    }

    public static function getCommerceBy($id){
        $query = DB::table("commerces")
            ->leftJoin("typecommerces","commerces.type_commerce_id","=","typecommerces.id")
            ->leftJoin("zone_commerces","zone_commerces.commerce_id","=","commerces.id")
            ->leftJoin("zones","zones.id","=","zone_commerces.zone_id")
            ->leftJoin("administreds","commerces.administred_id","administreds.id")
            ->leftJoin("mairies","administreds.mairie_id","mairies.id")
            ->leftJoin("communes","commerces.commune_id","communes.id")
            ->leftJoin("users","commerces.register_user_id","users.id")
            ->selectRaw("commerces.*,
                    typecommerces.name as type_commerce,zones.name as zone,
                    CONCAT_WS('',administreds.lastname,administreds.firstname) as administred,
                    CONCAT_WS(' / ',administreds.phone,administreds.phone2) as phone,
               administreds.email,
                    commerces.quartier,communes.name as commune,mairies.nom as mairie,users.name as register_user");

            $query->where("commerces.id","=",$id);
        $data  = $query->first();
            return $data;
    }

    public function chooseForfait(Request $request)
    {

            $request->validate([
                'forfait' => 'required|exists:type_taxe_forfaits,id',
                'commerce' => 'required|exists:commerces,id',
            ]);

            $checkIf = self::checkIfTaxeForfaitSelectedAreAffected($request->commerce);
            if($checkIf){
        $save  =  DB::table("taxeforfait_commerce_selecteds")->where("commerce_id","=",$request->commerce)
          ->update(["typetaxeforfait_id"=>$request->forfait]);
            }
            else{

             $save = TypeForfaitCommerceSeleted::create([
         "typetaxeforfait_id"=>$request->forfait,
         "commerce_id"=>$request->commerce
             ]);
            }

        if($save){
            return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);

        }
        return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);



    }


    /** VERIFIER SI UN FORFAIT A ETE CHOISIR POUR CE COMMERCE
     * @param $commerce_id
     * @param $type_forfait_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function checkIfTaxeForfaitSelectedAreAffected($commerce_id){
        $query = DB::table("taxeforfait_commerce_selecteds")
            ->where("taxeforfait_commerce_selecteds.commerce_id","=",$commerce_id)
//            ->where("type_taxe_forfaits.typetaxeforfait_id","=",$type_forfait_id)
            ->first();
        return $query;
    }


    public function store(Request $request)
    {
        $image = null;
        if ($request->get('id') == "") {
            $request->validate([
                'administred' => 'required',
                'commune' => 'required',
                'raison_social' => 'required',
                'type' => 'required',

            ]);
        }
        else {
            $request->validate([
                'id' => 'required|exists:agents,id',
            ]);
            $agentImage = Commerces::findOrFail($request->get('id'));
            $image = $agentImage->picture;
            $action = "update";

        }

        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            $image = $request->picture->store('/commerces');


        }

        // Agents::updateOrCreate(['id' => $request->get('id')], ['name' => $request->agent]);
        $save =  Commerces::updateOrCreate(['id' => $request->get('id')], [
            'administred_id' => $request->administred,
            'commune_id' => $request->commune,
            'raison_social' => $request->raison_social,
            'description' => $request->description,
            'quartier' => $request->quartier,
            'detail_localisation' => $request->detail_localisation,
            'mairie_id' => mairies()?mairies()->id:null,
            'type_commerce_id' => $request->type,
            'register_user_id' => auth()->user()->id,
            'picture' => $image,
        ]);


        if(!$save){
            return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);

        }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);

    }
    public function edit(Request $request)
    {

        $id = $request->get('id');

        $agent = DB::table("commerces")
            ->where("commerces.id","=",$id)
            ->selectRaw("commerces.*")
            ->first();

        if(!$agent) {

            return response()->json(['success' => false, 'message' => "Erreur survenue !"]);
        }

        return response()->json(['success' => true, 'data' => $agent]);
    }
    public function destroy(Request $request)
    {
        $agent = Commerces::findOrFail($request->get('id'));
        $destroy = $agent->delete();

        if (!$destroy) {
            return response()->json(array('success' => false, 'message' => Lang::get("message.delete_error")), 400);
        }


        return response()->json(['success'=>true,'message'=> Lang::get("message.delete_success")]);
    }


}
