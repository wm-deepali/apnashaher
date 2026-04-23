@extends('vendor.voyager.master')

@section('page_title', 'Manage Package')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage Packages</li>
    </ol>
@endsection
@section('content')

<div class="page-content container-fluid">

<h3>Add Package</h3>

<form action="{{ route('admin.manage-packages.store') }}" method="POST">

@csrf

@include('admin.packages._form')

<button class="btn btn-success">
Save
</button>

</form>

</div>

@endsection