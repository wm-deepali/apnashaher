@extends('layouts.app')
@section('title')
{{$page->title}}
@endsection
@push('styles')
<!-- Custom CSS -->
<style>

    .tc-container{
        width: 80%;
        margin: auto;
    }
    
  .tc-section {
   padding-bottom: 40px;
  }

  .tc-main-heading {
    font-weight: 900;
    letter-spacing: -0.04em;
  }

  .tc-card {
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .tc-card:hover {
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
  }

  .tc-card-header {
    background: #2563eb;
    color: white;
    font-weight: 700;
  }

  .tc-card-body {
    line-height: 1.75;
  }

  .tc-list li {
    margin-bottom: 0.75rem;
  }
</style>
 @endpush
@section('content')
<!-- TERMS & CONDITIONS PAGE -->
<div class="tc-page bg-white min-h-screen py-12 md:py-12">
  <div class="tc-container  mx-auto px-6 lg:px-8" >

    <!-- Page Title -->
    <h1 class="tc-title text-4xl md:text-5xl font-bold text-gray-900 mb-3 text-center">
      {{$page->title}}
    </h1>
    <p class="tc-updated text-center text-gray-600 mb-12">
     {!! $page->content !!}
</p>
    </div>

  </div>
</section>
@endsection