@extends('layouts.app')

@section('title')
@lang('user::label.title_edit')
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
                            <form method="post" action="{{ url('users/'.$user->id) }}"  autocomplete="off">
                                @csrf
                                @method("PUT")
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">@lang('user::label.name')</label>
                                    <div class="col-sm-3">
                                        @component('components.form.input_text', ['name' => 'name', 'value' => $user->name, 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'name']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">@lang('user::label.email')</label>
                                    <div class="col-sm-5">
                                        @component('components.form.input_email', ['name' => 'email', 'value' => $user->email, 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'email']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">@lang('user::label.roles')</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="role_id" required>
                                            <option value="">@lang('user::label.select_role')</option>
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}" @if(in_array($role->id, $role_ids)) selected @endif>{{$role->display_name}}</option>
                                            @endforeach
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'description']) @endcomponent
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="timezone_code" class="col-sm-2 col-form-label">@lang('user::label.timezone')</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="timezone_code" required>
                                            <option value="">@lang('user::label.timezone')</option>
                                            @foreach($timezones as $key => $timezone)
                                            <option value="{{$key}}" @if ($key == $user->timezone_code) selected @endif>{{$timezone}}</option>
                                            @endforeach
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'timezone_code']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="language_code" class="col-sm-2 col-form-label">@lang('user::label.language')</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="language_code" required>
                                            <option value="">@lang('user::label.select_language')</option>
                                            <option value="en" @if ($user->language_code == 'en') selected @endif>English</option>
                                            <option value="id" @if ($user->language_code == 'id') selected @endif>Indonesia</option>
                                        </select>
                                        @component('components.alert.invalid_form', ['name' => 'language_code']) @endcomponent
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
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Change Password</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="{{ url('users/'.$user->id."/password") }}"  autocomplete="off">
                                @csrf
                                @method("PUT")
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-5">
                                        @component('components.form.input_password', ['name' => 'password', 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'password']) @endcomponent
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm New Password</label>
                                    <div class="col-sm-5">
                                        @component('components.form.input_password', ['name' => 'password_confirmation', 'required' => true]) @endcomponent
                                        @component('components.alert.invalid_form', ['name' => 'password_confirmation']) @endcomponent
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
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
