@extends('layouts.app')

@section('title')
@lang('role::label.title_create')
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
                            <form method="post" action="{{ url('roles') }}" autocomplete="off">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">@lang('role::label.name')</label>
                                    <div class="col-sm-3">
                                        @component('components.form.input_text', ['name' => 'name', 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'name']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="display_name" class="col-sm-2 col-form-label">@lang('role::label.display_name')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.input_text', ['name' => 'display_name', 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'display_name']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">@lang('role::label.description')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.textarea', ['name' => 'description']) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'description']) @endcomponent
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-12 col-form-label">@lang('role::label.permissions')</label>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permission_id[]" value="{{$permission->id}}">
                                            <label class="form-check-label">{{$permission->display_name}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ __('navigation.save') }}</button>
                                        <a type="button" class="btn btn-light" href="{{ url('/roles') }}"><i class="fas fa-angle-left"></i> {{ __('navigation.cancel') }}</a>
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
