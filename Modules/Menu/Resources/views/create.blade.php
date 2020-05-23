@extends('layouts.app')

@section('title')
@lang('menu::label.title_create')
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
                            <form method="post" action="{{ url('permissions') }}" autocomplete="off">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">@lang('menu::label.name')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.input_text', ['name' => 'name', 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'name']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="link" class="col-sm-2 col-form-label">@lang('menu::label.link')</label>
                                    <div class="col-sm-3">
                                        @component('components.form.input_text', ['name' => 'link', 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'link']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fa_class" class="col-sm-2 col-form-label">@lang('menu::label.fa_class')</label>
                                    <div class="col-sm-3">
                                        <select name="fa_class" class="form-control">
                                            @foreach ($icons as $icon)
                                            <option value="{{$icon}}" @if($icon == old('fa_class')) selected @endif><i class="{{$icon}}"></i> {{$icon}}</option>
                                            @endforeach
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'fa_class']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="parent_permission_id" class="col-sm-2 col-form-label">Parent Permission</label>
                                    <div class="col-sm-5">
                                        <select name="parent_permission_id" class="form-control">
                                            <option value="0" data-name="">Main Permission</option>
                                            @foreach ($permissions as $permission)
                                            <option value="{{$permission->id}}" data-name="{{$permission->name}}" @if (old('parent_permission_id') == $permission->id) selected @endif>{{$permission->display_name}}</option>
                                            @endforeach
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'parent_permission_id']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">@lang('permission::label.description')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.textarea', ['name' => 'description']) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'description']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="permission_id" class="col-sm-2 col-form-label">@lang('menu::label.permission_id')</label>
                                    <div class="col-sm-5">
                                        <select name="permission_id" class="form-control">
                                            <option value="0" data-name="" @if (old('permission_id') == '0') selected @endif>No Permission</option>
                                            @foreach ($permissions as $value)
                                            <option value="{{$value->id}}" @if (old('permission_id') == $value->id) selected @endif>{{$value->display_name}}</option>
                                            @endforeach
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'permission_id']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="item_order" class="col-sm-2 col-form-label">@lang('menu::label.item_order')</label>
                                    <div class="col-sm-1">
                                        @component('components.form.input_text', ['name' => 'item_order', 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'item_order']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="item_order" class="col-sm-2 col-form-label">@lang('menu::label.active')</label>
                                    <div class="col-sm-5">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="active" id="inlineRadio1" value="1" @if (old('active') == '1') checked @endif>
                                            <label class="form-check-label" for="inlineRadio1">Active</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="active" id="inlineRadio2" value="0" @if (old('active') == '0') checked @endif>
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

@section('scripts')
<script>
function setupParentName() {
    const parent_name = $('select[name=parent_permission_id]').find('option:selected').attr('data-name');
    $('.prepend-name').html(parent_name + (parent_name != '' ? '.' : ''));
}
setupParentName();
$('select[name=parent_permission_id]').on('change', function (e) {
    setupParentName();
});
$('select[name=fa_class]').select2({
    placeholder: 'Select Icon...',
    theme: 'bootstrap4',
    escapeMarkup : function(markup) {
        return markup;
    }
});
</script>
@endsection