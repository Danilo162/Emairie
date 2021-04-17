<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;


use App\Models\Actualite;
use App\Models\Administred;
use App\Models\DemandeMairieService;
use App\Models\Service;
use App\Models\ThemeMairie;
use App\Models\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class CommerceController extends Controller
{

    public function lists(){
        $commerces = EntrepriseController::getCommerce(8);
        return view("frontend.commerce.index",compact('commerces'));
    }
public function detail(Request $request){
$id = ($request->q)?$request->q:"";
    $data = self::getMairieId($id);


    if(!$data){
        return back();
    }
$others = self::getMairies(6,null,$id,$data->type_organe_id);

    $allServices = \App\Http\Controllers\Backend\MairieController::getServiceMairie($id);

    return view("frontend.mairie.detail",compact('data','others','allServices'));
}


public function service(Request $request){
   $id = ($request->q)?$request->q:"";
   $mairie = ($request->target)?$request->target:"";

    $data = self::getMairieId($mairie);
    $service = Service::findOrFail($id);


    if(!$data || !$service  ){
        return back();
    }

    $others = self::getMairies(6,null,$id,$data->type_organe_id);


    return view("frontend.mairie.demande",compact('data','service','others'));
}

public static function getMairies($limit=null,$offset=null,$id_no_in=null,$type=null){
    $query =  DB::table("mairies")
        ->leftJoin("communes","mairies.commune_id","=","communes.id")
        ->whereNull("mairies.deleted_at")
        ->selectRaw("mairies.id, mairies.nom, mairies.picture, communes.name as commune,
                                    mairies.localisation, mairies.email, mairies.phone");;
    if($limit){
        $query->limit($limit);
    } if($limit){
        $query->offset($offset);
    }

    if($id_no_in){
        $query->where("mairies.id","!=",$id_no_in);
    }
    if($type){
        $query->where("type_organe_id","=",$type);
    }
        $datas = $query->get();

    return $datas;

}

public static function getMairieId($id){
    $query =
       DB::table("mairies")
           // ON LIE la Table "communes" à la Table "mairies" sélectionné ci-dessus avec "leftJoin()":
           ->leftJoin("type_organes","mairies.type_organe_id","=","type_organes.id")
           ->leftJoin("communes","mairies.commune_id","=","communes.id")
           ->whereNull("mairies.deleted_at")
           ->selectRaw("mairies.id, mairies.nom, mairies.picture, communes.name as commune,
                                    mairies.localisation, mairies.email,
                                    mairies.phone,mairies.type_organe_id,
                                    type_organes.name as type_organe");;
    if($id){
        $query->where("mairies.id","=",$id);
    }
    $data = $query->first();
    return $data;
}
    public function demande_store(Request $request){
        $request->validate([
            'numero_extrait' => 'required|exists:administreds,birth_certificate_number',
            'quantite' => 'required|integer|min:1|digits_between: 1,20',
            'mairie' => 'required|exists:mairies,id',
            'demande' => 'required|exists:services,id',
        ]);

        $administred = Administred::where("birth_certificate_number","=",$request->numero_extrait)->first();



        $save = DemandeMairieService::create([
            "birth_certificate_number"=>$request->numero_extrait,
            "quantite"=>$request->quantite,
            "mairie_id"=>$request->mairie,
            "service_id"=>$request->demande,
            "administred_id"=>$administred->id,
            "register_user_id"=>auth()->user()->id,
            "status"=>"ATTENTE",
            ]);

        if(!$save){
            return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);

        }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);

    }
}
