@foreach($items as $item)
  <li class="nav-item @if($item->hasChildren()){{'dropdown'}}@endif">
    @if($item->link) <a class="nav-link @if($item->hasChildren()){{'dropdown-toggle'}}@endif" @if($item->url()) href="{!! $item->url() !!}" @else href="#" @endif>
      {!! $item->title !!}
      @if($item->hasChildren()) <b class="caret"></b> @endif
    </a>
    @else
      <span class="navbar-text">{!! $item->title !!}</span>
    @endif
    @if($item->hasChildren())
      <ul class="dropdown-menu">
        @include(config('laravel-menu.views.bootstrap-subitems'),
array('items' => $item->children()))
      </ul>
    @endif
  </li>
  @if($item->divider)
  	<li{!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>
  @endif
@endforeach
