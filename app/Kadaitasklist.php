<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kadaitasklist extends Model
{
   protected $fillable = ['content', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
