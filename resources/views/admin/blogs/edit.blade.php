@extends('vendor.voyager.master')

@section('page_title', 'Manage Blogs')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage Blogs</li>
    </ol>
@endsection
@section('content')

<div class="page-content container-fluid">

<h3>Edit Blog</h3>

@include('admin.blogs._form')

</div>

@endsection