<?php

namespace App\Models;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'announcement_id',
        'name',
        'lastname',
        'city',
        'email',
        'phone',
        'resume',
        'user_id'


    ];

   // In Application.php model
public function announcement()
{
    return $this->belongsTo(Announcement::class, 'announcement_id');
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
