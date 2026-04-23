@extends('layouts.app')
@section('title', 'Why Us')
@push('styles')

<!-- Custom CSS -->
<style>
  .why-heading {
    font-weight: 900;
    letter-spacing: -0.04em;
  }

  .why-grid {
    perspective: 1000px;
  }

  .why-card {
    border-radius: 1.5rem;
    transition: all 0.4s ease;
  }

  .why-card:hover {
    transform: translateY(-12px) rotateX(5deg);
    box-shadow: 0 30px 60px rgba(0,0,0,0.12);
  }

  .why-icon {
    width: 100px;
    height: 100px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.08);
  }

  .why-cta {
    box-shadow: 0 10px 25px rgba(37,99,235,0.3);
  }

  .why-cta:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(37,99,235,0.4);
  }
</style>
 @endpush
@section('content')
<!-- WHY CHOOSE US SECTION -->
<section class="why-section py-20 md:py-28 bg-gradient-to-b from-gray-50 to-white">
  <div class="why-container max-w-7xl mx-auto px-6 lg:px-8">
    
    <!-- Heading -->
    <div class="text-center mb-16">
      <h2 class="why-heading text-4xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight">
        Why Choose <span class="text-blue-600">ApnaShaher</span>?
      </h2>
      <p class="why-subtext text-xl md:text-2xl text-gray-700 max-w-4xl mx-auto">
A simple and affordable digital platform that helps institutes improve visibility and connect with local students.
</p>
    </div>

    <!-- 4 Feature Grid -->
    <div class="why-grid  gap-8 lg:gap-10" style="display: grid; grid-template-columns: 1fr 1fr;">
      
      <!-- Feature 1 -->
      <div class="why-card bg-white rounded-2xl p-8 border border-gray-100 shadow-lg hover:shadow-2xl hover:-translate-y-3 transition-all duration-300">
        <div class="why-icon  mx-auto mb-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-4xl font-bold">
          1M+
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Targeted Local Visibility</h3>
        <p class="text-gray-700 text-center leading-relaxed">
          ApnaShaher helps institutes improve local visibility by making their profile accessible to students searching in their city or nearby area..
        </p>
      </div>

      <!-- Feature 2 -->
      <div class="why-card bg-white rounded-2xl p-8 border border-gray-100 shadow-lg hover:shadow-2xl hover:-translate-y-3 transition-all duration-300">
        <div class="why-icon  mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-4xl font-bold">
          Free
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Free Basic Listing</h3>
        <p class="text-gray-700 text-center leading-relaxed">
          Start with a free business profile listing and upgrade only when you need better visibility and additional features.
        </p>
      </div>

      <!-- Feature 3 -->
      <div class="why-card bg-white rounded-2xl p-8 border border-gray-100 shadow-lg hover:shadow-2xl hover:-translate-y-3 transition-all duration-300">
        <div class="why-icon  mx-auto mb-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-4xl font-bold">
          ✓
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Trust Building Features</h3>
        <p class="text-gray-700 text-center leading-relaxed">
          Verified profile details, complete information, and future review support help institutes build trust with students and parents.
        </p>
      </div>

      <!-- Feature 4 -->
      <div class="why-card bg-white rounded-2xl p-8 border border-gray-100 shadow-lg hover:shadow-2xl hover:-translate-y-3 transition-all duration-300">
        <div class="why-icon  mx-auto mb-6 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 text-4xl font-bold">
          24×7
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Easy Enquiry Management</h3>
        <p class="text-gray-700 text-center leading-relaxed">
          Track enquiries, manage institute information, and improve visibility through your institute dashboard..
        </p>
      </div>
    </div>

    <!-- CTA Button -->
    <div class="text-center mt-16">
      <a href="{{route('list-your-institute')}}" class="why-cta inline-block bg-blue-600 text-white px-12 py-5 rounded-xl text-xl font-bold hover:bg-blue-700 transition shadow-lg">
        List Your Institute Now — It's Free!
      </a>
    </div>

  </div>
</section>

@endsection