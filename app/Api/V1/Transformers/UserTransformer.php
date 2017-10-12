<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/8 0008
 * Time: 14:43
 */
namespace App\Api\V1\Transformers;

use App\Models\Member;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform(Member $item)
    {
        return [
            'id' => $item->id,
            'user_login' => $item->user_login,
            'user_nickname' => isset($item->user_nickname)?$item->user_nickname:'',
            'mobile' => isset($item->mobile)?$item->mobile:'',
            'qq' => isset($item->qq)?$item->qq:'',
            'wechat' => isset($item->wechat)?$item->wechat:'',
            'forget' => isset($item->forget)?$item->forget:'',
            'sex' => isset($item->sex)?$item->sex:'',

        ];
    }
}



















