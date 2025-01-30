<?php

namespace App\Services;

use App\Models\City;

class CityService
{
    public function index()
    {
        return City::all();
    }


    public function store(array $data)
    {
        return City::create([
            'name' => $data['name'],
        ]);
    }

    public function update(int $id, array $data)
    {
        $city = City::findOrFail($id);
        $city->update([
            'name' => $data['name'],
        ]);
        
        return $city; 
    }


    public function delete($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
    }


    public function bulkDelete(array $ids)
    {
        City::whereIn('id', $ids)->delete();
        return 'The selected cities have been successfully deleted.';
    }






    
}
