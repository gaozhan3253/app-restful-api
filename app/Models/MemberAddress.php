<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberAddress extends Model
{
    protected $fillable = [
        'id', 'user_id', 'name', 'alias', 'region', 'address', 'postcodes', 'description', 'mobile', 'is_default'
    ];

    /**
     * 添加收货地址
     * @param $request
     * @param $user
     * @return $this|Model
     */
    public static function createAddress($request,$user){
        $bool = MemberAddress::create([
            'user_id'=>$user->id,
            'name'=>$request->input('name'),
            'region'=>$request->input('region'),
            'address'=>$request->input('address'),
            'mobile'=>$request->input('mobile'),

            'alias'=>$request->input('alias',''),
            'region_name'=>$request->input('region_name','这个应该通过regionID查询出来'),
            'postcodes'=>$request->input('postcodes',''),
            'description'=>htmlspecialchars($request->input('description','')),
            'is_default'=>$request->input('is_default','0'),
        ]);
        return $bool;
    }

    /**
     * 修改收货地址
     * @param $request
     * @param $address
     */
    public static function updateAddress($request,$address)
    {
        $address->name = $request->input('name');
        $address->alias = $request->input('alias');
        $address->region = $request->input('region');
        $address->address = $request->input('address');
        $address->mobile = $request->input('mobile');
        $address->region_name = $request->input('region_name','');
        $address->postcodes = $request->input('postcodes','');
        $address->description = htmlspecialchars($request->input('description',''));
        $address->is_default = $request->input('is_default','0');
        $address->save();
    }

    /**
     * 一对多关联 用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member','user_id','id');
    }
}
