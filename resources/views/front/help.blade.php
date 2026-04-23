@extends('layouts.app')
@section('title', 'Help & Support')
@push('styles')
<!-- Custom CSS -->
<style>
  .help-section {
    background: #f9fafb;
  }

  .help-main-heading {
    font-weight: 900;
    letter-spacing: -0.03em;
  }

  .help-sub-heading {
    font-weight: 700;
  }

  .help-card {
    border-radius: 1.5rem;
    overflow: hidden;
    transition: all 0.4s ease;
  }

  .help-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 30px 60px rgba(0,0,0,0.12);
  }

  .help-btn {
    transition: all 0.3s ease;
    box-shadow: 0 4px 14px rgba(0,0,0,0.1);
  }

  .help-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(59,130,246,0.25);
  }
</style>
@endpush
@section('content')
<!-- HELP & SUPPORT SECTION -->
<section class="help-section py-10 md:py-20 bg-gray-50">
  <div class="help-container max-w-7xl mx-auto px-6">
    
    <!-- Heading -->
    <div class="text-center mb-16">
      <h2 class="help-main-heading text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
        Help & Support
      </h2>
      <p class="help-sub-heading text-xl md:text-2xl text-gray-700 max-w-3xl mx-auto">
        Need Assistance?
      </p>
      <p class="help-description text-lg text-gray-600 mt-4 max-w-4xl mx-auto">
        Need assistance? We offer comprehensive resources, FAQs, and contact information to address all your inquiries and technical issues. Get the help you need quickly and efficiently!
      </p>
    </div>

    <!-- 3 Cards Grid -->
    <div class="help-cards-grid grid md:grid-cols-3 gap-8 lg:gap-10">
      
      <!-- Card 1: FAQ -->
      <div class="help-card bg-white rounded-2xl shadow-lg border border-blue-100 overflow-hidden hover:shadow-2xl hover:-translate-y-3 transition-all duration-300">
        <div class="help-card-header bg-gradient-to-r from-blue-600 to-blue-700 text-white p-8 text-center">
          <h3 class="text-2xl font-bold">FAQ</h3>
          <p class="mt-3 text-blue-100">Learn from some of the pre-defined topics to understand better</p>
        </div>
        <div class="help-card-body p-8 text-center">
          <p class="text-gray-600 mb-6">Common questions answered instantly — save time!</p>
          <a href="#" class="help-btn inline-block bg-blue-600 text-white px-10 py-4 rounded-xl font-semibold hover:bg-blue-700 transition">
            Click Here →
          </a>
        </div>
      </div>

      <!-- Card 2: Raise a Ticket -->
      <div class="help-card bg-white rounded-2xl shadow-lg border border-orange-100 overflow-hidden hover:shadow-2xl hover:-translate-y-3 transition-all duration-300 relative">
        <!-- Optional "Popular" badge -->
    
        
        <div class="help-card-header bg-gradient-to-r from-orange-500 to-orange-600 text-white p-8 text-center">
          <h3 class="text-2xl font-bold">Raise a Ticket</h3>
          <p class="mt-3 text-orange-100">Do you still need support? No worries, create a ticket and we will help you</p>
        </div>
        <div class="help-card-body p-8 text-center">
          <p class="text-gray-600 mb-6">Our team will respond within 24 hours</p>
          <a href="#" class="help-btn inline-block bg-orange-600 text-white px-10 py-4 rounded-xl font-semibold hover:bg-orange-700 transition">
            Raise Ticket →
          </a>
        </div>
      </div>

      <!-- Card 3: Call or Email -->
      <div class="help-card bg-white rounded-2xl shadow-lg border border-purple-100 overflow-hidden hover:shadow-2xl hover:-translate-y-3 transition-all duration-300">
        <div class="help-card-header bg-gradient-to-r from-purple-600 to-indigo-600 text-white p-8 text-center">
          <h3 class="text-2xl font-bold">Call or Email us</h3>
          <p class="mt-3 text-purple-100">Direct human support — we're here for you</p>
        </div>
        <div class="help-card-body p-8">
          <div class="space-y-6 text-center md:text-left">
            <div class="flex items-center justify-center md:justify-start gap-4 text-lg">
              <span class="text-green-600 text-2xl">📞</span>
              <a href="tel:+917838351980" class="hover:text-blue-600 transition">
                +91 78383 XXXXX
              </a>
            </div>
            
            <div class="flex items-center justify-center md:justify-start gap-4 text-lg">
              <span class="text-green-600 text-2xl">💬</span>
              <a href="https://wa.me/917838351980" target="_blank" class="hover:text-blue-600 transition">
                +91 78383 XXXXX (WhatsApp)
              </a>
            </div>
            
            <div class="flex items-center justify-center md:justify-start gap-4 text-lg">
              <span class="text-red-600 text-2xl">✉️</span>
              <a href="mailto:support@apnashaher.com" class="hover:text-blue-600 transition">
                support@apnashaher.com
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>


@endsection