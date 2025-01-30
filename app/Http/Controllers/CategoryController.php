<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Spatie\Permission\Middleware\PermissionMiddleware;

class CategoryController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('role:super-admin|employee'),
            new Middleware(PermissionMiddleware::using('view-category'), only: ['index']),
            new Middleware(PermissionMiddleware::using('create-category'), only: ['create','store']),
            new Middleware(PermissionMiddleware::using('update-category'), only: ['edit','update']),
            new Middleware(PermissionMiddleware::using('delete-category'), only: ['destroy','bulkDelete']),
        ];
    }

    
    
    /**
     * Display a listing of the resource.
     */
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->index();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    
    public function store(CreateCategoryRequest $request)
    {
        $this->categoryService->store($request->validated());
        return redirect()->route('categories.index')->with('success', 'Kategoria eshte krijuar me sukses.');
    }


    
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

   
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $this->categoryService->update($id, $request->validated());
        return redirect()->route('categories.index')->with('success', 'Kategoria eshte perditesuar me sukses.');
    }

    
    public function destroy(string $id)
    {
         $this->categoryService->delete($id);
         return redirect()->route('categories.index')->with('success', 'Kategoria eshte fshire me sukses.');
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:categories,id'
        ]);

       $this->categoryService->bulkDelete($request->ids);
       return redirect()->route('categories.index')->with('success', 'Kategorite e selektuara jane fshire me sukses.');
    }
}
