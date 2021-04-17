<?php

// GENERER DANS LE REPERTOIRE "Backend" VIA: "php artisan make:controller \\Backend\CommuneController -r"
// Ce Controller combine avec "public/js/console/commune.js" qui gère le CRUD de façon asynchrone (AJAX) via VueJS:

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Communes;
use App\Models\DemandeMairieService;
use App\Models\DemandeMairieServiceHistorie;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ServiceController extends Controller
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


        $result = self::queryFor($from,$order,$limit,$search);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }
    public function index_demande(Request $request)
    {

        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $type = ($request->get('type')) ? $request->get('type') : '';


        $result = self::queryForServiceDemande($from,$order,$limit,$search,$type);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }

    public function queryFor($from,$order,$limit,$search){

        $query = DB::table("services")
					->whereNull("deleted_at")
					->orderBy("id",$order);

            if($search && !empty($search)){
                $query->where('name', 'LIKE', "%{$search}%");
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
    public function queryForServiceDemande($from,$order,$limit,$search,$type){

        $query =
            DB::table("demande_mairie_services")
                ->leftJoin("services","demande_mairie_services.service_id","=","services.id")
                ->leftJoin("administreds","demande_mairie_services.administred_id","=","administreds.id")
                ->leftJoin("mairies","demande_mairie_services.mairie_id","=","mairies.id")
                ->leftJoin("users","users.id","=","demande_mairie_services.register_user_id")
                ->whereNull("demande_mairie_services.deleted_at")
                ->selectRaw("demande_mairie_services.*,
            services.name as service,mairies.nom as mairie,
            DATE_FORMAT(demande_mairie_services.created_at,'%d/%m/%Y') as created,
             CONCAT_WS('',administreds.lastname,administreds.firstname) as administred,users.name as user")

        ->orderBy("demande_mairie_services.id",$order);

            if($search && !empty($search)){
                $query->where('services.name', 'LIKE', "%{$search}%");
            }

        if(!auth()->user()->isSuperAdmin()){

            $query->where("demande_mairie_services.mairie_id","=",mairies()->id);
        }
        if($type){
            $query->where("demande_mairie_services.status","=",$type);
        }
    /*    if($diff){
            $query->where("demande_mairie_services.status","!=",$diff);
        }*/

        $total = count($query->get());

        if($limit && !empty($limit)) {
            $query->take($limit)->skip($from);
        }
        $rows = $query->get();


        $jsonData["total"] = $total;
        $jsonData["rows"] =$rows;
        return $jsonData;
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
     * @param \Illuminate\Http\Request  $request
     * @return\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|min:1|unique:services,name,NULL,id,deleted_at,NULL']);

        if($request->id == ""){
            $image = null;
        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            // $image = $request->get('picture')->store('/mairie');
            $image = $request->picture->store('/services');

        }
        }else{
            $data = Service::findOrFail($request->id);
            $image = $data->picture;
            if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                // $image = $request->get('picture')->store('/mairie');
                $image = $request->picture->store('/services');

            }
        }

        // Communes::updateOrCreate(['id' => $request->get('id')], ['name' => $request->commune]);
      $save =  Service::updateOrCreate(['id' => $request->get('id')], ['name' => $request->name,
          'picture' =>$image]);

        if(!$save){
            return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);
        }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);

    }
    public function store_confirme(Request $request)
    {

            $data = DemandeMairieService::findOrFail($request->id);

            $status =  $request->status;
            if(!$data){
                return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);
            }

        // Communes::updateOrCreate(['id' => $request->get('id')], ['name' => $request->commune]);
      $save =  $data->update(['status' => $status]);


        DemandeMairieServiceHistorie::create([
            "demande_mairie_service_id"=>$request->id,
            "status"=>$status,
            "register_user_id"=>auth()->user()->id,

        ]);
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

    public function edit($id)
    {
        $type = Service::findOrFail($id);

        return response()->json($type);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $type = Service::findOrFail($request->get('id'));
        $destroy = $type->delete();

        if (!$destroy) {
            return response()->json(array('success' => true, 'message' => Lang::get('message.delete_error')), 400);
        }
        return response()->json(array('success' => false, 'message' => Lang::get('message.delete_success')));
    }

}
