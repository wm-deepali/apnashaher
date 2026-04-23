<form id="courseUpdateForm" data-id="{{ $course->id }}" enctype="multipart/form-data">

@csrf


<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Course Name</label>
<input type="text" name="name" class="form-control" value="{{ $course->name }}" required>
</div>
</div>



<div class="col-md-3">
<div class="form-group">
<label>Duration</label>
<input type="text" name="duration" class="form-control" value="{{ $course->duration }}" required>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Duration Unit</label>
<select name="duration_unit" class="form-control" required>

<option value="Days" @if($course->duration_unit=='Days') selected @endif>Days</option>
<option value="Months" @if($course->duration_unit=='Months') selected @endif>Months</option>
<option value="Years" @if($course->duration_unit=='Years') selected @endif>Years</option>

</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Mode</label>
<select name="mode" class="form-control" required>

<option value="Online" @if($course->mode=='Online') selected @endif>Online</option>
<option value="Offline" @if($course->mode=='Offline') selected @endif>Offline</option>
<option value="Both (Hybrid)" @if($course->mode=='Both (Hybrid)') selected @endif>Both (Hybrid)</option>

</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Course Fee</label>
<input type="text" name="course_fee" class="form-control" value="{{ $course->course_fee }}" required>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Available Seats</label>
<input type="number" name="available_seats" class="form-control" value="{{ $course->available_seats }}" required>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Start Date</label>
<input type="date" name="start_date" class="form-control" value="{{ $course->start_date }}" required>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Course Image</label>
<input type="file" name="image" class="form-control">

@if($course->image)
<br>
<img src="{{ asset('storage/'.$course->image) }}" width="80">
@endif

</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Thumbnail Image</label>
<input type="file" name="thumb_image" class="form-control">

@if($course->thumb_image)
<br>
<img src="{{ asset('storage/'.$course->thumb_image) }}" width="80">
@endif

</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Short Description</label>
<textarea name="short_desc" class="form-control">{{ $course->short_desc }}</textarea>
</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label>Detailed Information</label>
<textarea name="detailed_information" class="form-control" rows="5">
{{ $course->detailed_information }}
</textarea>
</div>
</div>

</div>

<button type="submit" class="btn btn-success">
Update Course
</button>

</form>