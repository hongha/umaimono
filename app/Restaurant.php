<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Food;

class Restaurant extends Model
{
   	public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
