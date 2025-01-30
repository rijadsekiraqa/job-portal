<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Requests\User\ProfileUpdateRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('role:super-admin|employee'),
            new Middleware(PermissionMiddleware::using('view-user'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-user'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('update-user'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('delete-user'), only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        $roles = Role::pluck('name', 'id');
        $query = User::query();

        // Filter by name
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter by email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Filter by roles
        if ($request->filled('roles')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->whereIn('name', $request->roles);
            });
        }

        $users = $query->get(); 
        $user = Auth::user();

        return view('admin.roles-permission.users.index', compact('users', 'roles', 'user'));
    }


    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.roles-permission.users.create', compact('roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $validated = $request->validated();

        $validated['name'] = ucfirst(strtolower($validated['name']));
        $validated['lastname'] = ucfirst(strtolower($validated['lastname']));

        $user = User::create([
            'name' => $validated['name'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'Përdoruesi është regjistruar me sukses');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        return view('admin.roles-permission.users.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $validated['name'] = ucfirst(strtolower($validated['name']));
        $validated['lastname'] = ucfirst(strtolower($validated['lastname']));

        $data = [
            'name' => $validated['name'],
            'lastname' => $validated['lastname'],
            'username' => $request->username,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $data += [
                'password' => Hash::make($request->password),
            ];
        }
        $user->update($data);
        $user->syncRoles($request->roles);


        return redirect()->route('users.index')->with('success', 'Përdoruesi është përditësuar me sukses');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Përdoruesi është fshirë me sukses');
    }

    public function userprofile()
    {
        $user = Auth::user();
        return view('admin.roles-permission.users.profile', compact('user'));
    }

    public function updateuserprofile(ProfileUpdateRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validated();

        $validated['name'] = ucfirst(strtolower($validated['name']));
        $validated['lastname'] = ucfirst(strtolower($validated['lastname']));


        $data = [
            'name' => $validated['name'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'username' => $validated['username'],
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($validated['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('userprofile')->with('success', 'Profili i përdoruesit është përditësuar me sukses');
    }




    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:users,id'
        ]);

        User::whereIn('id', $request->ids)->delete();

        return response()->json(['message' => 'The selected users have been successfully deleted.']);
    }
}
