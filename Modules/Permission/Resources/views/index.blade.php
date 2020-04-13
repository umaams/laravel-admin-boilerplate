@extends('layouts.app')

@section('title')
@lang('permission::label.title_view')
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
                            <a role="button" class="btn btn-primary" href="{{ url('permissions/create') }}"><i class="fas fa-plus-circle"></i> {{ __('navigation.add_new') }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="table" class="table table-striped table-inverse">
                                <thead class="thead-light">
                                    <tr>
                                        <th>@lang('permission::label.name')</th>
                                        <th>@lang('permission::label.display_name')</th>
                                        <th>@lang('permission::label.description')</th>
                                        <th style="width: 150px;"></th>
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
        ajax: '{{ url('permissions/datatable') }}',
        columns: [
            {data: 'name', name: 'name'},
            {data: 'display_name', name: 'display_name'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', className: 'text-center', searchable: false, orderable: false}
        ],
    });
});
</script>    
@endsection
