<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function index()
    {
        return Category::all();
    }


    public function store(array $data)
    {
        return Category::create([
            'name' => $data['name'],
        ]);
    }

    public function update(int $id, array $data)
    {
        $category = Category::findOrFail($id);

        $category->update([
            'name' => $data['name'],
        ]);

        return $category; 
    }


    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }

    public function bulkDelete(array $ids)
    {
        Category::whereIn('id', $ids)->delete();
        return 'The selected categories have been successfully deleted.';
    }


    



    
}
