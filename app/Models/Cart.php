<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'id', 'good_id', 'category_id', 'user_id', 'good_name', 'good_sn', 'good_description', 'good_image_url', 'good_price', 'number', 'sort', 'status'
    ];

    /**
     * 根据指定用户获取他的购物车信息
     * @param $user
     * @return mixed
     */
    public static function getAllCarts($user)
    {
        $carts =  $user->carts;
        foreach ($carts as $k=>$cart){
            //根据单个购物车商品信息 获取商品最新价格等信息
            $good = $cart->good;
            $cart['good_name'] = $good->name;
            $cart['good_sn'] = $good->sn;
            $cart['good_image_url'] = $good->image_url;
            $cart['good_price'] = $good->price;
        }
        return $carts;
    }

    /**
     * 根据指定用户获取购物车汇总 总价和数量
     * @param $user
     * @return array
     */
    public static function getTotalCarts($user)
    {
        $number = 0;
        $price = 0;
        $carts = self::getAllCarts($user);
        foreach ($carts as $cart) {
            $cartNumber = $cart->number;
            $cartPrice = $cart->good_price;
            $cartTotal = $cartNumber * $cartPrice;
            $number += $cartNumber;
            $price += $cartTotal;
        }
        return ['number' => $number, 'price' => $price];
    }

    /**
     * 添加指定商品加入指定用户的购物车
     * @param $user 用户obj
     * @param $good 商品obj
     * @param int $number 商品数量
     */
    public static function addCart($user, $good, $number = 1)
    {
        $goodCart = self::checkGoodInCart($user->id, $good->id);
        if (!empty($goodCart)) {
            //存在就增加数量
            $oldNumber = $goodCart->number;
            $number = $oldNumber + $number;
            $goodCart->number = $number;
            $goodCart->save();
        } else {
            //不存在就添加
            Cart::create([
                'good_id' => $good['id'],
                'category_id' => $good['category_id'],
                'user_id' => $user->id,
                'good_name' => $good['name'],
                'good_sn' => $good['sn'],
                'good_image_url' => $good['image_url'],
                'good_price' => $good['price'],
                'number' => $number,
            ]);
        }
    }

    /**
     * 删除购物车指定商品
     * @param $goodCart 购物车商品对象
     * @param $number 减少的商品数量
     */
    public static function delCart($goodCart, $number)
    {

        //存在就减少数量
        $oldNumber = $goodCart->number;
        $number = $oldNumber - $number;
        //如果减少后的数据大于0 说明商品还在 修改number就行 小于0 就删除
        if ($number > 0) {
            $goodCart->number = $number;
            $goodCart->save();
        } else {
            $goodCart->delete();
        }
    }

    /**
     * 判断指定用户指定商品是否存在购物车中
     * @param $user_id
     * @param $good_id
     * @return Model|null|static
     */
    protected static function checkGoodInCart($user_id, $good_id)
    {
        $where = [
            'user_id' => $user_id,
            'good_id' => $good_id
        ];
        return Cart::where($where)
            ->first();
    }


    /**
     * 一对多关联用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'user_id', 'id');
    }

    /**
     * 一对一关联商品表
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function good()
    {
        return $this->hasOne('App\Models\Good','id','good_id');
    }
}
