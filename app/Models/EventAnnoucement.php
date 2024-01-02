<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class EventAnnoucement extends Model
{
    use HasFactory;

    public function event()
    {
     return $this->belongsTo(Event::class,'event_id');
    }
    public function user()
    {
    return $this->belongsTo(User::class,'user_id');
    }

}
