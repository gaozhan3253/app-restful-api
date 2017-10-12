<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/12 0012
 * Time: 10:40
 */
namespace App\Facades\Rsa;

use Illuminate\Support\Facades\Facade;

class RsaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'rsa';
    }
}