<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\User;
use App\Models\Company;
use App\Models\Category;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        $superAdmin = User::whereHas('roles', function ($query) {
            $query->where('name', 'super-admin');
        })->first();

        $companies = Company::all();
        $categories = Category::all();
        $cities = City::all();

        $workSchedules = ['Full Time', 'Part Time'];

        if ($superAdmin) {
            foreach ($companies as $company) {
                $employee = User::role('employee')->inRandomOrder()->first();

                Announcement::create([
                    'company_id' => $company->id,
                    'category_id' => $categories->random()->id,
                    'city_id' => $cities->random()->id,
                    'user_id' => $superAdmin->id,  
                    'owner_id' => $employee ? $employee->id : null,
                    'job_title' => 'Senior Fullstack Developer (PHP/Laravel, Vue.js)',
                    'job_description' => 'We are seeking an experienced and talented Senior Fullstack Developer...',
                    'requirements' => json_encode([
                        'Develop, design, and maintain fullstack web applications using PHP/Laravel...',
                        'Collaborate with product managers, designers, and fellow developers...',
                    ]),
                    'qualifications' => json_encode([
                        'Minimum 6 years of experience as a Fullstack Developer...',
                        'Expertise in backend development using PHP and Laravel...',
                    ]),
                    'work_schedule' => $workSchedules[array_rand($workSchedules)],
                    'from_date' => Carbon::now()->toDateString(),
                    'to_date' => Carbon::now()->addDays(7)->toDateString(),
                    'status' => 'approved', 
                    'image' => $company->image,  
                ]);
            }
        }
    }
}
