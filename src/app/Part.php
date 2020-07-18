<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = [
        'name',
        'supplier_id',
        'created_user_id',
        'updated_user_id'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_parts');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
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
