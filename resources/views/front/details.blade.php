@extends('layouts.app')
@section('title', 'Help & Support')
@push('styles')
  <style>
    .en-mobile-btn {
      background: linear-gradient(90deg, #1565c0, #42a5f5);
      color: white;
      border: none;
      padding: 11px;
      font-size: 1rem;
      font-weight: 500;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.6);
      backdrop-filter: blur(3px);
      transition: all 0.3s ease;
      padding: 20px;
    }

    .modal-content {
      background: #fff;
      margin: 50px auto;
      padding: 30px 25px;
      width: 95%;
      max-width: 600px;
      border-radius: 12px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
      position: relative;
      animation: slideIn 0.4s ease;
      font-family: 'Poppins', sans-serif;
    }

    @keyframes slideIn {
      0% {
        transform: translateY(-50px);
        opacity: 0;
      }

      100% {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .modal .close {
      position: absolute;
      top: 15px;
      right: 20px;
      font-size: 26px;
      font-weight: bold;
      cursor: pointer;
      color: #333;
      transition: color 0.2s;
    }

    .modal .close:hover {
      color: #ff4d4f;
    }

    .modal-header h2 {
      margin: 0;
      font-size: 24px;
      color: #111;
    }

    .modal-header .modal-category {
      font-size: 14px;
      color: #888;
      margin-top: 3px;
    }

    .modal-body {
      margin-top: 20px;
      line-height: 1.6;
      color: #333;
    }

    .modal-meta {
      display: flex;
      justify-content: flex-start;
      gap: 20px;
      margin-top: 15px;
    }

    .modal-meta .meta-item {
      display: flex;
      align-items: center;
      gap: 6px;
      font-weight: 500;
      color: #555;
    }

    .modal-footer {
      margin-top: 25px;
      text-align: right;
    }

    .admission-enquiry-btn {
      background: #007BFF;
      color: #fff;
      border: none;
      padding: 12px 22px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 15px;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .admission-enquiry-btn:hover {
      background: #0056b3;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .profile-complete-section,
    .institute-profile-section {
      background: #fff;
      padding-top: 2rem;
      padding-bottom: 2rem;
      padding-left: 1.25rem;
      padding-right: 1.25rem;
    }

    .profile-container {
      max-width: 1100px;
      margin: 0 auto;
    }

    /* Banner / Top Section */
    .profile-banner {
      background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb00 100%);
      padding: 60px 0 80px;
    }

    .profile-header {
      display: flex;
      flex-direction: column;
      /* align-items: center; */
      /*gap: 20px;*/
    }

    @media (min-width: 768px) {
      .profile-header {
        flex-direction: row;
        /* align-items: center; */
        /*gap: 20px;*/
      }
    }

    .institute-logo-box {
      flex-shrink: 0;
    }

    .institute-logo {
      margin-top: 15px;
      width: 160px;
      height: 160px;
      border-radius: 5px;
      object-fit: cover;
      border: 6px solid white;
      box-shadow: 0 10px 30px rgba(21, 101, 192, 0.25);
    }

    .institute-info {
      flex: 1;
    }

    .institute-name {
      font-size: 2.6rem;
      font-weight: 800;
      color: #0d1117;
      margin-bottom: 10px;
    }

    .info-table {
      display: grid;
      grid-template-columns: 1fr 2fr;
      gap: 16px 24px;
      margin-bottom: 24px;
    }

    .info-row {
      display: contents;
    }

    .info-label {
      font-weight: 600;
      color: #555;
      font-size: 1.05rem;
    }

    .info-value {
      font-size: 1.1rem;
      color: #1565c0;
    }

    .website-link {
      color: #1565c0;
      text-decoration: underline;
    }

    .profile-badges {
      display: flex;
      gap: 12px;
      margin-bottom: 10px;
      flex-wrap: wrap;
    }

    .badge {
      padding: 6px 16px;
      border-radius: 30px;
      font-size: 0.9rem;
      font-weight: 600;
    }

    .badge.verified {
      background: #e8f5e9;
      color: #2e7d32;
    }

    .badge.featured {
      background: #e3f2fd;
      color: #1565c0;
    }


    /* About Section */
    .profile-about-section {
      padding: 60px 0;
      background-color: #ffffff;
    }

    .about-card {
      background: white;
      border-radius: 16px;
      padding: 40px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
      border: 1px solid #e3f2fd;
    }

    .about-title {
      font-size: 1.9rem;
      font-weight: 700;
      color: #0d1117;
      margin-bottom: 24px;
    }

    .about-text {
      font-size: 1.05rem;
      color: #444;
      line-height: 1.7;
      margin-bottom: 20px;
    }

    .horizontal-line {
      width: 100%;
      height: 1px;
      background-color: gray;
      margin: 20px 0;
    }

    .info-table {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .info-table h6 {
      margin: 0px;
    }

    .verline {
      width: 1px;
      height: 30px;
      background-color: #fff;
    }

    .institute-cat {
      display: flex;
      gap: 15px;
    }

    /* Responsive */
    @media (max-width: 768px) {

      .profile-complete-section,
      .institute-profile-section {
        background: #fff;
        padding-top: 1rem;
        padding-bottom: 1rem;
        padding-left: 0;
        padding-right: 0;
      }

      .institute-name {
        font-size: 26px;
        line-height: 30px;
      }

      .info-table {
        grid-template-columns: 1fr;
        gap: 12px;
      }

      .profile-actions {
        flex-direction: column;
      }
    }

    .profile-actions {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      margin-top: 24px;
    }

    .btn-contact,
    .btn-whatsapp {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      /* space between icon & text */
      padding: 14px 32px;
      font-size: 1.05rem;
      font-weight: 600;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease;
      border: none;
      min-width: 180px;
    }

    .btn-contact {
      background: #1565c0;
      color: white;
      box-shadow: 0 4px 15px rgba(21, 101, 192, 0.25);
    }

    .btn-contact:hover {
      background: #0d47a1;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(21, 101, 192, 0.35);
    }

    .btn-whatsapp {
      background: #25D366;
      /* WhatsApp green */
      color: white;
      box-shadow: 0 4px 15px rgba(37, 211, 102, 0.25);
    }

    .btn-whatsapp:hover {
      background: #20b058;
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(37, 211, 102, 0.35);
    }

    /* Optional: Make icons slightly larger */
    .btn-contact i,
    .btn-whatsapp i {
      font-size: 1.25rem;
    }

    .star-rating {
      display: flex;
      gap: 4px;
      /* space between stars */
      font-size: 1.4rem;
      /* adjust size as needed */
      color: #f59e0b;
      /* gold/yellow color */


    }

    .rating-section {
      display: flex;
      gap: 10px;
      align-items: center;
      margin-bottom: 20px;
    }

    .star-section i {
      transition: transform 0.2s ease;
      color: yellow;
    }

    .star-rating:hover i {
      transform: scale(1.15);
      /* subtle hover effect */
    }
  </style>
  <style>
    .time-review-section {
      background: #ffffff;
      padding: 40px 0px;
    }

    .time-review-container {
      max-width: 1200px;
      margin: 0 auto;
      display: grid;
      grid-template-columns: 1fr;
      gap: 40px;
    }

    @media (max-width: 992px) {
      .time-review-container {
        grid-template-columns: 1fr;
      }
    }

    .card-title {
      font-size: 1.9rem;
      font-weight: 700;
      color: #0d1117;
      margin-bottom: 12px;
    }

    .card-subtitle {
      font-size: 1rem;
      color: #555;
      margin-bottom: 30px;
    }

    /* Time Slots Card */
    .time-slots-card {
      background: white;
      border-radius: 16px;
      padding: 40px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
      border: 1px solid #e3f2fd;
    }

    .time-slots-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 16px;
    }

    .time-slot {
      background: #f8fbff;
      border-radius: 12px;
      padding: 18px;
      text-align: center;
      border: 1px solid #e3f2fd;
      transition: all 0.3s;
    }

    .time-slot:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 20px rgba(21, 101, 192, 0.12);
    }

    .time-slot.closed {
      background: #ffebee;
      border-color: #ffcdd2;
    }

    .time-slot.closed .timing {
      color: #c62828;
      font-weight: 600;
    }

    .day {
      font-weight: 600;
      color: #1565c0;
      margin-bottom: 8px;
    }

    .timing {
      font-size: 1rem;
      color: #333;
    }

    /* Review Form Card */
    .review-form-card {
      background: white;
      border-radius: 16px;
      padding: 40px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
      border: 1px solid #e3f2fd;
    }

    .review-form {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
      font-size: 0.98rem;
    }

    .form-input,
    .form-textarea,
    .form-select {
      padding: 14px 16px;
      border: 1.5px solid #bbdefb;
      border-radius: 10px;
      font-size: 1rem;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
      border-color: #1565c0;
      outline: none;
      box-shadow: 0 0 0 3px rgba(21, 101, 192, 0.12);
    }

    .form-textarea {
      resize: vertical;
      min-height: 120px;
    }

    .phone-group {
      display: grid;
      gap: 12px;
      grid-template-columns: 9fr 3fr;
    }

    .country-code {
      padding: 14px;
      border: 1.5px solid #bbdefb;
      border-radius: 10px;
      font-size: 1rem;
      min-width: 90px;
    }

    .phone-input {
      flex: 1;
    }

    .star-rating-input {
      display: flex;
      flex-direction: row-reverse;
      justify-content: flex-end;
      gap: 6px;
    }

    .star-rating-input input {
      display: none;
    }

    .star-rating-input label {
      font-size: 1.8rem;
      color: #ddd;
      cursor: pointer;
      transition: color 0.2s;
    }

    .star-rating-input input:checked~label,
    .star-rating-input label:hover,
    .star-rating-input label:hover~label {
      color: #f59e0b;
    }

    .submit-review-btn {
      background: linear-gradient(90deg, #1565c0, #42a5f5);
      color: white;
      border: none;
      padding: 16px;
      font-size: 1.1rem;
      font-weight: 600;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s;
      margin-top: 12px;
    }

    .submit-review-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(21, 101, 192, 0.3);
    }

    /* Responsive */
    @media (max-width: 992px) {
      .time-review-container {
        grid-template-columns: 1fr;
      }
    }

    .reviewotp-btn {
      display: inline-block;
      background-color: #4CAF50;
      /* green */
      color: white;
      font-weight: bold;
      padding: 10px 20px;
      margin: 5px 0;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .reviewotp-btn:hover {
      background-color: #45a049;
      transform: translateY(-2px);
    }

    .reviewotp-btn:disabled {
      background-color: #ccc;
      cursor: not-allowed;
      color: #666;
    }
  </style>

  <!-- ==================== CUSTOM CSS ==================== -->
  <style>
    .courses-section {
      background: #ffffff;
      padding: 40px 0px;
    }

    .courses-container {
      max-width: 1280px;
      margin: 0 auto;
    }

    .section-title {
      text-align: center;
      font-size: 2.6rem;
      font-weight: 800;
      color: #0d1117;
      margin-bottom: 12px;
    }

    .section-subtitle {
      text-align: center;
      font-size: 1.2rem;
      color: #555;
      margin-bottom: 50px;
    }

    .courses-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 28px;
    }

    .course-card {
      background: white;
      border-radius: 6px;
      overflow: hidden;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
      transition: all 0.35s ease;
      border: 1px solid #e3f2fd;
    }

    .course-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 50px rgba(21, 101, 192, 0.18);
    }

    /* Pastel Variations */
    .pastel-blue {
      border-top: 6px solid #bbdefb;
    }

    .pastel-green {
      border-top: 6px solid #c8e6c9;
    }

    .pastel-purple {
      border-top: 6px solid #e1bee7;
    }

    .pastel-orange {
      border-top: 6px solid #ffe0b2;
    }

    .course-image {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border: 5px solid #ffffff;
      overflow: hidden;
    }

    .course-content {
      padding: 14px;
    }

    .course-name {
      height: 45px;
      font-size: 16px;
      font-weight: 700;
      color: #0d1117;
      margin-bottom: 8px;
    }

    .course-category {
      font-size: 12px;
      color: #666;
      font-weight: 600;
      margin-bottom: 16px;
      background: rgb(235, 235, 235);
      padding: 2px 10px;
      width: fit-content;
      border-radius: 3px;
    }

    .course-meta {
      display: flex;
      flex-direction: column;
      gap: 12px;
      margin-bottom: 24px;
    }

    .meta-item {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.98rem;
      color: #444;
    }

    .meta-item i {
      color: #1565c0;
      font-size: 1.1rem;
    }

    .view-details-btn {
      display: block;
      width: 100%;
      padding: 14px;
      background: #1565c0;
      color: white;
      border: none;
      border-radius: 50px;
      font-weight: 600;
      cursor: pointer;
      text-align: center;
      transition: all 0.3s;
      text-decoration: none;
    }

    .view-details-btn:hover {
      background: #0d47a1;
      transform: translateY(-2px);
    }

    .rating-star-text {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .estblished {
      font-size: 13px;
      padding-left: 1.5rem;
      padding-right: 1.5rem;
      padding-top: 0.5rem;
      padding-bottom: 0.5rem;

    }

    /* Responsive */
    @media (max-width: 1024px) {
      .courses-grid {
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      }
    }

    @media (max-width: 640px) {

      .estblished {
        font-size: 13px;
        padding-left: .5rem;
        padding-right: .5rem;
        padding-top: 0.2rem;
        padding-bottom: 0.2rem;


      }

      .course-image {
        height: 300px;
      }

      .rating-section {
        display: flex;
        /*flex-direction:column;*/
        gap: 10px;
        align-items: start;
        margin-bottom: 20px;
      }

      .mobile-view-div {
        /*display:none;*/
      }

      .estblished {
        font-size: 13px;
      }

      .rating-star-text {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        /*margin-top:10px;*/
      }

      .about-card {
        background: white;
        border-radius: 0;
        padding: 0px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.00);
        border: none;
      }

      .text-3xl {
        font-size: 28px !important;
        line-height: 2.25rem;
      }

      .px-4 {
        padding-left: 10px !important;
        padding-right: 10px !important;
      }

      .section-title {
        text-align: center;
        font-size: 28px;
        font-weight: 800;
        color: #0d1117;
        margin-bottom: 12px;
      }

      .card-title {
        font-size: 28px;
        font-weight: 700;
        color: #0d1117;
        margin-bottom: 12px;
      }
    }
  </style>
  <style>
    /* Overlay when sidebar open */
    .sidebar-overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 999;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.4s ease;
    }

    .sidebar-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    /* Left Sidebar */
    .left-sidebar {
      position: fixed;
      top: 0;
      left: -500px;
      /* hidden by default */
      width: 500px;
      height: 100%;
      background: white;
      box-shadow: 10px 0 30px rgba(0, 0, 0, 0.25);
      z-index: 1000;
      transition: left 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
      overflow-y: auto;
    }

    .left-sidebar.open {
      left: 0;
    }

    .sidebar-header {
      background: #1565c0;
      color: white;
      padding: 20px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .sidebar-header h2 {
      font-size: 1.5rem;
      margin: 0;
    }

    .sidebar-close {
      background: none;
      border: none;
      color: white;
      font-size: 2rem;
      cursor: pointer;
      line-height: 1;
    }

    .sidebar-body {
      padding: 32px 24px;
    }

    .enquiry-form {
      display: flex;
      flex-direction: column;
      gap: 22px;
    }

    .form-label {
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
      font-size: 0.98rem;
    }

    .form-input,
    .form-textarea,
    .country-code {
      width: 100%;
      padding: 14px 16px;
      border: 1.5px solid #bbdefb;
      border-radius: 10px;
      font-size: 1rem;
    }

    .phone-group {
      display: flex;
      gap: 12px;
    }

    .country-code {
      min-width: 90px;
    }

    .form-textarea {
      resize: vertical;
      min-height: 110px;
    }

    .submit-enquiry-btn {
      background: linear-gradient(90deg, #1565c0, #42a5f5);
      color: white;
      border: none;
      padding: 16px;
      font-size: 1.1rem;
      font-weight: 600;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .submit-enquiry-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(21, 101, 192, 0.3);
    }

    .slideshow-container {
      height: 270px;
    }

    .phone-group-section {
      display: flex;
      gap: 10px;
    }

    .phone-group-section .phone-input {
      width: 60%;
    }

    @media (min-width: 769px) {
      .mobile-view-logo {
        display: none !important;
      }
    }


    /* Responsive - sidebar becomes full-width on mobile */
    @media (max-width: 768px) {
      .left-sidebar {
        width: 100%;
        left: -100%;
      }

      .phone-group {
        display: flex;
        flex-direction: column;
      }

      .phone-group-section {
        display: flex;
      }

      .slideshow-container {
        height: 170px;
      }

      .review-form-card {
        background: white;
        border-radius: 16px;
        padding: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
        border: 1px solid #e3f2fd;
      }

      .time-slots-card {
        background: white;
        border-radius: 16px;
        padding: 18px;
        margin-top: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);
        border: 1px solid #e3f2fd;
      }

      .time-review-section {
        background: #ffffff00;
        padding: 0px 0px;
      }

      .time-slots-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
      }

    }

    /* Sticky Footer Safe Area for Mobile */
    .fixed.bottom-0 {
      padding-bottom: env(safe-area-inset-bottom);
    }

    /* Optional: Thoda shadow aur better look */
    .shadow-2xl {
      box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.15);
    }
  </style>

@endpush
@section('content')
  <!-- ==================== INSTITUTE PROFILE DETAILS ==================== -->
  {{-- <section class="institute-profile-section">
    <div class="profile-banner">
      <div class="profile-container">
        Logo + Basic Info + Buttons
        <div class="profile-header">
          Left: Logo
          <div class="institute-logo-box">
            @php
            if($institute->logo) {
            $logo = asset('storage/'.$institute->logo);
            } else {
            $logo = strtoupper(substr($institute->name,0,1));
            $bgColor = pastelColor();
            $textColor = '#333';
            }

            $plan = $institute->latestPlan->plan;
            $features = $plan->features ?? null;

            $featured = $features?->featured_in_category_listings ?? false;
            $verified = $features?->verified_badge ?? false;
            @endphp
            @if($institute->logo !="")
            <img src="{{$logo}}" alt="Institute Logo" class="institute-logo">
            @else
            <div class="seller-logo-letter institute-logo" style="background-color: {{$bgColor}}; color: {{$textColor}};">
              {{$logo}}
            </div>
            @endif
          </div>

          Right: Name + Tabular Details
          <div class="institute-info">
            <h1 class="institute-name">{{$institute->name}} @if($verified)<i
                class="fas fa-check-circle verified-tick"></i>@endif </h1>
            <div class="rating-section">
              @if($institute->rating >0)
              <div class="star-rating">
                <span class="stars">
                  @for($i = 1; $i <= 5; $i++) @if($i <=floor($institute->rating))
                    <i class="fas fa-star"></i>
                    @elseif($i - $institute->rating < 1) <i class="fas fa-star-half-alt"></i>
                      @else
                      <i class="far fa-star"></i>
                      @endif
                      @endfor
                </span>
              </div>
              @else
              <div class="">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              @endif

              @php
              $avg = round($institute->rating, 1); // round to 1 decimal
              $displayAvg = ($avg == floor($avg)) ? floor($avg) : $avg;
              @endphp
              <span>({{$institute->rating > 0 ? $displayAvg : "No"}} Ratings)</span>
              @if($featured)
              <span class="badge featured">
                <i class="fas fa-star"></i> Featured Institute
              </span>
              @endif
            </div>
            <div class="institute-cat">

              <div class="course-chip">{{$institute->subcategory->name ?? ''}}</div>

            </div>
            <div class="horizontal-line"></div>
            <p style="font-weight: 500; margin: 0px;">{{$institute->description}}</p>


          </div>
        </div>
        <div class="horizontal-line"></div>
        <div class="info-table">
          <h6><b>Country</b><br>India</h6>
          <div class="verline"></div>
          <h6><b>Established</b><br>{{$institute->established_year}}</h6>
          <div class="verline"></div>
          <h6><b>Registered</b><br>2008</h6> -->

        </div>


        <div class="profile-actions">
          <a href="tel:{{$institute->mobile}}" class="btn-contact call-click-btn" data-id="{{$institute->id}}">
            <i class="fas fa-phone-alt"></i> Call Now
          </a>
          @if($institute->whatsapp !="")
          <a href="https://wa.me/{{$institute->whatsapp}}" target="_blank" class="btn-whatsapp whatsapp-click-btn"
            data-id="{{$institute->id}}">
            <i class="fab fa-whatsapp"></i> WhatsApp Chat
          </a>
          @endif

        </div>
      </div>
    </div>

    Introduction / About Section
    <div class="profile-about-section">
      <div class="profile-container">
        <div class="about-card">
          <h2 class="about-title">About {{$institute->name}}</h2>

          {{$institute->detailed_information}}
        </div>
      </div>
    </div>
  </section> --}}

  <section class="institute-profile-section  ">
    <div class="profile-container max-w-7xl mx-auto px-4">

      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <!-- ==================== LEFT SIDE (8 Columns) ==================== -->
        <div class="lg:col-span-8">

          <!-- Institute Name + Verified -->
          <div class="flex items-center gap-4 ">
            <div class="flex justify-center   mobile-view-logo">
              @if($institute->logo)
                <div class="w-20 h-20 bg-white rounded  border-1 border-white overflow-hidden"
                  style="border:1px solid #cdc8c8;">
                  <img src="{{ asset('storage/' . $institute->logo) }}" alt="{{$institute->name}}"
                    class="w-full h-full object-contain p-2">
                </div>
              @else
                <!-- Fallback Initial -->
                <div class="w-40 h-40 bg-gradient-to-br from-blue-100 via-indigo-100 to-purple-100 
                                    flex items-center justify-center text-slate-700 text-7xl font-bold 
                                    shadow-xl border-4 border-white rounded-3xl">
                  {{ strtoupper(substr($institute->name, 0, 1)) }}
                </div>
              @endif
            </div>
            <h1 class="institute-name  font-bold text-gray-900">
              {{$institute->name}} <i class="fas fa-check-circle verified-tick text-green-600 text-3xl"></i>
            </h1>




          </div>
          <div class="profile-header">

            <div class="institute-logo-box">
              @php
                if ($institute->logo) {
                  $logo = asset('storage/' . $institute->logo);
                } else {
                  $logo = strtoupper(substr($institute->name, 0, 1));
                  $bgColor = pastelColor();
                  $textColor = '#333';
                }

                $plan = optional($institute->latestPlan)->plan;
                $features = optional($plan)->features;

                $featured = $features?->featured_in_category_listings ?? false;
                $verified = $features?->verified_badge ?? false;
              @endphp

            </div>


            <div class="institute-info">

              <div class="rating-section">
                <div class="rating-star-text">
                  @if($institute->rating > 0)
                    <div class="star-rating">
                      <span class="stars">
                        @for($i = 1; $i <= 5; $i++)
                          @if($i <= floor($institute->rating))
                            <i class="fas fa-star"></i>
                          @elseif($i - $institute->rating < 1)
                            <i class="fas fa-star-half-alt"></i>
                          @else
                            <i class="far fa-star"></i>
                          @endif
                        @endfor
                      </span>
                    </div>
                  @else
                    <div class="">
                      <i class="fa-regular fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                      <i class="fa-regular fa-star"></i>
                    </div>
                  @endif

                  @php
                    $avg = round($institute->rating, 1); // round to 1 decimal
                    $displayAvg = ($avg == floor($avg)) ? floor($avg) : $avg;
                  @endphp
                  <span>({{$institute->rating > 0 ? $displayAvg : "No"}} Ratings)</span>
                </div>
                <span class="mobile-view-div">||</span>

                <div class="bg-white border border-gray-100 rounded  flex items-center justify-between estblished">
                  <p class=" uppercase tracking-widest text-slate-500 font-medium "> Established -
                    {{$institute->established_year ?? 'N/A'}}
                  </p>

                </div>

                @if($featured)
                  <span class="badge featured">
                    <i class="fas fa-star"></i> Featured Institute
                  </span>
                @endif
              </div>
              <!--<div class="institute-cat">-->

              <!--   <div class="course-chip">{{$institute->category->name ?? ''}}</div>-->

              <!--  </div>-->



            </div>
          </div>


          <!-- Image Slider -->

          <div class="slideshow-container mb-8 rounded-2xl overflow-hidden shadow-lg">

            @if(isset($institute->banners) && count($institute->banners) > 0)

              {{-- ✅ DYNAMIC BANNERS --}}
              @foreach($institute->banners as $index => $banner)
                <div class="mySlides fade">

                  @if($banner->link)
                    <a href="{{ $banner->link }}" target="_blank">
                      <img src="{{ asset('storage/' . $banner->image) }}" style="width:100%; height:100%; object-fit:cover;">
                    </a>
                  @else
                    <img src="{{ asset('storage/' . $banner->image) }}" style="width:100%; height:100%; object-fit:cover;">
                  @endif

                </div>
              @endforeach

              {{-- DOTS --}}
              <div class="dots-container">
                @foreach($institute->banners as $key => $banner)
                  <span class="dot" onclick="currentSlide({{ $key + 1 }})"></span>
                @endforeach
              </div>

            @else

              {{-- ❌ NO BANNERS → SHOW STATIC --}}
              <div class="mySlides fade">
                <img src="{{ asset('assets/slider/slider1.jpg') }}" style="width:100%; height:100%; object-fit:cover;">
              </div>

              <div class="mySlides fade">
                <img src="{{ asset('assets/slider/slider2.jpg') }}" style="width:100%; height:100%; object-fit:cover;">
              </div>

              <div class="mySlides fade">
                <img src="{{ asset('assets/slider/slider3.jpg') }}" style="width:100%; height:100%; object-fit:cover;">
              </div>

              <div class="dots-container">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
              </div>

            @endif

          </div>



          <!-- Category -->
          <div class="mb-6">
            <span class="course-chip text-lg px-6 py-2 bg-blue-100 text-blue-700 font-semibold rounded-full">
              {{$institute->subcategory->name ?? 'Education'}}
            </span>
          </div>

          <div class="horizontal-line"></div>
          <!-- Short Description -->
          <p class="text-lg text-gray-700 leading-relaxed mb-10">
            {{$institute->description ?? 'A premier institute dedicated to providing quality education and shaping bright futures.'}}
          </p>

          <!-- About Section -->
          <div class="about-card">
            <h2 class="about-title text-3xl font-bold mb-6">About {{$institute->name}}</h2>
            <div class="about-text text-gray-700 leading-relaxed text-[17px]">
              {!! $institute->detailed_information !!}
            </div>
          </div>

          <!-- ==================== GALLERY SECTION ==================== -->
          <section class="py-8 bg-white">
            <div class="max-w-7xl mx-auto px-4">

              <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900">Our Campus & Infrastructure</h2>
                <p class="text-gray-600 mt-3">Take a look at our facilities and learning environment</p>
              </div>

              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                @forelse($institute->galleries as $gallery)
                  <div class="group overflow-hidden rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300">
                    <img src="{{ asset('storage/' . $gallery->image) }}" alt="Gallery Image"
                      class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-500">
                  </div>
                @empty
                  <div class="group overflow-hidden rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&q=80&w=800"
                      alt="Campus View"
                      class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-500">
                  </div>

                  <!-- Image 2 -->
                  <div class="group overflow-hidden rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1591115765373-5207767f024d?auto=format&fit=crop&q=80&w=800"
                      alt="Classroom"
                      class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-500">
                  </div>

                  <!-- Image 3 -->
                  <div class="group overflow-hidden rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&q=80&w=800"
                      alt="Lab & Facilities"
                      class="w-full h-60 object-cover group-hover:scale-105 transition-transform duration-500">
                  </div>
                @endforelse

              </div>



            </div>
          </section>

          <!-- ==================== COURSES SECTION - PREMIUM CARDS ==================== -->
          <section class="courses-section">
            <div class="courses-container">
              <h2 class="section-title">Our Popular Courses & Programs</h2>
              <p class="section-subtitle">Explore verified courses with flexible timings and modes</p>

              <div class="courses-grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @if(isset($institute->courses) && count($institute->courses) > 0)
                  @foreach($institute->courses as $course)
                    <div class="course-card ">
                      <img src="{{ asset('storage/' . $course->image) }}" alt="{{$course->name}}" class="course-image">
                      <div class="course-content">
                        <h3 class="course-name">{{$course->name}}</h3>
                        <p class="course-category"> <span><b>Learning Method:</b> {{$course->mode}}</span></p>
                        <div class="flex justify-between items-center bg-white border border-gray-100 rounded p-2 mb-2">
                          <span class="text-sm font-medium text-gray-600">Course Fees</span>
                          <div class="text-right">
                            <span class="text-3xl font-bold text-indigo-700">
                              ₹{{ number_format($course->course_fee ?? 0) }}
                            </span>
                            <!--<span class="block text-xs text-gray-500">per student</span>-->
                          </div>
                        </div>

                        <div class="course-meta">
                          <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span><b>Duration:</b> {{$course->duration}} {{$course->duration_unit}}</span>
                          </div>
                          <!--<div class="meta-item">-->
                          <!--  <i class="fas fa-laptop-house"></i>-->
                          <!--  <span><b>Learning Method:</b> {{$course->mode}}</span>-->
                          <!--</div>-->
                          <div class="meta-item">
                            <i class="fas fa-laptop-house"></i>
                            <span><b>Available Seat:</b> {{$course->available_seats}}</span>
                          </div>

                        </div>

                        <a href="#" class="view-details-btn" onclick="openCourseModal({{ $course->id }}); return false;">
                          View Details <i class="fas fa-arrow-right"></i>
                        </a>
                      </div>
                    </div>
                  @endforeach
                @endif


              </div>
            </div>
          </section>
          <div id="courseModal" class="modal">
            <div class="modal-content">
              <span class="close" onclick="closeCourseModal()">&times;</span>

              <div class="modal-header">
                <h2 id="modalCourseName" class="text-2xl font-bold text-gray-900"></h2>
                <p class="modal-category" id="modalCourseCategory"></p>
              </div>

              <div class="modal-body space-y-8">

                <!-- Thumbnail -->
                <div id="modalCourseImage" class="rounded-2xl overflow-hidden shadow-md">
                  <!-- Image will be added via JS -->
                </div>

                <!-- Full Description -->
                <div>
                  <h3 class="text-lg font-semibold text-gray-800 mb-3">About This Course</h3>
                  <p id="modalCourseDescription" class="text-gray-700 leading-relaxed text-[15.5px]"></p>
                </div>

                <!-- Course Meta Information -->
                <div class="grid grid-cols-2 gap-6">
                  <div class="bg-gray-50 rounded-2xl p-5">
                    <div class="flex items-center gap-3">
                      <i class="fas fa-clock text-indigo-600 text-2xl"></i>
                      <div>
                        <p class="text-xs text-gray-500">Duration</p>
                        <p id="modalCourseDuration" class="font-semibold text-gray-900"></p>
                      </div>
                    </div>
                  </div>

                  <div class="bg-gray-50 rounded-2xl p-5">
                    <div class="flex items-center gap-3">
                      <i class="fas fa-laptop-house text-indigo-600 text-2xl"></i>
                      <div>
                        <p class="text-xs text-gray-500">Learning Mode</p>
                        <p id="modalCourseMode" class="font-semibold text-gray-900"></p>
                      </div>
                    </div>
                  </div>

                  <div class="bg-gray-50 rounded-2xl p-5">
                    <div class="flex items-center gap-3">
                      <i class="fas fa-users text-indigo-600 text-2xl"></i>
                      <div>
                        <p class="text-xs text-gray-500">Available Seats</p>
                        <p id="modalCourseSeats" class="font-semibold text-gray-900"></p>
                      </div>
                    </div>
                  </div>

                  <div class="bg-gray-50 rounded-2xl p-5">
                    <div class="flex items-center gap-3">
                      <i class="fas fa-rupee-sign text-indigo-600 text-2xl"></i>
                      <div>
                        <p class="text-xs text-gray-500">Course Fees</p>
                        <p id="modalCourseFee" class="font-bold text-2xl text-emerald-600"></p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

              <div class="modal-footer">
                <button onclick="openLeftSidebar()" class="admission-enquiry-btn w-full py-4 text-lg font-semibold">
                  <i class="fas fa-paper-plane mr-2"></i>
                  Admission Enquiry
                </button>
              </div>
            </div>
          </div>


          <!-- ==================== LEFT SIDEBAR (SWIPER/DRAWER STYLE) ==================== -->
          <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeLeftSidebar()"></div>

          <div class="left-sidebar" id="leftSidebar">
            <div class="sidebar-header">
              <h2>Enquire About This Course</h2>
              <button class="sidebar-close" onclick="closeLeftSidebar()">Ã—</button>
            </div>

            <div class="sidebar-body">
              <form class="enquiry-form">
                <div class="form-group">
                  <input type="hidden" name="institute_id" id="en-institute-id" value="{{ $institute->id }}">
                  <label class="form-label">Full Name *</label>
                  <input type="text" id="en-name" class="form-input" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                  <label class="form-label">Email Address *</label>
                  <input type="email" id="en-email" class="form-input" placeholder="your.email@example.com" required>
                </div>

                <div class="form-group">
                  <label class="form-label">Mobile Number *</label>
                  <div class="en-phone-group phone-group">
                    <select class="country-code" id="en-country-code" required style="width: 24%;">
                      <option value="+91"> +91</option>
                    </select>
                    <input type="tel" id="en-mobile" class="form-input phone-input" placeholder="Enter 10-digit number"
                      required><br>
                    <button type="button" id="send-otp-btn" style="margin-left:10px;" class="en-mobile-btn">Send
                      OTP</button>
                  </div>
                </div>

                <div class="form-group otp-div">
                </div>

                <div class="form-group">
                  <label class="form-label">Your Message / Query</label>
                  <textarea class="form-textarea" id="en-message" rows="5"
                    placeholder="Tell us what you want to know..."></textarea>
                </div>

                <button type="submit" class="submit-enquiry-btn">Submit Enquiry</button>
              </form>
            </div>
          </div>

          <!-- ==================== CSS ==================== -->

          <!-- ==================== LOCATION CARD ==================== -->
          <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 mt-6">
            <div class="flex items-start gap-4">
              <!-- Location Icon -->
              <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                <i class="fas fa-map-marker-alt text-2xl"></i>
              </div>

              <!-- Location Details -->
              <div class="flex-1">
                <p class="text-xs uppercase tracking-widest font-medium text-gray-500 mb-1">Location</p>
                <p class="text-gray-800 text-[17px] leading-tight font-medium">
                  {{$institute->profile_address ?? 'Not Available'}}
                </p>

                @if($institute->address)
                  <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                    {{$institute->profile_address}}
                  </p>
                @endif
              </div>
            </div>
          </div>

          <!-- ==================== TIME SLOTS + REVIEW FORM SECTION ==================== -->
          <section class="time-review-section">
            <div class="time-review-container">

              <!-- Left: Time Slots -->
              <div class="time-slots-card">
                <h2 class="card-title">Weekly Operating Hours</h2>
                <p class="card-subtitle">Our institute is open on the following days & timings</p>

                <div class="time-slots-grid">
                  @if(isset($institute->timings) && count($institute->timings) > 0)
                    @foreach($institute->timings as $timing)
                      @if($timing->is_active == 1)
                        <div class="time-slot">
                          <div class="day">{{$timing->day}}</div>
                          <div class="timing">{{date('g:i A', strtotime($timing->open_time))}} To
                            {{date('g:i A', strtotime($timing->close_time))}}
                          </div>
                        </div>
                      @else
                        <div class="time-slot closed">
                          <div class="day">{{$timing->day}}</div>
                          <div class="timing">Closed</div>
                        </div>
                      @endif

                    @endforeach
                  @endif



                </div>
              </div>

              <!-- Right: Review Form -->
              <div class="review-form-card">
                <h2 class="card-title">Submit Your Review</h2>
                <p class="card-subtitle">Help other students by sharing your experience</p>

                <form class="review-form" id="review-form">
                  <div class="form-group">
                    <label class="form-label">Your Rating *</label>
                    <div class="star-rating-input">
                      <input type="radio" id="star5" name="rating" value="5">
                      <label for="star5"><i class="fas fa-star"></i></label>
                      <input type="radio" id="star4" name="rating" value="4">
                      <label for="star4"><i class="fas fa-star"></i></label>
                      <input type="radio" id="star3" name="rating" value="3">
                      <label for="star3"><i class="fas fa-star"></i></label>
                      <input type="radio" id="star2" name="rating" value="2">
                      <label for="star2"><i class="fas fa-star"></i></label>
                      <input type="radio" id="star1" name="rating" value="1">
                      <label for="star1"><i class="fas fa-star"></i></label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" class="form-input" id="name" name="name" placeholder="Enter your full name"
                      required>
                  </div>

                  <div class="form-group">
                    <label class="form-label">Mobile Number *</label>
                    <div class="phone-group">
                      <div class="phone-group-section">
                        <select class="country-code" required style="width: 25%;">
                          <option value="+91"> +91</option>
                          <!-- Add more as needed -->
                        </select>
                        <input type="tel" name="mobile" id="mobile" class="form-input phone-input"
                          placeholder="Enter mobile number" style="width: 75%;" required>
                      </div>
                      <button type="button" class="reviewotp-btn" id="sendReviewOtpBtn">Send OTP</button>
                      <p id="mobile-msg" style="color:red;"></p>
                    </div>


                    <div id="otp-section" style="display:none; margin-top:10px;">
                      <label>Enter OTP *</label>
                      <input type="text" id="otp" name="otp" placeholder="Enter OTP" required disabled>
                      <button type="button" class="reviewotp-btn" id="verifyOtpBtn">Verify OTP</button>
                      <button id="resendOtpBtn" class="reviewotp-btn">Resend OTP</button>
                      <p id="otp-msg" style="color:red;"></p>
                    </div>
                  </div>



                  <!-- Other Form Fields -->
                  <input type="hidden" id="review_id" name="review_id">
                  <input type="hidden" id="institute_id" name="institute_id" value="{{ $institute->id }}">
                  <div class="form-group">
                    <label class="form-label">Your Review *</label>
                    <textarea class="form-textarea" id="review" name="review" rows="5"
                      placeholder="Share your experience, feedback or suggestions..." required></textarea>
                  </div>

                  <button type="submit" class="submit-review-btn" id="submitReviewBtn">Submit Review</button>

                  <p id="review-msg" style="color:green;"></p>
                </form>
              </div>

            </div>
          </section>
        </div>

        <!-- ==================== RIGHT SIDE STICKY CARD (4 Columns) ==================== -->
        <!-- ==================== RIGHT SIDE STICKY CARD ==================== -->
        <div class="lg:col-span-4">
          <div class="sticky top-24">

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">

              <!-- Logo Section -->
              <!-- Logo Section - No Crop, Proper Fit -->
              <div class="flex justify-center pt-8 pb-6 bg-gradient-to-b from-slate-50 to-white">
                @if($institute->logo)
                  <div class="w-40 h-40 bg-white rounded-3xl shadow-xl border-4 border-white overflow-hidden">
                    <img src="{{ asset('storage/' . $institute->logo) }}" alt="{{$institute->name}}"
                      class="w-full h-full object-contain p-2">
                  </div>
                @else
                  <!-- Fallback Initial -->
                  <div class="w-40 h-40 bg-gradient-to-br from-blue-100 via-indigo-100 to-purple-100 
                                    flex items-center justify-center text-slate-700 text-7xl font-bold 
                                    shadow-xl border-4 border-white rounded-3xl">
                    {{ strtoupper(substr($institute->name, 0, 1)) }}
                  </div>
                @endif
              </div>

              <!-- Institute Name + Badges -->
              <div class="text-center px-8 -mt-3">
                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{$institute->name}}</h3>

                <div class="flex justify-center gap-3 mb-8">
                  @if($verified)
                    <span class="badge verified flex items-center gap-1.5 px-4 py-1 text-sm">
                      <i class="fas fa-check-circle"></i> Verified
                    </span>
                  @endif

                  @if($featured)
                    <span class="badge featured flex items-center gap-1.5 px-4 py-1 text-sm">
                      <i class="fas fa-star"></i> Featured
                    </span>
                  @endif

                </div>
              </div>

              <!-- Action Buttons -->
              <div class="px-8 pb-8 space-y-3">
                <a href="tel:{{$institute->mobile}}"
                  class="btn-contact w-full flex items-center justify-center gap-3 py-4 text-lg font-semibold rounded-2xl call-click-btn"
                  data-id="{{$institute->id}}">
                  <i class="fas fa-phone-alt"></i>
                  Call Now
                </a>

                @if($institute->whatsapp)
                  <a href="https://wa.me/{{$institute->whatsapp}}" target="_blank"
                    class="btn-whatsapp w-full flex items-center justify-center gap-3 py-4 text-lg font-semibold rounded-2xl  whatsapp-click-btn"
                    data-id="{{$institute->id}}">
                    <i class="fab fa-whatsapp"></i>
                    WhatsApp Now
                  </a>
                @endif
                <p class="" style="width:100%; display:flex; text-align:center;justify-content: center;">Member Since:
                  23/11/2026</p>
              </div>


              <!-- Quick Info - Pastel Cards -->
              <!--<div class="bg-slate-50 px-8 py-9 border-t">-->
              <!--    <div class="grid grid-cols-2 gap-6">-->

              <!-- Established -->
              <!--        <div class="bg-white rounded-2xl p-5 text-center border border-slate-100">-->
              <!--            <p class="text-xs uppercase tracking-widest text-slate-500 font-medium mb-1">Established</p>-->
              <!--            <p class="text-3xl font-semibold text-slate-800">-->
              <!--                {{$institute->established_year ?? 'N/A'}}-->
              <!--            </p>-->
              <!--        </div>-->

              <!-- Location -->
              <!--        <div class="bg-white rounded-2xl p-5 text-center border border-slate-100">-->
              <!--            <p class="text-xs uppercase tracking-widest text-slate-500 font-medium mb-1">Location</p>-->
              <!--            <p class="text-lg font-medium text-slate-700 leading-tight">-->
              <!--                {{$institute->location ?? 'India'}}-->
              <!--            </p>-->
              <!--        </div>-->

              <!--    </div>-->
              <!--</div>-->

            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ==================== STICKY MOBILE FOOTER - CALL & WHATSAPP ==================== -->
  <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-2xl z-50 md:hidden"
    style="z-index:9999">
    <div class="flex items-center h-16 max-w-7xl mx-auto ">

      @if($institute->mobile)
        <a href="tel:{{$institute->mobile}}"
          class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5  flex items-center justify-center gap-2 transition-all active:scale-95 call-click-btn"
          data-id="{{$institute->id}}">
          <i class="fas fa-phone-alt text-lg"></i>
          <span>Call Now</span>
        </a>
      @endif

      @if($institute->whatsapp)
        <a href="https://wa.me/{{$institute->whatsapp}}" target="_blank"
          class="flex-1 bg-[#25D366] hover:bg-[#20b058] text-white font-semibold py-3.5  flex items-center justify-center gap-2 transition-all active:scale-95  whatsapp-click-btn"
          data-id="{{$institute->id}}">
          <i class="fab fa-whatsapp text-xl"></i>
          <span>WhatsApp</span>
        </a>
      @endif

      <!-- Agar sirf ek hi button hai to full width -->
      @if(!$institute->mobile && $institute->whatsapp)
        <a href="https://wa.me/{{$institute->whatsapp}}" target="_blank"
          class="flex-1 bg-[#25D366] hover:bg-[#20b058] text-white font-semibold py-3.5  flex items-center justify-center gap-2 transition-all active:scale-95 w-full  whatsapp-click-btn"
          data-id="{{$institute->id}}">
          <i class="fab fa-whatsapp text-xl"></i>
          <span>WhatsApp Now</span>
        </a>
      @endif

      @if(!$institute->whatsapp && $institute->mobile)
        <a href="tel:{{$institute->mobile}}"
          class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5  flex items-center justify-center gap-2 transition-all active:scale-95 w-full call-click-btn"
          data-id="{{$institute->id}}">
          <i class="fas fa-phone-alt text-lg"></i>
          <span>Call Now</span>
        </a>
      @endif

    </div>
  </div>
  <!-- ==================== CUSTOM CSS ==================== -->

@endsection
@push('after-scripts')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script>
    // Open Sidebar
    function openLeftSidebar() {
      document.getElementById('leftSidebar').classList.add('open');
      document.getElementById('sidebarOverlay').classList.add('active');
      document.body.style.overflow = 'hidden'; // prevent background scroll
    }

    // Close Sidebar
    function closeLeftSidebar() {
      document.getElementById('leftSidebar').classList.remove('open');
      document.getElementById('sidebarOverlay').classList.remove('active');
      document.body.style.overflow = ''; // restore scroll
    }

    // Close on overlay click
    document.getElementById('sidebarOverlay')?.addEventListener('click', closeLeftSidebar);
  </script>
  <script>
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    let mobileVerified = false; // track OTP verification

    // Send OTP
    $('#sendReviewOtpBtn').click(function () {
      let mobile = $('#mobile').val();
      let institute_id = $('#institute_id').val();
      $('#mobile-msg').text('');

      if (!/^\d{10}$/.test(mobile)) {
        toastr.error('Enter a valid 10-digit mobile number.');
        return;
      }
      let reviewsendotp = "{{ url('review/send-otp') }}";
      $.post(reviewsendotp, { mobile, institute_id }, function (res) {
        $('#otp-section').show();
        $('#otp').prop('disabled', false);
        $('#review_id').val(res.review_id);

        // Hide send button
        $('#sendReviewOtpBtn').hide();
        toastr.success(res.message);
      }).fail(function (err) {
        toastr.error(err.responseJSON.message);
      });
    });

    // Verify OTP
    $('#verifyOtpBtn').click(function () {
      let review_id = $('#review_id').val();
      let otp = $('#otp').val();
      $('#otp-msg').text('');

      if (!/^\d{6}$/.test(otp)) {
        toastr.error('Enter a valid 6-digit OTP.');
        return;
      }
      let reviewverifyotp = "{{ url('review/verify-otp') }}";
      $.post(reviewverifyotp, { review_id, otp }, function (res) {

        // Hide verify button
        $('#verifyOtpBtn').hide();

        // Mobile readonly
        $('#mobile').prop('readonly', true);

        // Disable OTP input
        $('#otp').prop('disabled', true);

        // âœ… Show Resend OTP button
        $('#resendOtpBtn').hide();
        mobileVerified = true; // mark mobile as verified
        toastr.success(res.message);
      }).fail(function (err) {
        toastr.error(err.responseJSON.message);
      });
    });
    // Resend OTP
    $('#resendOtpBtn').click(function () {
      let mobile = $('#mobile').val();
      let institute_id = $('#institute_id').val();
      let review_id = $('#review_id').val();

      if (!/^\d{10}$/.test(mobile)) {
        toastr.error('Enter a valid 10-digit mobile number.');
        return;
      }

      $.post("{{ url('review/send-otp') }}", { mobile, institute_id, review_id }, function (res) {
        toastr.success(res.message);

        // Re-enable OTP input for new OTP
        $('#otp').prop('disabled', false).val('');

        // Show Verify button again
        $('#verifyOtpBtn').show();

        // Hide Resend button until next verify
        $('#resendOtpBtn').show();
      }).fail(function (err) {
        toastr.error(err.responseJSON.message);
      });
    });
    // Submit Review
    $('#review-form').submit(function (e) {
      e.preventDefault();

      if (!mobileVerified) {
        toastr.warning('Please verify your mobile number first.');
        return;
      }

      let review_id = $('#review_id').val();
      let name = $('#name').val();
      let rating = $('input[name="rating"]:checked').val(); // âœ… FIX
      let review = $('#review').val();

      // Frontend validation
      if (!name) { toastr.error('Enter your name'); return; }
      if (!rating) { toastr.error('Please select a star rating'); return; }
      if (!review || review.length < 10) { toastr.error('Review must be at least 10 characters'); return; }

      let reviewsubmitreview = "{{ url('review/submit-review') }}";

      $.post(reviewsubmitreview, { review_id, name, rating, review }, function (res) {
        toastr.success(res.message);
        $('#review-form')[0].reset();
        $('#mobile').prop('readonly', false);

        // Disable OTP input
        $('#otp').prop('disabled', false);
        mobileVerified = false;
      }).fail(function (err) {
        toastr.error(err.responseJSON.message);
      });
    });
    function openCourseModal(courseId) {
      fetch(`{{url('/get-course')}}/${courseId}`)
        .then(response => response.json())
        .then(course => {

          document.getElementById('modalCourseName').innerText = course.name || 'Course Name';
          document.getElementById('modalCourseCategory').innerText = course.category_name || '';
          document.getElementById('modalCourseDescription').innerHTML = course.full_description || course.short_desc || 'No description available.';

          // Duration
          document.getElementById('modalCourseDuration').innerText =
            `${course.duration || ''} ${course.duration_unit || ''}`.trim();

          // Mode
          document.getElementById('modalCourseMode').innerText = course.mode || 'Not specified';

          // Seats
          document.getElementById('modalCourseSeats').innerText =
            course.available_seats ? course.available_seats : 'Contact Institute';

          // Fees - Clean (no "per student")
          document.getElementById('modalCourseFee').innerHTML =
            course.course_fee ? `₹${Number(course.course_fee).toLocaleString('en-IN')}` : 'Contact for fees';

          // Thumbnail
          const imageContainer = document.getElementById('modalCourseImage');
          imageContainer.innerHTML = course.thumb_image
            ? `<img src="${asset('storage/' + course.thumb_image)}" alt="${course.name}" class="w-full h-full object-cover">`
            : `<img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=800" 
                         alt="${course.name}" class="w-full h-full object-cover">`;

          // Save course id
          let courseInput = document.getElementById('en-course-id');
          if (!courseInput) {
            courseInput = document.createElement('input');
            courseInput.type = 'hidden';
            courseInput.id = 'en-course-id';
            courseInput.name = 'course_id';
            document.querySelector('.enquiry-form').appendChild(courseInput);
          }
          courseInput.value = course.id;

          document.getElementById('courseModal').style.display = 'block';
        })
        .catch(err => {
          console.error(err);
          alert('Failed to load course details');
        });
    }

    function closeCourseModal() {
      document.getElementById('courseModal').style.display = 'none';
    }


    let mobileEnquiryVerified = false;

    // Select existing send OTP button
    const sendOtpBtn = document.getElementById('send-otp-btn');

    // Select phone group to append OTP input and verify button
    const phoneGroup = document.querySelector('.otp-div');

    // Create OTP input
    const otpInput = document.createElement('input');
    otpInput.type = 'text';
    otpInput.placeholder = 'Enter OTP';
    otpInput.id = 'en-otp-input';
    otpInput.style.marginTop = '10px';
    otpInput.style.display = 'none';
    phoneGroup.appendChild(otpInput);

    // Create Verify button
    const verifyBtn = document.createElement('button');
    verifyBtn.innerText = 'Verify OTP';
    verifyBtn.type = 'button';
    verifyBtn.classList.add('en-mobile-btn');
    verifyBtn.style.marginLeft = '10px';
    verifyBtn.style.marginTop = '10px';
    verifyBtn.style.display = 'none';
    phoneGroup.appendChild(verifyBtn);

    // Function to send OTP
    function sendOtp() {
      const mobile = document.getElementById('en-mobile').value.trim();
      const country_code = document.getElementById('en-country-code').value;

      if (!mobile) { toastr.error('Enter mobile number'); return; }

      fetch('{{ route("enquiry.send.otp") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ mobile, country_code })
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            toastr.success('OTP sent! Check your phone.');
            otpInput.style.display = 'inline-block';
            verifyBtn.style.display = 'inline-block';
            sendOtpBtn.innerText = 'Resend OTP';
          } else {
            toastr.error(data.message || 'Please enter valid mobile number');
          }
        });
    }

    // Send OTP button click
    sendOtpBtn.addEventListener('click', sendOtp);

    // Verify OTP button click
    verifyBtn.addEventListener('click', () => {
      const mobile = document.getElementById('en-mobile').value.trim();
      const country_code = document.getElementById('en-country-code').value;
      const otp = otpInput.value.trim();

      if (!otp) { toastr.error('Enter OTP'); return; }

      fetch('{{ route("enquiry.verify.otp") }}', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ mobile, country_code, otp })
      })
        .then(res => res.json())
        .then(result => {
          if (result.success) {
            toastr.success('Mobile verified!');
            mobileEnquiryVerified = true;

            // Disable fields and hide buttons
            otpInput.disabled = true;
            verifyBtn.style.display = 'none';
            sendOtpBtn.style.display = 'none';
            document.getElementById('en-mobile').readOnly = true;
            document.getElementById('en-country-code').disabled = true;
          } else {
            toastr.error(result.message);
          }
        });
    });
    document.querySelector('.enquiry-form').addEventListener('submit', function (e) {
      e.preventDefault();

      if (!mobileEnquiryVerified) {
        toastr.error('Please verify your mobile number first!');
        return;
      }

      const data = {
        institute_id: document.getElementById('en-institute-id').value.trim(),
        course_id: document.getElementById('en-course-id')?.value, // new line
        name: document.getElementById('en-name').value.trim(),
        email: document.getElementById('en-email').value.trim(),
        mobile: document.getElementById('en-mobile').value.trim(),
        country_code: document.getElementById('en-country-code').value,
        message: document.getElementById('en-message').value.trim()
      };

      fetch('{{ route("admission.enquiry.submit") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
      })
        .then(async res => {
          if (res.status === 422) {
            // Validation errors
            const errorData = await res.json();
            if (errorData.errors) {
              for (const field in errorData.errors) {
                errorData.errors[field].forEach(msg => toastr.error(msg));
              }
            }
          } else {
            return res.json();
          }
        })
        .then(res => {
          if (res && res.success) {
            toastr.success('Enquiry submitted successfully!');
            document.querySelector('.enquiry-form').reset();
            document.getElementById('en-mobile').readOnly = false;
            document.getElementById('en-country-code').disabled = false;
            otpInput.disabled = false;
            otpInput.style.display = 'none';
            verifyBtn.style.display = 'none';
            sendOtpBtn.innerText = 'Send OTP';
            sendOtpBtn.style.display = 'inline-block';
            closeLeftSidebar();
            closeCourseModal();
            mobileEnquiryVerified = false;
            document.getElementById('en-course-id')?.remove();
          } else if (res) {
            toastr.error(res.message);
          }
        })
        .catch(err => {
          toastr.error('Something went wrong. Please try again.');
          console.error(err);
        });
    });
  </script>
@endpush