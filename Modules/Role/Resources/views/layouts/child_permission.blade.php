<li style="list-style: none;">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="permission_id[]" value="{{$child_permission->id}}" @if(in_array($child_permission->id, $permission_ids)) checked @endif>
        <label class="form-check-label">{{$child_permission->display_name}}</label>
    </div>
</li>
@if ($child_permission->permissions->count() > 0)
    <ul>
        @foreach ($child_permission->permissions as $childPermission)
            @include('role::layouts.child_permission', ['child_permission' => $childPermission])
        @endforeach
    </ul>
@endif