@extends('layouts.app')

@section('title')
@lang('menu::label.title_view')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@yield('title')</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a role="button" class="btn btn-primary" href="{{ url('menus/create') }}"><i class="fas fa-plus-circle"></i> {{ __('navigation.add_new') }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            @include('menu::layouts.menus', ['menus' => $menus])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection