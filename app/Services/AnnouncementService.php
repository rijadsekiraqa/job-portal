<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Announcement;

class AnnouncementService
{

    public function index()
    {
        return Announcement::all();
    }


    public function store(array $data)
    {
        return Announcement::create([
            'user_id' => $data['user_id'],
            'owner_id' => $data['owner_id'],
            'company_id' => $data['name'],
            'job_title' => $data['jobtitle'],
            'category_id' => $data['category'],
            'city_id' => $data['city'],
            'work_schedule' => $data['work_schedule'],
            'from_date' => $data['from_date_full'],
            'to_date' => $data['to_date_full'],
            'job_description' => $data['description'],
            'requirements' => json_encode($data['requirements']),
            'qualifications' => json_encode($data['qualifications']),
            'image' => $data['announcement_image'],
            'status' => $data['status'],
        ]);
        
    }


    public function update(int $id, array $data)
    {
        $announcement = Announcement::findOrFail($id);
        // Ndrysho owner_id nëse company_id ka ndryshuar
        if ($announcement->company_id != $data['company_id']) {
            $company = Company::find($data['company_id']);
            if ($company) {
                $data['owner_id'] = $company->user_id; // Përditëso owner_id nëse kompania është ndryshuar
            }
        }
        $announcement->update([
            'company_id' => $data['company_id'],
            'job_title' => $data['jobtitle'],
            'category_id' => $data['category_id'],
            'city_id' => $data['city_id'],
            'work_schedule' => $data['work_schedule'],
            'from_date' => $data['from_date'],
            'to_date' => $data['to_date'],
            'requirements' => json_encode($data['requirements']),
            'qualifications' => json_encode($data['qualifications']),
            'image' => $data['announcement_image'],
            'owner_id' => $data['owner_id'] ?? $announcement->owner_id,
        ]);

        return $announcement;
    }


    public function updateJobDescription(int $id, string $description)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->update([
            'job_description' => $description,
        ]);

        return $announcement;
    }



    public function delete($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();
    }



    public function bulkDelete(array $ids)
    {
        Announcement::whereIn('id', $ids)->delete();
        return 'The selected announcemenets have been successfully deleted.';
    }
}
