@extends('layouts.app')
@section('title', 'Home')
@php
  $pagebanner = 'partials.home-slider';
@endphp

@section('content')
  <style>
    .seller-logo-letter {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 40px;
      font-weight: bold;
      text-transform: uppercase;
    }

    /* MOBILE VIEW ONLY */
    @media (max-width: 768px) {

      .body-grid {
        display: flex;
        flex-direction: column;
      }

      /* Categories (Top) */
      .left-sidebar {
        order: 1;
        width: 100%;
        position: static;
        /* sticky hata do mobile me */
      }

      /* Main content (Middle) */
      .main-content {
        order: 2;
        width: 100%;
      }

      /* Ads (Bottom) */
      .right-sidebar {
        order: 3;
        width: 100%;
        position: static;
        /* sticky remove */
        margin-top: 20px;
      }

      .subcategories-section {
        width: auto;
      }

      .city-card span {
        display: block;
        padding: 4px 4px;
        font-size: 12px !important;
        color: #9ca3af;
      }

      .promo-card {
        padding: 20px 0px;
      }


    }

    @media (min-width: 769px) {
      .mobile-browse-btn {
        display: none;
      }

      .category-drawer {
        display: none;
      }

      .mobile-heading {
        display: none;
      }

      .mobile-view {
        display: none;
      }

      .seller-logo-wrapper {
        display: none;
      }
    }

    /* MOBILE ONLY */
    @media (max-width: 768px) {
      .desktop-view {
        display: none;
      }

      .body-grid {
        gap: 10px;
        padding: 8px;
      }

      .section-title-wrapper h2 {
        font-size: 28px;
      }

      .punchline-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 0px;
      }

      .mobile-heading {
        width: 100%;
      }

      .mobile-heading h3 {
        font-size: 28px;
        text-align: center;
        font-weight: 800;
        color: #0d1117;
        margin: 0px;
        margin-bottom: 16px;

      }

      .mobile-heading span {
        color: blue;
        text-decoration: underline;
      }

      /* Hide desktop filters */
      .left-sidebar,
      .subcategories-section {
        display: none;
      }

      /* Browse Button */
      .mobile-browse-btn {
        width: 100%;
        padding: 10px 0;
        font-size: 0.92rem;
        font-weight: 600;
        border-radius: 7px;
        cursor: pointer;
        transition: all 0.25s;
        border: none;
        background: #1565c0;
        color: white;
        text-align: center;

        cursor: pointer;
      }

      /* Drawer */
      .category-drawer {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
        z-index: 999;
      }

      .category-drawer.active {
        display: block;
      }

      .drawer-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
      }

      .drawer-panel {
        position: absolute;
        left: 0;
        top: 0;
        width: 85%;
        height: 100%;
        background: #fff;
        padding: 15px;
        animation: slideIn 0.3s ease;
      }

      .drawer-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
      }

      .drawer-body div {
        padding: 10px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
      }

      .drawer-body div:hover {
        background: #f1f5f9;
      }

      .hidden {
        display: none;
      }

      @keyframes slideIn {
        from {
          transform: translateX(-100%);
        }

        to {
          transform: translateX(0);
        }
      }
    }

    .breadcrumb {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      font-size: 13px;
      color: #666;
      margin-left: 10px;
      margin: bottom:0px;
    }

    .breadcrumb a {
      text-decoration: none;
      color: #0d6efd;
      transition: 0.2s;
    }

    .breadcrumb a:hover {
      text-decoration: underline;
    }

    .separator {
      margin: 0 6px;
      color: #999;
    }

    .breadcrumb .active {
      color: #333;
      font-weight: 500;
    }

    /* default desktop */
    .seller-logo-wrapper" {
   display: none;
    }

    .testimonial-slider-update {
      padding: 80px 0px;
    }

    .testimonial-heading {
      font-size: 3.5rem;
      line-height: 60px;
    }

    /* mobile fix */
    @media (max-width: 768px) {
      .testimonial-slider-update {
        padding: 40px 0px;
      }

      /* top row visible */
      .seller-top {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
      }

      .seller-logo {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: contain !important;
      }

      /*.seller-name {*/
      /*  font-size: 16px;*/
      /*  margin: 0;*/
      /*}*/

      .seller-name-row {
        flex: 1;
      }

      /* sidebar full width  */
      .seller-sidebar {
        width: 100%;
        margin-top: 10px;
      }


      .desktop-logo {
        display: none;
      }

      .feature-box {
        padding: 20px;
      }

      .right-sidebar {
        background: #ffffff00;
        padding: 0px;
      }

      .hero-punchline {
        background: #ffffff00;
      }

      .promo-card h2 {
        font-size: 28px;
      }

      .frustration-container {
        padding: 0 8px;
      }

      .faq-section {
        padding: 30px 0;
        margin-top: 0px;
      }

      .faq-title {
        font-size: 28px;
        font-weight: 800;
        color: #333;
        margin-bottom: 25px;
        margin-left: 10px;
      }

      .faq-form-card {
        background: #fff;
        padding: 45px 15px;
        border-radius: 14px;
        box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.07);
      }

      .list-institute-section {
        background-color: #fff;
        padding: 40px 0 40px;
      }

      .edu-local-body-section {
        /* background: white; */
        padding: 40px 0 40px;
      }

      .seller-main {
        flex: 1;
        padding: 28px 24px;
        display: flex;
        flex-direction: column;
        gap: 7px;
      }

      .view-more-btn {
        width: 100%;
      }

      .list-institute-section {
        background-color: #fff;
        padding: 40px 0 40px;
      }

      .text-4xl {
        font-size: 32px;
        line-height: 2.5rem;
      }

      .testimonial-heading {
        font-size: 32px;
      }

      .seller-logo-wrapper {
        height: auto;
      }

      .slideshow-container {
        height: 142px;
      }

      .sub-card {
        width: 100%;
        height: 40px;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        /* white-space: nowrap; */
        background: #f0f7ff;
        padding: 9px 10px;
        border-radius: 7px;
        text-align: center;
        font-weight: 600;
        color: #1565c0;
        font-size: 12px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      }

      .mobile-style {
        height: auto !important;
        display: none !important;

      }

      .hero-container {
        gap: 0px !important;
      }
    }
  </style>

  <!-- Hero / Main Punchline Section -->
  <section class="hero-punchline desktop-view bg-gray-50">
    <div class="punchline-container">
      <h1 class="main-heading">Find Educational Institutes<br> in Your City</h1>
      <p class="sub-heading">Compare courses, explore verified institutes, and connect directly.</p>

      <div class="button-group">
        <button class="btn btn-student">Seach Institutes in Your City</button>
        <button class="btn btn-institute">List Your Institute (Free)</button>
      </div>
    </div>
  </section>


  <!-- ==================== CATEGORIES SECTION ==================== -->
  <!-- ==================== CATEGORIES SECTION (Final) ==================== -->
  <section class="py-6 md:py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4">

      <!-- Header -->
      <!-- ==================== CATEGORIES HEADER ==================== -->
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">

        <!-- Left / Center on Mobile -->
        <div class="flex-1 text-center md:text-left">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
            Categories
          </h2>
          <p class="text-gray-500 text-base md:text-lg mt-2">
            Explore coaching institutes by category
          </p>
        </div>

        <!-- View All Link -->
        <div class="flex justify-center md:justify-end">
          <a href="{{ url('/explore-institutes') }}"
            class="text-blue-600 font-semibold hover:underline text-base md:text-lg whitespace-nowrap">
            View All Categories →
          </a>
        </div>

      </div>

      <!-- Categories Grid -->
      <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-7 gap-3 md:gap-4">

        @php
          $colors = [
            ['bg' => '#f0f4ff', 'hover' => '#e0e9ff', 'iconBg' => '#ffffff', 'iconColor' => '#3b82f6'],
            ['bg' => '#fff0f5', 'hover' => '#ffe4f0', 'iconBg' => '#ffffff', 'iconColor' => '#ec4899'],
            ['bg' => '#f0fdf4', 'hover' => '#d1f8e8', 'iconBg' => '#ffffff', 'iconColor' => '#22c55e'],
            ['bg' => '#fef3e8', 'hover' => '#fde8d3', 'iconBg' => '#ffffff', 'iconColor' => '#f97316'],
            ['bg' => '#f3e8ff', 'hover' => '#e9d5ff', 'iconBg' => '#ffffff', 'iconColor' => '#a855f7'],
            ['bg' => '#ecfdf5', 'hover' => '#c6f6e0', 'iconBg' => '#ffffff', 'iconColor' => '#10b981'],
            ['bg' => '#fefce8', 'hover' => '#fef9c3', 'iconBg' => '#ffffff', 'iconColor' => '#eab308'],
          ];
        @endphp

        @foreach($categories as $index => $category)

          @php
            $color = $colors[$index % count($colors)];
          @endphp

          <div onclick="window.location.href='{{ url('/') }}/{{ $category->slug }}-institutes'"
            class="aspect-square rounded-2xl p-3 md:p-5 text-center transition-all hover:shadow-md group cursor-pointer flex flex-col items-center justify-center"
            style="background: {{ $color['bg'] }};" onmouseover="this.style.background='{{ $color['hover'] }}'"
            onmouseout="this.style.background='{{ $color['bg'] }}'">

            <!-- Icon -->
            <div
              class="w-10 h-10 md:w-12 md:h-12 mx-auto rounded-2xl flex items-center justify-center text-2xl shadow-sm mb-3 group-hover:scale-110 transition-transform"
              style="background: {{ $color['iconBg'] }}; color: {{ $color['iconColor'] }};">
              <i class="{{ $category->icons ?? 'fas fa-building' }}"></i>
            </div>

            <!-- Name -->
            <p class="font-semibold text-gray-800 text-[11px] md:text-sm text-center">
              {{ $category->name }}
            </p>

          </div>

        @endforeach

      </div>
    </div>
  </section>


  <!-- this section will be done once we finalised other things -->

<!-- SECTION 1 -->
 <section class="py-10 bg-white">
  <div class="max-w-7xl mx-auto px-4">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
      <div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
          Featured Institutes
        </h2>
        <p class="text-gray-500 text-base md:text-lg mt-2 max-w-2xl">
          Top verified institutes recommended for you
        </p>
      </div>

      <a href="{{ url('/explore-institutes') }}"
         class="text-blue-600 font-semibold hover:underline whitespace-nowrap text-base md:text-lg">
        View All Institutes →
      </a>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

      @forelse($featuredInstitutes as $inst)

      <div onclick="window.location.href='{{ url('/') }}/{{ $inst->slug }}'"
           class="border rounded-xl p-4 hover:shadow-lg transition bg-white cursor-pointer">

        <!-- Tag -->
        <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full">
          Featured
        </span>

        <!-- Logo -->
        <div class="flex justify-center my-4">
          @if($inst->logo)
            <img src="{{ asset('storage/'.$inst->logo) }}"
                 class="w-16 h-16 rounded-full object-contain">
          @else
            <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-xl font-bold">
              {{ strtoupper(substr($inst->name,0,1)) }}
            </div>
          @endif
        </div>

        <!-- Name + Verified -->
        <div class="text-center">
          <h3 class="font-semibold text-lg flex justify-center items-center gap-1">
            {{ $inst->name }}

            @if(optional(optional($inst->latestPlan)->plan)->features?->verified_badge)
              <span class="text-blue-500 text-sm">✔</span>
            @endif
          </h3>
        </div>

        <!-- Description -->
        <p class="text-gray-500 text-sm text-center mt-2 line-clamp-2">
          {{ \Illuminate\Support\Str::limit($inst->description, 80) }}
        </p>

        <!-- Location -->
        <div class="text-center text-sm text-gray-600 mt-2">
          📍 {{ $inst->city->name ?? '' }}
        </div>

        <!-- Buttons -->
        <div class="mt-4 space-y-2">

          <a href="tel:{{ $inst->mobile }}"
             class="block w-full bg-blue-600 text-white py-2 rounded-lg text-center">
            Call Now
          </a>

          <a href="https://wa.me/{{ $inst->whatsapp }}"
             target="_blank"
             class="block w-full border border-blue-600 text-blue-600 py-2 rounded-lg text-center">
            WhatsApp
          </a>

        </div>

      </div>

      @empty

      <!-- Empty State -->
      <div class="col-span-full text-center py-10 text-gray-500">
        No featured institutes available
      </div>

      @endforelse

    </div>
  </div>
</section>


  <!-- SECTION 2 -->
 <section class="py-10 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
      <div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
          Popular Institutes
        </h2>
        <p class="text-gray-500 text-base md:text-lg mt-2 max-w-2xl">
          Most searched institutes by students
        </p>
      </div>

      <a href="{{ url('/explore-institutes') }}"
         class="text-blue-600 font-semibold hover:underline whitespace-nowrap text-base md:text-lg">
        View All Institutes →
      </a>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 bg-[#f8f7ff] py-8 px-6 -mx-6 rounded-3xl">

      @forelse($popularInstitutes as $inst)

      <div onclick="window.location.href='{{ url('/') }}/{{ $inst->slug }}'"
           class="border rounded-xl p-4 hover:shadow-lg transition bg-white cursor-pointer">

        <!-- Tag -->
        <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded-full">
          Popular
        </span>

        <!-- Logo -->
        <div class="flex justify-center my-4">
          @if($inst->logo)
            <img src="{{ asset('storage/'.$inst->logo) }}"
                 class="w-16 h-16 rounded-full object-contain">
          @else
            <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-xl font-bold">
              {{ strtoupper(substr($inst->name,0,1)) }}
            </div>
          @endif
        </div>

        <!-- Name + Verified -->
        <div class="text-center">
          <h3 class="font-semibold text-lg flex justify-center items-center gap-1">
            {{ $inst->name }}

            @if(optional(optional($inst->latestPlan)->plan)->features?->verified_badge)
              <span class="text-blue-500 text-sm">✔</span>
            @endif
          </h3>
        </div>

        <!-- Description -->
        <p class="text-gray-500 text-sm text-center mt-2 line-clamp-2">
          {{ \Illuminate\Support\Str::limit($inst->description, 80) }}
        </p>

        <!-- Location -->
        <div class="text-center text-sm text-gray-600 mt-2">
          📍 {{ $inst->city->name ?? '' }}
        </div>

        <!-- Buttons -->
        <div class="mt-4 space-y-2">

          <a href="tel:{{ $inst->mobile }}"
             class="block w-full bg-blue-600 text-white py-2 rounded-lg text-center">
            Call Now
          </a>

          <a href="https://wa.me/{{ $inst->whatsapp }}"
             target="_blank"
             class="block w-full border border-blue-600 text-blue-600 py-2 rounded-lg text-center">
            WhatsApp
          </a>

        </div>

      </div>

      @empty

      <!-- Empty State -->
      <div class="col-span-full text-center py-10 text-gray-500">
        No popular institutes available
      </div>

      @endforelse

    </div>
  </div>
</section>
  


  <!-- SECTION 3 -->
<section class="py-10 bg-white">
  <div class="max-w-7xl mx-auto px-4">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
      <div>
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
          Newly Added Institutes
        </h2>
        <p class="text-gray-500 text-base md:text-lg mt-2 max-w-2xl">
          Recently joined institutes on ApnaShaher
        </p>
      </div>

      <a href="{{ url('/explore-institutes') }}"
         class="text-blue-600 font-semibold hover:underline whitespace-nowrap text-base md:text-lg">
        View All Institutes →
      </a>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

      @forelse($recentInstitutes as $inst)

      <div onclick="window.location.href='{{ url('/') }}/{{ $inst->slug }}'"
           class="border rounded-xl p-4 hover:shadow-lg transition bg-white cursor-pointer">

        <!-- Tag -->
        <span class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">
          New
        </span>

        <!-- Logo -->
        <div class="flex justify-center my-4">
          @if($inst->logo)
            <img src="{{ asset('storage/'.$inst->logo) }}"
                 class="w-16 h-16 rounded-full object-contain">
          @else
            <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center text-xl font-bold">
              {{ strtoupper(substr($inst->name,0,1)) }}
            </div>
          @endif
        </div>

        <!-- Name + Verified -->
        <div class="text-center">
          <h3 class="font-semibold text-lg flex justify-center items-center gap-1">
            {{ $inst->name }}

            @if(optional(optional($inst->latestPlan)->plan)->features?->verified_badge)
              <span class="text-blue-500 text-sm">✔</span>
            @endif
          </h3>
        </div>

        <!-- Description -->
        <p class="text-gray-500 text-sm text-center mt-2 line-clamp-2">
          {{ \Illuminate\Support\Str::limit($inst->description, 80) }}
        </p>

        <!-- Location -->
        <div class="text-center text-sm text-gray-600 mt-2">
          📍 {{ $inst->city->name ?? '' }}
        </div>

        <!-- Buttons -->
        <div class="mt-4 space-y-2">

          <a href="tel:{{ $inst->mobile }}"
             class="block w-full bg-blue-600 text-white py-2 rounded-lg text-center">
            Call Now
          </a>

          <a href="https://wa.me/{{ $inst->whatsapp }}"
             target="_blank"
             class="block w-full border border-blue-600 text-blue-600 py-2 rounded-lg text-center">
            WhatsApp
          </a>

        </div>

      </div>

      @empty

      <!-- Empty State -->
      <div class="col-span-full text-center py-10 text-gray-500">
        No new institutes available
      </div>

      @endforelse

    </div>
  </div>
</section>

  <!-- this section will be done once we finalised other things -->

  <!-- ==================== IMPROVED BODY CONTENT SECTION ==================== -->
  <section class="edu-local-body-section">
    <div class="body-grid">
      <!-- MOBILE BROWSE BUTTON -->
      <div class="mobile-heading">
        <h3>
          Recently Added Listings in
          <span id="cityName">Delhi</span>
        </h3>
      </div>


      <div class="mobile-browse-btn" onclick="openCategoryDrawer()">
        <i class="fas fa-th-large"></i> Browse Categories
      </div>
      <div class="mobile-heading">
        <nav class="breadcrumb">

          <a href="#">Home</a>
          <span class="separator">›</span>

          <a href="#">Board & Academic Coachings</a>
          <span class="separator">›</span>

          <span class="active">Delhi</span>

        </nav>
      </div>

      <div class="category-drawer" id="categoryDrawer">

        <div class="drawer-overlay" onclick="closeCategoryDrawer()"></div>

        <div class="drawer-panel">

          <!-- Header -->
          <div class="drawer-header">
            <h4 id="drawerTitle">Categories</h4>
            <span onclick="closeCategoryDrawer()">✖</span>
          </div>

          <!-- Category List -->
          <!--<div class="drawer-body" id="drawerCategoryList"></div>-->
          <div class="category-list" id="categoryList"></div>

          <!-- Subcategory List -->
          <div class="drawer-body hidden" id="drawerSubCategoryList"></div>

        </div>

      </div>

      <!-- LEFT SIDEBAR - Categories (Sticky) -->
      <aside class="left-sidebar">
        <h3 class="sidebar-title">Categories</h3>
        <div class="category-list" id="categoryListside"></div>
      </aside>


      <!-- CENTER - Main Content -->
      <div class="main-content">

        <!-- Sticky Subcategories -->
        <div class="subcategories-section" id="subcategoriesSection">
          <h4 class="sub-title" id="activeCategoryName"></h4>
          <div class="sub-grid" id="subGrid"></div>
        </div>

        <!-- Seller Cards Grid -->
        <div class="seller-grid" id="sellerGrid"></div>

        <!-- View More -->
        <div class="view-more-wrapper">
          <button class="view-more-btn" onclick="goToListing()">
            View All Institutes <i class="fas fa-arrow-right"></i>
          </button>
        </div>

      </div>


      <!-- RIGHT SIDEBAR - Rotating Banner (Sticky) -->
      <aside class="right-sidebar">
        <section class="hero-punchline mobile-view">
          <div class="punchline-container">
            <h1 class="main-heading">Find Educational Institutes<br> in Your City</h1>
            <p class="sub-heading">Compare courses, explore verified institutes, and connect directly.</p>

            <div class="button-group">
              <button class="btn btn-student">Seach Institutes in Your City</button>
              <button class="btn btn-institute">List Your Institute (Free)</button>
            </div>
          </div>
        </section>
        <!-- <h3 class="sidebar-title">Featured Partners</h3> -->
        <div class="ad-rotator" id="adRotator"></div>
      </aside>

    </div>
  </section>


  <!-- ==================== WHY APNASHAHER SECTION ==================== -->
  <!-- ==================== UNDERSTAND FRUSTRATION - NUMBERED CARDS ==================== -->
  <section class="frustration-section">
    <div class="frustration-container">

      <div class="section-title-wrapper">
        <p class="highlight-sub">That’s Why ApnaShaher Works Differently</p>
        <h2>We Understand the Real Problem</h2>

      </div>

      <div class="intro-paragraph">
        Finding genuine students or trustworthy institutes has become confusing, expensive, and unreliable on most
        platforms.<br><span style="color:blue;">ApnaShaher</span> brings back simplicity, trust, and local relevance.


      </div>

      <div class="features-grid-4">
        <!-- Card 01 - Light Blue -->
        <div class="feature-box" style="--card-color: #e3f2fd; --number-bg: #bbdefb;">
          <div class="number-circle">01</div>
          <h3>Local First Approach</h3>
          <!-- <p>We focus only on institutes in your city & nearby — real results, no noise.</p> -->
        </div>

        <!-- Card 02 - Light Green -->
        <div class="feature-box" style="--card-color: #e8f5e9; --number-bg: #c8e6c9;">
          <div class="number-circle">02</div>
          <h3>Manual Verification</h3>
          <!-- <p>Every listing is checked by our team — accurate info you can trust.</p> -->
        </div>

        <!-- Card 03 - Light Purple -->
        <div class="feature-box" style="--card-color: #f3e5f5; --number-bg: #e1bee7;">
          <div class="number-circle">03</div>
          <h3>Direct & Free Contact</h3>
          <!-- <p>No lead selling, no hidden charges — students reach you directly.</p> -->
        </div>

        <!-- Card 04 - Light Orange -->
        <div class="feature-box" style="--card-color: #fff3e0; --number-bg: #ffe0b2;">
          <div class="number-circle">04</div>
          <h3>Trusted Since 2008</h3>
          <!-- <p>18+ years of helping local education community grow with honesty.</p> -->
        </div>
      </div>

      <div class="bottom-cta-area">
        <p>Ready for a simpler and more transparent way to connect students and institutes?</p>
        <button class="explore-btn">Start Exploring Institutes →</button>
      </div>

    </div>
  </section>



  <!-- ==================== LIST YOUR INSTITUTE SECTION (INTERACTIVE STEPS) ==================== -->

  <section class="faq-section">
    <div class="faq-container">
      <!-- LEFT SIDE FAQ -->
      <div class="faq-left">
        <h2 class="faq-title">Frequently Asked Questions</h2>
        <div class="faq-box">

          @foreach($faqs as $faq)

            <div class="faq-item">
              <div class="faq-question-row">
                <h3 class="faq-question">{{ $faq->question }}</h3>
                <span class="faq-icon">+</span>
              </div>

              <div class="faq-answer">
                {!! $faq->answer !!}
              </div>
            </div>

          @endforeach


        </div>
      </div>

      <!-- RIGHT SIDE ENQUIRY FORM (unchanged) -->
      <div class="faq-right">
        <div class="faq-form-card">
          <h2 class="faq-form-title">Send Us an Enquiry</h2>
          <p class="faq-form-sub">
            Have questions? Need help? Submit your enquiry and our team will reach out soon.
          </p>
          <form class="faq-form" id="homeenquiryForm">

            <input type="text" class="faq-input" name="full_name" placeholder="Full Name" value="">

            <input type="email" name="email_address" id="email-address" class="faq-input" placeholder="Email Address"
              value="">
            <div class="faq-phone-group">
              <select class="faq-country" name="country_code">
                <option value="+91">🇮🇳 +91</option>
              </select>

              <input type="tel" onkeypress="return isNumber(event)" class="faq-input phone-input" name="mobile_number"
                id="mobile-number" autocomplete="off" placeholder="Mobile Number" value="">
              <p id="verified_badge" style="color:green;display:none;">Verified</p>
            </div>
            <input type="tel" name="mobile" id="mob_in" class="form-control" style="display:none;" />
            <input type="text" name="isValid" id="is_valid_number" value="0" class="form-control" style="display:none;" />
            <div class="form-group mb-2" id="otp_field" style="display: none;">
              <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP" maxlength="6" />
            </div>
            <!-- <button type="button" class="otp-btn mb-2" id="send-otp-bt" onclick="sendOTP()">
                            Send OTP
                        </button>
                        <button type="button" class="otp-btn mb-2" id="verify-otp-bt" style="display: none;" onclick="verifyOTP()">
                            Verify
                        </button> -->
            <button type="button" class="otp-btn mb-2" id="resend-otp-bt" style="display:none;"
              onclick="sendOTP()">Re-Send OTP</button>
            <textarea name="message" class="faq-textarea" rows="4" placeholder="Write your message..."></textarea>
            <div class="col-md-12">
              <div class="g-recaptcha mb-2"></div>
            </div>
            <button type="submit" class="faq-btn">Submit Enquiry</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <section class="list-institute-section">
    <div class="list-container">

      <!-- Hero Promotion -->
      <div class="promo-card">
        <h2>Still waiting for students to find you?</h2>
        <p>Create your institute profile and get discovered by students in your area</p>
        <div class="promo-action">
          <button class="list-btn primary">List Your Institute – It’s Free</button>
        </div>
      </div>



    </div>
  </section>
  <!-- ==================== TRUSTED BY BUSINESSES SLIDER ==================== -->
  <section class=" to-gray-50  overflow-hidden testimonial-slider-update pb-4">
    <div class="max-w-7xl mx-auto  ">
      <!-- Title -->
      <div class="text-center px-6 py-6">
        <h2 class=" font-extrabold text-gray-900 testimonial-heading">
          Trusted by Institutes
          <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-yellow-500">
            Across India
          </span>
        </h2>
        <p class="mt-5 text-xl text-gray-600 font-medium">
          Real Feedback. Real Results.
        </p>
        <p class="mt-3 text-lg text-gray-500 max-w-3xl mx-auto">
          We’re proud to be the digital growth partner for Institutes nationwide
        </p>
      </div>

      <!-- Swiper Slider -->
      <div class="swiper testimonialSlider px-4 py-4">
        <div class="swiper-wrapper testimonial-slider-update">

          <!-- Slide 1 -->
          <div class="swiper-slide">
            <div
              class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 group h-full flex flex-col">
              <div class="flex items-center gap-4 mb-6">
                <img src="https://ashtonwell.com/public/assets/images/adnanahmed.avif" alt="Adnan Ahmed"
                  class="w-16 h-16 rounded-full object-cover ring-4 ring-blue-100">
                <div>
                  <h4 class="font-bold text-gray-900 text-lg">Adnan Ahmed</h4>
                  <p class="text-sm text-gray-600">Founder, IT Training Institute</p>
                </div>
              </div>
              <div class="flex gap-1 mb-5">
                <i class="fas fa-star text-yellow-500 text-xl"></i>
                <i class="fas fa-star text-yellow-500 text-xl"></i>
                <i class="fas fa-star text-yellow-500 text-xl"></i>
                <i class="fas fa-star text-yellow-500 text-xl"></i>
                <i class="fas fa-star text-yellow-500 text-xl"></i>
              </div>
              <p class="text-gray-700 italic leading-relaxed flex-grow">
                "A good initiative for local institutes. The platform is clean and easy to understand.
                It helps institutes like us to be visible online without spending too much."
              </p>
              <div class="mt-6 text-blue-200 text-6xl opacity-30">
                <i class="fas fa-quote-right"></i>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="swiper-slide">
            <div
              class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 group h-full flex flex-col">
              <div class="flex items-center gap-4 mb-6">
                <img src="https://ashtonwell.com/public/assets/images/sumitkumar.jpg" alt="Sumit Kumar"
                  class="w-16 h-16 rounded-full object-cover ring-4 ring-blue-100">
                <div>
                  <h4 class="font-bold text-gray-900 text-lg">Sumit Kumar</h4>
                  <p class="text-sm text-gray-600">Founder, The Exam Time</p>
                </div>
              </div>
              <div class="flex gap-1 mb-5">
                <i class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i>
              </div>
              <p class="text-gray-700 italic leading-relaxed flex-grow">
                "The Web Mingo team helped us build a robust online education system that’s easy to manage and fast. we
                love the platform’s speed and design. Highly recommended!"
              </p>
              <div class="mt-6 text-blue-200 text-6xl opacity-30">
                <i class="fas fa-quote-right"></i>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="swiper-slide">
            <div
              class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 group h-full flex flex-col">
              <div class="flex items-center gap-4 mb-6">
                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Andy Cox"
                  class="w-16 h-16 rounded-full object-cover ring-4 ring-blue-100">
                <div>
                  <h4 class="font-bold text-gray-900 text-lg">Rajiv Gupta</h4>
                  <p class="text-sm text-gray-600">Owner, Academic Coaching</p>
                </div>
              </div>
              <div class="flex gap-1 mb-5">
                <i class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i>
              </div>
              <p class="text-gray-700 italic leading-relaxed flex-grow">
                "The listing process was very simple and quick. It hardly took a few minutes to create institute profile.
                Looking forward to reaching more students through this platform."
              </p>
              <div class="mt-6 text-blue-200 text-6xl opacity-30">
                <i class="fas fa-quote-right"></i>
              </div>
            </div>
          </div>

          <!-- Slide 4 -->
          <div class="swiper-slide">
            <div
              class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 group h-full flex flex-col">
              <div class="flex items-center gap-4 mb-6">
                <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Mohd Rais"
                  class="w-16 h-16 rounded-full object-cover ring-4 ring-blue-100">
                <div>
                  <h4 class="font-bold text-gray-900 text-lg">Mohd Rais</h4>
                  <p class="text-sm text-gray-600">Founder, Commerce Coaching</p>
                </div>
              </div>
              <div class="flex gap-1 mb-5">
                <i class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i>
              </div>
              <p class="text-gray-700 italic leading-relaxed flex-grow">
                "We liked the concept of connecting students directly with institutes.
                The profile setup was smooth, and everything is well structured."
              </p>
              <div class="mt-6 text-blue-200 text-6xl opacity-30">
                <i class="fas fa-quote-right"></i>
              </div>
            </div>
          </div>

          <!-- Slide 5 -->
          <div class="swiper-slide">
            <div
              class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 group h-full flex flex-col">
              <div class="flex items-center gap-4 mb-6">
                <img src="https://ashtonwell.com/public/assets/images/rajesh-prasad.jpeg" alt="Rajesh Prasad"
                  class="w-16 h-16 rounded-full object-cover ring-4 ring-blue-100">
                <div>
                  <h4 class="font-bold text-gray-900 text-lg">Rajesh Prasad</h4>
                  <p class="text-sm text-gray-600">Principal, Regional College of Polytechnic</p>
                </div>
              </div>
              <div class="flex gap-1 mb-5">
                <i class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i>
              </div>
              <p class="text-gray-700 italic leading-relaxed flex-grow">
                "They built a complete website for our college that’s informative, modern, and easy for students to use.
                The team was professional and supportive throughout."
              </p>
              <div class="mt-6 text-blue-200 text-6xl opacity-30">
                <i class="fas fa-quote-right"></i>
              </div>
            </div>
          </div>

          <!-- Slide 6 -->
          <div class="swiper-slide">
            <div
              class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 group h-full flex flex-col">
              <div class="flex items-center gap-4 mb-6">
                <img src="https://ashtonwell.com/public/assets/images/mohd-umar.jpeg" alt="Mohd Umar"
                  class="w-16 h-16 rounded-full object-cover ring-4 ring-blue-100">
                <div>
                  <h4 class="font-bold text-gray-900 text-lg">Mohd. Umar</h4>
                  <p class="text-sm text-gray-600">Owner, Skill Development Institute</p>
                </div>
              </div>
              <div class="flex gap-1 mb-5">
                <i class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i>
              </div>
              <p class="text-gray-700 italic leading-relaxed flex-grow">
                "ApnaShaher looks promising for local visibility. The idea of category-based listing and direct enquiry is
                very useful for institutes."
              </p>
              <div class="mt-6 text-blue-200 text-6xl opacity-30">
                <i class="fas fa-quote-right"></i>
              </div>
            </div>
          </div>

          <!-- Slide 7 -->
          <div class="swiper-slide">
            <div
              class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 group h-full flex flex-col">
              <div class="flex items-center gap-4 mb-6">
                <img src="https://randomuser.me/api/portraits/women/39.jpg" alt="Ms Sheefali Nag"
                  class="w-16 h-16 rounded-full object-cover ring-4 ring-blue-100">
                <div>
                  <h4 class="font-bold text-gray-900 text-lg">Ms Sheefali Srivastava</h4>
                  <p class="text-sm text-gray-600">Founder, Language Instutute</p>
                </div>
              </div>
              <div class="flex gap-1 mb-5">
                <i class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i>
              </div>
              <p class="text-gray-700 italic leading-relaxed flex-grow">
                "Creating our listing was easy and hassle-free.
                It’s good to see a platform focused specifically on local institutes."
              </p>
              <div class="mt-6 text-blue-200 text-6xl opacity-30">
                <i class="fas fa-quote-right"></i>
              </div>
            </div>
          </div>

          <!-- Slide 8 -->
          <div class="swiper-slide">
            <div
              class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 group h-full flex flex-col">
              <div class="flex items-center gap-4 mb-6">
                <img src="https://ashtonwell.com/public/assets/images/pratibhasachan.jpg1" alt="Mr. Vineet Kumar"
                  class="w-16 h-16 rounded-full object-cover ring-4 ring-blue-100">
                <div>
                  <h4 class="font-bold text-gray-900 text-lg">Mr. Vineet Kumar</h4>
                  <p class="text-sm text-gray-600">Director, Polytechnic Institute</p>
                </div>
              </div>
              <div class="flex gap-1 mb-5">
                <i class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i><i class="fas fa-star text-yellow-500 text-xl"></i><i
                  class="fas fa-star text-yellow-500 text-xl"></i>
              </div>
              <p class="text-gray-700 italic leading-relaxed flex-grow">
                "A simple and economical way for institutes to get online visibility.
                Excited to see how this platform grows."
              </p>
              <div class="mt-6 text-blue-200 text-6xl opacity-30">
                <i class="fas fa-quote-right"></i>
              </div>
            </div>
          </div>

        </div>

        <!-- Navigation Arrows -->
        <div class="swiper-button-next text-blue-600 after:text-3xl"></div>
        <div class="swiper-button-prev text-blue-600 after:text-3xl"></div>

        <!-- Pagination Dots -->
        <div class="swiper-pagination !bottom-0 pt-6"></div>
      </div>

    </div>
  </section>
  <section class="list-institute-section">
    <div class="list-container">

      <!-- Hero Promotion -->
      <div class="promo-card">
        <h2>Find Institutes in Popular Cities</h2>
        <p>Explore coaching and training institutes across major cities near you</p>
        <div class="popular-cities-section">

          <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-6 gap-2 md:gap-5">
            @if(isset($poppularcities) && count($poppularcities) > 0)
              @foreach($poppularcities as $poppularcity)
                <div class="city-card">
                  <img src="{{ asset('storage/' . $poppularcity->image) }}" alt="Lucknow" class="city-img">
                  <span>{{$poppularcity->name}}</span>
                </div>
              @endforeach
            @endif

          </div>
        </div>
      </div>



    </div>
  </section>

  <script>

    // OPEN / CLOSE
    function openCategoryDrawer() {
      document.getElementById("categoryDrawer").classList.add("active");
      loadCategories();
    }

    function closeCategoryDrawer() {
      document.getElementById("categoryDrawer").classList.remove("active");
    }

    // LOAD CATEGORY (existing data se map karna hai)
    function loadCategories() {
      let categories = document.querySelectorAll("#categoryList div");
      let container = document.getElementById("drawerCategoryList");

      container.innerHTML = "";

      categories.forEach(cat => {
        let item = document.createElement("div");
        item.innerText = cat.innerText;

        item.onclick = function () {
          loadSubCategories(cat.innerText);
        };

        container.appendChild(item);
      });

      document.getElementById("drawerCategoryList").classList.remove("hidden");
      document.getElementById("drawerSubCategoryList").classList.add("hidden");
    }

    // LOAD SUBCATEGORY
    function loadSubCategories(categoryName) {

      let subContainer = document.getElementById("drawerSubCategoryList");
      let container = document.getElementById("drawerCategoryList");

      container.classList.add("hidden");
      subContainer.classList.remove("hidden");

      document.getElementById("drawerTitle").innerText = categoryName;

      // demo (replace with real data)
      let subs = ["Sub 1", "Sub 2", "Sub 3"];

      subContainer.innerHTML = "";

      subs.forEach(sub => {
        let item = document.createElement("div");
        item.innerText = sub;

        item.onclick = function () {
          filterData(sub);
          closeCategoryDrawer();
        };

        subContainer.appendChild(item);
      });
    }

    // FILTER FUNCTION
    function filterData(subcategory) {
      console.log("Filter by:", subcategory);
    }

  </script>
  <script>

    const cities = ["Delhi", "Noida", "Gurgaon", "Ghaziabad", "Faridabad"];
    let index = 0;

    setInterval(() => {
      const cityElement = document.getElementById("cityName");

      // fade out
      cityElement.style.opacity = 0;

      setTimeout(() => {
        index = (index + 1) % cities.length;
        cityElement.innerText = cities[index];

        // fade in
        cityElement.style.opacity = 1;
      }, 300);

    }, 2000);

  </script>

  <script>
    function goToListing() {
      let category = document.getElementById('currentSelectionSlug').value;
      let city = document.getElementById('currentcityslug').value;

      // Default category
      if (!category) {
        category = "explore";
      }

      let url = "{{ url('/') }}/" + category + "-institutes";
      //(url);
      // Add city if exists
      if (city) {
        url += "-in-" + city;
      }

      window.location.href = url;
    }
  </script>

@endsection