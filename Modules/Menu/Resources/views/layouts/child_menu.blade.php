<li class="list-group-item">{{ $child_menu->name }} <a class="btn btn-sm btn-success" href="{{ url('menus/'.$child_menu->id.'/edit') }}"><i class="fa fa-edit"></i> {{ __('navigation.edit') }}</a> <form class='form-horizontal' style='display: inline;' method='POST' action="{{url('menus/'.$child_menu->id)}}"><input type='hidden' name='_token' value='{{csrf_token()}}'><input type='hidden' name='_method' value='DELETE'><button class='btn btn-sm btn-danger' type='submit'><i class='fas fa-trash'></i> {{ __('navigation.delete') }}</button><form></li>
@if ($child_menu->menus)
    <ul>
        @foreach ($child_menu->menus as $childMenu)
            @include('menu::layouts.child_menu', ['child_menu' => $childMenu])
        @endforeach
    </ul>
@endif