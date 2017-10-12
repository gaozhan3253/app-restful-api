
<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
    @include('admin.guide')

</head>
<body>
<article class="cl pd-20">
    <form action="{{url('/admin/user/'.$user->id)}}" method="post" class="form form-horizontal" id="form-admin-add">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put" />

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$user->name}}" disabled placeholder="" id="name" name="name">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">初始密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="password" class="input-text" autocomplete="off"  placeholder="密码" id="password" name="password">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">确认密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" id="password2" name="password2">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>昵称：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="{{$user->nickname}}" placeholder="" id="nickname" name="nickname">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text"  value="{{$user->mobile}}"  placeholder="" id="mobile" name="mobile">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text"  value="{{$user->email}}"  placeholder="@" name="email" id="email">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">角色：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
				<select class="select" name="roles" size="1">
					@foreach($roles as $role)
					<option value="{{$role->id}}" @if($user->hasRole($role->name)) selected  @endif >{{$role->name}}</option>
                        @endforeach
				</select>
				</span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">备注：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea name="description" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="textarealength(this,100)">
                    {{$user->description}}
                </textarea>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
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
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-admin-add").validate({
            rules:{

                nickname:{
                    required:true,
                    minlength:1,
                    maxlength:30
                },

                password2:{
                    equalTo: "#password"
                },
                mobile:{
                    required:true,
                    isPhone:true,
                },
                email:{
                    required:true,
                    email:true,
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
                        parent.$('.btn-refresh').click();
                        parent.layer.close(index);
                    },
                    error:function (error) {
                        layer.msg('提交失败！');
                    }
                });

            }
        });
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>