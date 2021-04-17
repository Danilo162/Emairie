<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Backend\MairieController;
use App\Http\Controllers\Controller;


use App\Models\ThemeMairie;
use App\Models\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class HomeController extends Controller
{

    public function index(){

        $barners = ActualiteController::getNews(2);
        $news = ActualiteController::getNews(4);
        $one = ActualiteController::getNews(1);
        $two = ActualiteController::getNews(2,null,2);
        $commerces = EntrepriseController::getCommerce(4);

        $mairies = MairieController::getMairie(4,1);
        $ministeres = MairieController::getMairie(4,2);

        /*self::updateService();*/
        return view("frontend.home.index",compact('barners','news','one','two','commerces','mairies','ministeres'));

    }

    
    
    public function updateService(){
        $alls = DB::table("services")->get();

        $j=0;
        foreach ($alls as $all){

          /*  $check = DB::table("services")->where("name","=",$all->name)->first();
            if(!$check){*/
            $gene = $all->periode_paiement;
            if($gene){
                $ge = "";
                if($gene=="annuelle"){
                    $ge = "ANNUELLE";
                } if($gene=="non renouvelable"){
                    $ge = "NON RENOUVELABLE";
                }if($gene=="mensuelle"){
                    $ge = "MENSUELLE";
                }if($gene=="ponctuelle"){
                    $ge = "PONCTUELLE";
                }
                $insert = DB::table("services")->where("id","=",$all->id)->update([
                    /*     "name"=>$all->name,
                         "fait_generateur"=>$all->generateur,
                         "taux"=>$all->taux,*/
                    "type"=>"MINISTERE",
                    "periode_paiement"=>$ge,
                ]);
                if ($insert)
                    $j++;
            }

           /* }*/


        }
        dd($j);
    }

}
