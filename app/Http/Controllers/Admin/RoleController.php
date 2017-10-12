<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\adminRolePost;
use App\models\Permission;
use App\models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::get();
        return view('admin.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::where('status','=','1')->get();
        return view('admin.role.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(adminRolePost $request)
    {
        $name = $request->input('name','');
        $description = $request->input('description','');
        $permission = $request->input('permission');
        //添加角色
        $role = Role::create([
            'name'=>$name,
            'description'=>$description,
            'status' =>1
        ]);
        //添加权限
        if($request->permission){
            $role->attachPermissions($request->permission);
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
        $role = Role::find($id);
        $permissions = Permission::where('status','=','1')->get();
        return view('admin.role.edit',compact('role','permissions'));
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
        //添加角色
        $role = Role::find((int)$id);
        $role->name =$request->name;
        $role->description =$request->description;
        $role->save();

        $role->savePermissions($request->permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find((int)$id);
        //\vendor\zizaco\entrust\src\Entrust\Traits\EntrustRoleTrait.php
        //bug 直接用会报错  修改EntrustRoleTrait 51行的Config::get('auth.model') 改为 Config::get('auth.providers.users.model')

        $role->delete();
    }
}
