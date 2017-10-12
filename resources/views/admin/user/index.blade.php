@extends('admin.base')
@section('body')
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span
                    class="c-gray en">&gt;</span> 管理员管理 <a class="btn btn-success radius r"
                                                          style="line-height:1.6em;margin-top:3px"
                                                          href="javascript:location.replace(location.href);" title="刷新"><i
                        class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">
            <article class="cl pd-20">
                <div class="cl pd-5 bg-1 bk-gray"><span class="l">
                        <a class="btn btn-primary radius" href="javascript:;" onclick="admin_user_add('添加管理员','{{url('/admin/user/create')}}','800')">
                            <i class="Hui-iconfont">&#xe600;</i> 添加管理员</a>
                    </span> <span
                            class="r">共有数据：<strong>{{count($users)}}</strong> 条</span></div>
                <div class="mt-10">
                    <table class="table table-border table-bordered table-hover table-bg">
                        <thead>
                        <tr>
                            <th scope="col" colspan="9">管理员管理</th>
                        </tr>
                        <tr class="text-c">
                            <th width="25"><input type="checkbox" value="" name=""></th>
                            <th width="40">ID</th>
                            <th width="200">账号</th>
                            <th width="200">昵称</th>
                            <th width="300">邮箱</th>
                            <th width="300">角色</th>
                            <th width="300">状态</th>
                            <th width="300">最后登录时间</th>
                            <th width="70">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr class="text-c">
                                <td><input type="checkbox" value="" name=""></td>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->nickname}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        |{{$role->name}}
                                    @endforeach
                                </td>
                                <td class="td-status">
                                    @if($user->status == 1)
                                        <span class="label label-success radius">已启用</span>
                                    @else
                                        <span class="label radius">已停用</span>
                                    @endif
                                </td>


                                <td>{{$user->updated_at}}</td>

                                <td class="f-14"><a title="编辑" href="javascript:;"
                                                    onclick="admin_user_edit('管理员编辑','{{url('/admin/user/'.$user->id.'/edit')}}','1')"
                                                    style="text-decoration:none"><i class="Hui-iconfont">
                                            &#xe6df;</i></a>
                                    @if($user->id != 1)
                                    <a title="删除" href="javascript:;" onclick="admin_user_del(this,'{{$user->id}}')" class="ml-5"  style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
            </article>
        </div>
    </section>


    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="{{asset('lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/laypage/1.2/laypage.js')}}"></script>


    <script type="text/javascript">
        /*管理员-管理员-添加*/
        function admin_user_add(title,url,w,h){
            layer_show(title,url,w,h);
        }
        /*管理员-管理员-编辑*/
        function admin_user_edit(title,url,id,w,h){
            layer_show(title,url,w,h);
        }
        /*管理员-管理员-删除*/
        function admin_user_del(obj,id){
            layer.confirm('管理员删除须谨慎，确认要删除吗？',function(index){
                //此处请求后台程序，下方是成功后的前台处理……
                $.ajax({
                    url:'{{url('/admin/user')}}/'+id,
                    type:'delete',
                    data:{_token:'{{csrf_token()}}'},
                    success:function (data) {
                        layer.msg('已删除!', {icon: 1, time: 1000});
                        $(obj).parents("tr").remove();
                    },

                })
            });
        }
    </script>
    <!--/请在上方写此页面业务相关的脚本-->

@endsection
