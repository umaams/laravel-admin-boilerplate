@foreach ($permissions as $permission)
    <option value="{{$permission->id}}">{{$permission->display_name}}</option>
    @foreach ($permission->childrenPermissions as $childPermission)
        @include('menu::layouts.child_permission', ['child_permission' => $childPermission])
    @endforeach
@endforeach