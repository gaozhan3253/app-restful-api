<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    //

    protected $fillable = [
        'id', 'category_id', 'type_id', 'deliver_id', 'name', 'sn', 'price', 'stock', 'sales', 'description', 'content', 'top', 'hot', 'sort', 'status'

    ];



    /**
     * 获取商品列表
     * @param null $category_id 栏目ID
     * @param int $number 每页数量
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getGoods($category_id = null, $number = 20)
    {
        $where = [
            'status' => 1,
        ];
        //根据栏目ID 获取栏目下所有栏目ID
        $categorysID = Category::getCategoryId($category_id);
        //返回查询结果
        return Good::where($where)
            ->orderBy('sort', 'desc')
            ->whereIn('category_id',$categorysID)
            ->paginate($number);
    }


    /**
     * 获取指定数量的推荐产品 使用top字段
     * @param int $num 数量
     * @return \Illuminate\Support\Collection
     */
    public static function getRecommend($num = 10)
    {
        $where = [
            'status' => 1,
            'top' => 1
        ];
        return Good::where($where)
            ->limit($num)
            ->orderBy('sort', 'desc')
            ->get();
    }


    /**
     * 一对多 关联产品分类
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }

}
