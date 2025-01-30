<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Commands\CreatePermission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use App\Http\Requests\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;

class PermissionController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('role:super-admin|employee'),
            new Middleware(PermissionMiddleware::using('view-permission'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-permission'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('update-permission'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('delete-permission'), only: ['destroy']),
        ];
    }


    public function index()
    {
        $permissions = Permission::all();
        return view('admin.roles-permission.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.roles-permission.permission.create');
    }


    public function store(CreatePermissionRequest $request)
    {

        $validated = $request->validated();

        Permission::create([
            'name' => $validated['name']
        ]);

        return redirect()->route('permission.index')->with('success', 'Leja është regjistruar me sukses');
    }


    public function edit(Permission $permission)
    {
        return view('admin.roles-permission.permission.edit', [
            'permission' => $permission
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {

        $validated = $request->validated();

        $permission->update([
            'name' => $validated['name']
        ]);
        return redirect()->route('permission.index')->with('success', 'Leja është përditësuar me sukses');
    }

    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permission.index')->with('success', 'Leja është fshirë me sukses');
    }
}
