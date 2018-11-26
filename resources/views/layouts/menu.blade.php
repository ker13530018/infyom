<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

<li class="{{ Request::is('userRoles*') ? 'active' : '' }}">
    <a href="{!! route('userRoles.index') !!}"><i class="fa fa-edit"></i><span>User Roles</span></a>
</li>

<li class="{{ Request::is('contents*') ? 'active' : '' }}">
    <a href="{!! route('contents.index') !!}"><i class="fa fa-edit"></i><span>Contents</span></a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>

