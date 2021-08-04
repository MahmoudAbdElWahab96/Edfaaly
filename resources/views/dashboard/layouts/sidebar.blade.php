<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" style="margin-top: 50px">
            <li class="{{ Request::route()->getName() ==  'dashboard.index' ? 'active' : '' }}">
                <a href="{{route('dashboard.index')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            @if(auth()->user()->hasPermission('read_users'))
                <li class="{{ Request::route()->getName() == 'dashboard.get-all-users' ? 'active' : '' }}">
                    <a href="{{route('dashboard.get-all-users')}}">
                        <i class="fa fa-user"></i> <span>Users</span>
                    </a>
                </li>
                <li class="{{ Request::route()->getName() == 'dashboard.products.getIndex' ? 'active' : '' }}">
                    <a href="{{route('dashboard.products.getIndex')}}">
                        <i class="fa fa-product"></i> <span>Products</span>
                    </a>
                </li>
            @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
