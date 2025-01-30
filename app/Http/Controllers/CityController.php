<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Services\CityService;
use App\Http\Requests\City\CreateCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class CityController extends Controller implements HasMiddleware
{

    

    public static function middleware(): array
    {
        return [
            new Middleware('role:super-admin|employee'),
            new Middleware(PermissionMiddleware::using('view-city'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-city'), only: ['create','store']),
            new Middleware(PermissionMiddleware::using('update-city'), only: ['edit','update']),
            new Middleware(PermissionMiddleware::using('delete-city'), only: ['destroy','bulkDelete']),


        ];
    }


    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }


    public function index()
    {
        $cities = $this->cityService->index();
        return view('admin.city.index', compact('cities'));
    }

    
    public function create()
    {
        return view('admin.city.create');
    }

    
    public function store(CreateCityRequest $request)
    {
        $this->cityService->store($request->validated());
        return redirect()->route('cities.index')->with('success', 'Qyteti është krijuar me sukses.');
    }

    
    public function edit(string $id)
    {
        $city = City::findOrFail($id);
        return view('admin.city.edit', compact('city'));
    }

    
    public function update(UpdateCityRequest $request, string $id)
    {
        $this->cityService->update($id, $request->validated());
        return redirect()->route('cities.index')->with('success', 'Qyteti është përditësuar me sukses.');
    }


    public function destroy(string $id)
    {
         $this->cityService->delete($id);
         return redirect()->route('cities.index')->with('success', 'Qyteti është fshirë me sukses.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:cities,id'
        ]);

       $this->cityService->bulkDelete($request->ids);
      
    }

    




}
