<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/8 0008
 * Time: 14:43
 */
namespace App\Api\V1\Transformers;

use App\models\MemberAddress;
use League\Fractal\TransformerAbstract;

class AddressTransformer extends TransformerAbstract
{

    public function transform(MemberAddress $item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'alias' => $item->alias,
            'region' => $item->region,
            'region_name' =>  $item->region_name,
            'address' =>  $item->address,
            'postcodes' =>  $item->postcodes,
            'description' =>  $item->description,
            'mobile' =>  $item->mobile,
            'is_default' =>  $item->is_default,
        ];
    }
}



















