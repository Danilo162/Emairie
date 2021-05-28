<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend\AdministredController;
use App\Http\Controllers\Controller;


use App\Http\Controllers\Mobile\MobileApiController;
use App\Models\Administred;
use App\Models\DemandeMairieService;
use App\Models\Mairies;
use App\Models\Service;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ProfileController extends Controller
{

public function index(Request $request){

    return view("frontend.profile.index");
}
public function detail(Request $request){

   /* $data = AdministredController::getAdministredBy(auth()->user()->administred_id);*/
    $data = AdministredController::getAdministredBy(auth()->user()->administred_id);
  /*  dd($data,auth()->user()->administred_id,auth()->user());*/
    return view("frontend.profile.detail",compact('data'));
}
public function commerce(Request $request){
   /* $data = AdministredController::getAdministredBy(auth()->user()->administred_id);*/
    $datas = MobileApiController::queryForCommerce(1, "ASC", "","","",
        "",auth()->user()->administred_id,"","")["items"];
    return view("frontend.profile.commerce",compact('datas'));
}
public function demande(Request $request){
   /* $data = AdministredController::getAdministredBy(auth()->user()->administred_id);*/
    if(!auth()->user()->administred_id){
        return  back();
    }
    $datas = self::getMyService(auth()->user()->administred_id);

    $modes = DB::table("mode_paiements")->where("id","=",4)->get();
    $mairies = Mairies::all();
    $services = Service::all();

    return view("frontend.profile.demande",compact('datas','services','mairies','modes'));

}

public function service(Request $request){
$id = ($request->q)?$request->q:"";
$mairie = ($request->target)?$request->target:"";

    $data = self::getMairieId($mairie);
    $service = Service::findOrFail($id);


    if(!$data || !$service  ){
        return back();
    }

    $others = self::getMairies(6,null,$id);


    return view("frontend.mairie.demande",compact('data','service','others'));
}

public static function getMairies($limit=null,$offset=null,$id_no_in=null){
    $query =  DB::table("mairies")
        ->leftJoin("communes","mairies.commune_id","=","communes.id")
        ->whereNull("mairies.deleted_at")
        ->selectRaw("mairies.id, mairies.nom, mairies.picture, communes.name as commune,
                                    mairies.localisation, mairies.email, mairies.phone,
                                    ");;
    if($limit){
        $query->limit($limit);
    } if($limit){
        $query->offset($offset);
    }

    if($id_no_in){
        $query->where("mairies.id","!=",$id_no_in);
    }
        $datas = $query->get();

    return $datas;

}

public static function getMairieId($id){
    $query =
       DB::table("mairies")
           // ON LIE la Table "communes" à la Table "mairies" sélectionné ci-dessus avec "leftJoin()":
           ->leftJoin("communes","mairies.commune_id","=","communes.id")
           ->whereNull("mairies.deleted_at")
           ->selectRaw("mairies.id, mairies.nom, mairies.picture, communes.name as commune,
                                    mairies.localisation, mairies.email, mairies.phone");;
    if($id){
        $query->where("mairies.id","=",$id);
    }
    $data = $query->first();
    return $data;
}

public static function getMyService($id){

    $query =
       DB::table("demande_mairie_services")
           ->leftJoin("services","demande_mairie_services.service_id","=","services.id")
           ->leftJoin("mairies","demande_mairie_services.mairie_id","=","mairies.id")
           ->whereNull("demande_mairie_services.deleted_at")
           ->selectRaw("demande_mairie_services.*,
            services.name as service,mairies.nom as mairie,DATE_FORMAT(demande_mairie_services.created_at,'%d/%m/%Y') as created")
    ->orderBy("demande_mairie_services.id","desc");;
    if($id){
        $query->where("demande_mairie_services.administred_id","=",$id);
    }

    $data = $query->get();
    
    return $data;
}


    public function demande_store(Request $request){
        $request->validate([
          /*  'numero_extrait' => 'required|exists:administreds,birth_certificate_number',*/
            'quantite' => 'required|integer|min:1|digits_between: 1,20',
            'mairie' => 'required|exists:mairies,id',
            'demande' => 'required|exists:services,id',
            'mode_paiement' => 'required',
        ]);
/*
        $administred = Administred::where("id","=",auth()->user()->administred_id)->first();

        $coutTotal = intval($request->prix_unitaire)*intval($request->quantite);


        $checkDemandeService = MobileApiController::checkDemandeService($request->demande,$request->mairie,$administred->id);
        if($checkDemandeService){
            return response()->json(['success' => false, 'message' => "Vous avez déjà une demande en attente ou en traitement"], 200);
        }


        $save = DemandeMairieService::create([
            "birth_certificate_number"=>$request->numero_extrait,
            "quantite"=>$request->quantite,
            "mairie_id"=>$request->mairie,
            "service_id"=>$request->demande,
            "service_id"=>$request->demande,
            "administred_id"=>$administred->id,
            "register_user_id"=>auth()->user()->id,
            "status"=>"ATTENTE",
            ]);

        if(!$save){
            return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);

        }*/
     /*   return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);*/

        $mode = "account";
        if($request->mode_paiement!= "PORTEFEUILLE VIRTUEL"){
            $mode =  $request->mode_paiement;
        }

        storeDemande(auth()->user()->administred_id,$request->mairie,$request->demande,$request->price_unit,$mode,auth()->user()->id);
    }

    public function print_file(Request $request)
    {
        $id = ($request->q)?$request->q:"";
        $target = ($request->target)?$request->target:"";
        if ($id) {

            $data = AdministredController::getAdministredBy($id);
            if (!$data) {
                return back();
            }
$extrait =
    DB::table("demande_mairie_services")
        ->leftJoin("services","demande_mairie_services.service_id","=","services.id")
        ->leftJoin("mairies","demande_mairie_services.mairie_id","=","mairies.id")
        ->leftJoin("users","users.id","=","demande_mairie_services.register_user_id")
        ->whereNull("demande_mairie_services.deleted_at")
        ->selectRaw("demande_mairie_services.*,
            services.name as service,mairies.nom as mairie,
            DATE_FORMAT(demande_mairie_services.created_at,'%d/%m/%Y') as created,
             users.name as user")
        ->where("demande_mairie_services.id","=",$target)
        ->first();

            if (!$extrait) {
                return back();
            }

            $modeleFiche = view('frontend.profile.extrait', compact('data','extrait'))->render();

            $options = new \Dompdf\Options();
            $options->setIsRemoteEnabled(true);
            $domPdf = new Dompdf($options);
            $domPdf->loadHtml($modeleFiche);
            // (Optional) Setup the paper size and orientation
            $domPdf->setPaper('A4');
            $name = "fadvantech";
            $domPdf->render();
            $domPdf->stream(time() . '_myemairie_' . $name . '.pdf');
        } else {
            flash()->error("Erreur survenue...");
            return back();
        }
    }

}
