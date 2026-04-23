@extends('vendor.voyager.master')

@section('page_title','Edit Job Opening')

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

@section('content')

<div class="page-content container-fluid">

<div class="panel panel-bordered">

<div class="panel-body">

<form action="{{ route('admin.manage-jobs.update',$job->id) }}" method="POST">

@csrf
@method('PUT')

<div class="form-group">
<label>Job Title</label>
<input type="text"
name="job_title"
class="form-control"
value="{{ $job->job_title }}"
required>
</div>


<div class="form-group">
<label>Employment Type</label>

<select name="employment_type" class="form-control">

<option value="full_time" {{ $job->employment_type=='full_time' ? 'selected' : '' }}>Full Time</option>

<option value="part_time" {{ $job->employment_type=='part_time' ? 'selected' : '' }}>Part Time</option>

<option value="freelancing" {{ $job->employment_type=='freelancing' ? 'selected' : '' }}>Freelancing</option>

</select>

</div>


<div class="form-group">
<label>Job Location</label>
<input type="text"
name="job_location"
class="form-control"
value="{{ $job->job_location }}">
</div>


<div class="form-group">

<label>Job Type</label>

<select name="job_type" class="form-control">

<option value="in_person" {{ $job->job_type=='in_person' ? 'selected' : '' }}>In-Person</option>

<option value="remote" {{ $job->job_type=='remote' ? 'selected' : '' }}>Remote</option>

</select>

</div>


<div class="form-group">

<label>Salary Type</label>

<select name="salary_type" id="salaryType" class="form-control">

<option value="fixed" {{ $job->salary_type=='fixed' ? 'selected' : '' }}>Fixed</option>

<option value="range" {{ $job->salary_type=='range' ? 'selected' : '' }}>Range</option>

</select>

</div>


<div class="form-group" id="salaryFixed">

<label>Salary</label>

<input type="number"
name="salary_fixed"
class="form-control"
value="{{ $job->salary_fixed }}"
placeholder="Enter salary">

</div>


<div class="form-group" id="salaryRange">

<label>Salary Range</label>

<div style="display:flex; gap:10px">

<input type="number"
name="salary_from"
class="form-control"
value="{{ $job->salary_from }}"
placeholder="From">

<input type="number"
name="salary_to"
class="form-control"
value="{{ $job->salary_to }}"
placeholder="To">

</div>

</div>


<div class="form-group">

<label>Salary Duration</label>

<select name="salary_duration" class="form-control">

<option value="per_month" {{ $job->salary_duration=='per_month' ? 'selected' : '' }}>Per Month</option>

<option value="per_year" {{ $job->salary_duration=='per_year' ? 'selected' : '' }}>Per Year</option>

</select>

</div>


<div class="form-group">

<label>Overview</label>

<textarea name="overview"
class="form-control"
rows="4">{{ $job->overview }}</textarea>

</div>


<div class="form-group">

<label>Job Description</label>

<textarea name="job_description"
class="form-control summernote"
rows="6">{!! $job->job_description !!}</textarea>

</div>


<div class="form-group">

<label>Eligibility Criteria</label>

<textarea name="eligibility_criteria"
class="form-control summernote"
rows="6">{!! $job->eligibility_criteria !!}</textarea>

</div>


<button class="btn btn-primary">
Update Job
</button>

</form>

</div>

</div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


<script>

$('.summernote').summernote({
height:250
});

</script>


<script>

function toggleSalary()
{
let type=document.getElementById('salaryType').value;

if(type=='fixed')
{
document.getElementById('salaryFixed').style.display='block';
document.getElementById('salaryRange').style.display='none';
}
else
{
document.getElementById('salaryFixed').style.display='none';
document.getElementById('salaryRange').style.display='block';
}
}

document.getElementById('salaryType').addEventListener('change',toggleSalary);

window.onload=toggleSalary;

</script>


@endsection