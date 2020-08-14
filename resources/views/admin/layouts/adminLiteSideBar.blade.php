<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ active_link('dashboard') . active_link('', false) }}"><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    @can('users_manage')
    
    <li class="{{ active_link('users')  . active_link('permissions')  . active_link('roles')}} treeview">
        <a href="{{ url('#') }}">
            <i class="fa fa-users"></i> <span> الاعضاء</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            
            @can('الاعضاء')
            <li class="{{ active_link('users') . active_link('users/create') }} treeview">
            <a href="{{ url('#') }}">
                <i class="fa fa-users"></i> <span> الاعضاء</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ active_link('users') }}"><a href="{{ url('users') }}"><i class="fa fa-users"></i> جميع الاعضاء</a></li>
                <li class="{{ active_link('users/create', false) }}"><a href="{{ url('users/create') }}"><i class="fa fa-plus"></i>  اضافه عضو جديد </a></li>
            </ul>
        </li>
        @endcan
        <li class="{{ active_link('permissions') . active_link('permissions/create') }} treeview">
        <a href="{{ url('#') }}">
            <i class="fa fa-users"></i> <span> الصلاحيات</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ active_link('permissions') }}"><a href="{{ url('permissions') }}"><i class="fa fa-users"></i> جميع الصلاحيات</a></li>
            <li class="{{ active_link('permissions/create', false) }}"><a href="{{ url('permissions/create') }}"><i class="fa fa-plus"></i>  اضافه صلاحيه جديده </a></li>
        </ul>
    </li>
    @can('المجموعات')
    <li class="{{ active_link('roles') . active_link('roles/create') }} treeview">
    <a href="{{ url('#') }}">
        <i class="fa fa-users"></i> <span> المجموعات</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ active_link('roles') }}"><a href="{{ url('roles') }}"><i class="fa fa-users"></i> جميع المجموعات</a></li>
                  <li class="{{ active_link('roles/create', false) }}"><a href="{{ url('roles/create') }}"><i class="fa fa-plus"></i>  اضافه مجموعة جديده </a></li>
                </ul>
            </li>
            @endcan
        </ul>
    </li>
    @endcan
    @can('Account_Types')

    <li class="{{ active_link('companies') }}"><a href="{{url('companies')}}"><i class="fa fa-building-o"></i> <span>Companies</span></a></li>
    @endcan
    
    @can('شحن')
    <li class="{{ active_link('permissionex') . active_link('permissionent'). active_link('permissionexing') }} treeview">
        <a href="{{ url('permissionex') }}">
            <i class="fa fa-address-card-o"></i> <span>اذون شحن</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @can('اذون خروج شحن' )
            <li class="{{ active_link('permissionex') . active_link('c_users') }} treeview">
                <a href="{{ url('permissionex') }}">
                    <i class="fa fa-address-card-o"></i> <span> طلب صرف شحن</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ active_link('permissionex/create', false) }}"><a href="{{ url('permissionex/create') }}"><i class="fa fa-plus"></i> اضافه طلب </a></li>
                </ul>
            </li>
            @endcan
            @can('استلام طلبات شحن')
            <li class="{{ active_link('permissionex') }}"><a href="{{ url('permissionex') }}"><i class="fa fa-users"></i> استلام طلبات شحن </a></li>
           @endcan
            @can('طلبات تسليم شحن')
            <li class="{{ active_link('permissionexing') }}"><a href="{{ url('permissionexing') }}"><i class="fa fa-users"></i> اذون صرف الشحن</a></li>
           @endcan
            @can('اذون اضافه شحن' )
            <li class="{{ active_link('permissionent') . active_link('c_users') }} treeview">
                <a href="{{ url('permissionent') }}">
                    <i class="fa fa-address-card-o"></i> <span>تجهيز استلام</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ active_link('permissionent') }}"><a href="{{ url('permissionent') }}"><i class="fa fa-users"></i> جميع الاذون</a></li>
                    @can('التحكم في اذون استلام الشحن' )
                    
                    <li class="{{ active_link('permissionent/create', false) }}"><a href="{{ url('permissionent/create') }}"><i class="fa fa-plus"></i> اضافه اذن </a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('اذون شحن استلام')
            <li class="{{ active_link('permissionenting') }}"><a href="{{ url('permissionenting') }}"><i class="fa fa-users"></i> طلبات استلام الشحن</a></li>
           @endcan
        </ul>
    </li>
    @endcan
    @can('تجاره' )

    <li class="{{   active_link('inventoryacc') . active_link('inventory'). active_link('accountcustomers'). active_link('inventorytype') }} treeview">
        <a href="{{ url('companies_users') }}">
            <i class="fa fa-address-card-o"></i> <span> الارصده</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
    @can('جرد تجاره' )
    
    <li class="{{ active_link('inventory') }}"><a href="{{ url('inventory') }}"><i class="fa fa-users"></i> جرد الموبيلات</a></li>
    <li class="{{ active_link('inventoryacc') }}"><a href="{{ url('inventoryacc') }}"><i class="fa fa-users"></i> جرد الاكسسورات</a></li>
    @endcan
    @can('جرد شحن' )
    
    <li class="{{ active_link('inventorytype') }}"><a href="{{ url('inventorytype') }}"><i class="fa fa-users"></i> جرد اصناف شحن</a></li>
    @endcan
    @can('حسابات العملاء' )

    <li class="{{ active_link('accountcustomers') }}"><a href="{{url('accountcustomers')}}"><i class="fa fa-dashboard"></i> <span>حسابات عملاء الشحن   </span></a></li>

    @endcan
        </ul>
    </li>
    @endcan


       @can('مبيعات' )

<li class="{{ active_link('prometerrequests') .active_link('prometer') .active_link('prometerfinsh')}} treeview">
    <a href="">
        <i class="fa fa-address-card-o"></i> <span> طلبات مبيعات</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">

    @can('اضافه طلب مبيعات')
    <li class="{{ active_link('prometerrequests') }}"><a href="{{ url('prometerrequests') }}"><i class="fa fa-users"></i> جميع الطلبات</a></li>
    <li class="{{ active_link('prometerrequests/create') }}"><a href="{{ url('prometerrequests/create') }}"><i class="fa fa-users"></i> طلب مبيعات جديد</a></li>
    @endcan
    @can('استلام طلب مبيعات')
    <li class="{{ active_link('prometer') }}"><a href="{{ url('prometer') }}"><i class="fa fa-users"></i>استلام طلبات مبيعات</a></li>
    @endcan
    @can('قبول طلبات بيع')
    <li class="{{ active_link('prometerfinsh') }}"><a href="{{ url('prometerfinsh') }}"><i class="fa fa-users"></i>قبول طلبات بيع</a></li>
    @endcan
    </ul>
</li>
@endcan

    @can('تكويد' )

<li class="{{ active_link('mobilats') . active_link('acc'). active_link('customers') .active_link('typeofproduct') .active_link('customersfreight') }} treeview">
    <a href="{{ url('companies_users') }}">
        <i class="fa fa-address-card-o"></i> <span> تكويد</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">

    @can('اضافه منتجات تجاره')
        <li class="{{ active_link('mobilats') }}"><a href="{{ url('mobilats') }}"><i class="fa fa-users"></i> اصناف موبيلات</a></li>
        <li class="{{ active_link('acc') }}"><a href="{{ url('acc') }}"><i class="fa fa-users"></i> اصناف اكسسورات</a></li>
        <li class="{{ active_link('typeofproduct') }}"><a href="{{ url('typeofproduct') }}"><i class="fa fa-users"></i> اصناف شحن</a></li>
        @endcan
        @can('تكويد عملاء')
        <li class="{{ active_link('customers') }}"><a href="{{ url('customers') }}"><i class="fa fa-users"></i> عملاء تجاره</a></li>
        <li class="{{ active_link('customersfreight') }}"><a href="{{ url('customersfreight') }}"><i class="fa fa-users"></i>عملاء شحن</a></li>
        @endcan
    </ul>
</li>
@endcan

        @can('اذون تجاره')
    <li class="{{ active_link('mobilatsex') . active_link('mobilatsent'). active_link('Search'). active_link('Searchent'). active_link('accessoriesex'). active_link('accessoriesent') }} treeview">
        <a href="{{ url('#') }}">
            <i class="fa fa-address-card-o"></i> <span>اذون تجاره</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @can('اذون صرف تجاره' )
            <li class="{{ active_link('mobilatsex') . active_link('mobilatsex/create'). active_link('accessoriesex') }} treeview">
                <a href="{{ url('#') }}">
                    <i class="fa fa-address-card-o"></i> <span> اذون صرف</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ active_link('mobilatsex') }}"><a href="{{ url('mobilatsex') }}"><i class="fa fa-users"></i> جميع الاذون</a></li>
                    @can('اضافه اذون صرف تجاره' )
                    <li class="{{ active_link('mobilatsex/create', false) }}"><a href="{{ url('mobilatsex/create') }}"><i class="fa fa-plus"></i> اضافه اذن موبيلات جديد </a></li>
                    <li class="{{ active_link('accessoriesex/create', false) }}"><a href="{{ url('accessoriesex/create') }}"><i class="fa fa-plus"></i> اضافه اذن اكسسورات جديد </a></li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('اذون توريد تجاره' )
            <li class="{{ active_link('mobilatsent') . active_link('mobilatsent/create') . active_link('accessoriesent') }} treeview">
                <a href="{{ url('#') }}">
                    <i class="fa fa-address-card-o"></i> <span> اذون توريد / مرتجع</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ active_link('mobilatsent') }}"><a href="{{ url('mobilatsent') }}"><i class="fa fa-users"></i> جميع الاذون</a></li>
                    @can('اضافه اذون توريد تجاره' )
                    
                    <li class="{{ active_link('mobilatsent/create', false) }}"><a href="{{ url('mobilatsent/create') }}"><i class="fa fa-plus"></i>  اضافه اذن موبيلات جديد </a></li>
                    <li class="{{ active_link('accessoriesent/create', false) }}"><a href="{{ url('accessoriesent/create') }}"><i class="fa fa-plus"></i> اضافه اذن اكسسورات جديد </a></li>
                    @endcan
                </ul>
            </li>
            @endcan
                    @can('بحث' )
            <li class="{{ active_link('Search')  . active_link('Searchent') }} treeview">
                <a href="{{ url('#') }}">
                    <i class="fa fa-address-card-o"></i> <span> بحث</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ active_link('Search') }}"><a href="{{ url('Search') }}"><i class="fa fa-users"></i>بحث</a></li>
                </ul>
            </li>
                    @endcan
        </ul>
    </li>
    @endcan
    <li class=""><a href="https://main.sp-cargo.com"><i class="fa fa-dashboard"></i> <span>سيستم الصيانة</span></a></li>


</ul>
