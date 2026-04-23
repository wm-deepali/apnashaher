@extends('vendor.voyager.master')

@section('page_title', 'Manage Job Openings')

@section('breadcrumbs')
<ol class="breadcrumb">
<li>
<a href="{{ route('voyager.dashboard') }}">
<i class="voyager-home"></i> Dashboard
</a>
</li>
<li class="active">Manage Job Openings</li>
</ol>
@endsection

@section('page_header')
<h1 class="page-title">
<i class="voyager-briefcase"></i>
Manage Job Openings
</h1>
@stop


@section('content')

<div class="page-content browse container-fluid">

<a href="{{ route('admin.manage-jobs.create') }}" class="btn btn-success" style="margin-bottom:15px;">
Add Job Opening
</a>

<div class="panel panel-bordered">

<div class="panel-body">

@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif


<div class="table-responsive">

<table class="table table-hover">

<thead>
<tr>
<th>#</th>
<th>Date</th>
<th>Job Title</th>
<th>Employment Type</th>
<th>Work Mode</th>
<th>Location</th>
<th>Salary</th>
<th>Action</th>
</tr>
</thead>

<tbody>

@forelse($jobs as $job)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ date('Y-m-d', strtotime($job->created_at)) }}</td>

<td>{{ $job->job_title }}</td>

<td>{{ ucfirst(str_replace('_',' ',$job->employment_type)) }}</td>

<td>{{ ucfirst(str_replace('_',' ',$job->job_type)) }}</td>

<td>{{ $job->job_location }}</td>

<td>

@if($job->salary_type=='fixed')

₹{{ number_format($job->salary_fixed) }}
{{ ucfirst(str_replace('_',' ',$job->salary_duration)) }}

@else

₹{{ number_format($job->salary_from) }} -
₹{{ number_format($job->salary_to) }}
{{ ucfirst(str_replace('_',' ',$job->salary_duration)) }}

@endif

</td>

<td>

<a href="{{ route('admin.manage-jobs.edit',$job->id) }}"
class="btn btn-primary btn-sm">
Edit
</a>

<form method="POST"
action="{{ route('admin.manage-jobs.destroy',$job->id) }}"
style="display:inline">

@csrf
@method('DELETE')

<button type="submit"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this job?')">
Delete
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="8" class="text-center">
No job openings found
</td>
</tr>

@endforelse

</tbody>

</table>

</div>


<div class="pull-right">
{{ $jobs->links('pagination::bootstrap-5') }}
</div>

</div>

</div>

</div>

@endsection