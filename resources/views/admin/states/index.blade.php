@extends('vendor.voyager.master')

@section('page_title', 'Manage State')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage State</li>
    </ol>
@endsection
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>
       Manage State
    </h1>
@stop
@section('content')
<div class="page-content browse container-fluid">

    <a href="{{ route('admin.manage-states.create') }}" class="btn btn-success">
    Add State
    </a>
    <div class="panel panel-bordered">
        <div class="panel-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table id="statesTable" class="table table-hover no-footer">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($states  as $state)

                        <tr>

                        <td>{{ $state->id }}</td>
                        <td>{{ $state->country->name }}</td>
                        <td>{{ $state->name }}</td>

                        <td>

                        <a href="{{ route('admin.manage-states.edit',$state->id) }}"
                        class="btn btn-primary btn-sm">
                        Edit
                        </a>

                        <form action="{{ route('admin.manage-states.destroy',$state->id) }}"
                        method="POST"
                        style="display:inline-block">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this state?')">
                        Delete
                        </button>

                        </form>

                        </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

            

        </div>
    </div>

</div>

@stop
@push('javascript')
<script>
$(document).ready(function() {
    $('#statesTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true
    });
});
</script>
@endpush