<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;


use App\Models\Actualite;
use App\Models\ThemeMairie;
use App\Models\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class ActualiteController extends Controller
{

public function detail(Request $request){
$id = ($request->q)?$request->q:"";
    $data = self::getActualitById($id);


    if(!$data){
        return back();
    }
$others = self::getNews(6,null,null,$id);

    return view("frontend.actualite.detail",compact('data','others'));
}

public static function getNews($limit=null,$type=null,$offset=null,$id_no_in=null){
    $query =  DB::table("actualites")
        ->leftJoin("mairies","mairies.id","=","actualites.mairie_id")
        ->leftJoin("type_actualites","type_actualites.id","=","actualites.type_actualite_id")
        ->orderBy("actualites.id","desc")
        ->whereNull("actualites.deleted_at")
        ->selectRaw("actualites.*,DATE_FORMAT(actualites.created_at,'%d/%m/%Y') as created_at,mairies.nom as mairie,type_actualites.name as type");
    if($limit){
        $query->limit($limit);
    } if($limit){
        $query->offset($offset);
    }
    if($type){
        $query->where("type_actualites.id","=",$type);
    }
    if($id_no_in){
        $query->where("actualites.id","!=",$id_no_in);
    }
        $datas = $query->get();

    return $datas;

}

public static function getActualitById($id){
    $query = DB::table("actualites")
        ->leftJoin("mairies","mairies.id","=","actualites.mairie_id")
        ->leftJoin("type_actualites","type_actualites.id","=","actualites.type_actualite_id")
        ->orderBy("actualites.id","desc")
        ->whereNull("actualites.deleted_at")
        ->selectRaw("actualites.*,DATE_FORMAT(actualites.created_at,'%d/%m/%Y')
        as created_at,mairies.nom as mairie,type_actualites.name as type");
    if($id){
        $query->where("actualites.id","=",$id);
    }
    $data = $query->first();
    return $data;
}
}
