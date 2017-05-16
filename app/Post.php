<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Restaurant;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
