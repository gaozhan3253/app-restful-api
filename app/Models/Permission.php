<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = [
        'name', 'label', 'description','status', 'cid', 'icon',
    ];
}
