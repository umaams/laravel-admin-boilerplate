@extends('layouts.app')

@section('title')
@lang('user::label.title_show')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@yield('title') / {{$user->name}}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%;">@lang('user::label.name')</td>
                                            <td>{{$user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('user::label.email')</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('user::label.roles')</td>
                                            <td>{{ implode(', ', $user->roles->pluck('display_name')->all()) }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('user::label.created_at')</td>
                                            <td>{{$user->created_at->format('d F Y H:i')}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('user::label.updated_at')</td>
                                            <td>{{$user->updated_at->format('d F Y H:i')}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-inverse">
                                <thead class="thead-light">
                                    <tr>
                                        <th>@lang('user::label.permissions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <ul>
                                            @foreach ($user->allPermissions() as $permission)
                                            <li>{{$permission->display_name}}</li>
                                            @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a type="button" class="btn btn-light" href="{{ url('/users') }}"><i class="fas fa-angle-left"></i> Back</a>
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
$(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url('users/datatable') }}',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'roles', name: 'roles', searchable: false, orderable: false },
            {data: 'action', name: 'action', className: 'text-center', searchable: false, orderable: false}
        ],
    });
});
</script>    
@endsection
