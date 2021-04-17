<?php

use App\Models\Administred;
use App\Models\DemandeMairieService;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

if(!function_exists('logError')){

    function logError($action,$error){
        $ua = Request()->server('HTTP_USER_AGENT');

        $data = [
            "action"=>$action,
            "error"=>$error,
            "by"=>auth()->user()->id,
            "date"=>date("Y-m-d H:i:s"),
            "ip"=>Request()->ip(),
            "ua"=>$ua,
        ];

        Log::channel('error')->info("data:",$data);

    }
}
if(!function_exists('mairies')){
     function mairies()
    {

        $query = DB::table("mairies")
            ->leftJoin("agents","agents.mairie_id","=","mairies.id")
            ->where("agents.id","=",auth()->user()->agent_id)
            ->whereNull("mairies.deleted_at")
            ->whereNull("agents.deleted_at")
            ->selectRaw("mairies.*")
            ->first();
        if(!$query){
            return null;
        }
        return $query;
    }
}
if(!function_exists('adminitred')){
     function administred()
    {

        $query = DB::table("administreds")
            ->leftJoin("users","users.administred_id","=","administreds.id")
            ->where("users.administred_id","=",auth()->user()->administred_id)
            ->selectRaw("administreds.*")
            ->first();
        if(!$query){
            return null;
        }
        return $query;
    }
}
if(!function_exists('theme')){
     function theme()
    {
      $theme = "green";
        if(auth()->user()->isSuperAdmin()){
            $query =  DB::table("theme_mairies")->where("mairie_id","=",0)->first();
            if($query){
                $theme = $query->theme;
            }
        }else{
            $query =  DB::table("theme_mairies")->where("mairie_id","=",mairies()->id)->first();
            if($query){
                $theme = $query->theme;
            }
        }

        return $theme;
    }
}

if (!function_exists('d_number')) {
    function d_number($number,$decimal=",")
    {
        $number = str_replace(" ","",$number);
        if($number && is_numeric($number) && $number>0){
            return number_format($number, 2, $decimal, ' ');
        }
        else
            return 0;


    }

}
if (!function_exists('replace')) {
    function replace($number)
    {
        if ($number) {
            $number = str_replace(" ", "", $number);
            $number = str_replace("-", "", $number);
            return $number;
        }
        return "";
    }

}
if (!function_exists('img_agent')) {
    function img_agent($filename)
    {

        if($filename){
//            return 'https://s3.eu-west-2.amazonaws.com/fasi.ci/'.$filename;
            return  asset('storage/'.$filename);
        }else{
            return "";
        }



    }
}
if (!function_exists('d_format')) {
    function d_format($date)
    {
        if ($date && $date != "1970-01-01" && $date != null && $date != "") {
            return date("d/m/Y", strtotime($date));
        } else {
            return "";
        }

    }
}
if (!function_exists('chech_field')) {
    function chech_field($table_name,$field,$val)
    {
        $query = DB::table($table_name)->where($field,"=",$val)->whereNull("deleted_at")->first();
        return $query;

    }

}
if (!function_exists('d_format_rw')) {
    function d_format_rw($date)
    {

        if ($date && $date != "1970-01-01" && $date != "__/__/___" && $date != "____-__-__"
            && $date != "____-__-__") {
            $array = explode("/", $date);

            if (count($array) == 3 ) {

                $full = $array[2] . "-" . $array[1] . "-" . $array[0];
                if(is_numeric($array[2])){
//                    return;
                    return $full;
                }
//                dd($full);

            }
//            else
//            $array = explode("-", $date);
//            if (count($array) == 3 && array_filter($array,       'is_int')) {
//                $full = $array[2] . "-" . $array[1] . "-" . $array[0];
//                return $full;
//            }
            return "";
        } else {
            return "";
        }


    }

}
if (!function_exists('senderMySmsTech')) {

     function senderMySmsTech($number, $msg)
    {
        $url = "https://mysmstech.com/sms/api";
        $client = new \GuzzleHttp\Client();
        $request =  [
            'action'=>"send-sms",
            'api_key' => env("MY_SMSTECH_KEY"),
            'sms' => trim($msg),
            'from' => "MYEMAIRIE",
            'to' => "225".$number,
//            'unicode' => 1
        ];
        $response = $client->request('POST', $url, ['query' =>$request]);
        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody());
//
//        https://www.mysmstech.com/sms/api?action=send-sms&api_key=VXNlckVtYWlyaWU6QGR2YW50ZWNoMjEyMQ==&to=PhoneNumber&from=SenderID&sms=YourMessage


        return $content;
    }

}
if (!function_exists('getMonthBetween')) {

     function getMonthBetween($lastYear)
    {

        $date2  = $lastYear.'12-31';
        $date1  = (intval($lastYear)-1).'-01-01';
        $output = [];
        $time   = strtotime($date1);
        $last   = date('m-Y', strtotime($date2));
        $monthArray = [];

        do {
            $month = date('m-Y', $time);
            $total = date('t', $time);

            $monthArray[]=$month;
            $output[] = [
                'month' => $month,
                'total' => $total,
            ];

            $time = strtotime('+1 month', $time);
        } while ($month != $last);

        return $monthArray;
    }

}

if (!function_exists('truncate')) {
    function truncate($string, $length, $ellipsis = true)
    {
        $string = strip_tags($string);
        // Count all the uppercase and other wider-than-normal characters
        $wide = strlen(preg_replace('/[^A-Z0-9_@#%$&]/', '', $string));

        // Reduce the length accordingly
        $length = round($length - $wide * 0.2);

        // Condense all entities to one character
        $clean_string = preg_replace('/&[^;]+;/', '-', $string);
        if (strlen($clean_string) <= $length) return $string;

        // Use the difference to determine where to clip the string
        $difference = $length - strlen($clean_string);
        $result = substr($string, 0, $difference);

        if ($result != $string and $ellipsis) {
            $result = add_ellipsis($result);
        }

        return $result;
    }
}
if (!function_exists('add_ellipsis')) {
    function add_ellipsis($string)
    {
        $string = strip_tags($string);
        $string = substr($string, 0, strlen($string) - 3);
        return trim(preg_replace('/ .{1,3}$/', '', $string)) . '...';
    }
}
if (!function_exists('demande_etat')) {
    function demande_etat($status)
    {
        $btn = "btn-default";
        if($status){

            if($status=="ATTENTE"){
                $btn = "btn-warning";
            }
            if($status=="EN TRAITEMENT"){
                $btn = "btn-info";
            }
            if($status=="TRAITEE"){
                $btn = "btn-success";
            }

            $label = "<button type='button' class=\"btn btn-sm $btn \" style='font-size: 12px'> $status </button> ";
            return $label;
        }
       return "";
    }
}
if (!function_exists('dowloand_file')) {
    function dowloand_file($status,$administred_id,$id)
    {
        if($status){

            if( $status =="TRAITEE" ) {
                $link = route('profile.extrait',["q"=>$administred_id,"target"=>$id]);
                $label = "<a href=\"$link\"> <i class=\"fa fa-download\" style=\"color: deepskyblue\"></i>
                                        <i class=\"fa fa-file\"  style=\"color: orange\"></i> Télécharger </a>";
                return $label;
            }
        }
       return "";
    }
}

if(!function_exists('getAllService')){
    function getAllService($type=null,$diff=null)
    {
        $query = DB::table("demande_mairie_services")
            ->leftJoin("services","demande_mairie_services.service_id","=","services.id")
            ->selectRaw("demande_mairie_services.*,services.name as service")
           ;

        if(!auth()->user()->isSuperAdmin()){

            $query->where("demande_mairie_services.mairie_id","=",mairies()->id);
        }
        if($type){
            $query->where("demande_mairie_services.status","=",$type);
        }
        if($diff){
            $query->where("demande_mairie_services.status","!=",$diff);
        }
    /*    $query->dd();*/

      $data = $query->get();
        return $data;
    }
}


if(!function_exists('storeDemande')){
    function storeDemande($administred,$mairie,$service,$qte,$mode,$user)
    {

        $checkDemandeService = \App\Http\Controllers\Mobile\MobileApiController::checkDemandeService($service,$mairie,$administred);
        if($checkDemandeService){
            return response()->json(['success' => false, 'message' => "Vous avez déjà une demande en attente ou en traitement"], 200);
        }

        $demandeurObjet = Administred::findOrFail($administred);
        $serviceObjet  = Service::findOrFail($service);

        $coutTotal = intval($serviceObjet->price)*intval($qte);


        if($mode=="account"){
            $getVirtualAccount = \App\Http\Controllers\Mobile\MobileApiController::getBalanceByAdministred($administred);
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
                "quantite"=>$qte,
                "mairie_id"=>$mairie,
                "service_id"=>$service,
                "administred_id"=>$demandeurObjet->id,
                "register_user_id"=>$user,
                "total_price"=>$coutTotal,
                "status"=>"ATTENTE",
            ]);



            if (!$save) {
                return response()->json(['success' => false, 'message' => Lang::get('message.save_error')], 200);
            } else {
                $newsBalance = intval($amout_account)-intval($coutTotal);
                \App\Http\Controllers\Mobile\MobileApiController::updateBalance($getVirtualAccount->id,$coutTotal);
                /*
                                    $checkTaxe = self::getPaidedTaxeById($taxe_id);*/

                $name = $demandeurObjet->lastname." ".$demandeurObjet->firstanme;
                $phone = $demandeurObjet->phone;
                $service = $serviceObjet->name;
                $coutUnitaire = $serviceObjet->prix_unitaire;
                $code = time();

                $device =montant_simbole();

                $msg =   "Mr/Mme ".$name.", votre demande de  ".$service." (nombre de copie:".$qte.", coût unitaire: $coutUnitaire $device),
          montant: ".$coutTotal." $device est en attente de traitement. Code paiement:".$code;

                $rep = senderMySmsTech($phone,$msg);

                return response()->json(['success' => true, 'data' => $save, 'message' => Lang::get('message.operation_success')], 200);
            }


        }

    }
}
if(!function_exists('montant_simbole')){
    function montant_simbole()
    {
return "$";
    }
}
