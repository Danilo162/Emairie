<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TaxeMonth;
use App\Models\Typecommerce;
use App\Models\TypeTaxe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class TaxeCommercePaidedController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }


    public function lists(){
        $this->authorize("Tableau de bord des taxes");
        $communes = UtilsController::getMyCommune();
        $mairies = UtilsController::getMyMairie();
        $zones = UtilsController::getMyZone();
        $years = UtilsController::getMyYears();
        $months = UtilsController::getMyMonths();

        $typeTaxes = TypeTaxe::all();
        $typecommerces = Typecommerce::all();

        return view('dashbord.taxe', compact('communes','mairies','zones',
            'typeTaxes','typecommerces','years','months'));
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
        $commerce = ($request->get('commerce')) ? $request->get('commerce') : '';
        $commune = ($request->get('commune')) ? $request->get('commune') : '';
        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';
        $zone = ($request->get('zone')) ? $request->get('zone') : '';
        $etat_paided = ($request->get('etat_paided')) ? $request->get('etat_paided') : '';
        $type = ($request->get('type')) ? $request->get('type') : '';
        $type_taxe = ($request->get('type_taxe')) ? $request->get('type_taxe') : '';


        $result = self::queryFor($from,$order,$limit,$search,$mairie,$commune,$zone,$commerce,$etat_paided,$type,$type_taxe);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }

    public function queryFor($from,$order,$limit,$search,$mairie,$commune,$zone,$commerce,$etat_paided,$type,$type_taxe=null){

        $query = DB::table("taxe_commerce_paideds")
            ->leftJoin("taxeforfait_commerce_selecteds","taxe_commerce_paideds.taxecommerce_id","=","taxeforfait_commerce_selecteds.id")
            ->leftJoin("commerces","commerces.id","=","taxeforfait_commerce_selecteds.commerce_id")
            ->leftJoin("type_taxe_forfaits","type_taxe_forfaits.id","=","taxeforfait_commerce_selecteds.typetaxeforfait_id")
            ->leftJoin("users","users.id","=","taxe_commerce_paideds.payed_user_id")

           ->leftJoin("type_taxes","type_taxes.id","=","type_taxe_forfaits.type_taxe_id")
                ->leftJoin("zone_commerces","zone_commerces.commerce_id","=","commerces.id")
                ->leftJoin("zones","zones.id","=","zone_commerces.zone_id")


            ->leftJoin("administreds","commerces.administred_id","=","administreds.id")

					->whereNull("taxe_commerce_paideds.deleted_at")
					->orderBy("taxe_commerce_paideds.created_at",$order)
               ->selectRaw("taxe_commerce_paideds.id,
                                taxe_commerce_paideds.amount_prev,
                                 taxe_commerce_paideds.amount_paided,
                                  taxe_commerce_paideds.month,
                                  DATE_FORMAT(taxe_commerce_paideds.date_paided, '%d-%m-%Y') as date_paided,
                                  DATE_FORMAT(taxe_commerce_paideds.created_at, '%d-%m-%Y') as created_at,
                                  type_taxes.name as taxe,users.name as user_paided,commerces.raison_social,
                                  commerces.identifier,
                                  commerces.id as commerce_id,zones.name as zone,CONCAT_WS('' , lastname,firstname) as name,
             month,amount_prev,type_taxes.name as taxe
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
            } if($type_taxe && !empty($type_taxe)){
                $query->where('type_taxes.id', '=', $type_taxe);
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

        $query->distinct("taxe_commerce_paideds.id");
        $total = count($query->get());

        if($limit && !empty($limit)) {
            $query->take($limit)->skip($from);
        }
        $rows = $query->get();


        $jsonData["total"] = $total;
        $jsonData["rows"] =$rows;
        return $jsonData;
    }

    public function relanceToSms(Request $request){
     if($request->id){
         $id = $request->id;

        $query = DB::table("taxe_commerce_paideds")
            ->leftJoin("taxeforfait_commerce_selecteds","taxe_commerce_paideds.taxecommerce_id","=","taxeforfait_commerce_selecteds.id")
            ->leftJoin("commerces","commerces.id","=","taxeforfait_commerce_selecteds.commerce_id")
            ->leftJoin("type_taxe_forfaits","type_taxe_forfaits.id","=","taxeforfait_commerce_selecteds.typetaxeforfait_id")
            ->leftJoin("users","users.id","=","taxe_commerce_paideds.payed_user_id")
            ->leftJoin("type_taxes","type_taxes.id","=","type_taxe_forfaits.type_taxe_id")

            ->leftJoin("administreds","commerces.administred_id","=","administreds.id")
             ->where("taxe_commerce_paideds.id","=",$id)
             ->selectRaw("administreds.phone, CONCAT_WS('' , lastname,firstname) as name,
             month,amount_prev,type_taxes.name as taxe")
             ->first();

         if(!$query){
             return response()->json(array('success' => false, 'message' => Lang::get('message.error')),200);
         }

         $nameAdministred = $query->name;
         $phoneNumer = $query->phone;
         $month = $query->month;
         $taxe = $query->taxe;
         $amountPrev = $query->amount_prev;

      $msg =   "Mr/Mme ".$nameAdministred.", votre taxe du ".$month." (".$taxe."),
          montant: ".$amountPrev." OXF n'a pas été payé, veuillez vous mette à jour ";

         $rep = senderMySmsTech($phoneNumer,$msg);
         if ($rep->code != "ok") {
             return response()->json(array('success' => false, 'message' => "Non Envoyé"), 400);
         }
         return response()->json(array('success' => true, 'message' => " Envoyé"), 200);
     }
    }


    public function getCommerceTAxeInfoForStatistique(Request $request){

        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';
        $commune = ($request->get('commune')) ? $request->get('commune') : '';
        $commerce = ($request->get('commerce')) ? $request->get('commerce') : '';
        $type = ($request->get('type')) ? $request->get('type') : '';
        $type_taxe = ($request->get('type_taxe')) ? $request->get('type_taxe') : '';
        $month = ($request->get('month')) ? $request->get('month') : '';
        $year= ($request->get('year')) ? $request->get('year') : '';
        $zone = ($request->get('zone')) ? $request->get('zone') : '';
        $etat_paided = ($request->get('etat_paided')) ? $request->get('etat_paided') : '';

        $result = self::countTaxeCommerce($mairie,$commune,$zone,$commerce,$etat_paided,$type,$type_taxe,$month,$year);
        return response()->json($result);
    }

    public function countTaxeCommerce($mairie,$commune,$zone,$commerce,$etat_paided,$type,$type_taxe=null,$month=null,$year=null){
        $query = DB::table("taxe_commerce_paideds")
            ->leftJoin("taxeforfait_commerce_selecteds","taxe_commerce_paideds.taxecommerce_id","=","taxeforfait_commerce_selecteds.id")
            ->leftJoin("commerces","commerces.id","=","taxeforfait_commerce_selecteds.commerce_id")
            ->leftJoin("type_taxe_forfaits","type_taxe_forfaits.id","=","taxeforfait_commerce_selecteds.typetaxeforfait_id")
            ->leftJoin("users","users.id","=","taxe_commerce_paideds.payed_user_id")
            ->leftJoin("type_taxes","type_taxes.id","=","type_taxe_forfaits.type_taxe_id")
            ->leftJoin("zone_commerces","zone_commerces.commerce_id","=","commerces.id")
            ->whereNull("taxe_commerce_paideds.deleted_at")
            ->select(DB::raw(" COUNT(taxe_commerce_paideds.id)  as alls,
            SUM(CASE WHEN taxe_commerce_paideds.amount_prev IS NOT NULL THEN 1 ELSE 0 END)  as total_prev,
            SUM(CASE WHEN taxe_commerce_paideds.amount_prev IS NOT NULL THEN taxe_commerce_paideds.amount_prev ELSE 0 END)  as total_amount_prev,
            SUM(CASE WHEN taxe_commerce_paideds.amount_paided IS NOT NULL THEN 1 ELSE 0 END)  as total_paided,
            SUM(CASE WHEN taxe_commerce_paideds.amount_paided IS NOT NULL THEN taxe_commerce_paideds.amount_paided ELSE 0 END)  as total_amount_paided
         "));

        if($month && !empty($month) && $month !='--Tout--'){
            $query->where('taxe_commerce_paideds.month', '=', $month);
        }
        if($year && !empty($year) && is_numeric($year)){
            $query->where('taxe_commerce_paideds.month', 'LIKE', "%{$year}%");

        }if($type_taxe && !empty($type_taxe) && is_numeric($type_taxe)){
            $query->where('type_taxes.id', '=', $type_taxe);
        }
        if($mairie && !empty($mairie) && is_numeric($mairie)){
            $query->where('commerces.mairie_id', '=', $mairie);
        }
        if($commune && !empty($commune) && is_numeric($commune)){
            $query->where('commerces.commune_id', '=', $commune);
        }
        if($zone && !empty($zone) && is_numeric($zone)){
            $query->where('zone_commerces.zone_id', '=', $zone);
        }
        if($commerce && !empty($commerce)  && is_numeric($commerce)){
            $query->where('commerces.id', '=', $commerce);
        }
        if($type && is_numeric($type)){
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

        $result = $query->first();

        return $result;

    }
    public function detail_commerce(Request $request){
        $this->authorize("Tableau de bord des taxes");
        $month_select = ($request->month)?$request->month:"";
        $communes = UtilsController::getMyCommune();
        $mairies = UtilsController::getMyMairie();
        $zones = UtilsController::getMyZone();
        $years = UtilsController::getMyYears();
        $months = UtilsController::getMyMonths();

        $typeTaxes = TypeTaxe::all();
        $typecommerces = Typecommerce::all();

        return view('month.commerce', compact('communes','mairies','zones',
            'typeTaxes','typecommerces','years','months','month_select'));
    }

}
