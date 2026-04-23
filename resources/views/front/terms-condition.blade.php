@extends('layouts.app')
@section('title', 'Terms & Condition')
@push('styles')
<!-- Custom CSS -->
<style>

    .tc-container{
        width: 80%;
        margin: auto;
    }
    
  .tc-section {
   padding-bottom: 40px;
  }

  .tc-main-heading {
    font-weight: 900;
    letter-spacing: -0.04em;
  }

  .tc-card {
    border-radius: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .tc-card:hover {
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
  }

  .tc-card-header {
    background: #2563eb;
    color: white;
    font-weight: 700;
  }

  .tc-card-body {
    line-height: 1.75;
  }

  .tc-list li {
    margin-bottom: 0.75rem;
  }
</style>
 @endpush
@section('content')
<!-- TERMS & CONDITIONS PAGE -->
<div class="tc-page bg-white min-h-screen py-0 md:py-12">
  <div class="tc-container  mx-auto px-2 lg:px-8" >

    <!-- Page Title -->
    <h1 class="tc-title text-4xl md:text-5xl font-bold text-gray-900 mb-3 text-center">
      Terms & Conditions jj
    </h1>
    <p class="tc-updated text-center text-gray-600 mb-12">
      Last updated: March 06, 2026
    </p>

    <!-- Introduction -->
    <div class="tc-intro mb-12 text-lg text-gray-700 leading-relaxed">
      <p>
        Welcome to <strong>www.apnashaher.com</strong>. Please read these Terms and Conditions carefully before using our website. These Terms of Use outline the terms and conditions governing your access to and usage of the websites, mobile applications, and other portals owned, operated, branded, or provided by Apna Shaher (defined as the "Sites").
      </p>
      <p class="mt-6">
        By accessing or using the Site, you agree to be bound by these Terms. If you do not agree with any part of these terms, you must not use our Service.
      </p>
    </div>

    <!-- Sections -->
    <div class="tc-sections space-y-12 text-gray-800 leading-relaxed">

      <!-- 1. Acceptance of Terms -->
      <div class="tc-section">
        <h2 class="tc-section-title text-2xl md:text-3xl font-bold mb-4">1. Acceptance of Terms</h2>
        <p>
          By using this website, you agree to be bound by these Terms and Conditions and our Privacy Policy. If you do not agree with any part of these terms, you must discontinue use of the website immediately.
        </p>
      </div>

      <!-- 2. Use of the Site -->
      <div class="tc-section">
        <h2 class="tc-section-title text-2xl md:text-3xl font-bold mb-4">2. Use of the Site</h2>
        <p>
          You may use the Site only for lawful purposes and in accordance with these Terms. You agree not to:
        </p>
        <ul class="tc-list list-disc pl-6 mt-4 space-y-2">
          <li>Use the Site in any way that violates any applicable national or international law or regulation</li>
          <li>Post or transmit any content that is unlawful, harmful, threatening, abusive, defamatory, vulgar, obscene, or otherwise objectionable</li>
          <li>Impersonate any person or entity or misrepresent your affiliation with any person or entity</li>
          <li>Interfere with or disrupt the Site or servers or networks connected to the Site</li>
          <li>Attempt to gain unauthorized access to any portion of the Site</li>
        </ul>
      </div>

      <!-- 3. User Accounts & Listings -->
      <div class="tc-section">
        <h2 class="tc-section-title text-2xl md:text-3xl font-bold mb-4">3. User Accounts & Business Listings</h2>
        <p>
          To list your business/institute on ApnaShaher.com, you may be required to create an account and provide accurate, current, and complete information. You are responsible for:
        </p>
        <ul class="tc-list list-disc pl-6 mt-4 space-y-2">
          <li>Maintaining the confidentiality of your account credentials</li>
          <li>All activities that occur under your account</li>
          <li>Ensuring that all information in your listing (including images, descriptions, contact details) is accurate and not misleading</li>
          <li>Keeping your listing updated</li>
        </ul>
        <p class="mt-4">
          We reserve the right to remove, suspend, or terminate any listing or account that violates these Terms or contains false/misleading information.
        </p>
      </div>

      <!-- 4. Intellectual Property -->
      <div class="tc-section">
        <h2 class="tc-section-title text-2xl md:text-3xl font-bold mb-4">4. Intellectual Property</h2>
        <p>
          All content on the Site (excluding user-submitted content), including text, graphics, logos, icons, images, and software, is the property of ApnaShaher.com or its licensors and is protected by copyright, trademark, and other intellectual property laws.
        </p>
        <p class="mt-4">
          By posting content on the Site, you grant us a non-exclusive, royalty-free, perpetual, irrevocable, worldwide license to use, reproduce, modify, adapt, publish, translate, distribute, and display such content in connection with operating and promoting the Site.
        </p>
      </div>

      <!-- 5. Limitation of Liability -->
      <div class="tc-section">
        <h2 class="tc-section-title text-2xl md:text-3xl font-bold mb-4">5. Limitation of Liability</h2>
        <p>
          ApnaShaher.com and its affiliates shall not be liable for any direct, indirect, incidental, special, consequential, or punitive damages arising out of or in connection with your use of the Site, including but not limited to loss of profits, data, goodwill, or business interruption.
        </p>
        <p class="mt-4">
          We do not guarantee the accuracy, completeness, or usefulness of any information on the Site, nor do we endorse any opinions expressed by users.
        </p>
      </div>

      <!-- 6. Changes to Terms -->
      <div class="tc-section">
        <h2 class="tc-section-title text-2xl md:text-3xl font-bold mb-4">6. Changes to Terms</h2>
        <p>
          We may revise these Terms at any time by updating this page. You are expected to check this page periodically for changes. Your continued use of the Site following the posting of revised Terms means that you accept and agree to the changes.
        </p>
      </div>

      <!-- 7. Governing Law -->
      <div class="tc-section">
        <h2 class="tc-section-title text-2xl md:text-3xl font-bold mb-4">7. Governing Law</h2>
        <p>
          These Terms shall be governed by and construed in accordance with the laws of India. Any disputes arising out of or in connection with these Terms shall be subject to the exclusive jurisdiction of the courts located in Faridabad, Haryana.
        </p>
      </div>

      <!-- Contact -->
    

    </div>

  </div>
</section>
@endsection