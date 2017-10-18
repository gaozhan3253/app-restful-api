<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/8 0008
 * Time: 14:43
 */
namespace App\Api\V1\Transformers;

use App\Models\Cart;
use League\Fractal\TransformerAbstract;

class CartTransformer extends TransformerAbstract
{

    public function transform(Cart $item)
    {
        return [
            'id' => $item->id,
            'good_id' => $item->good_id,
            'category_id' => $item->category_id,
            'name' => $item->good_name,
            'sn' => isset($item->good_sn)?$item->good_sn:'',
            'price' => isset($item->good_price)?$item->good_price:'0',
            'number' => isset($item->number)?$item->number:'1',
            'image_url' => isset($item->good_image_url)?$item->good_image_url:'',
        ];
    }
}



















