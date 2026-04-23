@extends('layouts.app')
@section('title', 'Advertise With Us')
@push('styles')

<!-- Font Awesome for social icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Custom CSS -->
<style>
  .advertise-hero-title {
    font-weight: 900;
    letter-spacing: -0.03em;
  }
  .advertise-hero-btn {
    box-shadow: 0 10px 25px rgba(255,255,255,0.2);
  }
  .advertise-why-image img {
    transition: transform 0.6s ease;
  }
  .advertise-why-image:hover img {
    transform: scale(1.05);
  }
  .advertise-model-card {
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
  }
  .advertise-model-card:hover {
    transform: translateY(-8px);
    background: rgba(255,255,255,0.2);
  }
  .advertise-form-card {
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
  }
</style>
 @endpush
@section('content')
<!-- ADVERTISE WITH US PAGE -->
<div class="advertise-page bg-gray-50 min-h-screen">

  <!-- 1. Hero Banner -->
  <section class="advertise-hero relative bg-gradient-to-br from-blue-900 to-indigo-900 text-white py-32 md:py-48 text-center overflow-hidden">
    <div class="absolute inset-0 opacity-20">
      <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&q=80&w=2000" 
           alt="Global business" class="w-full h-full object-cover opacity-30">
    </div>
    
    <div class="advertise-hero-content relative z-10 max-w-5xl mx-auto px-6">
      <h1 class="advertise-hero-title text-4xl md:text-6xl font-extrabold leading-tight mb-6">
Promote Your Brand with Smart Visibility
</h1>
      <p class="advertise-hero-subtitle text-xl md:text-2xl max-w-4xl mx-auto mb-10">
       Advertise on ApnaShaher through flexible options like banner ads, pay-per-click campaigns, and impression-based visibility designed to improve your reach across relevant audiences.
</p>
      <a href="#" class="advertise-hero-btn inline-block bg-white text-blue-900 px-10 py-5 rounded-xl font-bold text-xl hover:bg-gray-100 transition shadow-lg">
        Start Advertising →
      </a>
    </div>
  </section>

  <!-- 2. Why Advertise Section -->
  <section class="advertise-why py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
      <div class="space-y-8">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
          Promote Your Brand with Smart<br>
<span class="text-blue-600">Advertising Options</span>
        </h2>
        
        
        
        
        <p class="text-xl text-gray-700 leading-relaxed">
          We connect you with a diverse audience, maximizing your brand's visibility and generating high-quality leads from local to global customers.
        </p>
        <ul class="space-y-6 text-lg text-gray-700">
          <li class="flex gap-4 items-start">
            <span class="text-green-500 text-3xl">✔</span>
            <span>ApnaShaher offers multiple advertising formats including banner ads, pay-per-click campaigns, 
            impression-based visibility, and premium placement options.</span>
          </li>
          <li class="flex gap-4 items-start">
            <span class="text-green-500 text-3xl">✔</span>
            <span>Choose a budget that fits your requirement and start promoting without complex media buying commitments.</span>
          </li>
          <li class="flex gap-4 items-start">
            <span class="text-green-500 text-3xl">✔</span>
            <span>Reach relevant users browsing categories, cities, and services through structured placement opportunities on the platform.</span>
          </li>
          <li class="flex gap-4 items-start">
            <span class="text-green-500 text-3xl">✔</span>
            <span>Submit your advertising requirement and our team can suggest the most suitable visibility option for your objective.</span>
          </li>
        </ul>
      </div>

      <div class="advertise-why-image rounded-3xl overflow-hidden shadow-2xl">
        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=1200" 
             alt="Business growth & global connection" 
             class="w-full h-auto object-cover">
      </div>
    </div>
  </section>

  <!-- 3. Global Opportunities Dark Section -->
  <section class="advertise-opportunities py-24 bg-gradient-to-br from-blue-900 to-indigo-950 text-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
        Explore Flexible Advertising Options<br>on APNASHAHER.COM
      </h2>
      <p class="text-xl md:text-2xl mb-16 opacity-90">
        Choose the advertising model that best fits your visibility goals and budget

      </p>

      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
        <div class="advertise-model-card bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 hover:bg-white/20 transition">
          <h3 class="text-2xl font-bold mb-4">Banner Ads</h3>
          <p class="opacity-90">High-visibility placements across homepage & category pages</p>
        </div>
        <div class="advertise-model-card bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 hover:bg-white/20 transition">
          <h3 class="text-2xl font-bold mb-4">Pay Per Click</h3>
          <p class="opacity-90">Only pay when someone clicks your ad — perfect for lead generation</p>
        </div>
        <div class="advertise-model-card bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 hover:bg-white/20 transition">
          <h3 class="text-2xl font-bold mb-4">Ads by Impressions</h3>
          <p class="opacity-90">Get thousands of views — ideal for brand awareness</p>
        </div>
        <div class="advertise-model-card bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 hover:bg-white/20 transition">
          <h3 class="text-2xl font-bold mb-4">Maximum Views</h3>
          <p class="opacity-90">Top priority placement for maximum exposure & reach</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 4. Fill the Form Section -->
  <section class="advertise-form-section py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">
      
      <!-- Left Image -->
      <div class="advertise-form-image rounded-3xl overflow-hidden shadow-2xl">
        <img src="https://apnashaher.com/static/media/contact.cd546cadd8cf3d502f5a.jpg" 
             alt="Business owner filling form" 
             class="w-full h-auto object-cover">
      </div>

      <!-- Right Form -->
      <div class="advertise-form-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 md:p-12 shadow-xl">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
          Fill the Form
        </h2>
        <p class="text-lg text-gray-700 mb-10">
          Still have questions or queries? Share your thoughts below — we'll get back to you soon!
        </p>

        <form class="space-y-6">
          <div class="grid md:grid-cols-2 gap-6">
            <input type="text" placeholder="Business Owner Name" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="text" placeholder="Business Name" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="grid md:grid-cols-2 gap-6">
            <input type="email" placeholder="Email Id" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input type="tel" placeholder="Mobile Number" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="grid md:grid-cols-2 gap-6">
            <select class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
              <option>Select Advertisement Type</option>
              <option>Banner Ads</option>
              <option>Pay Per Click</option>
              <option>Ads by Impressions</option>
              <option>Maximum Views</option>
            </select>
            <select class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
              <option>Monthly Budget</option>
              <option>₹5,000 - ₹10,000</option>
              <option>₹10,000 - ₹25,000</option>
              <option>₹25,000 - ₹50,000</option>
              <option>Above ₹50,000</option>
            </select>
          </div>
          <textarea placeholder="Type message here..." rows="5" class="w-full px-5 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

          <!-- Social Icons -->
          

          <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-xl text-xl font-bold hover:bg-blue-700 transition shadow-lg">
            Send Request
          </button>
        </form>
      </div>
    </div>
  </section>
</div>

@endsection