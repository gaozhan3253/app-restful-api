<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categorys';
    //
    protected $fillable = [
        'id','cid','name','description','image_url','sort','status'
    ];

    /**
     * 获取全部栏目信息
     * @return \Illuminate\Support\Collection
     */
    protected static function getAllCategory()
    {
        return Category::where(['status'=>1])->get();
    }

    /**
     * 获取栏目信息
     * @param null $cid 指定cid的栏目信息
     * @return array|\Illuminate\Support\Collection
     */
    public static function getCategory($cid = null)
    {
        $categorys = self::getAllCategory();
        if(!empty($cid)){
            $categorys = sonTree($categorys,$cid);
        }
        return $categorys;
    }



    /**
     * 获取指定栏目的所有子栏目ID(包含指定栏目)
     * @param null $cid 栏目ID
     * @return array
     */
    public static function getCategoryId($cid = null)
    {
        $categorysIDList = [];
        $categorys = self::getCategory($cid);
        foreach ($categorys as $v){
            $categorysIDList[] = $v['id'];
        }
        if(!empty($cid)){
            $categorysIDList[] = $cid;
        }

        return $categorysIDList;
    }

    /**
     * 关联good model，一对多
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany('App\Models\Good','category_id','id');
    }
}
