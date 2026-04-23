<form id="timingUpdateForm"
action="{{ route('admin.manage-institute.timing.update',$timing->id) }}">

@csrf

<div class="form-group">
<label>Day</label>
<select name="day" class="form-control">

<option value="Monday" {{ $timing->day=='Monday'?'selected':'' }}>Monday</option>
<option value="Tuesday" {{ $timing->day=='Tuesday'?'selected':'' }}>Tuesday</option>
<option value="Wednesday" {{ $timing->day=='Wednesday'?'selected':'' }}>Wednesday</option>
<option value="Thursday" {{ $timing->day=='Thursday'?'selected':'' }}>Thursday</option>
<option value="Friday" {{ $timing->day=='Friday'?'selected':'' }}>Friday</option>
<option value="Saturday" {{ $timing->day=='Saturday'?'selected':'' }}>Saturday</option>
<option value="Sunday" {{ $timing->day=='Sunday'?'selected':'' }}>Sunday</option>

</select>
</div>

<div class="form-group">
<label>Open Time</label>
<input type="time" name="open_time"
value="{{ $timing->open_time }}"
class="form-control">
</div>

<div class="form-group">
<label>Close Time</label>
<input type="time" name="close_time"
value="{{ $timing->close_time }}"
class="form-control">
</div>

<div class="form-group">
<label>Status</label>
<select name="is_active" class="form-control">
<option value="1" {{ $timing->is_active==1 ? 'selected':'' }}>Open</option>
<option value="0" {{ $timing->is_active==0 ?'selected':'' }}>Off / Closed</option>
</select>
</div>

<button class="btn btn-success">
Update Timing
</button>

</form>