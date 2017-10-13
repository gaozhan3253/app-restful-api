@extends('admin.base')
@section('body')
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span
                    class="c-gray en">&gt;</span> 产品管理 <a class="btn btn-success radius r"
                                                          style="line-height:1.6em;margin-top:3px"
                                                          href="javascript:location.replace(location.href);" title="刷新"><i
                        class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">
            <article class="cl pd-20">
                <div class="cl pd-5 bg-1 bk-gray"><span class="l"><a href="javascript:;"
                                                                                  onclick="admin_good_add('添加产品','{{url('/admin/good/create')}}','','610')"
                                                                                  class="btn btn-primary radius"><i
                                    class="Hui-iconfont">&#xe600;</i> 添加产品</a></span> <span
                            class="r">共有数据：<strong>{{count($goods)}}</strong> 条</span></div>
                <table class="table table-border table-bordered table-bg">
                    <thead>
                    <tr>
                        <th scope="col" colspan="9">产品</th>
                    </tr>
                    <tr class="text-c">
                        <th width="25"><input type="checkbox" name="" value=""></th>
                        <th width="10">ID</th>
                        <th width="60">产品栏目</th>
                        <th>产品名称</th>
                        <th width="100">库存</th>
                        <th width="100">售价</th>
                        <th width="100">销量</th>
                        <th width="100">状态</th>
                        <th width="100">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($goods as $good)
                        <tr class="text-c">
                            <td><input type="checkbox" value="1" name=""></td>
                            <td>{{$good->id}}</td>
                            <td  style="text-align: left;">{{$good->name}}</td>
                            <td  style="text-align: left;">{{$good->category->name}}</td>
                            <td>{{$good->stock}}</td>

                            <td>{{$good->price}}</td>
                            <td>{{$good->sales}}</td>
                            <td>
                                @if($good->status == 1)
                                    <span class="label label-success radius">已启用</span>
                                @else
                                    <span class="label radius">已停用</span>
                                @endif
                            </td>

                            <td><a title="编辑" href="javascript:;"
                                   onclick="admin_good_edit('角色编辑','{{url('/admin/good/'.$good->id.'/edit')}}','1','','310')"
                                   class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a
                                        title="删除" href="javascript:;" onclick="admin_good_del(this,'{{$good->id}}')"
                                        class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">
                                        &#xe6e2;</i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $goods->links('vendor.pagination.bootstrap-4') }}
            </article>
        </div>
    </section>


    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="{{asset('lib/My97DatePicker/4.8/WdatePicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/datatables/1.10.0/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('lib/laypage/1.2/laypage.js')}}"></script>
    <script type="text/javascript">
        /*
         参数解释：
         title	标题
         url		请求的url
         id		需要操作的数据id
         w		弹出层宽度（缺省调默认值）
         h		弹出层高度（缺省调默认值）
         */
        /*管理员-权限-添加*/
        function admin_good_add(title, url, w, h) {
            layer_show(title, url, w, h);
        }
        /*管理员-权限-编辑*/
        function admin_good_edit(title, url, id, w, h) {
            layer_show(title, url, w, h);
        }

        /*管理员-权限-删除*/
        function admin_good_del(obj, id) {
            layer.confirm('产品删除须谨慎，确认要删除吗？', function (index) {
               $.ajax({
                   url:'{{url('/admin/good')}}/'+id,
                   type:'delete',
                   data:{_token:'{{csrf_token()}}'},
                   success:function (data) {
                       layer.msg('已删除!', {icon: 1, time: 1000});
                       $(obj).parents("tr").remove();
                   }
               })
            });
        }
    </script>
    <!--/请在上方写此页面业务相关的脚本-->
@endsection