
<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
    @include('admin.guide')
</head>
<body>
<article class="cl pd-20">
    <form action="{{url('/admin/category')}}" method="post" class="form form-horizontal" id="form-admin-role-add">
    {{csrf_field()}}
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>上级栏目：</label>
            <div class="formControls col-xs-8 col-sm-9">
               <span class="select-box" style="width:150px;">
				<select class="select valid" name="cid" size="1" aria-required="true" aria-invalid="false">
					<option value="0">根目录</option>
                    @foreach($categorys as $category)
                        <option value="{{$category->id}}">|@for($i =$category->key;$i>1;$i--) ---- @endfor{{$category->name}}</option>
                    @endforeach
				</select>
                   <label id="adminRole-error" class="error valid" for="adminRole"></label>
				</span>
            </div>
        </div>


        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"> 栏目名称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="name" name="name" datatype="*4-16" nullmsg="栏目名称不能为空">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">备注：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="" name="description">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"> 排序：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text"   id="sort" name="sort" datatype="*4-16" value="0">
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
            </div>
        </div>
    </form>
</article>

@include('admin.footer')


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('lib/jquery.validation/1.14.0/jquery.validate.js')}}"></script>
<script type="text/javascript" src="{{asset('lib/jquery.validation/1.14.0/validate-methods.js')}}"></script>
<script type="text/javascript" src="{{asset('lib/jquery.validation/1.14.0/messages_zh.js')}}"></script>
<script type="text/javascript">
    $(function(){
        $(".category-list dt input:checkbox").click(function(){
            $(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
        });
        $(".category-list2 dd input:checkbox").click(function(){
            var l =$(this).parent().parent().find("input:checked").length;
            var l2=$(this).parents(".category-list").find(".category-list2 dd").find("input:checked").length;
            if($(this).prop("checked")){
                $(this).closest("dl").find("dt input:checkbox").prop("checked",true);
                $(this).parents(".category-list").find("dt").first().find("input:checkbox").prop("checked",true);
            }
            else{
                if(l==0){
                    $(this).closest("dl").find("dt input:checkbox").prop("checked",false);
                }
                if(l2==0){
                    $(this).parents(".category-list").find("dt").first().find("input:checkbox").prop("checked",false);
                }
            }
        });

        $("#form-admin-role-add").validate({
            rules:{
                name:{
                    required:true,
                },
            },
            onkeyup:false,
            focusCleanup:true,
            success:"valid",
            submitHandler:function(form){
                $(form).ajaxSubmit({
                    success:function (data) {
                        window.parent.location.reload(); //刷新父页面
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                    },
                    error:function (error) {
                        layer.msg('提交失败！');
                    }
                });

            },

        });
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>