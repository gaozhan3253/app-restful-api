<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //

    protected $fillable = [
        'id', 'category_id', 'type_id', 'deliver_id', 'name', 'sn', 'price', 'stock', 'sales', 'description', 'content', 'top', 'hot', 'sort', 'status'

    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

}
