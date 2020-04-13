@extends('layouts.app')

@section('title')
@lang('user::label.title_create')
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
                            <form method="post" action="{{ url('users') }}" autocomplete="off">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">@lang('user::label.name')</label>
                                    <div class="col-sm-3">
                                        @component('components.form.input_text', ['name' => 'name', 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'name']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">@lang('user::label.email')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.input_email', ['name' => 'email', 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'email']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">@lang('user::label.roles')</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="role_id" required>
                                            <option value="">@lang('user::label.select_role')</option>
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}" @if ($role->id == old('role_id')) selected @endif>{{$role->display_name}}</option>
                                            @endforeach
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'role_id']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">@lang('user::label.password')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.input_password', ['name' => 'password', 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'password']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-2 col-form-label">@lang('user::label.password_confirmation')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.input_password', ['name' => 'password_confirmation', 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'password_confirmation']) @endcomponent
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="timezone_code" class="col-sm-2 col-form-label">@lang('user::label.timezone')</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="timezone_code" required>
                                            <option value="">@lang('user::label.select_timezone')</option>
                                            @foreach($timezones as $key => $timezone)
                                            <option value="{{$key}}" @if ($key == old('timezone_code')) selected @endif>{{$timezone}}</option>
                                            @endforeach
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'timezone_code']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="languange_code" class="col-sm-2 col-form-label">@lang('user::label.language')</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="languange_code" required>
                                            <option value="">@lang('user::label.select_language')</option>
                                            <option value="en" @if (old('languange_code') == 'en') selected @endif>English</option>
                                            <option value="id" @if (old('languange_code') == 'id') selected @endif>Indonesia</option>
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'languange_code']) @endcomponent
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ __('navigation.save') }}</button>
                                        <a type="button" class="btn btn-light" href="{{ url('/users') }}"><i class="fas fa-angle-left"></i> {{ __('navigation.cancel') }}</a>
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
