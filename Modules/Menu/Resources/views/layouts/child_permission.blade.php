<option value="{{$child_permission->id}}">{{$child_permission->display_name}}</option>
@if ($child_permission->permissions->count() > 0)
    @include('menu::layouts.child_permission', ['child_permission' => $childPermission])
@endif