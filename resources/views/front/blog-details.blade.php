@extends('layouts.app')
@section('title')
{{$blog->title ?? "Blog Details"}}
@endsection
@push('styles')
<style>
    .pricing-cards-container {
      perspective: 1000px;
    }

    .pricing-card {
      border-radius: 1.5rem;
    }

    .pricing-card:hover {
      transform: translateY(-8px);
    }

    .checkbox-section {
      margin: 20px 0;
    }

    .checkbox-line {
      display: block;
      margin-bottom: 10px;
      font-size: 15px;
    }

    .gst-box {
      padding: 15px;
      background: #fff8e5;
      border: 1px solid #ffd48b;
      border-radius: 8px;
      margin-bottom: 20px;
    }

    .horizontal-line {
      width: 100%;
      height: 1px;
      background-color: rgb(218, 218, 218);
      margin: 20px 0;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #444;
      margin-top: 14px;
    }
  </style>
  <style>
    .card-listingpage {
      width: fit-content;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px 20px;

      border-radius: 12px;
      background: linear-gradient(135deg, #ffe8f3, #e3f6ff, #e8ffe8);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-align: center;
      margin: auto;
      margin-top: 15px;

    }

    .card-listingpage p {
      margin: 0;
      font-size: 16px;
      color: #333;
      font-weight: 500;
    }

    .edit-btn {
      display: inline-block;
      padding: 10px 10px;

      color: #0616a5;
      text-decoration: underline;
      border-radius: 8px;
      font-size: 15px;
      font-weight: bold;
      transition: 0.3s;
    }

    .slide-down {
      animation: slideDown 0.6s ease forwards;
    }

    @keyframes slideDown {
      0% {
        opacity: 0;
        transform: translateY(-40px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .step-slide {
      animation: stepSlideDown 0.5s ease forwards;
    }

    @keyframes stepSlideDown {
      0% {
        opacity: 0;
        transform: translateY(-35px);
      }

      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .plan-selected {
      background: #fff8e8 !important;
      border: 2px solid #04289e !important;
      border-radius: 10px;
      position: relative;
      box-shadow: 0 0 10px rgba(255, 194, 85, 0.4);
      transform: scale(1.03);
      transition: 0.3s;
      z-index: 15;
    }

    .popular-original {
      background: #fff8e8;
      border: 2px solid #ffcc74;
      box-shadow: 0 0 10px rgba(255, 194, 85, 0.4);
    }
  </style>
  <!-- Font Awesome for icons (add to head if needed) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Custom CSS -->
<style>
  .blog-detail-page {
    font-family: 'Segoe UI', system-ui, sans-serif;
  }

  .blog-detail-banner {
    position: relative;
  }

  .blog-detail-banner-overlay {
    background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 50%, transparent 100%);
  }

  .blog-detail-title {
    font-weight: 900;
    letter-spacing: -1px;
  }

  .blog-detail-article h2 {
    font-size: 2.25rem;
    font-weight: 800;
    margin: 2.5rem 0 1.25rem;
    color: #111827;
  }

  .blog-detail-article p {
    margin-bottom: 1.5rem;
    line-height: 1.8;
  }

  .blog-detail-article ul {
    list-style-type: disc;
    padding-left: 1.5rem;
    margin: 1.5rem 0;
  }

  .blog-detail-article blockquote {
    background: #f1f5f9;
    padding: 1.5rem 2rem;
    border-radius: 12px;
    margin: 2rem 0;
  }

  .blog-detail-stats div {
    transition: transform 0.3s;
  }

  .blog-detail-stats div:hover {
    transform: scale(1.05);
  }
</style>
@endpush
@section('content')

  <!-- BLOG DETAILS PAGE -->
<div class="blog-detail-page bg-gray-50 min-h-screen">

  <!-- Top Banner with Overlay Title -->
  <div class="blog-detail-banner relative h-[500px] md:h-[650px] overflow-hidden">
    @if(!empty($blog->image))
        <br>
        <img src="{{ asset('storage/'.$blog->image) }}" class="w-full h-full object-cover">
    @else
    <img 
      src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
      alt="Blog featured image" 
      class="w-full h-full object-cover">
    @endif
    <div class="blog-detail-banner-overlay absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>
    
    <div class="blog-detail-banner-content absolute bottom-0 left-0 right-0 p-8 md:p-16 text-white">
      <span class="blog-detail-category inline-block bg-blue-600 px-5 py-2 rounded-full text-sm font-semibold mb-4">
        Success Story
      </span>
      <h1 class="blog-detail-title text-4xl md:text-6xl font-extrabold leading-tight">
        {{$blog->title ?? ""}}
      </h1>
      <div class="blog-detail-meta mt-6 flex flex-wrap gap-6 text-lg opacity-90">
        <span>By Admin</span>
        <time>{{ date('F j, Y', strtotime($blog->created_at)) }}</time>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="blog-detail-container max-w-5xl mx-auto px-6 py-16 md:py-24">
    <article class="blog-detail-article prose prose-lg max-w-none">
       {!! $blog->content!!}
    </article>

    <!-- Author Card -->
    <!-- <div class="blog-detail-author mt-16 p-8 bg-white rounded-2xl shadow-lg border border-gray-100">
      <div class="flex items-center gap-6">
        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=200&q=80" 
             alt="Author" class="w-20 h-20 rounded-full object-cover">
        <div>
          <h4 class="text-xl font-bold">Admin Team</h4>
          <p class="text-gray-600">ApnaShaher Content Writer</p>
          <p class="mt-2 text-gray-700">Helping institutes grow online since 2020</p>
        </div>
      </div>
    </div> -->

    <!-- Share Buttons -->
    <div class="blog-detail-share mt-12 flex flex-wrap gap-6 justify-center md:justify-start">
      <span class="text-gray-700 font-medium py-2">Share this article:</span>
      <a href="#" class="text-blue-600 hover:text-blue-800 text-2xl"><i class="fab fa-facebook-f"></i></a>
      <a href="#" class="text-pink-600 hover:text-pink-800 text-2xl"><i class="fab fa-instagram"></i></a>
      <a href="#" class="text-black hover:text-gray-800 text-2xl"><i class="fab fa-x-twitter"></i></a>
      <a href="#" class="text-blue-700 hover:text-blue-900 text-2xl"><i class="fab fa-linkedin-in"></i></a>
      <a href="#" class="text-red-600 hover:text-red-800 text-2xl"><i class="fab fa-whatsapp"></i></a>
    </div>

    <!-- Related Blogs -->
    <div class="blog-related mt-20">
      <h3 class="text-3xl font-bold text-center mb-12">Related Articles</h3>
      <div class="grid md:grid-cols-3 gap-8">
        <!-- Related Card (same style as listing page) -->
         @if(isset($realted_blogs) && count($realted_blogs) >0)
        @foreach($realted_blogs as $realted_blog)
        <article class="blog-card">
           @if(!empty($blog->image))
              <br>
              <img src="{{ asset('storage/'.$realted_blog->image) }}" class="w-full h-48 object-cover rounded-t-xl">
          @else
          <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=800&q=80" 
               alt="Related" class="w-full h-48 object-cover rounded-t-xl">
          @endif
          <div class="p-6">
            <h4 class="text-xl font-bold mb-3">{{$realted_blog->title ?? ""}}</h4>
            <p class="text-gray-600 mb-4 line-clamp-2">{{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($blog->content)), 120) }}</p>
            <a href="{{ route('blog-details', $realted_blog->slug) }}" class="text-blue-600 font-semibold">Read More →</a>
          </div>
        </article>
         @endforeach
      @endif
        <!-- Repeat 2 more similar cards -->
      </div>
    </div>
  </div>
</div>
@endsection