<ul>
    @foreach ($permissions as $permission)
        <li class="list-group-item">{{ $permission->display_name }} <a class="btn btn-sm btn-success" href="{{ url('permissions/'.$permission->id.'/edit') }}"><i class="fa fa-edit"></i> {{ __('navigation.edit') }}</a> <form class='form-horizontal' style='display: inline;' method='POST' action="{{url('permissions/'.$permission->id)}}"><input type='hidden' name='_token' value='{{csrf_token()}}'><input type='hidden' name='_method' value='DELETE'><button class='btn btn-sm btn-danger' type='submit'><i class='fas fa-trash'></i> {{ __('navigation.delete') }}</button><form></li>
        <ul>
        @foreach ($permission->childrenPermissions as $childPermission)
            @include('permission::layouts.child_permission', ['child_permission' => $childPermission])
        @endforeach
        </ul>
    @endforeach
</ul>