<?php


namespace App\Http\Controllers\Backend;


use App\Http\Controllers\Controller;
use App\Models\TaxeCommercePaided;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;;

class UtilsController extends Controller
{

    public static function getMyMairie(){
        $query = DB::table("mairies")->whereNull("deleted_at");

        if(auth()->check()){

            if(!auth()->user()->isSuperAdmin()){
                $query->where("mairies.id","=",mairies()->id);
            }
        }
        $query->distinct("mairies.id");
        return $query->get();
    }
    public static function getMyYears(){
        $query = DB::table("taxe_months")->distinct("taxe_months.year")->whereNull("deleted_at");

        if(auth()->check()){
            if(!auth()->user()->isSuperAdmin()){
                $query->where("mairie_id","=",mairies()->id);
            }
        }

        $query->selectRaw("year,month,mairie_id");
        $datas = $query->get();

        return $datas;
    }
    public static function getMyMonths(){
        $query = DB::table("taxe_months")->whereNull("deleted_at");

        if(auth()->check()){
            if(!auth()->user()->isSuperAdmin()){
                $query->where("mairie_id","=",mairies()->id);
            }
        }
        $query->distinct("taxe_months.month");

        return $query->get();
    }
    public static function getMyCommune(){
        $query = DB::table("communes")
            ->leftJoin("mairies","communes.id","=","mairies.commune_id")
            ->whereNull("communes.deleted_at")
            ->whereNull("mairies.deleted_at")
            ;
        if(auth()->check()){
            if(!auth()->user()->isSuperAdmin()){
                $query->where("mairies.id","=",mairies()->id);
            }
        }

        $query->selectRaw("communes.*");
        $query->distinct("communes.id");
       $result= $query->get();

        return $result;
    }
    public static function getMyZone(){
        $query = DB::table("zones")
            ->whereNull("zones.deleted_at")
            ;
        if(auth()->check()){
            if(auth()->user()->isAdmin()){
                $query->where("mairie_id","=",mairies()->id);
            }

            if(auth()->user()->isAgent()){
                $query->leftJoin("zone_commerces","zone_commerces.zone_id","=","zones.id")
                    ->whereNull("zone_commerces.deleted_at");
                $query->where("zone_commerces.agent_id","=",auth()->user()->agent_id);
            }
        }

        $query->selectRaw("zones.*");
         $query->distinct("zones.id");
      $result =   $query->get();

        return $result;
    }
    public static function getMyAdministreds(){
        $query = DB::table("administreds")
            ->whereNull("administreds.deleted_at")
            ;
        if(auth()->check()){
            if(!auth()->user()->isAdmin()){
                $query->where("mairie_id","=",mairies()->id);
            }


        }

        $query->selectRaw("administreds.*");
         $query->distinct("administreds.id");
      $result =   $query->get();

        return $result;
    }


    /** RECUPERER LES INFORMATIONS DE LA TAXE D'UN UTILISATEUR
     * @param $commerce_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getCommerceTaxeInfors($commerce_id){
        $query = DB::table("type_taxe_forfaits")
            ->leftJoin("taxeforfait_commerce_selecteds","type_taxe_forfaits.id","=","taxeforfait_commerce_selecteds.typetaxeforfait_id")
            ->leftJoin("type_taxes","type_taxes.id","=","type_taxe_forfaits.type_taxe_id")
            ->selectRaw("type_taxe_forfaits.amount,type_taxes.name as taxe,type_taxe_forfaits.id")
            ->where("taxeforfait_commerce_selecteds.commerce_id","=",$commerce_id)->first();
        return $query;
    }

    /** RECUPEREs TOUS LES FORFAITS DE TAXES DISPONIBLES
     * @return \Illuminate\Support\Collection
     */
    public static function getAllTaxes(){
        $query = DB::table("type_taxe_forfaits")
            ->leftJoin("type_taxes","type_taxes.id","=","type_taxe_forfaits.type_taxe_id")
            ->selectRaw("type_taxe_forfaits.amount,type_taxe_forfaits.id,type_taxes.name as taxe")
            ->whereNull("type_taxe_forfaits.deleted_at")->get();
        return $query;
    }

    /** GENRER  LES LIGNES DE TAXES A PAYEES
     * @param $month
     */
    public static function createCurrentTaxeColunm($month){
        $getAllRelations = self::getAllSelectedTaxes();

        foreach ($getAllRelations as $allRelation){
            if(!self::checkIfTaxeAreNoGenerateInTaxeCommercePaideds($month,$allRelation->id)){
                $save =  TaxeCommercePaided::create([
                    "taxecommerce_id"=>$allRelation->id,
                    "month"=>$month,
                    "amount_prev"=>$allRelation->month,
                ]);

            }


        }

    }

    /** RECUPERER TOUTES LES RELATIONS DE TAXE COMMERCES
     * @return \Illuminate\Support\Collection
     */
    public static function getAllSelectedTaxes(){
        $query = DB::table("taxeforfait_commerce_selecteds")
            ->leftJoin("type_taxe_forfaits","type_taxe_forfaits.id","=","taxeforfait_commerce_selecteds.typetaxeforfait_id")
            ->selectRaw("type_taxe_forfaits.amount,taxeforfait_commerce_selecteds.id")->get();
        return $query;
    }

    /** VERIFIER SI LA LIGNE NA PAS ETE AFFECTEE DANS LA TAXE COMMERCE PAIDEDES
     * @param $month
     * @param $taxecommerce_id identifiant de taxeforfait_commerce_selecteds
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function checkIfTaxeAreNoGenerateInTaxeCommercePaideds($month, $taxecommerce_id){
        $query = DB::table("taxe_commerce_paideds")
            ->where("month","=",$month)
            ->where("taxe_commerce_paideds.taxecommerce_id","=",$taxecommerce_id)
            ->first();
        return $query;
    }
    public static function checkIfExisteInZoneInMairie($name=null, $mairie=null){
        $query = DB::table("zones");
        if($name){
            $query->where("zones.name","=",$name);
        }
        if($mairie){
            $query->where("zones.mairie_id","=",$mairie);
        }

        $result =   $query->whereNull("deleted_at")->first();
        return $result;
    }

}
