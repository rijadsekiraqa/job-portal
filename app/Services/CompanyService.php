<?php

namespace App\Services;

use App\Models\Company;

class CompanyService
{
    public function index($userId = null)
    {
        $query = Company::query();

        if ($userId) {
            $query->where('user_id', $userId);
        }

        return $query;
    }


    public function store(array $data)
    {
        return Company::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function update(int $id, array $data)
    {
        $company = Company::findOrFail($id);

        $company->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image'],
            'user_id' => $data['user_id'],
        ]);

        return $company;
    }


    public function getById(string $id)
    {
        return Company::find($id);
    }


    public function delete($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
    }


    public function bulkDelete(array $ids)
    {
        Company::whereIn('id', $ids)->delete();
        return 'The selected companies have been successfully deleted.';
    }
}
