<?php

namespace App\Models;

use App\Models\City;
use App\Models\Company;
use App\Models\Category;
use App\Models\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'owner_id',
        'company_id',
        'job_title',
        'category_id',
        'city_id',
        'work_schedule',
        'from_date',
        'to_date',
        'job_description',
        'requirements',
        'qualifications',
        'image',
        'status',
    ];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function applications()
    {
        return $this->hasMany(Application::class, 'announcement_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
