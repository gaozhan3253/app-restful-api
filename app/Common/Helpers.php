<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/7 0007
 * Time: 14:49
 */

/**
 * 传入数组 根据指定cid进行排序
 */
function cidSort($arr,$cid = 0,$i=0){
    static $data = array();
    $i++;
    foreach($arr as $k=>$v){
        if($v['cid'] == $cid){
            $v['key']=$i;
            $data[] = $v;
            cidSort($arr,$v['id'],$i);
        }
    }
    return $data;
}