<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categorys';
    //
    protected $fillable = [
        'id','cid','name','description','image_url','sort','status'
    ];


    public function goods()
    {
        return $this->hasMany('App\Models\Good','category_id','id');
    }
}
