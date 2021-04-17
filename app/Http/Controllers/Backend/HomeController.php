<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;


use App\Models\ThemeMairie;
use App\Models\Themes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return\Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->isSuperAdmin()){
            return view('dashbord.systeme');
        }elseif (auth()->user()->isAdmin()){
            return view('dashbord.fonctionel');
        }else{
            return view('dashbord.agent');
        }
    }

    /**
     * @return mixed recuperer administrés par mairie
     */
    public static function queryCountAdministryMairie(){
        $query = DB::table("mairies")
            ->whereNull("mairies.deleted_at")
            ->orderBy("mairies.nom")

            ->leftJoin(DB::raw("(SELECT
      count(administreds.id) as total,mairie_id
      FROM administreds
      GROUP BY administreds.mairie_id
      ) as administred"),function($join){
                $join->on("administred.mairie_id","=","mairies.id");
            })

            ->selectRaw("mairies.nom, administred.total")
        ;

        $rows = $query->get();

        $jsonData["rows"] =$rows;
        return $jsonData;
    }

    /**
     * @param $mairie
     * @return mixed recuperer administrés  par sexe
     */
    public static function queryCountAdministrySexe($mairie){
        $query = DB::table("administreds")
            ->whereNull("administreds.deleted_at")
//            ->orderBy("administreds.lastname")
//            ->select(DB::raw("SELECT
//      count(administreds.id) as total,administreds.gender"));
        ->select('administreds.gender', DB::raw('count(*) as total'));

        if($mairie){
            $query->where("administred.mairie_id","=",$mairie);
        }
        $query->groupBy("administreds.gender");

        $rows = $query->get();

        $jsonData["rows"] =$rows;
        return $jsonData;
    }

    /**
     * @param null $mairie
     * @return mixed recuperer commerce par type
     */
    public static function queryCountCommerceByType($mairie=null){
        $query = DB::table("typecommerces")
              ->leftJoin('commerces','typecommerces.id',"=","commerces.type_commerce_id")
            ->whereNull("commerces.deleted_at")
            ->whereNull("typecommerces.deleted_at")
            ->orderBy("typecommerces.name")
            ->selectRaw("typecommerces.name,
            count(commerces.id) as total");

        if($mairie){
            $query->where("commerces.mairie_id","=",$mairie);
        }
        $query->groupBy("typecommerces.name");


        $rows = $query->get();

        $jsonData["rows"] =$rows;
        return $jsonData;
    }

    /**
     * @return mixed recuperer commerce par mairie
     */
    public static function queryCountCommerceMairie(){
        $query = DB::table("mairies")
            ->whereNull("mairies.deleted_at")
            ->orderBy("mairies.nom")

            ->leftJoin(DB::raw("(SELECT
      count(commerces.id) as total,mairie_id
      FROM commerces
      GROUP BY commerces.mairie_id
      ) as commerce"),function($join){
                $join->on("commerce.mairie_id","=","mairies.id");
            })

            ->selectRaw("mairies.nom, commerce.total")
        ;

        $rows = $query->get();

        $jsonData["rows"] =$rows;
        return $jsonData;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Données tableau de bord de l'administrateur système
     */
    public function dashbord(Request $request){
        $mairie = ($request->get('mairie'))?$request->get('mairie'):"";

        $mairies = MairieController::queryFor("","desc","","")["total"];
        $administred = AdministredController::queryFor("","desc","","",$mairie,"","")["total"];
        $commerces = CommerceController::queryFor("","desc","","",$mairie,"","","")["total"];
        $pie_administred = self::queryCountAdministryMairie()["rows"];
        $pie_commerce = self::queryCountCommerceMairie()["rows"];
        $theme = theme();

      return response()->json(
          [
              "mairie"=>$mairies,
              "administred"=>$administred,
              "commerce"=>$commerces,
              "pie_administred"=>$pie_administred,
              "pie_commerce"=>$pie_commerce,
              "theme"=>$theme,

          ]
      );

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Données tableau de bord de l'administrateur fonctionnel
     */
    public function dashbord_fonctionnel(Request $request){
        $mairie = ($request->get('mairie'))?$request->get('mairie'):"";

        $administred = AdministredController::queryFor("","desc","","",$mairie,"","")["total"];
        $commerces = CommerceController::queryFor("","desc","","",$mairie,"","","")["total"];
       $agents = AgentController::queryFor("","desc","","",$mairie)["total"];
        $pie_administred = self::queryCountAdministrySexe($mairie)["rows"];
        $pie_commerce = self::queryCountCommerceByType($mairie)["rows"];
        $theme = theme();

      return response()->json(
          [

              "administred"=>$administred,
              "commerce"=>$commerces,
              "agent"=>$agents,
              "pie_administred"=>$pie_administred,
              "pie_commerce"=>$pie_commerce,
              "theme"=>$theme,

          ]
      );

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Afficher tous les thèmes
     */
    public function theme(){
        $themes = Themes::all();
        return view('tools.theme',compact('themes'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * Enregistrer un thème choisi
     */
    public function theme_store(Request $request)
    {
       $mairie =  ($request->get('mairie'))?$request->get('mairie'):0;
            $request->validate(['theme' => 'required|exists:themes,name']);

            if(!auth()->user()->isSuperAdmin()){
                if($mairie != mairies()->id){
                    return back();
                }
            }

        $destroy = DB::table("theme_mairies")->where("mairie_id","=",$mairie)->delete();

        $create = ThemeMairie::create([
            "theme" => $request->get('theme'),
            "mairie_id" => $mairie,
        ]);

        if (!$create) {
            return response()->json(['success' => false, 'message' => Lang::get('message.save_error')], 200);
        }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')], 200);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * Verifie si une personne est toujours connectée
     */
    public function check_session(){

        if (!auth()->check()) {
            return response()->json(['success' => true], 200);
        }
        return response()->json(['success' => false,], 200);
    }
}
