<?php

namespace App\Models\Information;

use App\Models\System\User;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['message'];

    public function seeder()
    {
        return $this->belongsTo(User::class,'seeder_id');

    }

    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id');

    }


    public function room()
    {
        return $this->belongsTo(Room::class,'room_id');

    }
}
