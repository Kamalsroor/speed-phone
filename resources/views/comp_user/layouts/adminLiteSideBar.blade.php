<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{ active_link_company('dashboard') . active_link_company('', false) }}"><a href="{{curl('dashboard')}}"><i class="fa fa-dashboard"></i> <span> Dashboard</span></a></li>
    @cadmin
        <li class="{{ active_link_company('c_users') }}"><a href="{{curl('c_users')}}"><i class="fa fa-users"></i> <span> Users</span></a></li>
    @endcadmin
    <li class="{{ active_link_company('account_types') }}"><a href="{{curl('account_types')}}"><i class="fa fa-credit-card-alt"></i> <span> Accounting Types</span></a></li>
    <li class="{{ active_link_company('sub_accounts') }}"><a href="{{curl('sub_accounts')}}"><i class="fa fa-window-restore"></i> <span> Sub Accounts</span></a></li>
    <li class="{{ active_link_company('transitions') . active_link_company('transition_details') }} treeview">
        <a href="{{ curl('transitions') }}">
            <i class="fa fa-money"></i> <span>Transitions</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ active_link_company('transitions/create', false) }}"><a href="{{ curl('transitions/create') }}"><i class="fa fa-plus"></i> Add Transition</a></li>
            <li class="{{ active_link_company('transitions', false) }}"><a href="{{ curl('transitions') }}"><i class="fa fa-money"></i> Transitions</a></li>
            <li class="{{ active_link_company('transition_details') }}"><a href="{{ curl('transition_details') }}"><i class="fa fa-eye"></i> Transition Details</a></li>
        </ul>
    </li>
</ul>
