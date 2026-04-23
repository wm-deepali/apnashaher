<div class="form-group">

<label>Country</label>

<select name="country_id" class="form-control">

@foreach($countries as $id => $name)

<option value="{{ $id }}"
@if(isset($state) && $state->country_id == $id) selected @endif>

{{ $name }}

</option>

@endforeach

</select>

</div>


<div class="form-group">

<label>State Name</label>

<input type="text"
name="name"
class="form-control"
value="{{ $state->name ?? '' }}">

</div>