<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\adminUserPost;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Flysystem\Exception;
use Psy\Exception\ErrorException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('status','=','1')->get();
        return view('admin.user.create',compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(adminUserPost $request)
    {
        //添加用户
        $user = User::create([
            'nickname'=>$request->nickname,
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'description'=>trim($request->description),
            'password'=>bcrypt($request->password),
            'status' =>1
        ]);

        //添加角色
        if($request->roles){
            $user->attachRole($request->roles);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find((int)$id);
        $roles = Role::where('status','=','1')->get();

        return view('admin.user.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //获取要修改的用户
        $user = User::find((int)$id);
        //判断密码是否为空 如果不为空就修改密码
        if($request->password !=''){
            $user->password = bcrypt($request->password);
        }
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->description = trim($request->description);
        $user->save();

        //权限处理

        $user->roles()->detach();

        if($request->roles){
            $user->attachRole($request->roles);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id != 1 && !empty($id)){
            $user = User::find((int)$id);
            $user->roles()->detach();
            $user->delete();
        }
    }
}
