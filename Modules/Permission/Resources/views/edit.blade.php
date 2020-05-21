@extends('layouts.app')

@section('title')
@lang('permission::label.title_edit')
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
                            <form method="post" action="{{ url('permissions/'.$permission->id) }}"  autocomplete="off">
                                @csrf
                                @method("PUT")
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">@lang('permission::label.name')</label>
                                    <div class="col-sm-3">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text prepend-name"></span>
                                            </div>
                                            @component('components.form.input_text', ['name' => 'name', 'required' => true, 'value' => str_replace($permission->parent_permission ? $permission->parent_permission->name.'.' : '', '', $permission->name)]) @endcomponent
                                        </div>                                          
                                        @component('components.alert.invalid_form', ['name' => 'name']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="display_name" class="col-sm-2 col-form-label">@lang('permission::label.display_name')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.input_text', ['name' => 'display_name', 'value' => $permission->display_name, 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'display_name']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="parent_permission_id" class="col-sm-2 col-form-label">Parent Permission</label>
                                    <div class="col-sm-5">
                                        <select name="parent_permission_id" class="form-control">
                                            <option value="0" data-name="" @if ($permission->parent_permission_id == '0') selected @endif>Main Permission</option>
                                            @foreach ($permissions as $value)
                                            <option value="{{$value->id}}" data-name="{{$value->name}}" @if ($permission->parent_permission_id == $value->id) selected @endif>{{$value->display_name}}</option>
                                            @endforeach
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'parent_permission_id']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">@lang('permission::label.description')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.textarea', ['name' => 'description', 'value' => $permission->description]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'description']) @endcomponent
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ __('navigation.save') }}</button>
                                        <a type="button" class="btn btn-light" href="{{ url('/permissions') }}"><i class="fas fa-angle-left"></i> {{ __('navigation.cancel') }}</a>
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
</script>
@endsection