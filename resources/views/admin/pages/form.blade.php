@extends('vendor.voyager.master')

@section('page_title', 'Manage Pages')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage Pages</li>
    </ol>
@endsection
@section('content')

<div class="page-content container-fluid">
    <h1>{{ isset($page) ? 'Edit Page' : 'Create Page' }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" 
          action="{{ isset($page) ? route('admin.manage-page.update', $page->id) : route('admin.manage-page.store') }}">
        @csrf
@if(isset($page))
@method('PUT')
@endif
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" 
                   name="title" 
                   id="title" 
                   class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title', $page->title ?? '') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" 
                   name="slug" 
                   id="slug" 
                   class="form-control @error('slug') is-invalid @enderror"
                   value="{{ old('slug', $page->slug ?? '') }}">
            @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" 
                      id="content" 
                      class="form-control @error('content') is-invalid @enderror" 
                      rows="10">{{ old('content', $page->content ?? '') }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            {{ isset($page) ? 'Update Page' : 'Create Page' }}
        </button>
    </form>
</div>

@endsection
@push('javascript')

<!-- TinyMCE Script -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
$(document).ready(function() {
  $('#content').summernote({
    height: 300
  });
});
</script>
@endpush