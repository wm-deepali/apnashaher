@extends('vendor.voyager.master')

@section('page_title', 'Manage Category')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage Category</li>
    </ol>
@endsection
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>
       Manage Category
    </h1>
@stop

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<div class="page-content browse container-fluid">

    <a href="{{ route('admin.manage-categories.create') }}" class="btn btn-success">
    Add Category
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
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Icon</th>
                            <th>Parent Category</th>
                            <th>Popular</th>
                            
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($categories as $category)

                        <tr>

                        <td>{{$category->id}}</td>

                        <td>{{$category->name}}</td>

                        <td>{{$category->slug}}</td>
                         <td><i class="{{$category->icons}}"></i></td>

                        <td>
                        {{ $category->parent->name ?? 'Main Category' }}
                        </td>

                        <td>

                        @if($category->is_popular)
                        <span class="badge badge-success">Yes</span>
                        @else
                        <span class="badge badge-secondary">No</span>
                        @endif

                        </td>

                        <td>

                        @if($category->status == 'active')
                        <span class="badge badge-success">Active</span>
                        @else
                        <span class="badge badge-danger">Deactivate</span>
                        @endif

                        </td>

                        <td>

                        <a href="{{ route('admin.manage-categories.edit',$category->id) }}"
                        class="btn btn-primary btn-sm">
                        Edit
                        </a>

                        <form action="{{ route('admin.manage-categories.destroy',$category->id) }}"
                        method="POST"
                        style="display:inline-block">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this category?')">
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
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>


@endsection