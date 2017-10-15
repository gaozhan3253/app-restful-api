<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/8 0008
 * Time: 14:43
 */
namespace App\Api\V1\Transformers;

use App\models\Good;
use League\Fractal\TransformerAbstract;

class GoodListTransformer extends TransformerAbstract
{

    public function transform(Good $item)
    {
        return [
            'id' => $item->id,
            'category_id' => $item->category_id,
            'category_name' => $item->category->name,
            'name' => $item->name,
            'sn' => isset($item->sn)?$item->sn:'',
            'price' => isset($item->price)?$item->price:'0',
            'stock' => isset($item->stock)?$item->stock:'0',
            'sales' => isset($item->sales)?$item->sales:'0',
            'image_url' => isset($item->image_url)?$item->image_url:'',
            'top' => isset($item->top)?$item->top:0,
            'hot' => isset($item->hot)?$item->hot:0,
            'sort' => isset($item->sort)?$item->sort:0,
        ];
    }
}



















