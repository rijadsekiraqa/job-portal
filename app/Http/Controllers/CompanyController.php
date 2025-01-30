<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\Company\CreateCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use Spatie\Permission\Middleware\PermissionMiddleware;

class CompanyController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('role:super-admin|employee'),
            new Middleware(PermissionMiddleware::using('view-company'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-company'), only: ['create', 'store']),
            new Middleware(PermissionMiddleware::using('update-company'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('delete-company'), only: ['destroy']),
            new Middleware(PermissionMiddleware::using('bulkdelete-company'), only: ['bulkDelete']),
            // new Middleware('role:super-admin', only: ['bulkDelete']),
        ];
    }

    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }


    public function index()
    {
        $currentUser = Auth::user();
        /** @var User $currentUser */
        if ($currentUser->hasRole('super-admin')) {
            $companies = $this->companyService->index()
                ->with('user') // Ensure the user relationship is loaded
                ->get();
        } else {
            $companies = $this->companyService->index()
                ->where('user_id', $currentUser->id)
                ->orWhereHas('user', function ($query) use ($currentUser) {
                    $query->where('id', $currentUser->id);
                })
                ->get();
        }

        return view('admin.company.index', compact('companies'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.company.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCompanyRequest $request)
    {
        $data = $request->validated();
        $currentUser = Auth::user();
        /** @var User $currentUser */
        $data['user_id'] = $currentUser->hasRole('super-admin')
            ? $request->input('user_id')
            : $currentUser->id;

        $data['image'] = $this->handleImageUpload($request);

        $this->companyService->store($data);
        return redirect()->route('companies.index')->with('success', 'Kompania është krijuar me sukes');
    }

    private function handleImageUpload($request)
    {
        if ($request->hasFile('company_image')) {
            return $request->file('company_image')->store('companies', 'public');
        }
        return null;
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();
        if ($currentUser->hasRole('super-admin')) {
            $company = Company::findOrFail($id);
            $users = User::all();
        } else {
            $company = Company::where('id', $id)
                ->where('user_id', $currentUser->id)
                ->firstOrFail();
            $users = [];
        }

        return view('admin.company.edit', compact('company', 'users'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $company = Company::findOrFail($id);

        if ($request->hasFile('company_image')) {
            $imagePath = $request->file('company_image')->store('companies', 'public');

        if ($company->image) {
            Storage::disk('public')->delete($company->image);
        }

            $validatedData['image'] = $imagePath;
        } else {
            $validatedData['image'] = $company->image;
        }

        $currentUser = Auth::user();
        /** @var \App\Models\User $currentUser */
        $validatedData['user_id'] = $currentUser->hasRole('super-admin')
            ? $request->input('user_id')
            : $currentUser->id;

        $this->companyService->update($id, $validatedData);
        return redirect()->route('companies.index')->with('success', 'Kompania është përditësuar me sukses');
    }

    public function destroy(string $id)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        if ($currentUser->hasRole('super-admin')) {
            $this->companyService->delete($id);
        } else {
            $company = $this->companyService->getById($id);

            if ($company && $company->user_id === $currentUser->id) {
                $this->companyService->delete($id);
            } else {
                abort(403, 'Unauthorized action.');
            }
        }
        return redirect()->route('companies.index')->with('success', 'Kompania është fshirë me sukses');
    }


    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:companies,id'
        ]);

        $this->companyService->bulkDelete($request->ids);
    }
}
