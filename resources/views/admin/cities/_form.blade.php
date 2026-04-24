<style>
    .form-check {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
}

.form-check-input {
    width: 16px;
    height: 16px;
    cursor: pointer;
}

.form-check-label {
    margin: 0;
    cursor: pointer;
}

</style><div class="form-group">



<label>State</label>

<select name="state_id" class="form-control" required>
<option value="">Select State</option>
@foreach($states as $id => $name)

<option value="{{ $id }}"
@if(isset($state) && $state->state_id == $id) selected @endif>

{{ $name }}

</option>

@endforeach

</select>

</div>
<div class="form-group">
    <label>City Name</label>
    <input type="text" name="name" class="form-control" value="{{ $city->name ?? old('name') }}" required>
</div>

<div class="form-check">
    <input type="checkbox" name="is_registered" class="form-check-input" value="1" {{ (isset($city) && $city->is_registered) ? 'checked' : '' }}>
    <label class="form-check-label">Show on Registration</label>
</div>

<div class="form-check">
    <input type="checkbox" name="is_popular" class="form-check-input" value="1" {{ (isset($city) && $city->is_popular) ? 'checked' : '' }}>
    <label class="form-check-label">Show as Popular</label>
</div>

<div id="popularImageSection" style="display:none">

@if(isset($city) && $city->is_popular && $city->image)
<div class="mb-2">
    <img src="{{ asset('storage/'.$city->image) }}" width="100">
</div>
@endif

<div class="form-group">
    <label>Popular Image</label>
    <input type="file" name="image" class="form-control">
</div>

</div>

<div class="form-check">
    <input type="checkbox" name="is_launching" class="form-check-input" value="1" {{ (isset($city) && $city->is_launching) ? 'checked' : '' }}>
    <label class="form-check-label">Show as Launching</label>
</div>

<div id="launchingFields" style="display:none">

<div class="form-group">
    <label>Slug</label>
    <input type="text" name="slug" class="form-control" value="{{ $city->slug ?? old('slug') }}">
</div>

<div class="form-group">
    <label>Meta Title</label>
    <input type="text" name="meta_title" class="form-control" value="{{ $city->meta_title ?? old('meta_title') }}">
</div>

<div class="form-group">
    <label>Meta Description</label>
    <textarea name="meta_description" class="form-control">{{ $city->meta_description ?? old('meta_description') }}</textarea>
</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

function toggleLaunchingFields() {
    if ($('input[name="is_launching"]').is(':checked')) {
        $('#launchingFields').show();
    } else {
        $('#launchingFields').hide();
    }
}

function togglePopularImage() {

    let isPopular = $('input[name="is_popular"]').is(':checked');
    
    if (isPopular) {
        $('#popularImageSection').show();
    } else {
        $('#popularImageSection').hide();
    }

}

$(document).ready(function () {

    toggleLaunchingFields();
    togglePopularImage();
    $('input[name="is_launching"]').change(function () {
        toggleLaunchingFields();
    });

     $('input[name="is_popular"]').change(function () {
        togglePopularImage();
    });


});

</script>

