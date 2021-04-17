<?php

// GENERER DANS LE REPERTOIRE "Backend" VIA: "php artisan make:controller \\Backend\AgentController -r"
// Ce Controller combine avec "public/js/console/agent.js" qui gère le CRUD de façon asynchrone (AJAX) via VueJS:

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Mairies;
use App\Models\Agents;
use App\Models\User\User;
use App\Rules\ChangePassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class AgentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return\Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->authorize('Listing Agents');
        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';
        $mairie = ($request->get('mairie')) ? $request->get('mairie') : '';



        $result = self::queryFor($from,$order,$limit,$search,$mairie);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }

    /**
     * @param $from
     * @param $order
     * @param $limit
     * @param $search
     * @return mixed
     */
    public static function queryFor($from, $order, $limit, $search,$mairie =null){

        $query = DB::table("agents")
                    // ON LIE la Table "mairies" à la Table "agents" sélectionné ci-dessus avec "leftJoin()":
                    ->leftJoin("mairies","agents.mairie_id","=","mairies.id")
                   ->leftJoin("users","users.agent_id","=","agents.id")
                   ->leftJoin("roles","users.role_id","=","roles.id")
					->whereNull("agents.deleted_at")
                    ->orderBy("agents.id",$order)
                    /* RECUPERATION CI-DESSOUS DE CHAQUE COLONNES DE LA TABLE "agents" et CELLE DE "name"
                        DE LA COLONNE "mairies": */
                    ->selectRaw("agents.id, agents.firstname, agents.lastname, agents.picture,
                                agents.job, mairies.nom as mairie, agents.email, agents.phone,roles.name as role");

            if($search && !empty($search)){
                $query->where('name', 'LIKE', "%{$search}%");
            }
            if($mairie && !empty($mairie)){
                $query->where('agents.mairie_id', '=', $mairie);
            }

//            ADMINISTRATEUR SYSTEME ET FONCTIONNEL
            if(auth()->user()->isSuperAdmin()){
                $query->whereIn("roles.id",RoleController::getMyRoleListId());
            }else{
                //            ADMINISTRATEUR FONCTIONNEL  , AGENT PERCEPTEUR ET AGENT
                if(auth()->user()->isAdmin()){
                    if(mairies()){
                        // LISTE DES COMPTES DES DE LA MAIRIES
                        $query->where("mairies.id","=",mairies()->id);
                        $query->whereIn("roles.id",RoleController::getMyRoleListId());
                    }

                }
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

    public function lists()
    {
        $mairies = Mairies::all();
       $roles = RoleController::getMyRole();
        return view('agent.index', compact('mairies','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param\Illuminate\Http\Request  $request
     * @return\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = null;
        $action = "create";
        /* EFFECTUER DES VERIFICATIONS SUR LES CHAMPS SEULEMENT SI L'ID DES CHAMPS DE REQUEST DU FORMULAIRE "HTML"
            EST NULL. TRES IMPORTANT POUR EFFECTER LES VALIDATIONS A CHAQUE CHAMPS DU FORMULAIRE LORS DES
            MODIFICATIONS VU QU'ON UTILISE LA METHODE "updateOrCreate()" ET PLUSIEURS CHAMPS A CREER ET METTRE
            A JOUR A LA FOIS LES DONNEES: */




//        try {
            if ($request->get('id') == "") {
                $request->validate([
                    'firstname' => 'required|min:1',
                    'lastname' => 'required|min:1',
                    'phone' => 'required|min:8|unique:agents,phone,NULL,id,deleted_at,NULL',
                    'email' => 'required|min:1,email:filter|unique:agents,email',
//                    'picture' => 'required|max:2048',
                    'mairie' => 'required|exists:mairies,id',
                    'job' => 'required',
                    'role' => 'required|exists:roles,id',
                ]);
            }
            else {
                $request->validate([
                    'id' => 'required|exists:agents,id',
                ]);
                $agentImage = Agents::findOrFail($request->get('id'));
                $image = $agentImage->picture;
                $action = "update";

            }

            if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
                // $image = $request->get('picture')->store('/agent');
                $image = $request->picture->store('/agents');


            }

            // Agents::updateOrCreate(['id' => $request->get('id')], ['name' => $request->agent]);
            $save_agent =  Agents::updateOrCreate(['id' => $request->get('id')], [
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => replace($request->phone),
                'email' => $request->email,
                'picture' => $image,
                'mairie_id' => $request->mairie,
                'job' => $request->job
            ]);

            $pwd = Str::random(6);
            $data = [];
            $data["name"]=$request->lastname." ".$request->lastname;
            $data["phone"]=replace($request->phone);
            $data["email"]=$request->email;
            $data["role"]=$request->role;
            $data["agent_id"]=$save_agent->id;
            $data["password"]=$pwd;

            if($request->id ==""){
                $msg = "Bonjour Mr/Mme ".$request->lastname." ".$request->lastname." Vottre compte à été crée,
                 Connectez vous avec vos identifiants. login :".$request->email."
                  Mot de passe ".$pwd." sur ".route('login');
             $send =   senderMySmsTech(replace($request->phone),$msg);

                $dataLog=[$msg,$send];
                Log::channel('agents')->info("data:",$dataLog);
            }

            $save =   auth()->user()->register($data,$request->get('id')?"update":"");

            self::logAgent($action,$save_agent->id);


            if(!$save){
                return response()->json(['success' => false, 'message' => Lang::get('message.save_error')]);

            }
            return response()->json(['success' => true, 'message' => Lang::get('message.save_success')]);




    }

    /**
     * Display the specified resource.
     *
     * @param int  $id
     * @return\Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @paramint  $id
     * @return\Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $id = $request->get('id');

        $agent = DB::table("agents")
            ->leftJoin("users","users.agent_id","=","agents.id")
            ->whereNull("agents.deleted_at")
            ->where("agents.id","=",$id)
            ->selectRaw("agents.id, agents.firstname, agents.lastname, agents.picture,
                                agents.job, users.role_id, agents.email, agents.phone,agents.mairie_id")
        ->first();
//        Agents::findOrFail($id);

        if(!$agent) {

             return response()->json(['success' => false, 'message' => "Erreur survenue !"]);
        }

        return response()->json(['success' => true, 'data' => $agent]);
    }

    public static function queryByOnAgent($id){
        $data = DB::table("agents")
            ->leftJoin("mairies","agents.mairie_id","mairies.id")
            ->leftJoin("users","users.agent_id","agents.id")
            ->leftJoin("roles","roles.id","users.role_id")
            ->where("agents.id","=",$id)
            ->selectRaw("agents.*,mairies.nom as mairie,roles.name as role,users.role_id")->first();
        if(!$data){
            return null;
        }
        return $data;
    }

    public function profil(){
        $data = self::queryByOnAgent(auth()->user()->agent_id);
        if(!$data){
            return back();
        }
        return view("agent.detail",compact('data'));
    }
    public function detail($id){
        $data = self::queryByOnAgent($id);
        if(!$data){
            return back();
        }
        return view("agent.detail",compact('data'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @paramint  $id
     * @return\Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $agent = Agents::findOrFail($request->get('id'));
        $destroy = $agent->delete();


		if (!$destroy) {
            return response()->json(array('success' => false, 'message' => Lang::get("message.delete_error")), 400);
        }
		$destroyUser = DB::table("users")
            ->where("agent_id","=",$request->get('id'))
            ->delete();

        if (!$destroyUser) {
            return response()->json(array('success' => false, 'message' => Lang::get("message.delete_error")), 400);
        }

        return response()->json(['success'=>true,'message'=> Lang::get("message.delete_success")]);
    }


    public static function logAgent($action,$id){
        $ua = Request()->server('HTTP_USER_AGENT');
        $data = [
            "a_id"=>$id,
            "action"=>$action,
            "by"=>auth()->user()->id,
            "date"=>date("Y-m-d H:i:s"),
            "ip"=>Request()->ip(),
            "ua"=>$ua,
        ];
        Log::channel('agents')->info("data:",$data);

    }
    public static function getAgentById(Request $request){
          $id = $request->ag_t;

          $data = self::queryByOnAgent($id);
          $html = "";
          if($data){
              $html = "
<table class=\"table table-hover table-bordered\">
                          <tr>
                              <td colspan=\"2\"><img style=\"width: 150px;border-radius: 5px\"
                                                   src=\"".img_agent($data->picture)."\"
                                                   alt=\"".$data->lastname."\"></td>
                          </tr>
                          <tr>
                              <td style=\"width: 150px\">Nom</td>
                              <td><b>$data->lastname</b></td>
                          </tr>
                          <tr>
                              <td>Prénom(s)</td>
                              <td><b>$data->firstname</b></td>
                          </tr>
                          <tr>
                              <td>Contact(s)</td>
                              <td><b>$data->phone</b></td>
                          </tr>
                          <tr>
                              <td>E-mail</td>
                              <td><b>$data->email</b></td>
                          </tr>
                          <tr>
                              <td>Fonction</td>
                              <td><b>$data->job</b></td>
                          </tr>
                          <tr>
                              <td>Rôle</td>
                              <td><b>$data->role</b></td>
                          </tr>
                          <tr>
                              <td>Mairie</td>
                              <td><b>$data->mairie</b></td>
                          </tr>
                          <tr>
                              <td>Crée le</td>
                              <td>".d_format($data->created_at)."</td>
                          </tr>
                          <tr>
                              <td>Modifié le</td>
                              <td>".d_format($data->updated_at)."</td>
                          </tr>
                      </table>";
        }
        return response()->json($html) ;

    }
    public function changePassword(Request $request){

        $request->validate([
            'mot_de_passe' => ['required', new ChangePassword()],
            'nouveau_mot_de_passe' => ['required'],
            'confirmer_mot_de_passe' => ['same:nouveau_mot_de_passe'],
        ]);

       $save = User::where("id","=",auth()->user()->id)
           ->update(['password'=> Hash::make($request->nouveau_mot_de_passe)]);

        if (!$save) {
            return response()->json(array('success' => false,
                'message' => Lang::get("message.update_error")), 400);
        }
        return response()->json(['success'=>true,'message'=> Lang::get("message.update_success")]);

    }

}
