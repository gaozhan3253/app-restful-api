@extends('admin.base')
@section('body')
    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span
                    class="c-gray en">&gt;</span> 产品分类管理 <a class="btn btn-success radius r"
                                                          style="line-height:1.6em;margin-top:3px"
                                                          href="javascript:location.replace(location.href);" title="刷新"><i
                        class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">
            <article class="cl pd-20">
                <div class="cl pd-5 bg-1 bk-gray"><span class="l"><a href="javascript:;"
                                                                                  onclick="admin_category_add('添加分类','{{url('admin/category/create')}}','','310')"
                                                                                  class="btn btn-primary radius"><i
                                    class="Hui-iconfont">&#xe600;</i> 添加分类</a></span> <span
                            class="r">共有数据：<strong>{{count($categorys)}}</strong> 条</span></div>
                <table class="table table-border table-bordered table-bg">
                    <thead>
                    <tr>
                        <th scope="col" colspan="7">权限节点</th>
                    </tr>
                    <tr class="text-c">
                        <th width="25"><input type="checkbox" name="" value=""></th>
                        <th width="40">ID</th>
                        <th>分类名</th>
                        <th>状态</th>
                        <th width="100">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categorys as $category)
                        <tr class="text-c">
                            <td><input type="checkbox" value="1" name=""></td>
                            <td>{{$category->id}}</td>
                            <td  style="text-align: left;">|@for($i =$category->key;$i>1;$i--) ---- @endfor{{$category->name}}</td>
                            <td  style="text-align: left;">
                                @if($category->status == 1)
                                    <span class="label label-success radius">已启用</span>
                                @else
                                    <span class="label radius">已停用</span>
                                @endif
                            </td>

                            <td><a title="编辑" href="javascript:;"
                                   onclick="admin_category_edit('分类编辑','{{url('/admin/category/'.$category->id.'/edit')}}','1','','310')"
                                   class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a
                                        title="删除" href="javascript:;" onclick="admin_category_del(this,'{{$category->id}}')"
                                        class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">
                                        &#xe6e2;</i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </article>
        </div>
    </section>


    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
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
        function admin_category_add(title, url, w, h) {
            layer_show(title, url, w, h);
        }
        /*管理员-权限-编辑*/
        function admin_category_edit(title, url, id, w, h) {
            layer_show(title, url, w, h);
        }

        /*管理员-权限-删除*/
        function admin_category_del(obj, id) {
            layer.confirm('权限删除须谨慎，确认要删除吗？', function (index) {
               $.ajax({
                   url:'{{url('/admin/category')}}/'+id,
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