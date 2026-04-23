@extends('layouts.app')
@section('title', 'About Us')
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
  @endpush
@section('content')

 

  <!-- Hero Banner Section -->
<section class="about-hero relative bg-gradient-to-br from-gray-50 via-white to-gray-100 py-20 md:py-20 overflow-hidden">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 text-start relative z-10">
    <!-- Main Title -->
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight leading-none">
      APNASHAHER.COM
    </h1>

    <!-- Underline Decoration -->
    <div class="mt-4 mb-8 flex justify-start">
      <div class="w-48 h-1.5 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full"></div>
    </div>

    <!-- Tagline -->
    <h2 class="text-2xl md:text-2xl font-bold text-gray-800 mb-6 leading-tight">
  An Economical Solution for Local Business Promotion
</h2>

<p class="text-xl md:text-1xl text-gray-600 max-w-1xl mb-12 leading-relaxed text-start">
  ApnaShaher.com, operated under <strong>Web Mingo IT Solutions Private Limited</strong>, is built to help businesses 
  and institutes improve local visibility through an economical and structured digital presence.
</p>

    <!-- Social Icons -->
    <div class="flex justify-start gap-6 md:gap-10">
      <a href="https://www.facebook.com/apnashaherdotcom" class="text-gray-700 hover:text-blue-600 transition text-3xl md:text-4xl">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#" class="text-gray-700 hover:text-pink-600 transition text-3xl md:text-4xl">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="#" class="text-gray-700 hover:text-black transition text-3xl md:text-4xl">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#" class="text-gray-700 hover:text-blue-700 transition text-3xl md:text-4xl">
        <i class="fab fa-linkedin-in"></i>
      </a>
      <a href="#" class="text-gray-700 hover:text-red-600 transition text-3xl md:text-4xl">
        <i class="fab fa-youtube"></i>
      </a>
    </div>
  </div>

  <!-- Background Decorative Elements (notebook, keyboard, etc.) -->
  <div class="absolute inset-0 opacity-10 pointer-events-none">
    <img src="https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&q=80&w=2000" 
         alt="Notebook background" 
         class="absolute bottom-0 left-0 w-1/3 md:w-1/4 object-contain opacity-70 transform -rotate-6">
    
    <img src="https://images.unsplash.com/photo-1587829741301-dc798b83add3?auto=format&fit=crop&q=80&w=800" 
         alt="Keyboard" 
         class="absolute bottom-10 right-10 w-64 md:w-96 object-contain opacity-60 transform rotate-6">
    
    <div class="absolute top-20 left-20 w-32 h-32 bg-blue-100 rounded-full blur-3xl opacity-30"></div>
    <div class="absolute bottom-40 right-40 w-40 h-40 bg-indigo-100 rounded-full blur-3xl opacity-30"></div>
  </div>
</section>

<!-- Font Awesome CDN for icons (add to head if not already) -->

<!-- ABOUT US PAGE -->
<div class="about-page bg-gradient-to-b from-gray-50 to-white min-h-screen">

  <!-- Hero / Banner Section -->
  <section class="about-hero relative bg-white py-24 md:py-32 text-center overflow-hidden">
    <div class="max-w-6xl mx-auto px-6">
      <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight">
        A Smart Directory for <br>
        <span class="text-blue-600">Businesses and Institutes</span>
      </h1>
      <p class="mt-6 text-xl md:text-2xl text-gray-700 max-w-4xl mx-auto">
       We help businesses and institutes improve visibility in an economical way
      </p>

      <div class="mt-10 flex flex-wrap justify-center gap-6">
        <span class="bg-green-50 border border-green-200 text-gray-800 px-8 py-4 rounded text-lg font-medium shadow-sm">
            <i class="fa-regular fa-square-check text-green-800"></i>
          Affordable
        </span>
        <span class="bg-green-50 border border-green-200 text-gray-800 px-8 py-4 rounded text-lg font-medium shadow-sm">
            <i class="fa-regular fa-square-check text-green-800"></i>
          Visibility
        </span>
        <span class="bg-green-50 border border-green-200 text-gray-800 px-8 py-4 rounded text-lg font-medium shadow-sm">
            <i class="fa-regular fa-square-check text-green-800"></i>
          Growth
        </span>
      </div>
    </div>
  </section>

  <!-- Tabs Navigation -->
  <div class="about-tabs sticky top-0 z-20 bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-6xl mx-auto px-6">
      <nav class="flex overflow-x-auto py-4 space-x-8 text-sm md:text-base font-medium no-scrollbar">
        <button class="about-tab-btn px-4 py-3 border-b-4 border-blue-600 text-blue-600 font-semibold" data-tab="company">Our Company</button>
        <button class="about-tab-btn px-4 py-3 border-b-4 border-transparent text-gray-600 hover:text-gray-900" data-tab="history">Our History</button>
        <button class="about-tab-btn px-4 py-3 border-b-4 border-transparent text-gray-600 hover:text-gray-900" data-tab="journey">Our Journey</button>
        <button class="about-tab-btn px-4 py-3 border-b-4 border-transparent text-gray-600 hover:text-gray-900" data-tab="core">Core Values</button>
        <button class="about-tab-btn px-4 py-3 border-b-4 border-transparent text-gray-600 hover:text-gray-900" data-tab="milestone">Milestone Reached</button>
       <!-- <button class="about-tab-btn px-4 py-3 border-b-4 border-transparent text-gray-600 hover:text-gray-900" data-tab="investors">Our Investors</button> -->
      </nav>
    </div>
  </div>

  <!-- Tab Contents -->
  <div class="max-w-6xl mx-auto px-6 py-16">

    <!-- Our Company Tab (default active) -->
    <div id="about-company" class="about-tab-content">
      <!-- <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8">Connecting Businesses Worldwide</h2> -->
      
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
          <p>
            The ApnaShaher.com vision understands the dynamic nature of the business sector that requires an adaptable platform. ApnaShaher.com provides just that. Everyone from wholesalers to retailers, service providers to educational institutions, startups to established companies is accepted here.
          </p>
          <p>
            We're dedicated to being a one-stop shop for all of your company's product and service needs. Our primary objective is to help businesses get recognised globally by connecting them to potential clients worldwide and creating a setting where worthwhile companies can flourish.
          </p>
          <!-- <p>
            Here at ApnaShaher.com, we've devoted ourselves to helping businesses of all shapes and sizes achieve global recognition. Businesses in today's market have many hurdles; our platform strives to help you solve these obstacles and embrace new possibilities.
          </p> -->
        </div>

        <div class="rounded-2xl overflow-hidden shadow-2xl">
          <img src="https://apnashaher.com/assets/images/about-2.png" 
               alt="Modern business building at sunset" class="w-full h-auto object-cover">
        </div>
      </div>
    </div>

    <!-- Our History Tab -->
    <div id="about-history" class="about-tab-content hidden">
      <!-- <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8">Our History</h2> -->
      <div class="space-y-8 text-lg text-gray-700">
        <p>
ApnaShaher.com was originally conceptualized and launched in 2008 as a local business directory initiative 
with the objective of helping local businesses become discoverable online within their cities. The platform began by offering city-based business listings, 
allowing local shops, service providers, and institutions to create an online presence and connect with nearby customers.</p>

<p>During its early phase, ApnaShaher expanded across multiple cities and served as a practical digital directory model for local discovery.
Over time, as digital business requirements evolved, the focus gradually shifted toward website design, development, and digital services, 
which were delivered under the parent business operations. </p>

<p>ApnaShaher.com is now being relaunched and operated as a digital platform under <strong>Web Mingo IT Solutions Private Limited</strong>, with a 
renewed focus on structured local listings, educational institutes, service providers, and category-based business visibility. </p>

<p><strong>Web Mingo IT Solutions Private Limited</strong> is the parent company responsible for managing the platform, technology
infrastructure, billing, payment processing, customer support, and future service expansion related to ApnaShaher.com.</p>

<p>All payments, subscriptions, invoices, and related commercial activities for ApnaShaher.com are processed under
the legal entity <strong>Web Mingo IT Solutions Private Limited</strong>. </p>

        <div class="grid md:grid-cols-3 gap-6 mt-12">
          <div class="bg-blue-50 p-6 rounded-xl text-center">
            <p class="text-4xl font-bold text-blue-600">2008</p>
            <p class="mt-2 text-gray-700">Founded in Lucknow</p>
          </div>
          <div class="bg-blue-50 p-6 rounded-xl text-center">
            <p class="text-4xl font-bold text-blue-600">2012</p>
            <p class="mt-2 text-gray-700">Digital Transformation</p>
          </div>
          <div class="bg-blue-50 p-6 rounded-xl text-center">
            <p class="text-4xl font-bold text-blue-600">2026</p>
            <p class="mt-2 text-gray-700">Re-launched</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Our Journey Tab -->
    <div id="about-journey" class="about-tab-content hidden">
      <!-- <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8">Our Journey</h2> -->
      <div class="space-y-12">
        <div class="grid lg:grid-cols-2 gap-10 items-center">
          <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&q=80&w=800" 
               alt="Team working together" class="rounded-2xl shadow-xl">
          <<div class="space-y-6 text-lg text-gray-700">
  <p>ApnaShaher began in 2008 as a local business directory initiative with a simple goal — helping local businesses become discoverable online within their own cities.</p>

  <p>What started with direct local outreach and city-based listings gradually evolved as businesses began seeking websites, digital visibility, and stronger online presence.</p>

  <p>Today, ApnaShaher is being relaunched under Web Mingo IT Solutions Private Limited with a renewed focus on local discovery, educational institutes, and category-based business visibility across selected Indian cities.</p>
</div>
        </div>
      </div>
    </div>

    <!-- Core Values Tab -->
    <div id="about-core" class="about-tab-content hidden">
      <!-- <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-12 text-center">Our Core Values</h2> -->
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl text-center border border-blue-100 shadow-lg hover:shadow-xl transition">
          <div class="w-20 h-20 mx-auto mb-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-5xl font-bold">I</div>
          <h3 class="text-2xl font-bold mb-4">Integrity</h3>
          <p class="text-gray-700">Transparency and honesty in every dealing — building trust is our foundation.</p>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-8 rounded-2xl text-center border border-purple-100 shadow-lg hover:shadow-xl transition">
          <div class="w-20 h-20 mx-auto mb-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-5xl font-bold">N</div>
          <h3 class="text-2xl font-bold mb-4">Innovation</h3>
          <p class="text-gray-700">Constant evolution with cutting-edge features to keep businesses ahead.</p>
        </div>

        <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-8 rounded-2xl text-center border border-green-100 shadow-lg hover:shadow-xl transition">
          <div class="w-20 h-20 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-5xl font-bold">C</div>
          <h3 class="text-2xl font-bold mb-4">Connection</h3>
          <p class="text-gray-700">Creating meaningful networks between buyers, sellers, and opportunities worldwide.</p>
        </div>
      </div>
    </div>

    <!-- Milestone Reached Tab -->
   <div id="about-milestone" class="about-tab-content hidden">
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

    <div class="bg-white p-8 rounded-2xl border shadow-md text-center">
      <p class="text-5xl font-bold text-blue-600 mb-4">2008</p>
      <p class="text-xl font-semibold">ApnaShaher Started</p>
    </div>
    <div class="bg-white p-8 rounded-2xl border shadow-md text-center">
      <p class="text-5xl font-bold text-blue-600 mb-4">2026</p>
      <p class="text-xl font-semibold">Platform Relaunch Phase</p>
    </div>
<div class="bg-white p-8 rounded-2xl border shadow-md text-center">
      <p class="text-5xl font-bold text-blue-600 mb-4">15+</p>
      <p class="text-xl font-semibold">Years of Digital Experience</p>
    </div>
    
    <div class="bg-white p-8 rounded-2xl border shadow-md text-center">
      <p class="text-5xl font-bold text-blue-600 mb-4">6+</p>
      <p class="text-xl font-semibold">Cities Reached</p>
    </div>

    <div class="bg-white p-8 rounded-2xl border shadow-md text-center">
      <p class="text-5xl font-bold text-blue-600 mb-4">1000+</p>
      <p class="text-xl font-semibold">Business Listings Created</p>
    </div>

    

    <div class="bg-white p-8 rounded-2xl border shadow-md text-center">
      <p class="text-5xl font-bold text-blue-600 mb-4">20+</p>
      <p class="text-xl font-semibold">Team Members</p>
    </div>

  </div>
</div>

    <!-- Our Investors Tab -->
  <!--  <div id="about-investors" class="about-tab-content hidden">
      <!-- <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-12 text-center">Our Investors & Partners</h2> -->
    <!--  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white p-10 rounded-2xl border shadow-md text-center">
          <img src="https://via.placeholder.com/180x80?text=Investor+1" alt="Investor Logo" class="mx-auto mb-6">
          <h3 class="text-xl font-bold">HDFC Bank</h3>
          <p class="text-gray-600 mt-2">Strategic Banking Partner</p>
        </div>
        <div class="bg-white p-10 rounded-2xl border shadow-md text-center">
          <img src="https://via.placeholder.com/180x80?text=Investor+2" alt="Investor Logo" class="mx-auto mb-6">
          <h3 class="text-xl font-bold">Startup India Fund</h3>
          <p class="text-gray-600 mt-2">Government Backed</p>
        </div>
        <div class="bg-white p-10 rounded-2xl border shadow-md text-center">
          <img src="https://via.placeholder.com/180x80?text=Partner+3" alt="Partner Logo" class="mx-auto mb-6">
          <h3 class="text-xl font-bold">Tech Mahindra</h3>
          <p class="text-gray-600 mt-2">Technology Partner</p>
        </div>
        <!-- Add more as needed -->
   <!--   </div>
    </div> -->

  </div>
</div>

<!-- JavaScript for Tab Switching -->
<script>
  const tabButtons = document.querySelectorAll('.about-tab-btn');
  const tabContents = document.querySelectorAll('.about-tab-content');

  tabButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      // Remove active from all
      tabButtons.forEach(b => {
        b.classList.remove('border-blue-600', 'text-blue-600', 'font-semibold');
        b.classList.add('border-transparent', 'text-gray-600');
      });
      tabContents.forEach(c => c.classList.add('hidden'));

      // Activate clicked
      btn.classList.remove('border-transparent', 'text-gray-600');
      btn.classList.add('border-blue-600', 'text-blue-600', 'font-semibold');

      const tabId = btn.getAttribute('data-tab');
      document.getElementById(`about-${tabId}`).classList.remove('hidden');
    });
  });
</script>

<!-- CSS Classes (add to your <style> or Tailwind config) -->
<style>
  .about-hero-title {
    font-weight: 900;
    letter-spacing: -0.025em;
  }
  .about-hero-highlights .about-highlight {
    transition: all 0.3s ease;
  }
  .about-hero-highlights .about-highlight:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
  }
  .about-section-title {
    font-weight: 800;
    line-height: 1.1;
  }
  .about-core-card {
    transition: all 0.4s ease;
  }
  .about-core-card:hover {
    transform: translateY(-8px);
  }
</style>
<!-- Standout Features Section (with right image) -->
<section class="about-features py-20 md:py-28 bg-gradient-to-b from-gray-50 to-white">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <!-- Main Heading -->
    <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 text-center mb-16 leading-tight">
      Discover the standout features<br>
      that make us <span class="text-blue-600">exceptional</span> for businesses!
    </h2>

    <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
      <!-- Left: Features List -->
      <div class="space-y-10 md:space-y-12">
        <!-- Feature 1: 12 Year Experience Badge (mobile pe visible) -->
        <div class="lg:hidden mb-8 text-center">
          <div class="inline-block bg-black text-white text-xl md:text-2xl font-bold px-8 py-4 rounded-xl shadow-lg">
            17 Years of Digital Experience
          </div>
        </div>

        <!-- Global Reach -->
        <div class="about-feature flex gap-5 md:gap-6">
          <div class="flex-shrink-0">
            <span class="text-green-500 text-4xl md:text-5xl">✔</span>
          </div>
          <div>
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">Wider Visibility</h3>
            <p class="text-gray-700 text-lg leading-relaxed">
              ApnaShaher helps businesses and institutes improve their visibility by making their profiles accessible to a broader 
              audience through structured digital listings. Our platform supports better discoverability across categories and locations.</p>
          </div>
        </div>

        <!-- Comprehensive Listings -->
        <div class="about-feature flex gap-5 md:gap-6">
          <div class="flex-shrink-0">
            <span class="text-green-500 text-4xl md:text-5xl">✔</span>
          </div>
          <div>
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">Comprehensive Listings</h3>
            <p class="text-gray-700 text-lg leading-relaxed">
              ApnaShaher provides a simple platform for businesses, institutes, service providers, startups, and local
              professionals to present their services with complete profile details, helping users find relevant options easily.</p>
          </div>
        </div>

        <!-- Business Inquiries -->
        <div class="about-feature flex gap-5 md:gap-6">
          <div class="flex-shrink-0">
            <span class="text-green-500 text-4xl md:text-5xl">✔</span>
          </div>
          <div>
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">Better Business Connections</h3>
            <p class="text-gray-700 text-lg leading-relaxed">
              Our platform helps businesses and institutes receive relevant enquiries by making contact details, 
              profiles, and service information easily accessible to interested users.</p>
          </div>
        </div>

        <!-- User-Friendly Interface (from your second screenshot) -->
        <!-- <div class="about-feature flex gap-5 md:gap-6">
          <div class="flex-shrink-0">
            <span class="text-green-500 text-4xl md:text-5xl">✔</span>
          </div>
          <div>
            <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">User-Friendly Interface</h3>
            <p class="text-gray-700 text-lg leading-relaxed">
              You will have no difficulty navigating ApnaShaher.com. The main objective for creating this platform is the simplicity of use for vendors and buyers in examining, connecting, and transacting.
            </p>
          </div>
        </div> -->
      </div>

      <!-- Right: Image + 12 Year Badge (desktop only visible) -->
      <div class="about-features-image relative rounded-3xl overflow-hidden shadow-2xl lg:block hidden">
        <!-- Big Experience Badge -->
        <div class="absolute top-8 right-8 bg-black text-white text-3xl md:text-4xl font-bold px-10 py-6 rounded-2xl shadow-2xl z-10">
          17 Years<br>Experience
        </div>

        <img src="https://apnashaher.com/static/media/about-feature.ddb16b73b6bee489815b.jpg" 
             alt="Modern city skyline representing global business" 
             class="w-full h-full object-cover">
      </div>
    </div>
  </section>
</div>

<!-- Optional CSS for better feel (add to your <style> tag) -->
<style>
  .about-feature {
    transition: transform 0.3s ease;
  }
  .about-feature:hover {
    transform: translateX(8px);
  }
  .about-features-image {
    height: 620px; /* adjust as needed */
  }
  @media (max-width: 1024px) {
    .about-features-image {
      display: none;
    }
  }
</style>

<section class="faq-section">
    <div class="faq-container">
        <!-- LEFT SIDE FAQ -->
        <div class="faq-left">
            <h2 class="faq-title">Frequently Asked Questions</h2>
            <div class="faq-box">

                <!-- Static FAQ 1 -->
                <div class="faq-item">
                    <div class="faq-question-row">
                        <h3 class="faq-question">How can I find the best coaching institute near me?</h3>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Just enter your city or area in the search bar on the homepage. You can filter by category (like NEET, IIT-JEE, CBSE coaching, etc.), read verified reviews, and directly contact institutes.
                    </div>
                </div>

                <!-- Static FAQ 2 -->
                <div class="faq-item">
                    <div class="faq-question-row">
                        <h3 class="faq-question">Are all institutes on ApnaShaher verified?</h3>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Yes, every institute goes through a manual verification process before appearing live. We check documents, contact details, and location to ensure authenticity and build trust.
                    </div>
                </div>

                <!-- Static FAQ 3 -->
                <div class="faq-item">
                    <div class="faq-question-row">
                        <h3 class="faq-question">Is listing my institute free?</h3>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Yes! Basic listing is completely free. You can upgrade anytime to Premium or Pro plans for better visibility, verified badge, top ranking, and more features.
                    </div>
                </div>

                <!-- Static FAQ 4 -->
                <div class="faq-item">
                    <div class="faq-question-row">
                        <h3 class="faq-question">How do students contact me directly?</h3>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        We never sell leads. Students see your mobile number, WhatsApp (if provided), and enquiry form right on your profile. You receive direct calls/messages.
                    </div>
                </div>

                <!-- Static FAQ 5 -->
                <div class="faq-item">
                    <div class="faq-question-row">
                        <h3 class="faq-question">Can I update my institute details later?</h3>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Yes, after listing you get a dashboard where you can edit name, description, courses, photos, timings, fees, and more anytime.
                    </div>
                </div>

                <!-- Static FAQ 6 -->
                <div class="faq-item">
                    <div class="faq-question-row">
                        <h3 class="faq-question">How long does verification take?</h3>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Usually 24–48 hours. Once approved, your institute profile goes live and starts appearing in searches.
                    </div>
                </div>

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
                   
                    <input type="email" name="email_address" id="email-address" class="faq-input" placeholder="Email Address" value="">
                    <div class="faq-phone-group">
                        <select class="faq-country" name="country_code">
                            <option value="+91">🇮🇳 +91</option>
                        </select>
                   
                        <input type="tel" onkeypress="return isNumber(event)" class="faq-input phone-input" name="mobile_number" id="mobile-number" autocomplete="off" placeholder="Mobile Number" value="">
                        <p id="verified_badge" style="color:green;display:none;">Verified</p>
                    </div>
                    <input type="tel" name="mobile" id="mob_in" class="form-control" style="display:none;" />
                    <input type="text" name="isValid" id="is_valid_number" value="0" class="form-control" style="display:none;" />
                    <div class="form-group mb-2" id="otp_field" style="display: none;">
                        <input
                            type="text"
                            class="form-control"
                            id="otp"
                            name="otp"
                            placeholder="Enter OTP"
                            maxlength="6"
                        />
                    </div>
                    <!-- <button type="button" class="otp-btn mb-2" id="send-otp-bt" onclick="sendOTP()">
                        Send OTP
                    </button>
                    <button type="button" class="otp-btn mb-2" id="verify-otp-bt" style="display: none;" onclick="verifyOTP()">
                        Verify
                    </button> -->
                    <button type="button" class="otp-btn mb-2" id="resend-otp-bt" style="display:none;" onclick="sendOTP()">Re-Send OTP</button>
                    <textarea name="message" class="faq-textarea" rows="4" placeholder="Write your message..."></textarea>
                        <div class="col-md-12">
                            <div class="g-recaptcha mb-2" ></div>
                        </div>
                    <button type="submit" class="faq-btn">Submit Enquiry</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection