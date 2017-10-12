<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/12 0012
 * Time: 10:40
 */
namespace App\Facades\Aes;

use Illuminate\Support\Facades\Facade;

class AesFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'aes';
    }
}