<ul>
    @foreach ($permissions as $permission)
        <li style="list-style: none;">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permission_id[]" value="{{$permission->id}}" @if(in_array($permission->id, $permission_ids)) checked @endif>
                <label class="form-check-label">{{$permission->display_name}}</label>
            </div>
        </li>
        <ul>
        @foreach ($permission->childrenPermissions as $childPermission)
            @include('role::layouts.child_permission', ['child_permission' => $childPermission])
        @endforeach
        </ul>
    @endforeach
</ul>