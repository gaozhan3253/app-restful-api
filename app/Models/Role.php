<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description','status'
    ];
}
