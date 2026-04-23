@extends('vendor.voyager.master')

@section('page_title', 'Manage Cities')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage Cities</li>
    </ol>
@endsection
@section('content')

<div class="page-content container-fluid">

<h3>Edit City</h3>

<form action="{{ route('admin.manage-cities.update', $city->id) }}" method="POST" enctype="multipart/form-data">

 @csrf
@method('PUT')

@include('admin.cities._form')

<button class="btn btn-success">
Update
</button>

</form>

</div>

@endsection
