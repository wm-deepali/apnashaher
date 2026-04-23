@extends('vendor.voyager.master')

@section('page_title','Add Job Opening')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

@section('content')

<div class="page-content container-fluid">

<div class="panel panel-bordered">

<div class="panel-body">

<form action="{{ route('admin.manage-jobs.store') }}" method="POST">

@csrf

<div class="form-group">
<label>Job Title</label>
<input type="text" name="job_title" class="form-control" required>
</div>


<div class="form-group">
<label>Employment Type</label>

<select name="employment_type" class="form-control">

<option value="full_time">Full Time</option>
<option value="part_time">Part Time</option>
<option value="freelancing">Freelancing</option>

</select>

</div>


<div class="form-group">
<label>Job Location</label>
<input type="text" name="job_location" class="form-control">
</div>

<div class="form-group">

<label>Job Type</label>

<select name="job_type" class="form-control">

<option value="in_person">In-Person</option>
<option value="remote">Remote</option>

</select>

</div>


<div class="form-group">

<label>Salary Type</label>

<select name="salary_type" id="salaryType" class="form-control">

<option value="fixed">Fixed</option>
<option value="range">Range</option>

</select>

</div>


<div class="form-group" id="salaryFixed">

<label>Salary</label>

<input type="number"
name="salary_fixed"
class="form-control"
placeholder="Enter salary">

</div>


<div class="form-group" id="salaryRange" style="display:none">

<label>Salary Range</label>

<div style="display:flex; gap:10px">

<input type="number"
name="salary_from"
class="form-control"
placeholder="From">

<input type="number"
name="salary_to"
class="form-control"
placeholder="To">

</div>

</div>


<div class="form-group">

<label>Salary Duration</label>

<select name="salary_duration" class="form-control">

<option value="per_month">Per Month</option>
<option value="per_year">Per Year</option>

</select>

</div>


<div class="form-group">

<label>Overview</label>

<textarea name="overview"
class="form-control"
rows="4"></textarea>

</div>


<div class="form-group">

<label>Job Description</label>

<textarea name="job_description"
class="form-control summernote"
rows="6"></textarea>

</div>


<div class="form-group">

<label>Eligibility Criteria</label>

<textarea name="eligibility_criteria"
class="form-control summernote"
rows="6"></textarea>

</div>


<button class="btn btn-success">
Save Job
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

document.getElementById('salaryType').addEventListener('change',function(){

let type=this.value;

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

});

</script>

@endsection