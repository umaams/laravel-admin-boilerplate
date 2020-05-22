@foreach($items as $item)
  <li>
    @if($item->link) <a class="dropdown-item @if($item->hasChildren()){{'dropdown-toggle'}}@endif" @if($item->url()) href="{!! $item->url() !!}" @else href="#" @endif>
      @if (!empty($item->data('icon'))) <i class="{{$item->data('icon')}}"></i> @endif {!! $item->title !!}
      @if($item->hasChildren()) <b class="caret"></b> @endif
    </a>
    @else
      <span class="navbar-text">@if (!empty($item->data('icon'))) <i class="{{$item->data('icon')}}"></i> @endif {!! $item->title !!}</span>
    @endif
    @if($item->hasChildren())
      <ul class="dropdown-menu">
        @include(config('laravel-menu.views.bootstrap-items'),
array('items' => $item->children()))
      </ul>
    @endif
  </li>
  @if($item->divider)
  	<li{!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>
  @endif
@endforeach
