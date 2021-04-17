<?php
namespace App\Http\Controllers\Backend;

use App\Http\Requests\Permission\PermissionCreateRequest;
use App\Http\Requests\Permission\PermissionDestroyRequest;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class PermissionController extends Controller
{
    public function index(Request $request)
    {

        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';

        $search = ($request->get('search')) ? $request->get('search') : '';
        $role = ($request->get('re_r')) ? $request->get('re_r') : '';

        $result = self::queryFor($from,$order,$limit,$search,$role);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }
    public function index_delegue(Request $request)
    {
        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';

        $search = ($request->get('search')) ? $request->get('search') : '';
        $role = ($request->get('ro_r')) ? $request->get('ro_r') : '';
        $agent = ($request->get('ag_ia')) ? $request->get('ag_ia') : '';
        $is_ = ($request->get('is_')) ? $request->get('is_') : '';

        $result = self::queryForDelegue($from,$order,$limit,$search,$role,$agent,$is_);
//        $jsonData["total_count"] = $result["total_count"];
//        $jsonData["items"] = $result["items"];


        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];


        return response()->json($jsonData);
    }

    public function queryFor($from,$order,$limit,$search,$role){

        $query = DB::table("permissions")
            ->whereNull("deleted_at")
            ->where("permissions.status","!=",0)
            ->orderBy("id",$order);

        if($search && !empty($search)){
            $query->where('name', 'LIKE', "%{$search}%");
        }
        if ($role && !empty($role)) {
            $query->leftJoin("role_permission","role_permission.permission_id","=","permissions.id");
            $query->where('role_permission.role_id', '=', $role);
        }
        $query->selectRaw('permissions.id,permissions.name,permissions.comment,
     ( CASE WHEN permissions.status = 0 OR permissions.status = 1  THEN 1 END ) as stricted');

       $query->distinct("permissions.id");        $total = count($query->get());

        if($limit && !empty($limit)) {
            $query->take($limit)->skip($from);
        }
        $rows = $query->get();


        $jsonData["total"] = $total;
        $jsonData["rows"] =$rows;
        return $jsonData;
    }
    public function queryForDelegue($from,$order,$limit,$search,$role,$agent,$is_){


        $user = User::where("agent_id",$agent)->first();
        if(!$user){
            return null;
        }

        $user_id = $user->id;
        $user_role_id = $user->role_id;

        $query = DB::table("permissions")
            ->whereNull("permissions.deleted_at")
            ->where("permissions.status","!=",0)


            ->orderBy("name",$order);

        // permission déjç déléguées
        if($is_){
           $query->leftJoin("user_permission","user_permission.permission_id","=","permissions.id");
           $query->where("user_permission.user_id","=",$user_id);
        }else{
            //            // liste des permissions disponible à déléguées
//                permission qui n'st pas na pas été attribué a son role'
            $query->whereNotIn('permissions.id',function ($query) use ($user_role_id){

                $query->select("role_permission.permission_id")
                    ->from("role_permission")
                    ->whereRaw("role_permission.role_id = $user_role_id");

            })
                //  permission qui n'st pas na pas été déléguée '
                ->whereNotIn('permissions.id',function ($query) use ($user_id){

                    $query->select("user_permission.permission_id")
                        ->from("user_permission")
                        ->whereRaw("user_permission.user_id= $user_id");

                });
        }

        if($search && !empty($search)){
            $query->where('name', 'LIKE', "%{$search}%");
        }
     $query->selectRaw("permissions.id,permissions.name,permissions.comment

     ");

//       $query->distinct("permissions.id");
//        $total = count($query->get());
//
//        if($limit && !empty($limit)) {
//            $query->take($limit)->skip($from);
//        }
//        $rows = $query->get();

//        $query->groupBy("permissions.id");
        $total = count($query->get());

        if($limit && !empty($limit)) {
            $query->take($limit)->skip($from);
        }
        $rows = $query->get();


        $jsonData["total"] = $total;
        $jsonData["rows"] =$rows;
        return $jsonData;;

    }


    public function store(PermissionCreateRequest $request)
    {
        if($request->get('id') == ""){

            $request->validate(['name' => 'required|min:1|unique:permissions,name,NULL,id,deleted_at,NULL']);
        }

        $create = Permission::updateOrCreate(["id"=>$request->get('id')],['name' => $request->get('name'),
            'comment' => $request->get('commentaire'),
            'status' => 1,
        ]);
        if (!$create) {
            return response()->json(['success' => false, 'message' =>Lang::get('message.save_error')], 200);
        }
        return  response()->json(['success' => true, 'message' =>Lang::get('message.save_success')], 200);


    }



    public function destroy(PermissionDestroyRequest $request)
    {
        $permission = Permission::findOrFail($request->get('id'));
        $destroy = $permission->delete();

        if (!$destroy) {
            return response()->json(array('success' => true, 'message' => Lang::get('message.delete_error')), 400);
        }
        return response()->json(array('success' => true, 'message' =>  Lang::get('message.delete_success')), 200);
    }

}
