<li class="list-group-item">{{ $child_permission->display_name }} <a class="btn btn-sm btn-success" href="{{ url('permissions/'.$child_permission->id.'/edit') }}"><i class="fa fa-edit"></i> {{ __('navigation.edit') }}</a> <form class='form-horizontal' style='display: inline;' method='POST' action="{{url('permissions/'.$child_permission->id)}}"><input type='hidden' name='_token' value='{{csrf_token()}}'><input type='hidden' name='_method' value='DELETE'><button class='btn btn-sm btn-danger' type='submit'><i class='fas fa-trash'></i> {{ __('navigation.delete') }}</button><form></li>
@if ($child_permission->permissions)
    <ul>
        @foreach ($child_permission->permissions as $childPermission)
            @include('role::layouts.child_permission', ['child_permission' => $childPermission])
        @endforeach
    </ul>
@endif