<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/8 0008
 * Time: 14:43
 */
namespace App\Api\V1\Transformers;

use App\models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{

    public function transform(Category $item)
    {
        return [
            'id' => $item->id,
            'cid' => $item->cid,
            'name' => $item->name,
            'description' => isset($item->description)?$item->description:'',
            'image_url' => isset($item->image_url)?$item->image_url:'',
            'sort' => isset($item->sort)?$item->sort:0,
        ];
    }
}



















