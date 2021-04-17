<?php

// GENERER DANS LE REPERTOIRE "Backend" VIA: "php artisan make:controller \\Backend\MairieController -r"
// Ce Controller combine avec "public/js/console/mairie.js" qui gère le CRUD de façon asynchrone (AJAX) via VueJS:

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Communes;
use App\Models\Mairies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class AdministredController extends Controller
{

    public function lists()
    {
        $communes = UtilsController::getMyCommune();

        return view('administred.index', compact('communes'));
    }
    public function create()
    {
        $communes = UtilsController::getMyCommune();
        return view('administred.create', compact('communes'));
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
        $is_service = ($request->get('is_service')) ? $request->get('is_service') : '';


        $result = self::queryFor($from,$order,$limit,$search,$mairie,$commune,$is_service);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }

    public static function queryFor($from,$order,$limit,$search,$mairie,$commune,$is_service){

        $query = DB::table("administreds")

                    ->leftJoin("communes","administreds.residence_commune_id","=","communes.id")
					->whereNull("administreds.deleted_at")
                    ->orderBy("administreds.lastname",$order)

                    ->selectRaw("administreds.id,administreds.lastname,administreds.firstname,
                     communes.name as commune_residence,
                                    administreds.phone,administreds.phone2, administreds.email
                                    , administreds.birth_date
                                     , administreds.birth_place,job,picture,gender,birth_certificate_number");

            if($search && !empty($search)){
                $query->where('administreds.lastname', 'LIKE', "%{$search}%");
                $query->orWhere('administreds.firstname', 'LIKE', "%{$search}%");
            }
        if($mairie){
            $query->leftJoin("mairies","administreds.mairie_id","mairies.id");
            $query->where("administreds.mairie_id","=",$mairie);
            $query->selectRaw('mairies.nom');

        } if($commune){
            $query->where("administreds.residence_commune_id","=",$commune);
        }
//        if($mairie){
//            $query->where("administreds.residence_commune_id","=",$commune);
//        }

        $total = count($query->get());

        if($limit && !empty($limit)) {
            $query->take($limit)->skip($from);
        }
        $rows = $query->get();


        $jsonData["total"] = $total;
        $jsonData["rows"] =$rows;
        return $jsonData;
    }

    public function detail($id){

        $data = self::getAdministredBy($id);
        if(!$data){
            return back();
        }
        return view("administred.detail",compact('data'));
    }

    public static function getAdministredBy($id){
        $query = DB::table("administreds")
        ->leftJoin("communes","administreds.residence_commune_id","=","communes.id")
        ->leftJoin("communes as c_n","administreds.birth_commune_id","=","c_n.id")
            ->whereNull("administreds.deleted_at")
            ->selectRaw("administreds.*,
                     communes.name as commune,c_n.name as commune_naissance,
                                        DATE_FORMAT(administreds.birth_date, '%d-%m-%Y') as birth_date,
                                  DATE_FORMAT(administreds.created_at, '%d-%m-%Y') as created_at

                                     ");


        $query->where("administreds.id","=",$id);
        $data  = $query->first();
        return $data;
    }

}
