<?php

namespace App\Models\User;




use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Log;


trait Feature
{

    public static function register($data,$update=null)
    {

        if ($update==null) {
            $datas =  User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
//                'picture' => isset($data['picture']) ? $data['picture'] : "",
                'role_id' => isset($data['role']) ? $data['role'] :5,
                'agent_id' => isset($data['agent_id'])?$data['agent_id']:null,
                'administred_id' => isset($data['administred_id'])?$data['administred_id']:null,
            ]);

        } else {

          $datas =   User:: where('agent_id', $data['agent_id'])
                ->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],

                ]);


        }
        return $datas;
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @paramPermission $permission
     * @returnboolean
     */
    public function hasPermissionTo(Permission $permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->role()->first()->id == $role->id) {
                return true;
            }
        }
        foreach ($permission->users as $user) {
            if (auth()->user()->id == $user->id) {
                return true;
            }
        }
        return false;

    }

    /**
     * @param$permission
     * @returnbool
     */
    protected function hasPermissionThroughRole($permission)
    {

            foreach ($permission->roles as $role) {
                if ($this->role()->first()->id == $role->id) {
                    return true;
                }
            }

        return false;
    }
    protected function hasPermissionThroughUser($permission)
    {
            foreach ($permission->users as $user) {
                if (auth()->user()->id == $user->id) {
                    return true;
                }
            }
        return false;
    }
    // Admin système
    public function isSuperAdmin()
    {
        return $this->hasRole(1);
    }
    // Admin fonctionnel
    public function isAdmin()
    {
        return $this->hasRole(2);
    }

    // Percepteur
    public function isAgentPercepteur()
    {
        return $this->hasRole(3);
    }
    // Agent
    public function isAgent()
    {
        return $this->hasRole(4);
    }
    public function isAdministred()
    {
        return $this->hasRole(5);
    }

    private function hasRole($role_id)
    {
//        $role = Role::whereName($role)->firstOrFail();
        $role = Role::where("id",'=',$role_id)->firstOrFail();
        return auth()->user()->role_id == $role->id;
    }

}
