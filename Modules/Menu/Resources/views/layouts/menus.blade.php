<ul>
    @foreach ($menus as $menu)
        <li class="list-group-item">{{ $menu->name }} <a class="btn btn-sm btn-success" href="{{ url('menus/'.$menu->id.'/edit') }}"><i class="fa fa-edit"></i> {{ __('navigation.edit') }}</a> <form class='form-horizontal' style='display: inline;' method='POST' action="{{url('menus/'.$menu->id)}}"><input type='hidden' name='_token' value='{{csrf_token()}}'><input type='hidden' name='_method' value='DELETE'><button class='btn btn-sm btn-danger' type='submit'><i class='fas fa-trash'></i> {{ __('navigation.delete') }}</button><form></li>
        <ul>
        @foreach ($menu->childrenMenus as $childMenu)
            @include('menu::layouts.child_menu', ['child_menu' => $childMenu])
        @endforeach
        </ul>
    @endforeach
</ul>