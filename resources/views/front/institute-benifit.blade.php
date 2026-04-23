@extends('layouts.app')
@section('title', 'Institute Benifit')
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
.benifit-grid{
    display: grid;
    grid-template-columns: 7fr 5fr;
}

@media (max-width: 768px) {
   .benifit-grid{
    display: grid;
    grid-template-columns: 1fr;
}
   
}
 </style>
 @endpush
@section('content')
  <!-- Hero Banner Section -->
<section class="about-hero relative bg-gradient-to-br from-gray-50 via-white to-gray-100 py-6 md:py-20 overflow-hidden" style="background-image: url(https://apnashaher.com/assets/images/ctop.jpg);">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 text-start relative z-10">
    
    <!-- Tagline -->
    <h2 class="text-4xl md:text-3xl font-bold text-gray-800 mb-6 leading-tight">
      Your first digital step can shape your business<br> visibility and future growth
    </h2>

    <!-- Description -->
    <p class="text-xl md:text-1xl text-gray-600 max-w-1xl  mb-12 leading-relaxed text-start">
        Improve visibility, connect with more people, and present your institute or <br> business on a growing digital platform designed for better reach.
<br> Register today and start achieving your goals.
    </p>

    <!-- Social Icons -->
   <a href="{{route('list-your-institute')}}">
            <button class="list-btn"> List Your Institute</button>
            </a>
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

<!-- Institute Benefits Section -->
<section class="institute-benefits py-8 md:py-28 bg-gradient-to-b from-gray-50 to-white">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    
    <!-- Main Heading -->
    <h2 class="institute-benefits-heading text-4xl md:text-5xl font-extrabold text-gray-900 text-center mb-16 leading-tight">
     Why Businesses & Institutes Choose<br>ApnaShaher?
    </h2>

    <p class="institute-benefits-subtext text-center text-xl md:text-2xl text-gray-700 max-w-5xl mx-auto mb-16">
      ApnaShaher helps businesses and institutes improve visibility, connect with the right audience, 
      and present their services through structured digital listings designed for better reach and growth.
</p>

    <div class=" gap-10 lg:gap-16 items-start benifit-grid" style="">
      
      <!-- Left: 4 Benefits Cards -->
      <div class="institute-benefits-cards grid md:grid-cols-2 gap-6 lg:gap-8">
        
        <!-- Card 1 -->
        <div class="institute-benefits-card bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-4 border border-blue-100 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <h3 class="text-2xl font-bold text-gray-800 mb-4">Increase Visibility & Reach</h3>
          <p class="text-gray-700 leading-relaxed">
            Listing on ApnaShaher helps businesses and institutes improve visibility among people actively 
            searching for relevant services in their city or nearby area.</p>
        </div>

        <!-- Card 2 -->
        <div class="institute-benefits-card bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl p-4 border border-green-100 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <h3 class="text-2xl font-bold text-gray-800 mb-4">Buil trust through better Presence</h3>
          <p class="text-gray-700 leading-relaxed">
            A complete digital profile with clear details helps users understand your services better and builds confidence in your presence.</p>
        </div>

        <!-- Card 3 -->
        <div class="institute-benefits-card bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-4 border border-purple-100 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <h3 class="text-2xl font-bold text-gray-800 mb-4">Generate relevant enquiries</h3>
          <p class="text-gray-700 leading-relaxed">
            Presenting your services, offerings, timings, and contact details clearly can improve enquiry opportunities from interested users.</p>
        </div>

        <!-- Card 4 -->
        <div class="institute-benefits-card bg-gradient-to-br from-amber-50 to-yellow-50 rounded-2xl p-4 border border-amber-100 shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <h3 class="text-2xl font-bold text-gray-800 mb-4">Affordable Long-term Promotion</h3>
          <p class="text-gray-700 leading-relaxed">
           ApnaShaher offers a practical and affordable way to maintain digital visibility without depending entirely on expensive advertising campaigns.</p>
        </div>
      </div>

      <!-- Right: Image Card -->
      <div class="institute-benefits-image-card relative rounded-3xl overflow-hidden shadow-2xl lg:sticky lg:top-20">
        <img src="https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&q=80&w=1200" 
             alt="Students learning in modern classroom" 
             class="w-full h-auto lg:h-[680px] object-cover">

        <!-- Optional small overlay text (like screenshot mein "Growth with Us") -->
        <div class="absolute bottom-8 left-8 bg-white/80 backdrop-blur-sm px-6 py-3 rounded-xl shadow-lg">
          <p class="text-lg font-semibold text-gray-900">Growth with Us</p>
        </div>
      </div>

    </div>
    
    
    
    
    
    
    
  </div>
</section>

<!-- Optional Custom CSS (add to your <style> tag) -->
<style>
  .institute-benefits-heading {
    font-weight: 900;
    letter-spacing: -0.025em;
  }
  .institute-benefits-card {
    transition: all 0.4s ease;
  }
  .institute-benefits-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
  }
  .institute-benefits-image-card {
    border-radius: 2rem;
  }
  @media (max-width: 1024px) {
    .institute-benefits-image-card {
      order: 2; /* image niche aa jaye mobile pe */
    }
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
          12 Year<br>Experience
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