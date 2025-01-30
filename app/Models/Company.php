<?php

namespace App\Models;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'user_id'
    ];

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

   
}
