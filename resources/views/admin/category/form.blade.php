@extends('vendor.voyager.master')

@section('page_title', 'Manage Category')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage Category</li>
    </ol>
@endsection

@section('content')

<div class="container-fluid">

<h2>
@if(isset($category))
Edit Category
@else
Add Category
@endif
</h2>

<form method="POST"
@if(isset($category))
action="{{ route('admin.manage-categories.update',$category->id) }}"
@else
action="{{ route('admin.manage-categories.store') }}"
@endif
>

@csrf

@if(isset($category))
@method('PUT')
@endif


<div class="row">

<div class="col-md-6">
<div class="form-group">
<label>Category Name</label>
<input type="text" name="name" id="name" class="form-control"
value="{{ $category->name ?? '' }}">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Slug</label>
<input type="text" name="slug" id="slug" class="form-control"
value="{{ $category->slug ?? '' }}">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Icon</label>
<input type="text" name="icons" class="form-control"
value="{{ $category->icons ?? '' }}">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Meta Title</label>
<input type="text" name="meta_title" class="form-control"
value="{{ $category->meta_title ?? '' }}">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Tags</label>
<input type="text" name="tags" class="form-control"
value="{{ $category->tags ?? '' }}">
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Parent Category</label>
<select name="parent_id" class="form-control">

<option value="">Main Category</option>

@foreach($categories as $cat)

<option value="{{$cat->id}}"
@if(isset($category) && $category->parent_id == $cat->id)
selected
@endif
>
{{$cat->name}}
</option>

@endforeach

</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Status</label>

<select name="status" class="form-control">

<option value="active"
@if(isset($category) && $category->status == 'active')
selected
@endif
>
Active
</option>

<option value="deactive"
@if(isset($category) && $category->status == 'deactive')
selected
@endif
>
Deactivate
</option>

</select>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>Meta Description</label>
<textarea name="meta_description" class="form-control">
{{ $category->meta_description ?? '' }}
</textarea>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label>
<input type="checkbox" name="is_popular" value="1"
@if(isset($category) && $category->is_popular)
checked
@endif
>
Popular Category
</label>
</div>
</div>

</div>

<button class="btn btn-primary">
@if(isset($category))
Update Category
@else
Create Category
@endif
</button>

</form>

</div>

@endsection
@push('javascript')
<script>
$(document).ready(function(){

    $('#name').on('keyup', function(){
        let slug = $(this).val()
            .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '') 
        .replace(/\s+/g, '-') 
        .replace(/-+/g, '-') 
        .replace('-board-academic-coachings','')
        .replace(/-+/g, '-') 
        .replace(/^-|-$/g, '');

        $('#slug').val(slug);
    });

});
</script>
@endpush