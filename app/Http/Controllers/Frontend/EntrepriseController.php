<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend\CommerceController;
use App\Http\Controllers\Controller;


use App\Models\Actualite;
use App\Models\ThemeMairie;
use App\Models\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class EntrepriseController extends Controller
{

public function detail(Request $request){

    $id = ($request->q)?$request->q:"";
    $data = CommerceController::getCommerceBy($id);
    if(!$data){
        return back();
    }

    return view("frontend.profile.commerce-detail",compact('data'));
}
public function index(){

    return view("frontend.actaulite.detail",compact('data','others'));
}

public static function getCommerce($limit=null,$type=null,$offset=null){
        $query = DB::table("commerces")
            ->leftJoin("typecommerces","commerces.type_commerce_id","=","typecommerces.id")
            ->leftJoin("zone_commerces","zone_commerces.commerce_id","=","commerces.id")
            ->leftJoin("zones","zones.id","=","zone_commerces.zone_id")
            ->leftJoin("administreds","commerces.administred_id","administreds.id")
            ->leftJoin("mairies","administreds.mairie_id","mairies.id")
            ->leftJoin("communes","commerces.commune_id","communes.id")

            ->selectRaw("commerces.*,
                    typecommerces.name as type_commerce,zones.name as zone,
                    CONCAT_WS('',administreds.lastname,administreds.firstname) as administred,
                    commerces.quartier,communes.name as commune,mairies.nom as mairie,typecommerces.name as type");
        if($limit){
            $query->limit($limit);
        } if($limit){
            $query->offset($offset);
        }
        if($type){
            $query->where("typecommerces.id","=",$type);
        }
        $datas = $query->get();

        return $datas;

    }

}
