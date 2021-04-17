<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Mobile\MobileApiController;
use App\Models\TaxeCommercePaided;
use App\Models\TaxeMonth;
use App\Models\Typecommerce;
use App\Models\TypeTaxe;
use App\Models\Zone;
use App\Models\ZoneCommerce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class TaxeMonthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function lists()
    {
        $this->authorize("Listing Taxe  Mois");
        $years = UtilsController::getMyYears();

        return view('month.index', compact('years'));
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize("Listing Taxe  Mois");

        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $year = ($request->get('year')) ? $request->get('year') : '';
        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';

        $result = self::queryFor($from,$order,$limit,$search,$mairie,$year);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }


    public function queryFor($from,$order,$limit,$search,$mairie=null,$year=null){


        $query = DB::table("taxe_months")

            ->leftJoin(DB::raw("(SELECT month,
            COUNT(taxe_commerce_paideds.id)  as alls,
            SUM(CASE WHEN taxe_commerce_paideds.amount_prev IS NOT NULL THEN 1 ELSE 0 END)  as total_prev,
            SUM(CASE WHEN taxe_commerce_paideds.amount_prev IS NOT NULL THEN taxe_commerce_paideds.amount_prev ELSE 0 END)  as total_amount_prev,
            SUM(CASE WHEN taxe_commerce_paideds.amount_paided IS NOT NULL THEN 1 ELSE 0 END)  as total_paided,
            SUM(CASE WHEN taxe_commerce_paideds.amount_paided IS NOT NULL THEN taxe_commerce_paideds.amount_paided ELSE 0 END)  as total_amount_paided


            FROM taxe_commerce_paideds
             LEFT JOIN taxeforfait_commerce_selecteds ON taxeforfait_commerce_selecteds.id = taxe_commerce_paideds.taxecommerce_id
             LEFT JOIN commerces ON taxeforfait_commerce_selecteds.commerce_id = commerces.id

              WHERE taxe_commerce_paideds.deleted_at IS NULL
              AND taxeforfait_commerce_selecteds.deleted_at IS NULL
              AND commerces.deleted_at IS NULL


             GROUP BY month)
               tblMonths"),
                function($join)
                {
                    $join->on('taxe_months.month', '=', 'tblMonths.month');
                })->select('taxe_months.month', 'tblMonths.*')


            ->whereNull("taxe_months.deleted_at")

            ->orderBy("taxe_months.id",$order);


        if($search && !empty($search)){
            $query->where('taxe_months.month', 'LIKE', "%{$search}%");
            $query->orWhere('taxe_months.year', 'LIKE', "%{$search}%");
        }
        if($mairie && !empty($mairie)){
            $query->where('taxe_months.id', '=', $mairie);
        }
        if($year && !empty($year)){
            $query->where('taxe_months.year', '=', $year);
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
   $mairie =mairies();
   if(!$mairie){
       return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);
   }
        $check = self::checkIfExisteTaxeMonth($request->mois,mairies()->id);

   if($check){
       return response()->json(['success' => false, 'message' => Lang::get('message.taxe_month_exist')]);
   }
        $year = explode("-",$request->mois)[1];

       $save =  TaxeMonth::create(
           [
               'month' => $request->mois,
               'year' => $year,
               'mairie_id' => mairies()?mairies()->id:null,
               'register_user_id' => auth()->user()->id,
               ]);


       if($save){
           $allSelecteds = UtilsController::getAllSelectedTaxes();

           $nb = 0;
           foreach ($allSelecteds as $allSelected){

               if(!self::checkIfExisteTaxeMonthInTaxeCommercePaided($request->mois,$allSelected->id)){
                   $saveTaxe =  TaxeCommercePaided::create(
                       [
                           'month' => $request->mois,
                           'amount_prev' => $allSelected->amount,
                           'taxecommerce_id' => $allSelected->id,
                       ]);
                   if($saveTaxe)
                       $nb++;
               }
           }
       }


       if(!$save){
           return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);
       }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')."(".$nb.")"]);

    }

    /**
     *  VERIFIER SI LE MOIS A ETE DEJA GENERE
     *
     * @paramint  $id
     * @return\Illuminate\Http\Response
     */


    public static function checkIfExisteTaxeMonth($month, $mairie){
        $query = DB::table("taxe_months");
        if($month){
            $query->where("month","=",$month);
        }
        if($mairie){
            $query->where("mairie_id","=",$mairie);
        }
       $result = $query->whereNull("deleted_at")->first();
        return $result;
    }

    /** VERIFIER SI LA LIGNE DU MOIS A ETE CREE POUR LE COMMERCE
     * @param $month
     * @param $taxecommerce_id
     * @return \Illuminate\Database\Query\Builder
     */
    public static function checkIfExisteTaxeMonthInTaxeCommercePaided($month, $taxecommerce_id){
        $query = DB::table("taxe_commerce_paideds");
        if($month){
            $query->where("month","=",$month);
        }
        if($taxecommerce_id){
            $query->where("taxecommerce_id","=",$taxecommerce_id);
        }
       $result = $query->whereNull("deleted_at")->first();
        return $result;
    }
}
