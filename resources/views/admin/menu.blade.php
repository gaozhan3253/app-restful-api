
<!--_menu 作为公共模版分离出去-->
<aside class="Hui-aside">

    <div class="menu_dropdown bk_2">

        <dl id="menu-product">
            <dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="{{url('admin/category')}}" title="分类管理">分类管理</a></li>
                    <li><a href="{{url('admin/good')}}" title="产品管理">产品管理</a></li>
                </ul>
            </dd>
        </dl>

        <dl id="menu-member">
            <dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="{{url('admin/member')}}" title="会员列表">会员列表</a></li>
                </ul>
            </dd>
        </dl>

        <dl id="menu-admin">
            <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="{{url('admin/role')}}" title="角色管理">角色管理</a></li>
                    <li><a href="{{url('admin/permission')}}" title="权限管理">权限管理</a></li>
                    <li><a href="{{url('admin/user')}}" title="管理员列表">管理员列表</a></li>
                </ul>
            </dd>
        </dl>

    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->
