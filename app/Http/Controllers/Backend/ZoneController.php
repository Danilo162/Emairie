<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Mobile\MobileApiController;
use App\Models\Zone;
use App\Models\ZoneCommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ZoneController extends Controller
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
        $this->authorize("Listing Zones");

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
    public function agent(Request $request)
    {

        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $zone = ($request->get('zone')) ? $request->get('zone') : '';

        $query = DB::table("agents")
            ->leftJoin("zone_commerces","zone_commerces.agent_id","=","agents.id")
            ->whereNull("agents.deleted_at")
            ->whereNull("zone_commerces.deleted_at")
            ->orderBy("agents.lastname",$order)
            ->selectRaw("CONCAT_WS('',lastname,firstname) as name , agents.id,agents.phone,agents.picture");

        if($search && !empty($search)){
            $query->where('name', 'LIKE', "%{$search}%");
        }
        if($zone && !empty($zone)){
            $query->where('zone_id', '=', $zone);
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
    public function agentNoAttach(Request $request)
    {

        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $zone = ($request->get('zone')) ? $request->get('zone') : '';

        $query = DB::table("agents")
//            ->leftJoin("zone_commerces","zone_commerces.agent_id","=","agents.id")
            ->whereNull("agents.deleted_at")
//            ->whereNull("zone_commerces.deleted_at")
            ->orderBy("agents.lastname",$order)
            ->selectRaw("CONCAT_WS('',lastname,firstname) as name ,
             agents.id,agents.phone,agents.picture");

        if($search && !empty($search)){
            $query->where('name', 'LIKE', "%{$search}%");
        }
        if($zone && !empty($zone)){

//            $query->whereNotIn('id', DB::table('zone_commerces')
//                ->where("zone_id","=",$zone)->pluck('agent_id'));
//          $query->where('agents.id', '!=', $zone);
//            $query->whereNotIn("zone_commerces.zone_id",[$zone]);
            $query->whereNotIn('agents.id',function($query) use ($zone){
                $query->select('zone_commerces.agent_id')->from('zone_commerces')
                ->where("zone_id","=",$zone);
            });
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

    public function queryFor($from,$order,$limit,$search){

        $query = DB::table("zones")
					->whereNull("zones.deleted_at")
            ->leftJoin(DB::raw("(SELECT
       COUNT(zone_commerces.id) as commerce_number,zone_commerces.zone_id
      FROM zone_commerces WHERE zone_commerces.deleted_at IS NULL
      AND zone_commerces.commerce_id IS NOT NULL
      GROUP BY zone_commerces.zone_id
      ) as tblcommerce"),
                function($join){
                    $join->on("tblcommerce.zone_id","=","zones.id");

                })
        ->orderBy("zones.id",$order);

            if($search && !empty($search)){
                $query->where('name', 'LIKE', "%{$search}%");
            }

        if(!auth()->user()->isSuperAdmin()){
            if(mairies()){
                // LISTE DES COMPTES DES DE LA MAIRIES
                $query->where("zones.mairie_id","=",mairies()->id);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param\Illuminate\Http\Request  $request
     * @return\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        $mairie_id = mairies()?mairies()->id:null;
       $check = UtilsController::checkIfExisteInZoneInMairie($request->name,$mairie_id);
   if($check){
       return response()->json(['success' => false, 'message' => Lang::get('message.taxe_zone_exist')]);
   }
        // Communes::updateOrCreate(['id' => $request->get('id')], ['name' => $request->commune]);
       $save =  Zone::updateOrCreate(['id' => $request->get('id')],
           [
               'name' => $request->name,
               'mairie_id' => $mairie_id,
               ]);

       if(!$save){
           return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);
       }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);

    }
    public function attachToZone(Request $request)
    {
      $check = MobileApiController::checkIfExisteInZone($request->id);

      if($check){
          return response()->json(['success' => false, 'message' => Lang::get('message.commerce_exist')]);
      }

       $save =  ZoneCommerce::create([
           'zone_id' => $request->zone,
           'commerce_id' => $request->id,
       ]);

       if(!$save){
           return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);
       }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);

    }
    public function attachAgentToZone(Request $request)
    {
      $check = MobileApiController::checkIfExisteInZone("",$request->id,$request->zone);

      if($check){
          return response()->json(['success' => false, 'message' => Lang::get('message.agent_exist')]);
      }

       $save =  ZoneCommerce::create([
           'zone_id' => $request->zone,
           'agent_id' => $request->id,
       ]);

       if(!$save){
           return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);
       }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detattachToZone(Request $request)
    {

      $destroy = ZoneCommerce::where("commerce_id","=",$request->commerce)->forceDelete();

        if (!$destroy) {
            return response()->json(array('success' => false, 'message' => Lang::get('message.delete_error')), 400);
        }
        return response()->json(array('success' => true, 'message' => Lang::get('message.delete_success')), 200);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detattachAgentToZone(Request $request)
    {

        $destroy = ZoneCommerce::where("agent_id","=",$request->id)->where("zone_id","=",$request->zone)->forceDelete();

        if (!$destroy) {
            return response()->json(array('success' => false, 'message' => Lang::get('message.delete_error')), 400);
        }
        return response()->json(array('success' => true, 'message' => Lang::get('message.delete_success')), 200);

    }


    public function edit($id)
    {
        $zone = Zone::findOrFail($id);
        return response()->json($zone);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @paramint  $id
     * @return\Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $zone = Zone::findOrFail($request->get('id'));
        $destroy = $zone->delete();

		if (!$destroy) {
            return response()->json(array('success' => true, 'message' => Lang::get('message.delete_error')), 400);
        }
        return response()->json(array('success' => false, 'message' => Lang::get('message.delete_success')), 200);

    }

    public function detail($id){
        $data = Zone::findOrFail($id);
        if(!$data){
            return back();
        }
        return view("zone.detail",compact('data'));
    }
}
