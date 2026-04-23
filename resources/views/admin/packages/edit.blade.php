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

<h3>Edit Package</h3>

<form action="{{ route('admin.manage-packages.update',$package->id) }}" method="POST">

@csrf
@method('PUT')

@include('admin.packages._form')

<button class="btn btn-success">
Update
</button>

</form>

</div>

@endsection