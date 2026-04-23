<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}" />
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"></noscript>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Tailwind (Compile in production) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<link rel="icon" type="image/png" sizes="32x32" href="https://apnashaher.com/7z7J6JUAFLAaTf3JffWL7k4qfn1wTlwD1qH4inko.svg">
<link rel="icon" type="image/png" sizes="16x16" href="https://apnashaher.com/7z7J6JUAFLAaTf3JffWL7k4qfn1wTlwD1qH4inko.svg">
<link rel="apple-touch-icon" href="https://apnashaher.com/7z7J6JUAFLAaTf3JffWL7k4qfn1wTlwD1qH4inko.svg">


@stack('styles')
</head>

    <body>

        <!-- Preloader -->
        @include('partials.topbar')

        
        <!-- Main Header -->
        @include('partials.header')
        <!-- End Main Header -->			

    
        
       @includeIf($pagebanner ?? '')
       @yield('content')
        

        <!-- Footer -->
        @include('partials.footer')


        @include('partials.scripts')
        
        @stack('after-scripts')
    </body>

</html>