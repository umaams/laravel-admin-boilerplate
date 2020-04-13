@extends('layouts.app')

@section('title')
@lang('user::label.title_view')
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
                            <a role="button" class="btn btn-primary" href="{{ url('users/create') }}"><i class="fas fa-plus-circle"></i> {{ __('navigation.add_new') }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table" class="table table-striped table-inverse">
                                <thead class="thead-light">
                                    <tr>
                                        <th>@lang('user::label.name')</th>
                                        <th>@lang('user::label.email')</th>
                                        <th>@lang('user::label.roles')</th>
                                        <th style="width: 200px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                            </table>
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
