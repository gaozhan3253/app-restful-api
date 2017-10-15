@extends('admin.base')
@section('body')

    <section class="Hui-article-box">
        <nav class="breadcrumb"><i class="Hui-iconfont"></i> <a href="/" class="maincolor">首页</a>
            <span class="c-999 en">&gt;</span>
            <span class="c-666">我的桌面</span>
            <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
        <div class="Hui-article">
            <article class="cl pd-20">
                <p class="f-20 text-success">欢迎使用H-ui.admin
                    <span class="f-14">v2.3</span>
                    后台模版！</p>
                <p>登录次数：18 </p>
                <p>上次登录IP：222.35.131.79.1  上次登录时间：2014-6-14 11:19:55</p>
        <form action="{{url('api/uploadfile')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="file" name="filename">
            <button type="submit"> 提交 </button>
        </form>
            </article>
            <footer class="footer">
                <p>感谢jQuery、layer、laypage、Validform、UEditor、My97DatePicker、iconfont、Datatables、WebUploaded、icheck、highcharts、bootstrap-Switch<br> Copyright &copy;2015 H-ui.admin v3.0 All Rights Reserved.<br> 本后台系统由<a href="http://www.h-ui.net/" target="_blank" title="H-ui前端框架">H-ui前端框架</a>提供前端技术支持</p>
            </footer>
        </div>
    </section>

@endsection