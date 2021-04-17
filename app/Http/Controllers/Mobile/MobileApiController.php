<?php

// GENERER DANS LE REPERTOIRE "Backend" VIA: "php artisan make:controller \\Backend\MairieController -r"
// Ce Controller combine avec "public/js/console/mairie.js" qui gère le CRUD de façon asynchrone (AJAX) via VueJS:

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Administred;
use App\Models\Commerces;
use App\Models\Communes;
use App\Models\DemandeMairieService;
use App\Models\Mairies;
use App\Models\Service;
use App\Models\TaxeCommercePaided;
use App\Models\Typecommerce;
use App\Models\User\User;
use App\Models\VirtualAccount;
use App\Models\ZoneCommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class MobileApiController extends Controller
{

    /** Verification de lien
     * @return \Illuminate\Http\JsonResponse
     */
    public function checker()
    {
        return response()->json(['success' => true], 200);

    }

    public function getCommune()
    {
        $commune = Communes::all();
        return $commune;

    }
    public function getMairie()
    {
        $mairie = Mairies::all();
        return $mairie;

    }
    public function getTypeCommerce()
    {
        $typeCommerce = Typecommerce::all();
        return $typeCommerce;

    }

    /** login
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        if ($request->username && $request->password) {
            $username = $request->username;
            $user = User::where("email", "=", $username)->selectRaw("id,name,phone,administred_id,email,role_id,password")->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    switch ($user->role_id) {
                        case 5:
                            $rep = DB::table("users")
                                ->leftJoin("administreds", "administreds.id", "users.administred_id")
                                ->leftJoin("mairies", "administreds.mairie_id", "mairies.id")
                                ->leftJoin("virtual_accounts", "virtual_accounts.administred_id", "administreds.id")
                                ->where("users.id", "=", $user->id)
                                ->selectRaw("users.id,users.name,users.phone,users.administred_id,
                               users.email,users.role_id,administreds.picture,
                                 users.agent_id,
                               administreds.mairie_id,mairies.nom as mairie,virtual_accounts.amount,
                               mairies.picture as mairie_picture,
                                IFNULL(users.codepin,'') as codepin")
                                ->first();
                            break;
                        default:
                            $rep = DB::table("users")
                                ->leftJoin("agents", "agents.id", "users.agent_id")
                                ->leftJoin("mairies", "agents.mairie_id", "mairies.id")
                                ->leftJoin("zone_commerces", "zone_commerces.agent_id", "agents.id")
                                ->leftJoin("zones", "zone_commerces.zone_id", "zones.id")
                                ->where("users.id", "=", $user->id)
                                ->selectRaw("users.id,users.name,users.phone,users.administred_id,
                                users.agent_id,
                               users.email,users.role_id,agents.picture,agents.mairie_id,mairies.nom as mairie,
                               mairies.picture as mairie_picture,zones.name as zone,zone_id,
                                IFNULL(users.codepin,'') as codepin")
                                ->first();
                            break;
                    }

                    return response()->json(['success' => true, 'message' => "Connexion réussie", 'data' => $rep], 200);
                }
            }
            return response()->json(['success' => false, 'message' => "Login ou Mot de passe incorrect "], 200);
        }


    }


    /** first store
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeStepOne(Request $request)
    {

//        chech_field

//        $data = [$request->nom, $request->prenom , $request->lieu_naiss ,
//            $request->mairie , $request->numero_civil , $request->commune ,
//            $request->date_naiss , $request->sexe];
//        Log::channel('login')->info("data:",$data);

        if ($request->nom && $request->prenom && $request->lieu_naiss &&
            $request->mairie && $request->numero_civil && $request->commune &&
            $request->date_naiss && $request->sexe) {

            if (chech_field("administreds", "birth_certificate_number", $request->numero_civil)) {
                return response()->json(['success' => false, 'message' => Lang::get('message.field_exist_number_certificat')], 200);
            }

            $save = Administred::create([
                'firstname' => $request->nom,
                'lastname' => $request->prenom,
                'mairie_id' => $request->mairie,
                'birth_date' => date("Y-m-d",strtotime($request->date_naiss)),
                'birth_place' => $request->lieu_naiss,
                'birth_commune_id' => $request->commune,
                'gender' => $request->sexe,
                'register_user_id' => $request->user,
                'birth_certificate_number' => $request->numero_civil
            ]);


            if (!$save) {
                return response()->json(['success' => false, 'message' => Lang::get('message.save_error')], 200);
            } else {
                self::createVirtualAccount($save->id);
                return response()->json(['success' => true, 'data' => $save, 'message' => Lang::get('message.save_success')], 200);
            }


        } else {
            return response()->json(['success' => false, 'message' => Lang::get('message.field_empty')], 200);
        }
    }


    /** second store
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeStepTwo(Request $request)
    {

        if ($request->id && $request->contact1 && $request->email && $request->type_piece &&
            $request->numero_cni && $request->commune) {

            if (chech_field("users", "phone", replace($request->contact1))) {
                return response()->json(['success' => false, 'message' => Lang::get('message.field_exist_phone')], 200);
            }
            if (chech_field("administreds", "phone", replace($request->contact1))) {
                return response()->json(['success' => false, 'message' => Lang::get('message.field_exist_phone')], 200);
            }
            if (chech_field("users", "email", $request->email)) {
                return response()->json(['success' => false, 'message' => Lang::get('message.field_exist_email')], 200);
            }
            if (chech_field("administreds", "identity_papers_id", $request->numero_cni)) {
                return response()->json(['success' => false, 'message' => Lang::get('message.field_exist_piece')], 200);
            }


            $administred = Administred::findOrFail($request->id);

            $save = $administred->update([

                'phone' => replace($request->contact1),
                'phone2' => replace($request->contact2),
                'email' => $request->email,
                'job' => $request->fonction,
                'quartier_residence' => $request->quartier,
                'residence_commune_id' => $request->commune,
                'identity_papers_type' => $request->type_piece,
                'identity_papers_id' => $request->numero_cni,

            ]);

            if (!$save) {
                return response()->json(['success' => false, 'message' => Lang::get('message.save_error')], 200);
            } else {

                $pwd = Str::random(6);
//                $data = [];
//                $data["name"]=$administred->lastname." ".$administred->firstname;
//                $data["phone"]=replace($request->contact1);
//                $data["email"]=$request->email;
//                $data["role"]=5;
//                $data["administred_id"]=$request->id;
//                $data["password"]=$pwd;

//                if($request->id ==""){
                    $msg = "Bonjour Mr/Mme ".$request->lastname." ".$request->lastname." Vottre compte à été crée,
                 Connectez vous avec vos identifiants. login :".$request->email."
                  Mot de passe ".$pwd." sur ".route('login');
//                    auth()->user()->register($data,null);

                $datas =  User::create([
                    'name' => $administred->lastname." ".$administred->firstname,
                    'email' => $request->email,
                    'phone' => replace($request->contact1),
                    'password' => bcrypt($pwd),
//                'picture' => isset($data['picture']) ? $data['picture'] : "",
                    'role_id' =>5,
//                    'agent_id' => $data['agent_id'],
                    'administred_id' => $administred->id,
                ]);


                $send =   senderMySmsTech(replace($request->contact1),$msg);

//                }



                return response()->json(['success' => true, 'message' => Lang::get('message.save_success')], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => Lang::get('message.field_empty')], 200);
        }


    }

    /** three store
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeStepThree(Request $request)
    {

        Log::channel('login')->info("data:",["inter"]);
    $data = [$request->id, $request->cni_recto , $request->cni_verso ,
            $request->signature,$request->picture,"Dani" ];
        Log::channel('login')->info("data:",$data);


        if ($request->id && $request->cni_recto && $request->cni_verso && $request->signature) {

            $id = $request->id;


            $save_cni_recto = "";
            $save_cni_verso = "";
            $save_cni_recto = "";
//            if($request->cni_recto)
//            $save_cni_recto = self::createImageFromBase64($request->cni_recto, $id, "piece_recto");

            if ($request->hasFile('cni_recto') && $request->file('cni_recto')->isValid()) {
                $save_cni_recto = $request->cni_recto->store('/administreds/'.$id);
            }
            if ($request->hasFile('cni_verso') && $request->file('cni_verso')->isValid()) {
                $save_cni_verso = $request->cni_verso->store('/administreds/'.$id);
            }
            if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                $save_photo = $request->picture->store('/administreds/'.$id);
            }
//
//            if($request->cni_recto)
//            $save_cni_recto = self::createImageFromBase64($request->cni_recto, $id, "piece_recto");
//
//            if($request->cni_recto)
//            $save_cni_verso = self::createImageFromBase64($request->cni_recto, $id, "piece_verso");

            if($request->signature)
            $save_signature = self::createImageFromBase64($request->signature, $id, "signature");


            $administred = Administred::findOrFail($id);

            $save = $administred->update([
                'fichier_piece' => $save_cni_recto."||".$save_cni_verso,
                'signature' => $save_signature,
                'picture' => $save_photo,

            ]);


            if (!$save) {
                return response()->json(['success' => false, 'message' => Lang::get('message.save_error')], 200);
            } else {
                $administred = self::getAdministred($id);

                return response()->json(['success' => true,'data'=>$administred, 'message' => Lang::get('message.save_success')], 200);
            }
        } else {
            return response()->json(['success' => false, 'message' => Lang::get('message.field_empty')], 200);
        }


    }

    /** generate & store image from base64
     * @param $file_data
     * @param $id
     * @param $name
     * @return string
     */
    public static  function createImageFromBase64($file_data, $id, $name): string
    {
        $folder = "administreds/" . $id . '/';
        $file_name = $folder . $name . '.png'; //generating unique file name;
        if ($file_data != "") { // storing image in storage/app/public Folder
            Storage::disk('public')->put($file_name, base64_decode($file_data));
            return  $file_name;
        }
    }


    /** Create virtual Account
     * @param $administred_id
     */
    public static function createVirtualAccount($administred_id)
    {
        if ($administred_id) {
            $query = VirtualAccount::create([
                "amount" => 50000,
                "administred_id" => $administred_id,
            ]);
        }
    }
    public static function updateCommerceIdentify($commerce_id,$administred,$request_picture)
    {
//        $picture = "";
//        if($request_picture)
//            $picture = self::createImageFromBase64($request_picture, $administred, "commerce/".$commerce_id);



        if ($commerce_id) {
            $commerce = Commerces::findOrFail($commerce_id);
            if($commerce){
                $save = $commerce->update([
                    "identifier"=>sprintf("%08d", $commerce_id),
//                    'picture' => $picture,
                ]);
                if($save){
                    return $save;
                }
                return false;
            }
        }
    }

    public static function getAdministredInfo(Request $request)
    {
/*        $query = DB::table("administreds")
        ->leftJoin("mairies", "administreds.mairie_id", "mairies.id")
        ->leftJoin("virtual_accounts", "virtual_accounts.administred_id", "administreds.id")
        ->where("administreds.id", "=", $request->id)
        ->selectRaw("administreds.picture,
                               administreds.mairie_id,mairies.nom as mairie,virtual_accounts.amount,
                               mairies.picture as mairie_picture,virtual_accounts.amount,

                               DATE_FORMAT(administreds.birth_date,'%d-%m-%Y') as birth_date,
                               firstname,lastname,administreds.phone,phone2,administreds.email,job
                               ")
        ->first();*/



        $query = DB::table("administreds")
            ->leftJoin("mairies", "administreds.mairie_id", "mairies.id")
            ->leftJoin("communes as commune_naissance", "administreds.birth_commune_id", "commune_naissance.id")
            ->leftJoin("communes as commune_residence", "administreds.residence_commune_id", "commune_residence.id")
            ->leftJoin("virtual_accounts", "virtual_accounts.administred_id", "administreds.id")
            ->where("administreds.id", "=", $request->id)
            ->selectRaw("administreds.*,
                             mairies.nom as mairie,virtual_accounts.amount,
                               mairies.picture as mairie_picture,
                               DATE_FORMAT(administreds.birth_date,'%d-%m-%Y') as birth_date,


                               commune_naissance.name as commune_naissance
                               ,commune_residence.name as commune_residence,tblcommerce.commerce_number,virtual_accounts.administred_id
                               ")

            ->leftJoin(DB::raw("(SELECT
       COUNT(commerces.id) as commerce_number,commerces.administred_id
      FROM commerces WHERE commerces.deleted_at IS NULL
      GROUP BY commerces.administred_id
      ) as tblcommerce"),
                function($join){
                    $join->on("tblcommerce.administred_id","=","administreds.id");

                })->first();



        if (!$query) {
            return response()->json(['success' => false, 'message' => Lang::get('message.error')], 200);
        }
        return response()->json( $query, 200);
    }
    public static function virtualAccount(Request $request)
    {
        $query = self::getvirtualAccount($request->id);
        if (!$query) {
            return response()->json(['success' => false, 'message' => Lang::get('message.error')], 200);
        }
        return response()->json(['success' => true, 'data' => $query], 200);
    }

    public static function getAdministred($administred_id)
    {
        $query = DB::table("administreds")
            ->leftJoin("mairies", "administreds.mairie_id", "mairies.id")
            ->leftJoin("virtual_accounts", "virtual_accounts.administred_id", "administreds.id")
            ->where("administreds.id", "=", $administred_id)
            ->selectRaw("administreds.picture,
                               administreds.mairie_id,mairies.nom as mairie,virtual_accounts.amount,
                               mairies.picture as mairie_picture,virtual_accounts.amount,

                               DATE_FORMAT(administreds.birth_date,'%d-%m-%Y') as birth_date,
                               firstname,lastname,administreds.phone,phone2,administreds.email,job
                               ")
            ->first();
        return $query;
    }
    public  function getAdministreds(Request $request){

        $current = ($request->get('current')) ? $request->get('current') : 0;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $user = ($request->get('user')) ? $request->get('user') : '';
        $zone = ($request->get('zone')) ? $request->get('zone') : '';
        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';
        $commune_residence = ($request->get('commune_residence')) ? $request->get('commune_residence') : '';



        $result = self::queryForAdministred($current,$order,$search,$user,$zone,$mairie,$commune_residence);
//        $jsonData["total"] = $result["total"];
//        $jsonData["rows"] = $result["rows"];

        return response()->json($result,200);
    }
    public  function getNews(Request $request){

        $current = ($request->get('current')) ? $request->get('current') : 0;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';
        $type = ($request->get('type')) ? $request->get('type') : '';
        $barner = ($request->get('barner')) ? $request->get('barner') : '';



        $result = self::queryForNews($current,$order,$search,$type,$mairie);

        return response()->json($result,200);
    }

    public  function getBarner(Request $request){

        $limit = ($request->get('limit')) ? $request->get('limit') : 4;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';
        $type = ($request->get('type')) ? $request->get('type') : '';


        $result = self::queryFoBarner($limit,$order,$search,$type,$mairie);
        return response()->json($result,200);
    }

    public  function getCommerces(Request $request){

        $current = ($request->get('current')) ? $request->get('current') : 0;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $user = ($request->get('user')) ? $request->get('user') : '';
        $zone = ($request->get('zone')) ? $request->get('zone') : '';
        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';
        $commune = ($request->get('commune')) ? $request->get('commune') : '';
        $administred_id = ($request->get('administred')) ? $request->get('administred') : '';
//        $agent = ($request->get('agent')) ? $request->get('agent') : '';
        $type = ($request->get('type')) ? $request->get('type') : '';



        $result = self::queryForCommerce($current,$order,$search,$user,$mairie,$commune,$administred_id,$type,$zone);
//        $jsonData["total"] = $result["total"];
//        $jsonData["rows"] = $result["rows"];

        return response()->json($result,200);
    }
    public  function getTaxes(Request $request){

        $current = ($request->get('current')) ? $request->get('current') : 0;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $user = ($request->get('user')) ? $request->get('user') : '';
        $zone = ($request->get('zone')) ? $request->get('zone') : '';
        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';
        $commune = ($request->get('commune')) ? $request->get('commune') : '';
        $administred_id = ($request->get('administred')) ? $request->get('administred') : '';
        $commerce = ($request->get('commerce')) ? $request->get('commerce') : '';
        $etat = ($request->get('etat')) ? $request->get('etat') : '';
        $type = ($request->get('type')) ? $request->get('type') : '';



        $result = self::queryForTaxePaided($current,$order,$search,$mairie,$administred_id,$commune,$zone,$commerce,$etat,$type);
        return response()->json($result,200);
    }
    public  function getService(Request $request){

        $current = ($request->get('current')) ? $request->get('current') : 0;
        $order = ($request->get('order')) ? $request->get('order') : 'ASC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';


        $result = self::queryForService($current,$order,$search,$mairie);
        return response()->json($result,200);
    }

    public function queryForAdministred($current, $order, $search,$user,$mairie,$commune_residence,$zone){
        $row = 10;

        $query = DB::table("administreds")
            ->leftJoin("mairies", "administreds.mairie_id", "mairies.id")
            ->leftJoin("communes as commune_naissance", "administreds.birth_commune_id", "commune_naissance.id")
            ->leftJoin("communes as commune_residence", "administreds.residence_commune_id", "commune_residence.id")
            ->leftJoin("virtual_accounts", "virtual_accounts.administred_id", "administreds.id")
            ->orderBy("administreds.lastname",$order)
            ->selectRaw("administreds.picture,administreds.id,
                               administreds.mairie_id,mairies.nom as mairie,virtual_accounts.amount,
                               mairies.picture as mairie_picture,
                               DATE_FORMAT(administreds.birth_date,'%d-%m-%Y') as birth_date,
                               administreds.birth_place,  administreds.quartier_residence,
                                administreds.birth_certificate_number, administreds.identity_papers_id,
                                 administreds.identity_papers_type, administreds.gender,administreds.fichier_piece,
                                 administreds.signature,
                               firstname,lastname,administreds.phone,phone2,administreds.email,job,
                               administreds.fichier_piece,  administreds.signature,
                               commune_naissance.name as commune_naissance
                               ,commune_residence.name as commune_residence,tblcommerce.commerce_number
                               ")

            ->leftJoin(DB::raw("(SELECT
       COUNT(commerces.id) as commerce_number,commerces.administred_id
      FROM commerces WHERE commerces.deleted_at IS NULL
      GROUP BY commerces.administred_id
      ) as tblcommerce"),
                function($join){
            $join->on("tblcommerce.administred_id","=","administreds.id");

        });


        if($search && !empty($search)){
            $query->where('administreds.lastname', 'LIKE', "%{$search}%");
            $query->orWhere('administreds.firstname', 'LIKE', "%{$search}%");
        }

        if($user){
            $query->where("administreds.register_user_id","=",$user);
        }

        if($mairie){
            $query->where("administreds.mairie_id","=",$mairie);
        }
        if($commune_residence){
            $query->where("administreds.residence_commune_id","=",$commune_residence);
        }

        $total = count($query->get());

        // var_dump($currentIndex);
        $limit_l = ($current * $row) - ($row);

        //calculate the low and high limits for the SQL LIMIT x,y clause
        if ($current !=null) {
            $limit_l = ($current * $row) - ($row);
        }

        if ($row == -1)
            $limit_q = "";  //no limit
        else{
            $query->take($row)->skip($limit_l);
        }
            // $limit = "LIMIT " . $limit_l . "," . $limit_h;

        $datas = $query->get();

        $pagestotales  = ceil($total / $row);


        return [
            "total_page"=>$pagestotales,
            "current"=>intval($current)+1,
            "total_count"=>$total,
            "success"=>$current<=$pagestotales ? true:null,
            "items"=>$datas,
        ];

    }
    public function queryFoBarner($limit, $order, $search,$type,$mairie){
        $row = 10;

        $query = DB::table("actualites")
            ->leftJoin("mairies","mairies.id","=","actualites.mairie_id")
            ->leftJoin("type_actualites","type_actualites.id","=","actualites.type_actualite_id")
            ->orderBy("actualites.id","desc")
            ->whereNull("actualites.deleted_at")
            ->selectRaw("actualites.*,DATE_FORMAT(actualites.created_at,'%d/%m/%Y')
        as created_at,mairies.nom as mairie,type_actualites.name as type")
            ->orderBy("actualites.id",$order);

        if($search && !empty($search)){
            $query->where('administreds.lastname', 'LIKE', "%{$search}%");
            $query->orWhere('administreds.firstname', 'LIKE', "%{$search}%");
        }

        if($mairie){
            $query->where("actualites.mairie_id","=",$mairie);
        }
        if($type){
            $query->where("actualites.type_actualite_id","=",$type);
        }

            $query->limit($limit);

           $datas = $query->get();

        return $datas;

    }
    public function queryForNews($current, $order, $search,$type,$mairie){
        $row = 10;

        $query = DB::table("actualites")
            ->leftJoin("mairies","mairies.id","=","actualites.mairie_id")
            ->leftJoin("type_actualites","type_actualites.id","=","actualites.type_actualite_id")
            ->orderBy("actualites.id","desc")
            ->whereNull("actualites.deleted_at")
            ->selectRaw("actualites.*,DATE_FORMAT(actualites.created_at,'%d/%m/%Y')
        as created_at,mairies.nom as mairie,type_actualites.name as type")
            ->orderBy("actualites.id",$order);


        if($search && !empty($search)){
            $query->where('administreds.lastname', 'LIKE', "%{$search}%");
            $query->orWhere('administreds.firstname', 'LIKE', "%{$search}%");
        }

      /*  if($mairie){
            $query->where("actualites.mairie_id","=",$mairie);
        }*/
        if($type){
            $query->where("actualites.type_actualite_id","=",$type);
        }

        $total = count($query->get());

        // var_dump($currentIndex);
        $limit_l = ($current * $row) - ($row);

        //calculate the low and high limits for the SQL LIMIT x,y clause
        if ($current !=null) {
            $limit_l = ($current * $row) - ($row);
        }

        if ($row == -1)
            $limit_q = "";  //no limit
        else{
            $query->take($row)->skip($limit_l);
        }
            // $limit = "LIMIT " . $limit_l . "," . $limit_h;

        $datas = $query->get();

        $pagestotales  = ceil($total / $row);


        return [
            "total_page"=>$pagestotales,
            "current"=>intval($current)+1,
            "total_count"=>$total,
            "success"=>$current<=$pagestotales ? true:null,
            "items"=>$datas,
        ];

    }
    public static function queryForCommerce($current, $order, $search,$user,$mairie,$commune,$administred_id,$type,$zone){
        $row = 10;

        $query = DB::table("commerces")
            ->leftJoin("administreds", "administreds.id", "commerces.administred_id")
            ->leftJoin("virtual_accounts", "virtual_accounts.administred_id", "administreds.id")
            ->leftJoin("mairies", "commerces.mairie_id", "mairies.id")
            ->leftJoin("typecommerces", "commerces.type_commerce_id", "typecommerces.id")
            ->leftJoin("communes", "commerces.commune_id", "communes.id")
            ->leftJoin("zone_commerces", "zone_commerces.commerce_id", "commerces.id")
            ->leftJoin("zones", "zone_commerces.zone_id", "zones.id")
            ->whereNull("commerces.deleted_at")
            ->orderBy("commerces.raison_social",$order)
            ->selectRaw("commerces.id,commerces.administred_id,commerces.picture,commerces.raison_social
                       ,commerces.quartier,
                               commerces.mairie_id,mairies.nom as mairie,
                               DATE_FORMAT(commerces.created_at,'%d-%m-%Y') as created_at,
                               typecommerces.name as type_commerce,  commerces.identifier,
                                administreds.identity_papers_id,
                               commerces.latitude, commerces.longitude,
                               firstname,lastname,administreds.phone,phone2,administreds.email,job,
                               administreds.picture as ad_picture,
                               administreds.fichier_piece,communes.name as commune,
                               zone_commerces.zone_id,zones.name as zone,taxes.*,taxesPaid.*,
                               virtual_accounts.amount as balance,administreds.phone
                               ");

        // Forfait taxe
            $query->leftJoin(DB::raw("(SELECT
      taxeforfait_commerce_selecteds.commerce_id,type_taxe_forfaits.amount,
      type_taxes.name as taxe,typetaxeforfait_id
      FROM taxeforfait_commerce_selecteds
      LEFT JOIN type_taxe_forfaits ON type_taxe_forfaits.id=taxeforfait_commerce_selecteds.typetaxeforfait_id
      LEFT JOIN type_taxes ON type_taxes.id=type_taxe_forfaits.type_taxe_id
      WHERE taxeforfait_commerce_selecteds.deleted_at IS NULL

      ) as taxes"),
                function($join){
            $join->on("taxes.commerce_id","=","commerces.id");

        });


            // Taxe Impaye
        $query->leftJoin(DB::raw("(SELECT
      taxeforfait_commerce_selecteds.commerce_id,
      SUM(CASE WHEN taxe_commerce_paideds.amount_prev IS NOT NULL THEN 1 ELSE 0 END)  as total_prev,
            SUM(CASE WHEN taxe_commerce_paideds.amount_prev IS NOT NULL THEN taxe_commerce_paideds.amount_prev ELSE 0 END)  as total_amount_prev,

            SUM(CASE WHEN taxe_commerce_paideds.amount_paided IS NOT NULL THEN 1 ELSE 0 END)  as total_paided,
            SUM(CASE WHEN taxe_commerce_paideds.amount_paided IS NOT NULL THEN taxe_commerce_paideds.amount_paided ELSE 0 END)  as total_amount_paided,

            SUM(CASE WHEN taxe_commerce_paideds.amount_paided IS NULL AND taxe_commerce_paideds.amount_prev IS NOT NULL  THEN 1 ELSE 0 END)  as total_no_paided,
            SUM(CASE WHEN taxe_commerce_paideds.amount_paided IS  NULL AND taxe_commerce_paideds.amount_prev IS NOT NULL THEN taxe_commerce_paideds.amount_prev ELSE 0 END)  as total_amount_no_paided

      FROM taxe_commerce_paideds
       LEFT JOIN taxeforfait_commerce_selecteds ON taxe_commerce_paideds.taxecommerce_id=taxeforfait_commerce_selecteds.id

      WHERE taxeforfait_commerce_selecteds.deleted_at IS NULL
      AND taxe_commerce_paideds.deleted_at IS NULL
      GROUP BY commerce_id

      ) as taxesPaid"),
            function($join){
                $join->on("taxesPaid.commerce_id","=","commerces.id");

            });



        if($search && !empty($search)){
            $query->where('commerces.raison_social', 'LIKE', "%{$search}%");
        }

        if($user && $user != "null"){
            $query->where("commerces.register_user_id","=",$user);
        }


        if($mairie &&  $mairie != "null" &&  $administred_id == null){
            $query->where("commerces.mairie_id","=",$mairie);
        }
        if($administred_id &&  $administred_id != "null"){
            $query->where("commerces.administred_id","=",$administred_id);
        }
        if($commune &&  $commune != "null"){
            $query->where("commerces.commune_id","=",$commune);
        }
        if($type &&  $type != "null"){
            $query->where("commerces.type_commerce_id","=",$type);
        }
        if($zone &&  $zone != "null"  && $administred_id == null){
            $query->where("zone_commerces.zone_id","=",$zone);
        }

//        $query->dd();

        $total = count($query->distinct()->get());

        // var_dump($currentIndex);
        $limit_l = ($current * $row) - ($row);

        //calculate the low and high limits for the SQL LIMIT x,y clause
        if ($current !=null) {
            $limit_l = ($current * $row) - ($row);
        }

        if ($row == -1)
            $limit_q = "";  //no limit
        else{
            $query->take($row)->skip($limit_l);
        }
            // $limit = "LIMIT " . $limit_l . "," . $limit_h;

        $datas = $query->distinct()->get();

        $pagestotales  = ceil($total / $row);


        return [
            "total_page"=>$pagestotales,
            "current"=>intval($current)+1,
            "total_count"=>$total,
            "success"=>$current<=$pagestotales ? true:null,
            "items"=>$datas,
        ];

    }


    public function queryForService($current,$order,$search,$mairie){
        $row = 10;
        $query = DB::table("services")

            ->orderBy("services.name",$order)
            ->selectRaw("services.*");

        if($search && !empty($search)){
            $query->where('services.name', 'LIKE', "%{$search}%");
        }

        $total = count($query->distinct()->get());

        // var_dump($currentIndex);
        $limit_l = ($current * $row) - ($row);

        //calculate the low and high limits for the SQL LIMIT x,y clause
        if ($current !=null) {
            $limit_l = ($current * $row) - ($row);
        }

        if ($row == -1)
            $limit_q = "";  //no limit
        else{
            $query->take($row)->skip($limit_l);
        }
        // $limit = "LIMIT " . $limit_l . "," . $limit_h;

        $datas = $query->distinct()->get();

        $pagestotales  = ceil($total / $row);


        return [
            "total_page"=>$pagestotales,
            "current"=>intval($current)+1,
            "total_count"=>$total,
            "success"=>$current<=$pagestotales ? true:null,
            "items"=>$datas,
        ];
    }

    public function queryForTaxePaided($current,$order,$search,$mairie,$administred,$commune,$zone,$commerce,$etat_paided,$type){
        $row = 10;
        $query = DB::table("taxe_commerce_paideds")
            ->leftJoin("taxeforfait_commerce_selecteds","taxe_commerce_paideds.taxecommerce_id","=","taxeforfait_commerce_selecteds.id")
            ->leftJoin("commerces","commerces.id","=","taxeforfait_commerce_selecteds.commerce_id")
            ->leftJoin("type_taxe_forfaits","type_taxe_forfaits.id","=","taxeforfait_commerce_selecteds.typetaxeforfait_id")
            ->leftJoin("users","users.id","=","taxe_commerce_paideds.payed_user_id")

            ->leftJoin("type_taxes","type_taxes.id","=","type_taxe_forfaits.type_taxe_id")
            ->leftJoin("zone_commerces","zone_commerces.commerce_id","=","commerces.id")
            ->whereNull("taxe_commerce_paideds.deleted_at")
            ->orderBy("taxe_commerce_paideds.created_at",$order)
            ->selectRaw("taxe_commerce_paideds.id,
                                taxe_commerce_paideds.amount_prev,
                                 taxe_commerce_paideds.amount_paided,
                                  taxe_commerce_paideds.month,
                                  DATE_FORMAT(taxe_commerce_paideds.date_paided, '%d-%m-%Y') as date_paided,
                                  DATE_FORMAT(taxe_commerce_paideds.created_at, '%d-%m-%Y') as created_at,
                                  type_taxes.name as taxe,users.name as user_paided
                                 ");

        if($search && !empty($search)){
            $query->where('taxe_commerce_paideds.amount_prev', 'LIKE', "%{$search}%");
            $query->orWhere('taxe_commerce_paideds.amount_paided', 'LIKE', "%{$search}%");
        }
        if($mairie && !empty($mairie)){
            $query->where('commerces.mairie_id', '=', $mairie);
        }
        if($commune && !empty($commune)){
            $query->where('commerces.commune_id', '=', $commune);
        }
        if($zone && !empty($zone)){
            $query->where('zone_commerces.zone_id', '=', $zone);
        }
        if($commerce && !empty($commerce)){
            $query->where('commerces.id', '=', $commerce);
        }
        if($administred && !empty($administred)){
            $query->where('commerces.administred_id', '=', $administred);
        }
        if($type){
            $query->where("commerces.type_commerce_id","=",$type);
        }
        if($etat_paided && !empty($etat_paided)){
            if($etat_paided=="PAYE"){
                $query->whereNotNull('taxe_commerce_paideds.amount_paided');
            }
            if($etat_paided=="NON_PAYE"){
                $query->whereNull('taxe_commerce_paideds.amount_paided');
            }
        }

        $total = count($query->distinct()->get());

        // var_dump($currentIndex);
        $limit_l = ($current * $row) - ($row);

        //calculate the low and high limits for the SQL LIMIT x,y clause
        if ($current !=null) {
            $limit_l = ($current * $row) - ($row);
        }

        if ($row == -1)
            $limit_q = "";  //no limit
        else{
            $query->take($row)->skip($limit_l);
        }
        // $limit = "LIMIT " . $limit_l . "," . $limit_h;

        $datas = $query->distinct()->get();

        $pagestotales  = ceil($total / $row);


        return [
            "total_page"=>$pagestotales,
            "current"=>intval($current)+1,
            "total_count"=>$total,
            "success"=>$current<=$pagestotales ? true:null,
            "items"=>$datas,
        ];
    }

    /** Store Commerce
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeCommerceStepOne(Request $request)
    {
//
//        $data = [$request->administred_id, $request->raison_social , $request->description ,
//            $request->quartier , $request->mairie , "type"=>$request->type_commerce ,
//            $request->commune , $request->user,"lat"=> $request->latitude, "lng"=>$request->longitude];
//        Log::channel('login')->info("data:",$data);


        if ($request->administred_id && $request->raison_social &&
            $request->description && $request->quartier &&
            $request->mairie && $request->type_commerce
            && $request->commune &&
            $request->user) {

            if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                $save_photo = $request->picture->store('/administreds/'.$request->administred_id.'/commerces' );
            }

            $save = Commerces::create([
                'raison_social' => $request->raison_social,
                'administred_id' => $request->administred_id,
                'description' => $request->description,
                'quartier' => $request->quartier,
                'mairie_id' => $request->mairie,
                'commune_id' => $request->commune,
                'picture' => $save_photo,
                'type_commerce_id' => $request->type_commerce,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            if (!$save) {
                return response()->json(['success' => false, 'message' => Lang::get('message.save_error')], 200);
            } else {
                self::updateCommerceIdentify($save->id,$request->administred_id,$request->picture);
                if($request->zone_id){
                    if(self::checkIfExisteInZone($save->id,$request->zone_id)){
                        self::affecteToZpne($save->id,$request->zone_id);
                    }
                }

                return response()->json(['success' => true, 'data' => $save, 'message' => Lang::get('message.save_success')], 200);
            }


        } else {
            return response()->json(['success' => false, 'message' => Lang::get('message.field_empty')], 200);
        }
    }

    /** affecter dans la zone
     * @param $commerce_id
     * @param $zone_id
     */
    public static function affecteToZpne($commerce_id, $zone_id)
    {
        if ($commerce_id && $zone_id) {
            $query = ZoneCommerce::create([
                "commerce_id" => $commerce_id,
                "zone_id" => $zone_id,
            ]);
        }
    }

    /** Verifier si le commerce a été enregistré dans la base
     * @param $commerce_id
     * @param $zone_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function checkIfExisteInZone($commerce_id=null, $agent_id=null, $zone_id=null){
        $query = DB::table("zone_commerces");
        if($zone_id){
            $query->where("zone_id","=",$zone_id);
        }
     if($commerce_id){
            $query->where("commerce_id","=",$commerce_id);
        }

        if($agent_id){
            $query->where("agent_id","=",$agent_id);
        }
          $result =   $query->whereNull("deleted_at")->first();
        return $result;
    }


    /** STORE TAXE FOR PAIDED
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeTaxePaided(Request $request)
    {

//        chech_field

//        $data = [$request->nom, $request->prenom , $request->lieu_naiss ,
//            $request->mairie , $request->numero_civil , $request->commune ,
//            $request->date_naiss , $request->sexe];
//        Log::channel('login')->info("data:",$data);

        if ($request->taxe && $request->mode_paiement  ) {

        $taxe_id = $request->taxe ;
        $modePaiement = $request->mode_paiement ;


        $checkIfPaided = self::checkPaidedTaxe($taxe_id);
        if(!$checkIfPaided){
            return response()->json(['success' => false, 'message' => "La taxe a été déjà payée"], 200);
        }

        // verifier l'esistance de la taxe et le montant prevu
//        $checkTaxe = self::getPaidedTaxeById($taxe_id);
        $checkTaxe = TaxeCommercePaided::find($taxe_id);
        if(!$checkTaxe){
            return response()->json(['success' => false, 'message' => Lang::get('message.error')], 20);
        }
        $amout_prev = $checkTaxe->amount_prev;

       $commerce = self::getCommerceByTaxe($request->taxe);
        // Recuperer les montants
            if($modePaiement=="account"){

                $getVirtualAccount = self::getAdministredBalance($commerce->commerce_id);
                if(!$getVirtualAccount){
                    return response()->json(['success' => false, 'message' => Lang::get('message.error')], 20);
                }

                // SI LE MONTANT PREVU EST SUPERIEUR AU MONTANT SUR LE COMPTE

                $amout_account = $getVirtualAccount->amount;
                if(intval($amout_prev)>intval($amout_account)){
                    return response()->json(['success' => false, 'message' => Lang::get('message.taxe_inssuffisance_balance')], 20);
                }


                $save = $checkTaxe->update([
                    'amount_paided' => $amout_prev,
                    'date_paided' => date("Y-m-d H:i:s"),
                    'payed_user_id' => $request->user,
                ]);


                if (!$save) {
                    return response()->json(['success' => false, 'message' => Lang::get('message.save_error')], 200);
                } else {
                    $newsBalance = intval($amout_account)-intval($amout_prev);
                    self::updateBalance($getVirtualAccount->id,$amout_prev);

                    $administred = Administred::findOrFail($getVirtualAccount->administred_id);

                    $checkTaxe = self::getPaidedTaxeById($taxe_id);


                    $name = $administred->lastname." ".$administred->firstanme;
                    $phone = $administred->phone;
                    $taxe = $checkTaxe->taxe;
                    $code = time();

                    $msg =   "Mr/Mme ".$name.", votre taxe du ".$checkTaxe->month." (".$taxe."),
          montant: ".$amout_prev." OXF été payée. Code paiement:".$code;

                    $rep = senderMySmsTech($phone,$msg);

                    return response()->json(['success' => true, 'data' => $save, 'message' => Lang::get('message.operation_success')], 200);
                }


            }



        } else {
            return response()->json(['success' => false, 'message' => Lang::get('message.field_empty')], 200);
        }
    }
    public function storeDemandeService(Request $request)
    {

//        chech_field

//        $data = [$request->nom, $request->prenom , $request->lieu_naiss ,
//            $request->mairie , $request->numero_civil , $request->commune ,
//            $request->date_naiss , $request->sexe];
//        Log::channel('login')->info("data:",$data);

        if ($request->mairie && $request->mode_paiement &&  $request->service) {

        $mairie = $request->mairie ;
        $service = $request->service ;
        $administred_id = $request->administred_id ;
        $modePaiement = $request->mode_paiement ;



        $checkDemandeService = self::checkDemandeService($service,$mairie,$administred_id);
        if($checkDemandeService){
            return response()->json(['success' => false, 'message' => "Vous avez déjà une demande en attente ou en traitement"], 200);
        }

      $demandeurObjet = Administred::findOrFail($administred_id);
       $serviceObjet  = Service::findOrFail($service);

       $coutTotal = intval($serviceObjet->prix_unitaire)*intval($request->quantite);


            if($modePaiement=="account"){

                $getVirtualAccount = self::getBalanceByAdministred($administred_id);
                if(!$getVirtualAccount){
                    return response()->json(['success' => false, 'message' => Lang::get('message.error')], 20);
                }
                // SI LE MONTANT PREVU EST SUPERIEUR AU MONTANT SUR LE COMPTE

                $amout_account = $getVirtualAccount->amount;

                if(intval($coutTotal)>intval($amout_account)){
                    return response()->json(['success' => false, 'message' => Lang::get('message.taxe_inssuffisance_balance')], 20);
                }


                $save = DemandeMairieService::create([
                    "birth_certificate_number"=>$demandeurObjet->birth_certificate_number,
                    "quantite"=>$request->quantite,
                    "mairie_id"=>$mairie,
                    "service_id"=>$request->service,
                    "administred_id"=>$demandeurObjet->id,
                    "register_user_id"=>$request->user,
                    "status"=>"ATTENTE",
                ]);



                if (!$save) {
                    return response()->json(['success' => false, 'message' => Lang::get('message.save_error')], 200);
                } else {
                    $newsBalance = intval($amout_account)-intval($coutTotal);
                    self::updateBalance($getVirtualAccount->id,$coutTotal);
/*
                    $checkTaxe = self::getPaidedTaxeById($taxe_id);*/


                    $name = $demandeurObjet->lastname." ".$demandeurObjet->firstanme;
                    $phone = $demandeurObjet->phone;
                    $service = $serviceObjet->name;
                    $coutUnitaire = $serviceObjet->prix_unitaire;
                    $qte = $request->quantite;
                    $code = time();

                    $msg =   "Mr/Mme ".$name.", votre demande de  ".$service." (nombre de copie:".$qte.", coût unitaire: $coutUnitaire $),
          montant: ".$coutTotal." $ est en attente de traitement. Code paiement:".$code;

                    $rep = senderMySmsTech($phone,$msg);

                    return response()->json(['success' => true, 'data' => $save, 'message' => Lang::get('message.operation_success')], 200);
                }


            }




        } else {
            return response()->json(['success' => false, 'message' => Lang::get('message.field_empty')], 200);
        }
    }

    public static function getPaidedTaxeById($id){
        $query = DB::table("taxe_commerce_paideds")->where("taxe_commerce_paideds.id",$id)
            ->leftJoin("taxeforfait_commerce_selecteds","taxe_commerce_paideds.taxecommerce_id","=","taxeforfait_commerce_selecteds.id")
            ->leftJoin("type_taxe_forfaits","type_taxe_forfaits.id","=","taxeforfait_commerce_selecteds.typetaxeforfait_id")
            ->leftJoin("type_taxes","type_taxes.id","=","type_taxe_forfaits.type_taxe_id")
            ->selectRaw("type_taxes.name as taxe,taxe_commerce_paideds.month")
            ->first();
        return $query;
    }

    public static function getCommerceByTaxe($id){
        $query = DB::table("taxe_commerce_paideds")->where("taxe_commerce_paideds.id",$id)
            ->leftJoin("taxeforfait_commerce_selecteds","taxe_commerce_paideds.taxecommerce_id","=","taxeforfait_commerce_selecteds.id")
            ->leftJoin("type_taxe_forfaits","type_taxe_forfaits.id","=","taxeforfait_commerce_selecteds.typetaxeforfait_id")
            ->leftJoin("type_taxes","type_taxes.id","=","type_taxe_forfaits.type_taxe_id")
            ->selectRaw("type_taxes.name as taxe,taxe_commerce_paideds.month,
            taxeforfait_commerce_selecteds.commerce_id")
            ->first();
        return $query;
    }


    public static function checkPaidedTaxe($id){
        $query = DB::table("taxe_commerce_paideds")->whereNull("taxe_commerce_paideds.amount_paided")->where("taxe_commerce_paideds.id",$id)
            ->first();
        return $query;
    }
    public static function checkDemandeService($service,$mairie,$adminitred_id){
        $query = DB::table("demande_mairie_services")
            ->whereNull("demande_mairie_services.deleted_at")
            ->where("service_id","=",$service)
            ->where("mairie_id","=",$mairie)
            ->where("administred_id","=",$adminitred_id)
            ->where("status","=","ATTENTE")
            ->orWhere("status","=","EN TRAITEMENT")
            ->first();
        return $query;
    }


    /** EN PASSANT PAR LE COMMERCE
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getAdministredBalance($id){
        $query = DB::table("commerces")
            ->leftJoin("virtual_accounts","commerces.administred_id",
                "=","virtual_accounts.administred_id")
            ->where("commerces.id",$id)
           ->whereNull("virtual_accounts.deleted_at")
            ->selectRaw("amount,virtual_accounts.id,commerces.administred_id")->first();
        return $query;
    }

    /** GET BALANCE
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getBalanceByAdministred($id){
        $query = DB::table("virtual_accounts")
            ->where("administred_id",$id)
           ->whereNull("virtual_accounts.deleted_at")
            ->selectRaw("amount,virtual_accounts.id,administred_id")->first();
        return $query;
    }

    public static function updateBalance($id,$valPaided){
        $newVirtual = VirtualAccount::findOrFail($id);

       $save = $newVirtual->update(["amount"=>intval($newVirtual->amount)-intval($valPaided)]);
       return $save;
    }


}
