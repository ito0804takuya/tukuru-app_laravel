<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function parts()
    {
        return $this->belongsToMany('App\Part');
    }
}
