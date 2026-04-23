<form action="{{ isset($blog) ? route('admin.manage-blog.update',$blog->id) : route('admin.manage-blog.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@if(isset($blog))
@method('PUT')
@endif


<div class="form-group">
    <label>Title</label>
    <input type="text"
           name="title"
           class="form-control @error('title') is-invalid @enderror"
           value="{{ old('title', $blog->title ?? '') }}"
           required>

    @error('title')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<div class="form-group">
    <label>Blog Image</label>

    <input type="file"
           name="image"
           class="form-control @error('image') is-invalid @enderror">

    @error('image')
    <span class="text-danger">{{ $message }}</span>
    @enderror

    @if(!empty($blog->image))
        <br>
        <img src="{{ asset('storage/'.$blog->image) }}" width="120">
    @endif
</div>


<div class="form-group">
    <label>Content</label>

    <textarea name="content"
              id="content"
              class="form-control @error('content') is-invalid @enderror"
              rows="8">{{ old('content', $blog->content ?? '') }}</textarea>

    @error('content')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<hr>

<h4>SEO Settings</h4>

<div class="form-group">
    <label>Meta Title</label>

    <input type="text"
           name="meta_title"
           class="form-control"
           value="{{ old('meta_title', $blog->meta_title ?? '') }}">
</div>


<div class="form-group">
    <label>Meta Description</label>

    <textarea name="meta_description"
              class="form-control"
              rows="3">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
</div>


<div class="form-group">
    <label>Meta Keywords</label>

    <input type="text"
           name="meta_keywords"
           class="form-control"
           value="{{ old('meta_keywords', $blog->meta_keywords ?? '') }}">
</div>


<div class="form-group">
    <label>Status</label>

    <select name="status" class="form-control">

        <option value="1"
        {{ old('status', $blog->status ?? 1) == 1 ? 'selected' : '' }}>
        Active
        </option>

        <option value="0"
        {{ old('status', $blog->status ?? 1) == 0 ? 'selected' : '' }}>
        Inactive
        </option>

    </select>
</div>


<br>

<button type="submit" class="btn btn-success">
    {{ isset($blog) ? 'Update Blog' : 'Save Blog' }}
</button>

</form>

@push('javascript')
{{-- Summernote Editor --}}
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
$(document).ready(function() {

    $('#content').summernote({
        height:300
    });

});
</script>
@endpush