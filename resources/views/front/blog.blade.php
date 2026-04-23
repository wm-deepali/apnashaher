@extends('layouts.app')
@section('title', 'Blogs')
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

  <!-- Custom CSS -->
<style>
  .blog-section {
    padding: 0 0 80px;
    background: #f8f9fc;
  }

  /* Banner */
  .blog-banner {
    position: relative;
    height: 420px;
    background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    overflow: hidden;
  }

  .blog-banner-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.35);
  }

  .blog-banner-content {
    position: relative;
    z-index: 2;
    max-width: 900px;
    padding: 0 20px;
  }

  .blog-main-heading {
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 1rem;
    letter-spacing: -1px;
  }

  .blog-sub-heading {
    font-size: 1.5rem;
    font-weight: 400;
    opacity: 0.95;
  }

  /* Container & Grid */
  .blog-container {
    max-width: 1280px;
    margin: -100px auto 0;
    padding: 0 20px;
    position: relative;
  }

  .blog-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 30px;
  }

  @media (min-width: 768px) {
    .blog-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (min-width: 1024px) {
    .blog-grid {
      grid-template-columns: repeat(3, 1fr);
    }
  }

  /* Blog Card */
  .blog-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    transition: all 0.35s ease;
  }

  .blog-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
  }

  .blog-card-image-wrapper {
    position: relative;
    height: 240px;
    overflow: hidden;
  }

  .blog-card-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
  }

  .blog-card:hover .blog-card-image {
    transform: scale(1.08);
  }

  .blog-card-category {
    position: absolute;
    top: 16px;
    left: 16px;
    background: rgba(59, 130, 246, 0.95);
    color: white;
    font-size: 0.85rem;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 50px;
  }

  .blog-card-content {
    padding: 24px 20px;
  }

  .blog-card-date {
    font-size: 0.9rem;
    color: #6b7280;
    display: block;
    margin-bottom: 12px;
  }

  .blog-card-title {
    font-size: 1.35rem;
    font-weight: 800;
    color: #111827;
    margin-bottom: 12px;
    line-height: 1.35;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .blog-card-excerpt {
    font-size: 1rem;
    color: #4b5563;
    line-height: 1.6;
    margin-bottom: 20px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .blog-card-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.95rem;
  }

  .blog-card-author {
    color: #6b7280;
    font-weight: 500;
  }

  .blog-read-more {
    color: #3b82f6;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s;
  }

  .blog-read-more:hover {
    color: #1d4ed8;
    text-decoration: underline;
  }

  /* Load More */
  .blog-load-more-wrapper {
    text-align: center;
    margin-top: 60px;
  }

  .blog-load-more {
    background: #3b82f6;
    color: white;
    border: none;
    padding: 16px 48px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s;
  }

  .blog-load-more:hover {
    background: #2563eb;
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
  }
</style>
@endpush

@section('content')
<!-- BLOG LISTING SECTION -->
<section class="blog-section">
  <!-- Top Banner + Heading -->
  <div class="blog-banner">
    <div class="blog-banner-overlay"></div>
    <div class="blog-banner-content">
      <h1 class="blog-main-heading">Latest Insights & Updates</h1>
      <p class="blog-sub-heading">
        Expert tips, success stories, business trends aur coaching industry ke latest updates
      </p>
    </div>
  </div>

  <!-- Blog Cards Container -->
  <div class="blog-container">
    <div class="blog-grid">

      @if(isset($blogs) && count($blogs) >0)
      @foreach($blogs as $blog)
      <!-- Blog Card 1 -->
      <article class="blog-card">
        <div class="blog-card-image-wrapper">
          @if(!empty($blog->image))
              <br>
              <img src="{{ asset('storage/'.$blog->image) }}" class="blog-card-image">
          @else
          <img 
            src="https://images.unsplash.com/photo-1522202176988-66273c2b033f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
            alt="Student success story" 
            class="blog-card-image">
          @endif
          <span class="blog-card-category">Success Story</span>
        </div>
        <div class="blog-card-content">
          <time class="blog-card-date">{{ date('F j, Y', strtotime($blog->created_at)) }}</time>
          <h2 class="blog-card-title">
            {{$blog->title ?? ""}}
          </h2>
          <p class="blog-card-excerpt">
{{ \Illuminate\Support\Str::limit(html_entity_decode(strip_tags($blog->content)), 120) }}
</p>
          <div class="blog-card-meta">
            <span class="blog-card-author">By Admin</span>
            <a href="{{ route('blog-details', $blog->slug) }}" class="blog-read-more">Read More →</a>
          </div>
        </div>
      </article>
      @endforeach
      @endif
      

    </div>

    <!-- Load More Button -->
    <div class="blog-load-more-wrapper">
      <button class="blog-load-more">Load More Blogs</button>
    </div>
  </div>
</section>


@endsection