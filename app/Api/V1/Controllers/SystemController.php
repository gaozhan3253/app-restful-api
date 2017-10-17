<?php

namespace App\Api\V1\Controllers;


use App\Api\BaseController;
use App\models\Good;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;


class SystemController extends BaseController
{
    //
    public function upload(Request $request)
    {
        dump( date('Y-m-d H:i:s',time()));
        for($i=8418;$i<19999;$i++){
            Good::create([
                'category_id'=>1,
                'name'=>'产品名称'.$i,
                'sn'=>$i,
                'price'=>$i,
                'stock'=>100,
                'sales'=>rand(0,999),
                'description'=>'产品描述'.$i,
                'sort'=>$i,
                'status'=>1
            ]);
        }
        dump( date('Y-m-d H:i:s',time()));

//        $name = Redis::set('name','高展');
//        $name = Redis::get('name');
//        dump($name);
//        Cache::store('redis')->put('foo', '123',100);
//
//        $value = Cache::store('redis')->get('foo');
//        dump($value);

//        Cache::store('redis')->put('name','高展');
//
//        $name = Cache::store('redis')->get('name');
//dump($name);
//        dump($request->allFiles());
//        if ($request->hasFile('filename')) {
//            $path = request()->file('filename')->store('events');
//            return $path;
//
//        }else{
//            return 'not exists';
//        }
//        $path = Storage::putFile('/upload', $request->file('file_name'));
//        $path = Storage::putFile('file_name', $request->file('avatar'));
    }
}
