@extends('vendor.voyager.master')

@section('page_title', 'Manage FAQ')

@section('breadcrumbs')
<ol class="breadcrumb">
    <li>
        <a href="{{ route('voyager.dashboard') }}">
            <i class="voyager-home"></i> Dashboard
        </a>
    </li>
    <li class="active">Manage FAQ</li>
</ol>
@endsection


@section('page_header')
<h1 class="page-title">
    <i class="voyager-help"></i>
    Manage FAQ
</h1>
@stop


@section('content')

<div class="page-content browse container-fluid">

<a href="{{ route('admin.manage-faq.create') }}" class="btn btn-success">
    Add FAQ
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
<th>Date & Time</th>
<th>Question</th>
<th>Show on Home</th>
<th>Status</th>
<th>Action</th>
</tr>

</thead>


<tbody>

@foreach($faqs as $faq)

<tr>

<td>
{{ date('Y-m-d g:i A', strtotime($faq->created_at)) }}
</td>

<td>
{{ $faq->question }}
</td>

<td>
{{ $faq->show_on_home ? 'Yes' : 'No' }}
</td>

<td>
{{ $faq->status ? 'Active' : 'Inactive' }}
</td>


<td>

<a href="{{ route('admin.manage-faq.edit',$faq->id) }}"
class="btn btn-primary btn-sm">
Edit
</a>

<form method="POST"
action="{{ route('admin.manage-faq.destroy',$faq->id) }}"
style="display:inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm"
onclick="return confirm('Are you sure?')">
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
{{ $faqs->links('pagination::bootstrap-5') }}
</div>


</div>

</div>

</div>

@endsection