@extends('vendor.voyager.master')

@section('page_title', 'Add FAQ')

@section('breadcrumbs')
<ol class="breadcrumb">
    <li>
        <a href="{{ route('voyager.dashboard') }}">
            <i class="voyager-home"></i> Dashboard
        </a>
    </li>
    <li>
        <a href="{{ route('admin.manage-faq.index') }}">Manage FAQ</a>
    </li>
    <li class="active">Add FAQ</li>
</ol>
@endsection

@section('page_header')
<h1 class="page-title">
    <i class="voyager-plus"></i>
    Add FAQ
</h1>
@stop

@section('content')

<div class="page-content container-fluid">

<div class="panel panel-bordered">

<div class="panel-body">

<form action="{{ route('admin.manage-faq.store') }}" method="POST">

@csrf

<div class="form-group">
<label>Question</label>
<input type="text" name="question" class="form-control" required>
</div>

<div class="form-group">
<label>Answer</label>
<textarea name="answer" class="form-control" rows="5" required></textarea>
</div>

<div class="form-group">
<label>Sort Order</label>
<input type="number" name="sort_order" class="form-control" value="0">
</div>

<div class="form-group">
<label>Show on Home</label>
<select name="show_on_home" class="form-control">
<option value="1">Yes</option>
<option value="0">No</option>
</select>
</div>

<div class="form-group">
<label>Status</label>
<select name="status" class="form-control">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

<button type="submit" class="btn btn-success">
Save FAQ
</button>

<a href="{{ route('admin.manage-faq.index') }}" class="btn btn-default">
Cancel
</a>

</form>

</div>

</div>

</div>

@endsection