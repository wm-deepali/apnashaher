@extends('vendor.voyager.master')
@section('page_title', 'Manage Blogs')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage Blogs</li>
    </ol>
@endsection
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>
       Manage Blogs
    </h1>
@stop
@section('content')
<div class="page-content browse container-fluid">
<a href="{{ route('admin.manage-blog.create') }}" class="btn btn-success">Add Blog</a>

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
                <th>Date & Time</th>
                <th>Title</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>

                <tbody>

                @foreach($blogs as $blog)

                <tr>
                <td>{{ date('Y-m-d g:i A', strtotime($blog->created_at)) }}</td>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->slug }}</td>
                <td>{{ $blog->status ? 'Active' : 'Inactive' }}</td>

                <td>

                <a href="{{ route('admin.manage-blog.edit',$blog->id) }}"
                class="btn btn-primary btn-sm">Edit</a>

                <form method="POST"
                action="{{ route('admin.manage-blog.destroy',$blog->id) }}"
                style="display:inline">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm">
                Delete
                </button>

                </form>

                </td>

                </tr>

                @endforeach

                </tbody>
              </table>
            </div>

            <div class="pull-right">
                {{ $blogs->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>

@endsection