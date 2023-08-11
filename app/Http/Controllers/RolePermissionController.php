<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Http\Requests\role_permission\CreateRolePermissionRequest;
use App\Http\Requests\role_permission\UpdateRolePermissionRequest;
use App\Http\Requests\role_permission\UpdateUserRolePermissionRequest;

class RolePermissionController extends Controller
{
    public function index()
    {
        $this->authorize('role_permission_list');

        $permissions = Permission::orderBy('controller')->get();
        $data['permissionList'] = $permissions->unique('controller')->pluck('controller');
        $data['permissionNameKeyList'] = $permissions->unique('name_key')->pluck('name_key')->toArray();

        $data['roles'] = Role::orderBy('name')->get();

        return view('role_permission.index', $data);
    }

    public function store(CreateRolePermissionRequest $request)
    {
        $this->authorize('role_permission_create');

        $fields = $request->validated();

        $permissionsToSync = array();
        foreach ($fields['permissions'] as $key => $value) {
            $dbPermissionId = Permission::where('name_key', $key)->pluck('id')->first();
            array_push($permissionsToSync, $dbPermissionId);
        }

        DB::transaction(function () use ($fields, $permissionsToSync) {
            $dbRole = Role::create([
                'name' => $fields['role'],
                'status' => $fields['status'],
            ]);

            $dbRole->permissions()->sync($permissionsToSync);
        });

        $data['status'] = true;
        $data['msg'] = 'Role Created';

        return response()->json($data);
    }

    //load permissions for selected role
    public function getPermissions()
    {
        $this->authorize('role_permission_view');

        $validated = request()->validate([
            'role' => ['required', 'integer'],
            'user' => ['nullable', 'integer']
        ]);

        $res = Role::where('id', $validated['role'])
            ->with(['permissions' => function (Builder $query) {
                $query->where('status', '1')->orderBy('name');
            }])
            ->get();

        $permissions = $res->pluck('permissions')->collapse();

        $data['role'] = $res->first();
        $data['permissionList'] = $permissions->unique('controller')->pluck('controller');
        $data['permissionNameKeyList'] = $permissions->unique('name_key')->pluck('name_key')->toArray();

        if (request('user') && filled(request('user'))) {
            $user = User::find($validated['user']);
            $user->load(['role.permissions']); //load permission relating to selected role of user
            $data['userPermissions'] = $user->permissions;
        }

        return response()->json($data);
    }

    //update permission /role wise
    public function updateRolePermission(UpdateRolePermissionRequest $request)
    {
        $this->authorize('role_permission_update');

        $validated = $request->validated();

        $permissionsToSync = array();
        foreach ($validated['permissions'] as $key => $value) {
            $dbPermissionId = Permission::where('name_key', $key)->pluck('id')->first();
            array_push($permissionsToSync, $dbPermissionId);
        }


        $role = Role::find($validated['role_id']);

        DB::transaction(function () use ($role, $validated, $permissionsToSync) {
            $role->update([
                'name' => $validated['role'],
                'status' => $validated['status'],
            ]);

            $role->permissions()->sync($permissionsToSync);
        });

        $data['status'] = true;
        $data['msg'] = 'Role Updated';

        return response()->json($data);
    }

    public function destroy(Role $role)
    {
        $this->authorize('role_permission_delete');

        DB::transaction(function () use ($role) {
            // Role::destroy($id);
            $role->delete();
        });

        return to_route('role-permission')->with('status', 'Role Deleted');
    }

    //load role and permissions for selected user
    public function getUserRolePermissions()
    {
        $this->authorize('user_role_permission_view');

        $validated = request()->validate([
            'userId' => ['required', 'integer', 'exists:users,id']
        ]);

        $user = User::find($validated['userId']);
        $user->load(['role.permissions']); //load permission relating to selected role of user

        $userPermissions = $user->permissions;
        $rolePermissions = $user->role->pluck('permissions')->collapse();


        $data['user'] = $user;
        $data['role'] = $user->role->first();

        $data['permissionList'] = $rolePermissions->unique('controller')->pluck('controller');
        $data['permissionNameKeyList'] = $rolePermissions->unique('name_key')->pluck('name_key')->toArray();
        
        $data['userPermissions'] = $userPermissions;
        $data['status'] = true;

        return response()->json($data);
    }

    //update role and permission /user wise
    public function updateUserRolePermissions(UpdateUserRolePermissionRequest $request)
    {
        $this->authorize('user_role_permission_update');

        $validated = $request->validated();

        $permissionsToSync = array();
        foreach ($validated['permissions'] as $key => $value) {
            $dbPermissionId = Permission::where('name_key', $key)->pluck('id')->first();
            array_push($permissionsToSync, $dbPermissionId);
        }

        $user = User::find($validated['user_id']);
        $role = Role::where('id', $validated['role'])->pluck('id')->toArray();

        DB::transaction(function () use ($role, $user, $permissionsToSync) {
            $user->role()->sync($role);

            $user->permissions()->sync($permissionsToSync);
        });

        $data['status'] = true;
        $data['msg'] = 'User Role Updated';

        return response()->json($data);
    }

    //update permission
    //on hold
    public function updatePermission(Request $request)
    {
        $validated = $request->validated();
        dd($validated);
    }
}
