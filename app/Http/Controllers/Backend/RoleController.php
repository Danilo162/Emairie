<?php


namespace App\Http\Controllers\Backend;


use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Requests\Role\RoleDestroyRequest;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize("Listing Roles");

        $jsonData = [];

        $from = ($request->get('offset')) ? $request->get('offset') : 0;
        $limit = ($request->get('limit')) ? $request->get('limit') : 10;
        $order = ($request->get('order')) ? $request->get('order') : 'DESC';
        $search = ($request->get('search')) ? $request->get('search') : '';



        $result = self::queryFor($from, $order, $limit, $search);
        $jsonData["total"] = $result["total"];
        $jsonData["rows"] = $result["rows"];

        return response()->json($jsonData);
    }

    public function queryFor($from, $order, $limit, $search)
    {
        $roleIds = self::getMyRoleListId();
        $query = DB::table("roles")
            ->whereNull("deleted_at")
            ->orderBy("id", $order)
            ->selectRaw("roles.*" ) ;

        if (auth()->user()->isSuperAdmin()) {
            $query->whereIn("roles.id",$roleIds);
        }

        if (auth()->user()->isAdmin()) {
            $query->whereIn("roles.id", $roleIds);
        }

        if ($search && !empty($search)) {
            $query->where('name', 'LIKE', "%{$search}%");
        }


        $total = count($query->get());

        if ($limit && !empty($limit)) {
            $query->take($limit)->skip($from);
        }
        $rows = $query->get();


        $jsonData["total"] = $total;
        $jsonData["rows"] = $rows;
        return $jsonData;
    }

    public function store(RoleCreateRequest $request)
    {
        // SAVE
//
        if ($request->get('id') == "") {

            $request->validate(['name' => 'required|min:1|unique:roles,name,NULL,id,deleted_at,NULL']);
        }


        $create = Role::updateOrCreate(["id" => $request->get('id')], ['name' => $request->get('name'),
            'comment' => $request->get('commentaire')]);
        if (!$create) {
            return response()->json(['success' => false, 'message' => Lang::get('message.save_error')], 200);
        }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')], 200);

    }

    public function permission(Role $role)
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();
        $perPage = intdiv(count($permissions), 4);
        return view('role.permission', compact('role', 'permissions', 'perPage'));
    }

    public function delegation(Role $role)
    {
        $permissions = Permission::orderBy('name', 'ASC')->get();

        return view('role.delegation', compact('role', 'permissions'));
    }

    public function assignPermission(Request $request)
    {
        $role = Role::findOrFail($request->get('role_id'));
        $assign = $role->permissions()->sync($request->get('permission_id'));

        if (!$assign) {
            return response()->json(['success' => false, 'message' => Lang::get('message.save_error')], 200);
        }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')], 200);
    }
    public function assignPermissionDelagation(Request $request)
    {
        $request->validate(['p_ms' => 'required']);

        $user = User::where("agent_id","=",$request->get('ag_t'))->first();

//        $users = User::findOrFail($user->id);
        $assign =  DB::table('user_permission')->insert([
            "user_id"=>$user->id,
            "permission_id"=>$request->get('p_ms')]);

//        $users->permissions()->sync($request->get('p_ms'));

        if (!$assign) {
            return response()->json(['success' => false, 'message' => Lang::get('message.save_error')], 200);
        }
        return response()->json(['success' => true, 'message' => Lang::get('message.save_success')], 200);
    }

    public function edit(Role $role)
    {

        return view('backend.role.edit', compact('role'));
    }


    public function destroy(RoleDestroyRequest $request)
    {
        $role = Role::findOrFail($request->get('id'));
        $destroy = $role->delete();

        if (!$destroy) {
            return response()->json(array('success' => true, 'message' => Lang::get('message.delete_error')), 400);
        }
        return response()->json(array('success' => true, 'message' => Lang::get('message.delete_success')), 200);
    }
    public function destroy_delegation(Request $request)
    {
        $user = User::where("agent_id","=",$request->get('ag_t'))->first();

        $destroy = DB::table("user_permission")
            ->where("user_id","=",$user->id)
            ->where("permission_id","=",$request->p_ms)->delete();


        if (!$destroy) {
            return response()->json(array('success' => true, 'message' => Lang::get('message.delete_error')), 400);
        }
        return response()->json(array('success' => true, 'message' => Lang::get('message.delete_success')), 200);
    }

    /**
     *  Recuperer les roles les administrateur systeme et fonctionnels ont droit a attribuer des roles
     */
    public static function getMyRole()
    {

        $roleIds = self::getMyRoleListId();

            $query = DB::table("roles")->whereNull("deleted_at");
            if (auth()->user()->isSuperAdmin()) {
                $query->whereIn("roles.id",$roleIds);
            }

            if (auth()->user()->isAdmin()) {
                $query->whereIn("roles.id", $roleIds);
            }

            if (auth()->user()->isSuperAdmin() || auth()->user()->isAdmin()) {
                $data = $query->get();
            } else {
                $data = null;
            }

            return $data;


    }
    public static function getMyRoleListId()
    {
        $lists = [];
        {
            $query = DB::table("roles")->whereNull("deleted_at")
                ->selectRaw("id");

            if (auth()->user()->isSuperAdmin()) {
                $query->whereIn("roles.id", [1,2]);
            }

            if (auth()->user()->isAdmin()) {
                $query->whereNotIn("roles.id", [1, 2, 5]);
            }

            if (auth()->user()->isSuperAdmin()|| auth()->user()->isAdmin()) {
                $data = $query->get();

            } else {
                $data = null;
            }
            if($data){
                foreach ($data as $datum){
                    $lists[] = $datum->id;
                }
            }

            return $lists;
        }

    }
}
