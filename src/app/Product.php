<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function parts()
    {
        return $this->belongsToMany('App\Part', 'product_parts');
    }

    public function createdUser()
    {
        return $this->belongsTo('App\User', 'created_user_id');
    }

    public function updatedUser()
    {
        return $this->belongsTo('App\User', 'updated_user_id');
    }
}
