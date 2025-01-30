<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class RoleController extends Controller implements HasMiddleware
{


    public static function middleware(): array
    {
        return [
            new Middleware('role:super-admin|employee'),
            new Middleware(PermissionMiddleware::using('view-role'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-role'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('update-role'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('delete-role'), only: ['destroy']),
        ];
    }


    public function index()
    {
        $roles = Role::all();
        return view('admin.roles-permission.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('admin.roles-permission.roles.create', compact('permissions'));
    }


    public function store(CreateRoleRequest $request)
    {
        $validated = $request->validated();

        $role = Role::create([
            'name' => $validated['name']
        ]);

        $permission = Permission::where('name', $request->permission[0])->first();

        $role->syncPermissions($request->permission);
        return redirect()->route('role.index')->with('success', 'Roli eshte regjistruar me sukses');
    }





    public function edit(Role $role)
    {
        $permissions = Permission::get();

        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id')
            ->toArray();

        return view('admin.roles-permission.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }


    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validated = $request->validated();

        $role->update([
            'name' => $validated['name']
        ]);

        $permissions = Permission::whereIn('id', $request->permission)->get();

        $role->syncPermissions($permissions);

        return redirect()->route('role.index')->with('success', 'Roli eshte perditesuar me sukses');
    }




    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route('role.index')->with('success', 'Roli eshte fshire me sukses');;
    }
}
