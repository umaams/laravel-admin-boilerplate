@extends('layouts.app')

@section('title')
@lang('menu::label.title_edit')
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
                            <form method="post" action="{{ url('menus/'.$menu->id) }}"  autocomplete="off">
                                @csrf
                                @method("PUT")
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">@lang('menu::label.name')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.input_text', ['name' => 'name', 'value' => $menu->name, 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'name']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="link" class="col-sm-2 col-form-label">@lang('menu::label.link')</label>
                                    <div class="col-sm-3">
                                        @component('components.form.input_text', ['name' => 'link', 'value' => $menu->link, 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'link']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fa_class" class="col-sm-2 col-form-label">@lang('menu::label.fa_class')</label>
                                    <div class="col-sm-2">
                                        @component('components.form.input_text', ['name' => 'fa_class', 'value' => $menu->fa_class]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'fa_class']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="parent_menu_id" class="col-sm-2 col-form-label">@lang('menu::label.parent_menu_id')</label>
                                    <div class="col-sm-5">
                                        <select name="parent_menu_id" class="form-control">
                                            <option value="0" data-name="" @if ($menu->parent_menu_id == '0') selected @endif>Main Permission</option>
                                            @foreach ($menus as $value)
                                            <option value="{{$value->id}}" @if ($menu->parent_menu_id == $value->id) selected @endif>{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'parent_menu_id']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">@lang('menu::label.description')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.textarea', ['name' => 'description', 'value' => $menu->description]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'description']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="permission_id" class="col-sm-2 col-form-label">@lang('menu::label.permission_id')</label>
                                    <div class="col-sm-5">
                                        <select name="permission_id" class="form-control">
                                            <option value="0" data-name="" @if ($menu->permission_id == '0') selected @endif>No Permission</option>
                                            @foreach ($permissions as $value)
                                            <option value="{{$value->id}}" @if ($menu->permission_id == $value->id) selected @endif>{{$value->display_name}}</option>
                                            @endforeach
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'permission_id']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="item_order" class="col-sm-2 col-form-label">@lang('menu::label.item_order')</label>
                                    <div class="col-sm-1">
                                        @component('components.form.input_text', ['name' => 'item_order', 'value' => $menu->item_order, 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'item_order']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="item_order" class="col-sm-2 col-form-label">@lang('menu::label.active')</label>
                                    <div class="col-sm-5">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="active" id="inlineRadio1" value="1" @if ($menu->active == '1') checked @endif>
                                            <label class="form-check-label" for="inlineRadio1">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="active" id="inlineRadio2" value="0" @if ($menu->active == '0') checked @endif>
                                            <label class="form-check-label" for="inlineRadio2">Non Active</label>
                                        </div>
                                        @component('components.alert.invalid_form', ['name' => 'item_order']) @endcomponent
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ __('navigation.save') }}</button>
                                        <a type="button" class="btn btn-light" href="{{ url('/menus') }}"><i class="fas fa-angle-left"></i> {{ __('navigation.cancel') }}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection