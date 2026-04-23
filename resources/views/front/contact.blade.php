@extends('layouts.app')
@section('title', 'Contact Us')
@push('styles')
<!-- Custom CSS -->
<style>
  .contact-banner-title {
    font-weight: 900;
    letter-spacing: -0.04em;
  }

  .contact-left-title {
    font-weight: 800;
    border-bottom-width: 4px;
  }

  .contact-form-card {
    box-shadow: 0 20px 50px rgba(0,0,0,0.1);
  }

  .contact-map-frame iframe {
    border-radius: 10px;
  }
  .contact-card{
background:white;
border-radius:16px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
transition:.3s;
cursor:pointer;
}

.contact-card:hover{
transform:translateY(-6px);
box-shadow:0 15px 35px rgba(0,0,0,.15);
}

.office-card{
background:white;
border-radius:16px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
transition:.3s;
}

.office-card:hover{
transform:translateY(-5px);
box-shadow:0 18px 35px rgba(0,0,0,.15);
}


</style>
@endpush
@section('content')
<!-- CONTACT US SECTION -->
<section class="contact-section bg-white min-h-screen">

  <!-- Top Banner -->
  <div class="contact-banner relative bg-gradient-to-br from-gray-100 to-gray-200 py-24 md:py-32 text-center overflow-hidden">
    <div class="absolute inset-0 opacity-10">
      <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&q=80&w=2000" 
           alt="Office background" class="w-full h-full object-cover opacity-30">
    </div>

    <div class="contact-banner-content relative z-10 max-w-5xl mx-auto px-6">
      <h1 class="contact-banner-title text-5xl md:text-6xl font-extrabold text-gray-900 mb-6">
        Contact Us
      </h1>
      <p class="contact-banner-subtitle text-xl md:text-2xl text-gray-700 max-w-4xl mx-auto">
        For any questions or if you need any assistance? Reach out to us — we're here to help you every step of the way!
      </p>

      <!-- Social Icons -->
      
    </div>
  </div>

  <!-- Main Contact Content -->
  <div class="contact-main max-w-6xl mx-auto px-6 py-16 grid lg:grid-cols-2 gap-12">

    <!-- Left: Office Details -->
    <div class="contact-left ">
      <h2 class="contact-left-title text-3xl md:text-4xl font-bold text-gray-900 mb-8 border-b-4 border-blue-600 pb-4 inline-block">
        CONTACT US
      </h2>

      <div class="contact-office space-y-8 text-lg text-gray-700">
<div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-6">


<!-- Corporate Office -->

<div class="office-card p-6 text-center">

<div class="icon mb-3">
<i class="fas fa-city text-3xl text-indigo-600"></i>
</div>

<h3 class="font-bold text-lg mb-2">
Corporate Office
</h3>

<p class="text-gray-600 text-sm leading-6">
Unit Number: 1025, Tower - A, 10th Floor, I-Thum IT Park, 
<br> Sector - 62, Noida - 201301, Uttar Pradesh, India
</p>

</div>

</div>

        
        <div class="grid grid-cols-2 gap-6">

<!-- Sales Email -->
<div class="contact-card text-center p-6">
    
<div class="icon mb-3">
<i class="fas fa-envelope text-3xl text-indigo-600"></i>
</div>

<p class="font-semibold mb-1">For Business Enquiries</p>

<a href="mailto:business@apnashaher.com"
class="text-gray-600 hover:text-indigo-600 text-sm">
business@apnashaher.com
</a>p

</div>


<!-- HR Email -->
<div class="contact-card text-center p-6">

<div class="icon mb-3">
<i class="fas fa-user-tie text-3xl text-indigo-600"></i>
</div>

<p class="font-semibold mb-1">For Support</p>

<a href="mailto:hr@apnashaher.com"
class="text-gray-600 hover:text-indigo-600 text-sm">
support@apnashaher.com
</a>

</div>


<!-- Phone -->
<div class="contact-card text-center p-6">

<div class="icon mb-3">
    
<i class="fas fa-phone text-3xl text-indigo-600"></i>
</div>

<p class="font-semibold mb-1">Mobile</p>

<a href="tel:+917068401234"
class="text-gray-600 hover:text-indigo-600 text-sm">
+91 70684 01234
</a>

</div>


<!-- Open Time -->
<div class="contact-card text-center p-6">

<div class="icon mb-3">
    
<i class="fa-brands fa-whatsapp text-3xl text-indigo-600"></i>
</div>

<p class="font-semibold mb-1">Whatsapp</p>

<a href="tel:+917068401234"
class="text-gray-600 hover:text-indigo-600 text-sm">
+91 70684 01234
</a>

</div>

</div>
 <div class="contact-form-card bg-gradient-to-br from-blue-50 rounded-2xl p-4 shadow-xl mb-5 flex items-center justify-center gap-6">

    <h3 class="font-semibold text-base text-gray-800 whitespace-nowrap mb-0">
        Connect With Us
    </h3>

    <div class="flex gap-3">

        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white shadow text-blue-600 transition duration-300 transform hover:-translate-y-1 hover:scale-110 hover:shadow-lg">
            <i class="fab fa-facebook-f"></i>
        </a>

        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white shadow text-pink-600 transition duration-300 transform hover:-translate-y-1 hover:scale-110 hover:shadow-lg">
            <i class="fab fa-instagram"></i>
        </a>

        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white shadow text-blue-700 transition duration-300 transform hover:-translate-y-1 hover:scale-110 hover:shadow-lg">
            <i class="fab fa-linkedin-in"></i>
        </a>

        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white shadow text-red-600 transition duration-300 transform hover:-translate-y-1 hover:scale-110 hover:shadow-lg">
            <i class="fab fa-youtube"></i>
        </a>

        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-lg bg-white shadow text-black transition duration-300 transform hover:-translate-y-1 hover:scale-110 hover:shadow-lg">
            <i class="fa-brands fa-x-twitter"></i>
        </a>

    </div>

</div>



        <!--<div class="contact-details space-y-4">-->
        <!--  <p><strong>Email (Sales):</strong> <a href="mailto:business@apnashaher.com" class="text-blue-600 hover:underline">business@apnashaher.com</a></p>-->
        <!--  <p><strong>Email (HR/Career):</strong> <a href="mailto:hr@apnashaher.com" class="text-blue-600 hover:underline">hr@apnashaher.com</a></p>-->
        <!--  <p><strong>Phone:</strong> <a href="tel:+917068401234" class="text-blue-600 hover:underline">+91 70684 01234</a></p>-->
        <!--  <p><strong>Open Time:</strong> 24 X 7 (Customer Care)</p>-->
        <!--</div>-->
      </div>
    </div>

    <!-- Right: Send Message Form -->
    <div class="">
          
    <div class="contact-form-card bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-8 md:p-12 shadow-xl">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">
        Send Us Your Message
      </h2>

      <form class="space-y-6">
        <input type="text" placeholder="Name" class="w-full px-6 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
        
        <input type="email" placeholder="Email" class="w-full px-6 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
        
        <input type="tel" placeholder="Mobile No." class="w-full px-6 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
        
        <textarea rows="6" placeholder="Your Message..." class="w-full px-6 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>

        <!-- CAPTCHA -->
        <div class="flex items-center gap-4">
          <span class="px-4 py-3 bg-gray-100 rounded-xl font-semibold text-gray-700">
            7 + 3 = ?
          </span>
          <input type="text" placeholder="Enter Answer" class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-xl text-xl font-bold hover:bg-blue-700 transition shadow-lg">
          SEND MESSAGE
        </button>
      </form>
    </div>
</div>

 
  </div>

  <!-- Google Map Section -->
  <section class="contact-map py-16 bg-gray-100">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8">
        Find Us Here
      </h2>

      <!-- Google Maps Embed (replace with your real embed code) -->
      <div class="contact-map-frame rounded-3xl overflow-hidden shadow-2xl">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.1194289498017!2d77.37250999999999!3d28.626182500000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce550ad860eeb%3A0xfba24a7c2d170983!2sI-thum%20and%20Grandslam%20Developers%20Pvt%20ltd!5e0!3m2!1sen!2sin!4v1773417143386!5m2!1sen!2sin" 
          width="100%" 
          height="500" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>

      <p class="text-gray-600 mt-6 text-lg">
        Plot Number A- 40, I-Thum IT Park, Sector - 62, Noida, Uttar Pradesh, India
      </p>
    </div>
  </section>
</section>


@endsection