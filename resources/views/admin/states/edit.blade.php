@extends('vendor.voyager.master')

@section('page_title', 'Manage State')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage State</li>
    </ol>
@endsection
@section('content')

<div class="page-content container-fluid">

<h3>Edit State</h3>

<form action="{{ route('admin.manage-states.update',$state->id) }}" method="POST">

@csrf
@method('PUT')

@include('admin.states._form')

<button class="btn btn-success">
Update
</button>

</form>

</div>

@endsection