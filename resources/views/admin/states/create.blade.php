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

<h3>Add State</h3>

<form action="{{ route('admin.manage-states.store') }}" method="POST">

@csrf

@include('admin.states._form')

<button class="btn btn-success">
Save
</button>

</form>

</div>

@endsection