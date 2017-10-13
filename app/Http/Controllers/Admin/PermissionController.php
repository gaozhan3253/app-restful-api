<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\adminPermissionPost;
use App\models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * 权限列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::get();
        $permissions = cidSort($permissions);
        return view('admin.permission.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        $permissions = cidSort($permissions);
        return view('admin.permission.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(adminPermissionPost $request)
    {

        $permission = Permission::create([
            'name'=>$request->name,
            'label'=>$request->label,
            'description'=>$request->description,
            'cid'=>$request->cid,
            'status' =>1,
        ]);
        return $permission;
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
        $permissions = Permission::get();
        $permissions = cidSort($permissions);
        $result = Permission::find($id);
        return view('admin.permission.edit',compact('permissions','result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(adminPermissionPost $request, $id)
    {
        //获取要修改的用户
        $permission = Permission::find((int)$id);
        $permission->cid = $request->cid;
        $permission->name = $request->name;
        $permission->label = $request->label;
        $permission->description = trim($request->description);
        $permission->save();

        return $permission;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::find((int)$id);
        $permission->delete();
    }
}
