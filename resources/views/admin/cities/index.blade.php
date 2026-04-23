@extends('vendor.voyager.master')

@section('page_title', 'Manage Cities')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage Cities</li>
    </ol>
@endsection

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>
       Manage Cities
    </h1>
@stop
@section('content')
<div class="page-content browse container-fluid">

    <a href="{{ route('admin.manage-cities.create') }}" class="btn btn-success">
    Add City
    </a>
    <div class="panel panel-bordered">
        <div class="panel-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table id="cityTable" class="table table-hover no-footer">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>State</th>
                                <th>Name</th>
                                <th>Registered</th>
                                <th>Popular</th>
                                <th>Launching</th>
                                <th>Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cities as $city)
                            <tr>
                                <td>{{ $city->id }}</td>
                                 <td>{{ $city->state->name ?? "" }}</td>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->is_registered ? 'Yes' : 'No' }}</td>
                                <td>{{ $city->is_popular ? 'Yes' : 'No' }}</td>
                                <td>{{ $city->is_launching ? 'Yes' : 'No' }}</td>
                                <td>
                                    @if($city->image)
                                    <img src="{{ asset('storage/'.$city->image) }}" width="80">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.manage-cities.edit', $city->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('admin.manage-cities.destroy', $city->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this city?')">Delete</button>
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
    $('#cityTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true
    });
});
</script>
@endpush