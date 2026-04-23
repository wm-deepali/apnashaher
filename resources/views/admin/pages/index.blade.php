@extends('vendor.voyager.master')

@section('page_title', 'Manage Pages')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage Pages</li>
    </ol>
@endsection
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>
       Manage Pages
    </h1>
@stop
@section('content')
<div class="page-content browse container-fluid">

    <a href="{{ route('admin.manage-page.create') }}" class="btn btn-success">
    Add Page
    </a>
    <div class="panel panel-bordered">
        <div class="panel-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover no-footer">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->title }}</td>
                                <td>{{ $page->slug ?? '-' }}</td>
                                <td>
                                @if($page->status)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-secondary">Deactive</span>
                                @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.manage-page.edit', $page->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('admin.manage-page.destroy', $page->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this page?')">Delete</button>
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