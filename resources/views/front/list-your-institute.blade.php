@extends('layouts.app')
@section('title', 'List Your Institute')
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

        .error-text {
            color: red;
            font-size: 13px;
            margin-top: 4px;
            display: block;
        }

        input.error,
        select.error,
        textarea.error {
            border: 1px solid red;
        }

        .resend-otp-btn-new {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;

        }

        @media (min-width: 769px) {
            .mobile-view-card {
                display: none !important;
            }
        }

        @media (max-width: 768px) {

            .desktop-view-card {
                display: none !important;
            }

            .list-institute-section {
                background-color: #fff;
                padding: 20px 0 50px;
            }

            .step-card {
                border: 1px solid #e0e7f0;
                border-radius: 16px;
                padding: 10px;
                position: relative;
            }

            .form-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                gap: 0px;
            }

            .thank-you-section {
                min-height: 100vh;
                background: linear-gradient(135deg, #f0f7ff 0%, #e3f2fd 100%);
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 40px 8px;
            }

            .step-card h4 {
                font-size: 1.55rem;
                margin-bottom: 0px;
                margin-top: 15px;
                color: #0d1117;
            }

            .featured-points {
                list-style: none;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px 40px;
                margin: 0 0 40px;
                font-size: 1.05rem;
                color: #333;
            }

            .card-listingpage p {
                margin: 0;
                font-size: 17px;
                color: #333;
                font-weight: 500;
            }


        }
    </style>

    <style>
        /* Multi Select Subcategory - Clean & Nice Look */
        .subcategory-multi-select {
            border: 1px solid #d1d5db;
            border-radius: 12px;
            background: #ffffff;
            padding: 16px;
            min-height: 140px;
            max-height: 320px;
            overflow-y: auto;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .subcategory-multi-select label {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 10px 12px;
            margin: 0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
        }

        .subcategory-multi-select label:hover {
            background-color: #f8fafc;
        }

        .subcategory-multi-select input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            accent-color: #3b82f6;
            cursor: pointer;
            flex-shrink: 0;
            /* Important - checkbox size fixed rahe */
        }

        .subcategory-multi-select span {
            font-size: 15px;
            line-height: 1.4;
            color: #374151;
            flex: 1;
        }

        /* Scrollbar Styling (Optional but looks premium) */
        .subcategory-multi-select::-webkit-scrollbar {
            width: 6px;
        }

        .subcategory-multi-select::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
    </style>
@endpush
@section('content')

    <section class="list-institute-section">
        <div class="list-container">



            <!-- Listing Process with Steps -->
            <div class="listing-process">
                <div class="process-header" style=" margin: auto;">
                    <p class="highlight-sub">Free Listing (Basic) available • Upgrade anytime for better visibility</p>
                    <h2 style="
                                                                                    font-weight: 800;
                                                                                    color: #0d1117;
                                                                                    line-height: 1.1;
                                                                                    margin-bottom: 10px;
                                                                                    letter-spacing: -1px;">List your
                        Institute
                        on
                        ApnaShaher.com
                    </h2>
                    <p class="sub">Takes less then <strong>2 Minutes</strong> </p>

                </div>

                <ul class="featured-points" style="width: 80%; margin: auto; margin-top: 20px;
                                                                                      margin-bottom: 20px;">
                    <li><i class="fas fa-check"></i> Get discovered by local students</li>
                    <li><i class="fas fa-check"></i> Verified & trusted listings only</li>
                    <li><i class="fas fa-check"></i> No obligation to upgrade</li>
                </ul>

                <div class="cta-group">
                    <button class="continue-btn start-listing">Start Listing Now</button>
                    <a href="{{route('plans')}}" class="view-plans-link" target="blank">View Plans</a>
                    <div class="card-listingpage">
                        <p>Already Listed on ApnaShaher.com? Want to edit?</p>
                        <a href="{{route('institute.dashboard')}}" class="edit-btn">Click Here</a>
                    </div>



                </div>


                <!-- Interactive Multi-Step Form -->
                <div class="steps-wrapper" id="stepsWrapper" style="display: none;">
                    <div class="steps-container">

                        <!-- Progress Bar -->
                        <div class="progress-bar">
                            <div class="progress-step active" data-step="1">1</div>
                            <div class="progress-step" data-step="2">2</div>
                            <div class="progress-step" data-step="3">3</div>
                            <div class="progress-step" data-step="4">4</div>
                        </div>

                        <!-- Step 1 -->
                        <div class="step-card active" id="step1" style=" margin: auto;">
                            <div class="step-number">STEP 1</div>
                            <h4>Basic Institute Information</h4>

                            <div class="form-grid">
                                <div class="form-group full">
                                    <label>Institute Name *</label>
                                    <input type="hidden" id="institute_id">
                                    <input type="text" id="institute_name" placeholder="e.g. Bright Minds Academy"
                                        required />
                                    <small class="error-text" id="error_name"></small>
                                </div>

                                <div class="form-group full">
                                    <label>Country</label>
                                    <input type="text" id="country" value="India" readonly />
                                </div>

                                <div class="form-group full">
                                    <label>State *</label>
                                    <select id="state_id" required>
                                        <option value="">Select State</option>
                                        @if(isset($states) && count($states) > 0)
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}">{{$state->name}}</option>
                                            @endforeach
                                        @endif
                                        <!-- Add more -->
                                    </select>
                                    <small class="error-text" id="error_state"></small>
                                </div>

                                <div class="form-group full">
                                    <label>City *</label>
                                    <select id="city_id" required>
                                        <option value="">Select City</option>

                                    </select>
                                    <small class="error-text" id="error_city"></small>
                                </div>

                                <div class="form-group full">
                                    <label>Institute Address *</label>
                                    <textarea id="profile_address" placeholder="Enter full institute address"
                                        required></textarea>
                                    <small class="error-text" id="error_profile_address"></small>
                                </div>

                                <div class="form-group full">
                                    <label>Mobile Number *</label>
                                    <div class="input-with-btn">
                                        <small class="error-text" id="error_mobile"></small>
                                        <input type="tel" id="mobile" placeholder="10-digit number" maxlength="10"
                                            required />
                                        <button type="button" class="otp-btn" id="otp-btn" onclick="sendOtp()"
                                            style="display:none;">Send OTP</button>

                                    </div>
                                </div>

                                <div class="form-group full otp-group" style="display:none;">
                                    <label>Enter OTP *</label>
                                    <input type="text" id="otp" placeholder="6-digit OTP" maxlength="6" />
                                    <div class="resend-otp-btn-new">
                                        <button type="button" class="otp-btn" onclick="verifyOtp()">Verify OTP</button>
                                        <button type="button" class="otp-btn resend-otp-btn" onclick="sendOtp()">Resend
                                            OTP</button>
                                    </div>
                                    <small class="error-text" id="error_otp"></small>
                                </div>
                            </div>

                            <div class="step-actions">
                                <button type="button" class="next-btn" onclick="saveStep1()">Next →</button>
                            </div>

                            <div id="resumeMsg" style="display:none;color:green;">
                                Your previous registration found. Continuing from where you left.
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="step-card" id="step2" style="display:none;  margin: auto;">
                            <div class="step-number">STEP 2</div>
                            <h4>Category & Details</h4>

                            <div class="form-grid">
                                <div class="form-group full">
                                    <label>Category</label>
                                    <select id="category_id" required>
                                        <option value="">Select Category</option>
                                        @if(isset($categories) && count($categories) > 0)
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                        <!-- Add more -->
                                    </select>
                                    <small class="error-text" id="error_category_id"></small>
                                </div>

                                <!--<div class="form-group full" id="subcategoryWrapper">-->
                                <!--  <label for="subcategory_id">Sub Category *</label>-->
                                <!--  <select id="subcategory_id">-->
                                <!--    <option value="">Select Sub Category</option>-->

                                <!-- Add your full list -->
                                <!--  </select>-->
                                <!--  <small class="error-text" id="error_subcategory_id"></small>-->
                                <!--</div>-->
                                <div class="form-group full" id="subcategoryWrapper">
                                    <label for="subcategory_id">
                                        Sub Category

                                    </label>

                                    <div id="subcategoryContainer"
                                        class="subcategory-multi-select border border-gray-300 rounded-xl p-4 bg-white min-h-[140px] max-h-[320px] overflow-auto">

                                        <div id="subcategoryCheckboxes" class="space-y-3">
                                            <!-- Dynamic checkboxes will come here -->
                                        </div>
                                    </div>

                                    <!-- Hidden field for selected values -->
                                    <input type="hidden" id="subcategory_id" name="subcategory_id">

                                    <small class="error-text" id="error_subcategory_id"></small>
                                </div>

                                <div class="form-group full">
                                    <label>Short Description (max 2 lines) *</label>
                                    <textarea id="description" rows="3"
                                        placeholder="e.g. Best CBSE & ICSE coaching with 95%+ results..." maxlength="250"
                                        required></textarea>
                                    <small class="error-text" id="error_description"></small>
                                    <small id="charCount">0 / 200</small>
                                </div>

                                <div class="form-group full">
                                    <label>WhatsApp Number (optional)</label>
                                    <input type="tel" id="whatsapp" placeholder="Same as mobile or different" />
                                    <small class="error-text" id="error_whatsapp"></small>
                                </div>
                            </div>

                            <div class="step-actions">
                                <button class="back-btn " onclick="goToStep(1)">← Back</button>
                                <button type="button" class="next-btn" onclick="saveStep2()">Next →</button>
                            </div>
                        </div>

                        <!-- Step 3 - Pricing -->
                        <div class="step-card" id="step3" style="display:none;">
                            <div class="step-number">STEP 3</div>

                            <h4 class="text-3xl font-bold text-gray-900 text-center mb-3">Choose the Right Visibility Plan
                                for Your
                                Institute</h4>
                            <p class="text-center text-gray-600 mb-10">Select the plan that best matches your institute's
                                growth goals
                            </p>

                            <div
                                class="pricing-cards-container grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 max-w-6xl mx-auto desktop-view-card">
                                @if(isset($packages) && count($packages) > 0)
                                    @foreach($packages as $package)
                                        @if($package->is_popular)
                                            <div
                                                class="pricing-card relative bg-gradient-to-b from-white to-blue-50 rounded-2xl border-2 border-blue-500 shadow-2xl p-8 flex flex-col transform scale-105 transition-all duration-300 hover:scale-110 z-10">
                                                <!-- Recommended Badge -->
                                                <div
                                                    class="absolute -top-4 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-sm font-bold px-6 py-1.5 rounded-full shadow-lg">
                                                    Most Popular
                                                </div>

                                                <div class="text-center mb-6">
                                                    <h5 class="text-2xl font-bold text-gray-900">{{$package->name}}</h5>
                                                    <p class="text-sm text-blue-600 mt-1 font-medium">{{$package->title}}</p>

                                                    <!-- Updated Price Section -->
                                                    <div class="mt-5 flex items-baseline justify-center gap-2">
                                                        <span
                                                            class="text-5xl font-extrabold text-blue-700">₹{{$package->formatted_offered_price }}</span>
                                                        <span class="text-xl font-semibold text-blue-600">/ Year</span>
                                                    </div>

                                                    <p class="text-sm text-gray-600 mt-1">{{$package->validity_days}} Days Validity</p>
                                                </div>
                                                @if($package->features)
                                                    <ul class="space-y-4 text-gray-700 flex-1">
                                                        <li {!! $package->features->apnashaher_listing ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->apnashaher_listing ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>ApnaShaher Listing</span>
                                                        </li>
                                                        @if($package->features->courses_programs && $package->features->courses_programs > 0)
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>Upto {{ $package->features->courses_programs }} Courses / Programs</span>
                                                            </li>
                                                        @else
                                                            <li class="flex items-start gap-3 opacity-50">
                                                                <span class="text-gray-400 text-xl">✘</span>
                                                                <span>Courses / Programs</span>
                                                            </li>
                                                        @endif
                                                        <!-- <li {!! $package->features->call_whatsapp_button ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    {!! $package->features->call_whatsapp_button ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span>Calls & WhatsApp Button</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                </li> -->

                                                        <li class="flex items-start gap-3">
                                                            <span class="text-green-500 text-xl">✔</span>
                                                            <span>{{ ucfirst($package->features->search_visibility) }} Search
                                                                Visibility</span>
                                                        </li>
                                                        <!-- <li class="flex items-start gap-3">
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span class="text-green-500 text-xl">✔</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span>{{ ucfirst($package->features->contact_display) }} Contact Display</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                </li> -->

                                                        <li class="flex items-start gap-3">
                                                            <span class="text-green-500 text-xl">✔</span>
                                                            <span>{{ ucfirst($package->features->profile_editing) }} Profile Editing</span>
                                                        </li>
                                                        <li {!! $package->features->verified_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->verified_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Verified Badge</span>
                                                        </li>
                                                        <li class="flex items-start gap-3">
                                                            <span class="text-green-500 text-xl">✔</span>
                                                            <span>{{ ucfirst($package->features->support_type) }}</span>
                                                        </li>

                                                        <li {!! $package->features->profile_performance_insight ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->profile_performance_insight ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Profile Performance Insight</span>
                                                        </li>
                                                        <li {!! $package->features->custom_profile_url ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->custom_profile_url ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Custom Profile URL<br />(<span
                                                                    style="font-size:13px;">(www.apnashaher.com/your-own-url</span>)</span>
                                                        </li>
                                                        <li {!! $package->features->preferred_institute_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->preferred_institute_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Preferred Institute Badge</span>
                                                        </li>
                                                        <li {!! $package->features->featured_in_category_listings ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->featured_in_category_listings ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Featured in Category Listings</span>
                                                        </li>
                                                        <li {!! $package->features->promotional_banner_placement ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->promotional_banner_placement ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Promotional Banner Placement</span>
                                                        </li>
                                                        <li {!! $package->features->ai_profile_description_generator ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->ai_profile_description_generator ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span> AI Profile Description Generator</span>
                                                        </li>

                                                    </ul>
                                                @else
                                                    <span>No Features</span>
                                                @endif
                                                <div class="mt-8">
                                                    <button onclick="saveStep3({{$package->id}})"
                                                        class="w-full py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg">
                                                        Start {{$package->name}}
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div
                                                class="pricing-card bg-white rounded-2xl border border-gray-200 shadow-lg p-8 flex flex-col transition-all duration-300 hover:shadow-xl">
                                                <div class="text-center mb-6">
                                                    <h5 class="text-2xl font-bold text-gray-800">{{$package->name}}</h5>
                                                    <p class="text-sm text-gray-500 mt-1">{{$package->title}}</p>
                                                    <div class="mt-4 text-4xl font-bold text-gray-900">
                                                        <span
                                                            class="text-5xl font-extrabold text-gray-900">₹{{$package->formatted_offered_price }}</span>
                                                        <span class="text-xl font-semibold text-gray-900">/ Year</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 mt-1">{{$package->validity_days}} Days Validity</p>
                                                </div>
                                                @if($package->features)
                                                    <ul class="space-y-4 text-gray-700 flex-1">
                                                        <li {!! $package->features->apnashaher_listing ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->apnashaher_listing ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>ApnaShaher Listing</span>
                                                        </li>
                                                        @if($package->features->courses_programs && $package->features->courses_programs > 0)
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>Upto {{ $package->features->courses_programs }} Courses / Programs</span>
                                                            </li>
                                                        @else
                                                            <li class="flex items-start gap-3 opacity-50">
                                                                <span class="text-gray-400 text-xl">✘</span>
                                                                <span>Courses / Programs</span>
                                                            </li>
                                                        @endif
                                                        <!-- <li {!! $package->features->call_whatsapp_button ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    {!! $package->features->call_whatsapp_button ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span>Calls & WhatsApp Button</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                </li> -->

                                                        <li class="flex items-start gap-3">
                                                            <span class="text-green-500 text-xl">✔</span>
                                                            <span>{{ ucfirst($package->features->search_visibility) }} Search
                                                                Visibility</span>
                                                        </li>
                                                        <!-- <li class="flex items-start gap-3">
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span class="text-green-500 text-xl">✔</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                    <span>{{ ucfirst($package->features->contact_display) }} Contact Display</span>
                                                                                                                                                                                                                                                                                                                                                                                                                                                </li> -->

                                                        <li class="flex items-start gap-3">
                                                            <span class="text-green-500 text-xl">✔</span>
                                                            <span>{{ ucfirst($package->features->profile_editing) }} Profile Editing</span>
                                                        </li>
                                                        <li {!! $package->features->verified_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->verified_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Verified Badge</span>
                                                        </li>
                                                        <li class="flex items-start gap-3">
                                                            <span class="text-green-500 text-xl">✔</span>
                                                            <span>{{ ucfirst($package->features->support_type) }}</span>
                                                        </li>

                                                        <li {!! $package->features->profile_performance_insight ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->profile_performance_insight ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Profile Performance Insight</span>
                                                        </li>
                                                        <li {!! $package->features->custom_profile_url ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->custom_profile_url ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Custom Profile URL<br />(<span
                                                                    style="font-size:13px;">(www.apnashaher.com/your-own-url</span>)</span>
                                                        </li>
                                                        <li {!! $package->features->preferred_institute_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->preferred_institute_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Preferred Institute Badge</span>
                                                        </li>
                                                        <li {!! $package->features->featured_in_category_listings ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->featured_in_category_listings ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Featured in Category Listings</span>
                                                        </li>
                                                        <li {!! $package->features->promotional_banner_placement ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->promotional_banner_placement ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span>Promotional Banner Placement</span>
                                                        </li>
                                                        <li {!! $package->features->ai_profile_description_generator ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                            {!! $package->features->ai_profile_description_generator ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                            <span> AI Profile Description Generator</span>
                                                        </li>

                                                    </ul>
                                                @else
                                                    <span>No Features</span>
                                                @endif
                                                <div class="mt-8">
                                                    <button onclick="saveStep3({{$package->id}})"
                                                        class="w-full py-4 bg-gray-100 text-gray-800 font-semibold rounded-xl hover:bg-gray-200 transition">
                                                        Start {{$package->name}}
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>


                            <div
                                class="pricing-cards-container grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 max-w-6xl mx-auto mobile-view-card">
                                @if(isset($packages) && count($packages) > 0)
                                    @foreach($packages as $package)

                                        @if($package->is_popular)
                                            <!-- ==================== MOST POPULAR CARD ==================== -->
                                            <div
                                                class="pricing-card relative bg-gradient-to-b from-white to-blue-50 rounded-2xl border-2 border-blue-500 shadow-2xl p-8 flex flex-col transform scale-105 transition-all duration-300 hover:scale-110 z-10">
                                                <!-- Recommended Badge -->
                                                <div
                                                    class="absolute -top-4 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-sm font-bold px-6 py-1.5 rounded-full shadow-lg">
                                                    Most Popular
                                                </div>

                                                <div class="text-center mb-6">
                                                    <h5 class="text-2xl font-bold text-gray-900">{{$package->name}}</h5>
                                                    <p class="text-sm text-blue-600 mt-1 font-medium">{{$package->title}}</p>
                                                    <div class="mt-5 flex items-baseline justify-center gap-2">
                                                        <span
                                                            class="text-5xl font-extrabold text-blue-700">₹{{$package->formatted_offered_price}}</span>
                                                        <span class="text-xl font-semibold text-blue-600">/ Year</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 mt-1">{{$package->validity_days}} Days Validity</p>
                                                </div>

                                                @if($package->features)
                                                    <ul class="space-y-4 text-gray-700 flex-1">

                                                        <!-- DESKTOP VIEW - All Features -->
                                                        <div class="hidden md:block">
                                                            <li {!! $package->features->apnashaher_listing ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->apnashaher_listing ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>ApnaShaher Listing</span>
                                                            </li>
                                                            @if($package->features->courses_programs && $package->features->courses_programs > 0)
                                                                <li class="flex items-start gap-3">
                                                                    <span class="text-green-500 text-xl">✔</span>
                                                                    <span>Upto {{ $package->features->courses_programs }} Courses /
                                                                        Programs</span>
                                                                </li>
                                                            @else
                                                                <li class="flex items-start gap-3 opacity-50">
                                                                    <span class="text-gray-400 text-xl">✘</span>
                                                                    <span>Courses / Programs</span>
                                                                </li>
                                                            @endif
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>{{ ucfirst($package->features->search_visibility) }} Search
                                                                    Visibility</span>
                                                            </li>
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>{{ ucfirst($package->features->profile_editing) }} Profile
                                                                    Editing</span>
                                                            </li>
                                                            <li {!! $package->features->verified_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->verified_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Verified Badge</span>
                                                            </li>
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>{{ ucfirst($package->features->support_type) }}</span>
                                                            </li>
                                                            <li {!! $package->features->profile_performance_insight ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->profile_performance_insight ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Profile Performance Insight</span>
                                                            </li>
                                                            <li {!! $package->features->custom_profile_url ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->custom_profile_url ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Custom Profile URL<br /><span
                                                                        style="font-size:13px;">(www.apnashaher.com/your-own-url)</span></span>
                                                            </li>
                                                            <li {!! $package->features->preferred_institute_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->preferred_institute_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Preferred Institute Badge</span>
                                                            </li>
                                                            <li {!! $package->features->featured_in_category_listings ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->featured_in_category_listings ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Featured in Category Listings</span>
                                                            </li>
                                                            <li {!! $package->features->promotional_banner_placement ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->promotional_banner_placement ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Promotional Banner Placement</span>
                                                            </li>
                                                            <li {!! $package->features->ai_profile_description_generator ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->ai_profile_description_generator ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>AI Profile Description Generator</span>
                                                            </li>
                                                        </div>

                                                        <!-- MOBILE VIEW - First 3 Features + More -->
                                                        <div class="md:hidden">
                                                            <!-- First 3 Features -->
                                                            <li {!! $package->features->apnashaher_listing ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->apnashaher_listing ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>ApnaShaher Listing</span>
                                                            </li>
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>{{ ucfirst($package->features->search_visibility) }} Search
                                                                    Visibility</span>
                                                            </li>
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>{{ ucfirst($package->features->profile_editing) }} Profile
                                                                    Editing</span>
                                                            </li>

                                                            <!-- + More Button -->
                                                            <div id="show-more-btn-{{$package->id}}" class="mt-4 pt-2">
                                                                <button onclick="showMoreFeatures({{$package->id}})"
                                                                    class="text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1 text-sm">
                                                                    + More features
                                                                    <i class="fas fa-chevron-down"></i>
                                                                </button>
                                                            </div>

                                                            <!-- Hidden Remaining Features -->
                                                            <div id="remaining-features-{{$package->id}}" class="hidden space-y-4 mt-4">
                                                                @if($package->features->courses_programs && $package->features->courses_programs > 0)
                                                                    <li class="flex items-start gap-3">
                                                                        <span class="text-green-500 text-xl">✔</span>
                                                                        <span>Upto {{ $package->features->courses_programs }} Courses /
                                                                            Programs</span>
                                                                    </li>
                                                                @else
                                                                    <li class="flex items-start gap-3 opacity-50">
                                                                        <span class="text-gray-400 text-xl">✘</span>
                                                                        <span>Courses / Programs</span>
                                                                    </li>
                                                                @endif

                                                                <li {!! $package->features->verified_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->verified_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Verified Badge</span>
                                                                </li>
                                                                <li class="flex items-start gap-3">
                                                                    <span class="text-green-500 text-xl">✔</span>
                                                                    <span>{{ ucfirst($package->features->support_type) }}</span>
                                                                </li>
                                                                <li {!! $package->features->profile_performance_insight ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->profile_performance_insight ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Profile Performance Insight</span>
                                                                </li>
                                                                <li {!! $package->features->custom_profile_url ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->custom_profile_url ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Custom Profile URL<br /><span
                                                                            style="font-size:13px;">(www.apnashaher.com/your-own-url)</span></span>
                                                                </li>
                                                                <li {!! $package->features->preferred_institute_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->preferred_institute_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Preferred Institute Badge</span>
                                                                </li>
                                                                <li {!! $package->features->featured_in_category_listings ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->featured_in_category_listings ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Featured in Category Listings</span>
                                                                </li>
                                                                <li {!! $package->features->promotional_banner_placement ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->promotional_banner_placement ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Promotional Banner Placement</span>
                                                                </li>
                                                                <li {!! $package->features->ai_profile_description_generator ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->ai_profile_description_generator ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>AI Profile Description Generator</span>
                                                                </li>
                                                            </div>
                                                        </div>

                                                    </ul>
                                                @else
                                                    <span>No Features</span>
                                                @endif

                                                <div class="mt-8">
                                                    <button onclick="saveStep3({{$package->id}})"
                                                        class="w-full py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg">
                                                        Start {{$package->name}}
                                                    </button>
                                                </div>
                                            </div>

                                        @else
                                            <!-- ==================== NORMAL CARD ==================== -->
                                            <div
                                                class="pricing-card bg-white rounded-2xl border border-gray-200 shadow-lg p-8 flex flex-col transition-all duration-300 hover:shadow-xl">
                                                <div class="text-center mb-6">
                                                    <h5 class="text-2xl font-bold text-gray-800">{{$package->name}}</h5>
                                                    <p class="text-sm text-gray-500 mt-1">{{$package->title}}</p>
                                                    <div class="mt-4 text-4xl font-bold text-gray-900">
                                                        <span
                                                            class="text-5xl font-extrabold text-gray-900">₹{{$package->formatted_offered_price}}</span>
                                                        <span class="text-xl font-semibold text-gray-900">/ Year</span>
                                                    </div>
                                                    <p class="text-sm text-gray-600 mt-1">{{$package->validity_days}} Days Validity</p>
                                                </div>

                                                @if($package->features)
                                                    <ul class="space-y-4 text-gray-700 flex-1">

                                                        <!-- DESKTOP VIEW - All Features -->
                                                        <div class="hidden md:block">
                                                            <!-- Same full list as popular card (copy kar liya hai) -->
                                                            <li {!! $package->features->apnashaher_listing ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->apnashaher_listing ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>ApnaShaher Listing</span>
                                                            </li>
                                                            @if($package->features->courses_programs && $package->features->courses_programs > 0)
                                                                <li class="flex items-start gap-3">
                                                                    <span class="text-green-500 text-xl">✔</span>
                                                                    <span>Upto {{ $package->features->courses_programs }} Courses /
                                                                        Programs</span>
                                                                </li>
                                                            @else
                                                                <li class="flex items-start gap-3 opacity-50">
                                                                    <span class="text-gray-400 text-xl">✘</span>
                                                                    <span>Courses / Programs</span>
                                                                </li>
                                                            @endif
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>{{ ucfirst($package->features->search_visibility) }} Search
                                                                    Visibility</span>
                                                            </li>
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>{{ ucfirst($package->features->profile_editing) }} Profile
                                                                    Editing</span>
                                                            </li>
                                                            <li {!! $package->features->verified_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->verified_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Verified Badge</span>
                                                            </li>
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>{{ ucfirst($package->features->support_type) }}</span>
                                                            </li>
                                                            <li {!! $package->features->profile_performance_insight ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->profile_performance_insight ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Profile Performance Insight</span>
                                                            </li>
                                                            <li {!! $package->features->custom_profile_url ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->custom_profile_url ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Custom Profile URL<br /><span
                                                                        style="font-size:13px;">(www.apnashaher.com/your-own-url)</span></span>
                                                            </li>
                                                            <li {!! $package->features->preferred_institute_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->preferred_institute_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Preferred Institute Badge</span>
                                                            </li>
                                                            <li {!! $package->features->featured_in_category_listings ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->featured_in_category_listings ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Featured in Category Listings</span>
                                                            </li>
                                                            <li {!! $package->features->promotional_banner_placement ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->promotional_banner_placement ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>Promotional Banner Placement</span>
                                                            </li>
                                                            <li {!! $package->features->ai_profile_description_generator ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->ai_profile_description_generator ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>AI Profile Description Generator</span>
                                                            </li>
                                                        </div>

                                                        <!-- MOBILE VIEW - First 3 + More -->
                                                        <div class="md:hidden">
                                                            <!-- First 3 Features -->
                                                            <li {!! $package->features->apnashaher_listing ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                {!! $package->features->apnashaher_listing ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                <span>ApnaShaher Listing</span>
                                                            </li>
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>{{ ucfirst($package->features->search_visibility) }} Search
                                                                    Visibility</span>
                                                            </li>
                                                            <li class="flex items-start gap-3">
                                                                <span class="text-green-500 text-xl">✔</span>
                                                                <span>{{ ucfirst($package->features->profile_editing) }} Profile
                                                                    Editing</span>
                                                            </li>

                                                            <!-- + More Button -->
                                                            <div id="show-more-btn-{{$package->id}}" class="mt-4 pt-2">
                                                                <button onclick="showMoreFeatures({{$package->id}})"
                                                                    class="text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1 text-sm">
                                                                    + More features
                                                                    <i class="fas fa-chevron-down"></i>
                                                                </button>
                                                            </div>

                                                            <!-- Hidden Remaining Features -->
                                                            <div id="remaining-features-{{$package->id}}" class="hidden space-y-4 mt-4">
                                                                @if($package->features->courses_programs && $package->features->courses_programs > 0)
                                                                    <li class="flex items-start gap-3">
                                                                        <span class="text-green-500 text-xl">✔</span>
                                                                        <span>Upto {{ $package->features->courses_programs }} Courses /
                                                                            Programs</span>
                                                                    </li>
                                                                @else
                                                                    <li class="flex items-start gap-3 opacity-50">
                                                                        <span class="text-gray-400 text-xl">✘</span>
                                                                        <span>Courses / Programs</span>
                                                                    </li>
                                                                @endif

                                                                <li {!! $package->features->verified_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->verified_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Verified Badge</span>
                                                                </li>
                                                                <li class="flex items-start gap-3">
                                                                    <span class="text-green-500 text-xl">✔</span>
                                                                    <span>{{ ucfirst($package->features->support_type) }}</span>
                                                                </li>
                                                                <li {!! $package->features->profile_performance_insight ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->profile_performance_insight ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Profile Performance Insight</span>
                                                                </li>
                                                                <li {!! $package->features->custom_profile_url ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->custom_profile_url ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Custom Profile URL<br /><span
                                                                            style="font-size:13px;">(www.apnashaher.com/your-own-url)</span></span>
                                                                </li>
                                                                <li {!! $package->features->preferred_institute_badge ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->preferred_institute_badge ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Preferred Institute Badge</span>
                                                                </li>
                                                                <li {!! $package->features->featured_in_category_listings ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->featured_in_category_listings ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Featured in Category Listings</span>
                                                                </li>
                                                                <li {!! $package->features->promotional_banner_placement ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->promotional_banner_placement ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>Promotional Banner Placement</span>
                                                                </li>
                                                                <li {!! $package->features->ai_profile_description_generator ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                                                                    {!! $package->features->ai_profile_description_generator ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                                                                    <span>AI Profile Description Generator</span>
                                                                </li>
                                                            </div>
                                                        </div>

                                                    </ul>
                                                @else
                                                    <span>No Features</span>
                                                @endif

                                                <div class="mt-8">
                                                    <button onclick="saveStep3({{$package->id}})"
                                                        class="w-full py-4 bg-gray-100 text-gray-800 font-semibold rounded-xl hover:bg-gray-200 transition">
                                                        Start {{$package->name}}
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                    @endforeach
                                @endif
                            </div>

                            <!-- Bottom Note -->
                            <!-- <p class="text-center text-gray-600 mt-10 text-sm">
                                                                                                You can upgrade your plan anytime after listing.
                                                                                              </p> -->

                            <!-- Step Actions -->
                            <div class="step-actions flex justify-between mt-12">
                                <button
                                    class="back-btn  px-8 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition"
                                    onclick="goToStep(2)">
                                    ← Back
                                </button>
                                <!-- <button
                                                                                                  class="next-btn  px-8 py-3 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition shadow-md"
                                                                                                  onclick="goToStep(4)">
                                                                                                  Continue →
                                                                                                </button> -->
                            </div>
                        </div>
                        <div class="step-card" id="step4" style="display:none; margin: auto; margin-top:15px;">
                            <div class="step-number">STEP 4</div>
                            <!-- <h4>Plans Details</h4> -->
                            <div style="display: flex;justify-content: space-between;">

                                <h3 id="plan_name" style="font-size: 26px; margin:0; font-weight:700;"></h3>

                                <div style="text-align:right;">
                                    <h3 style="font-size: 26px; margin:0; font-weight:700;">
                                        <strong>Price:</strong> ₹<span id="plan_price">0</span>
                                    </h3>

                                    <div id="priceBreakup" style="margin-top:10px; font-size:15px;">

                                        <div>Base Price: ₹<span id="base_price">0</span></div>

                                        <div id="gst_row">
                                            <div id="cgst_row">CGST (<span id="cgst_rate"></span>%): ₹<span
                                                    id="cgst_amount">0</span></div>
                                            <div id="sgst_row">SGST (<span id="sgst_rate"></span>%): ₹<span
                                                    id="sgst_amount">0</span></div>

                                            <div id="igst_row" style="display:none;">
                                                IGST (<span id="igst_rate"></span>%): ₹<span id="igst_amount">0</span>
                                            </div>
                                        </div>

                                        <div style="margin-top:5px; font-weight:600;">
                                            Total Payable: ₹<span id="total_price">0</span>
                                        </div>

                                    </div>
                                </div>

                            </div>


                            <p style="font-size: 18px; margin:5px 0;">
                                <strong>Validity:</strong> <span id="plan_validity"> Days
                            </p>



                            <div class="horizontal-line">

                            </div>


                            <div class="checkbox-section">
                                <label class="checkbox-line">
                                    <input type="checkbox" id="gstCheck" onchange="toggleGST()"> I need a GST Invoice
                                </label>


                            </div>

                            <!-- 🔥 GST DETAILS (HIDDEN BY DEFAULT) -->
                            <div id="gstDetails" class="gst-box" style="display:none;">

                                <div class="form-group full">
                                    <label>GSTIN (mandatory)</label>
                                    <input type="text" id="gstin" placeholder="Enter GST Number" />
                                    <small class="error-text" id="error_gstin"></small>
                                </div>

                                <div class="form-group full">
                                    <label>Legal Business Name</label>
                                    <input type="text" id="business_name" placeholder="Registered Business Name" />
                                    <small class="error-text" id="error_business_name"></small>
                                </div>

                                <div class="form-group full">
                                    <label>Billing Address</label>
                                    <textarea rows="2" id="billing_address" placeholder="Full Billing Address"></textarea>
                                    <small class="error-text" id="error_billing_address"></small>
                                </div>


                                <div class="form-group full">
                                    <label>Email for Invoice</label>
                                    <input type="email" id="invoice_email" placeholder="Invoice Email Address" />
                                    <small class="error-text" id="error_invoice_email"></small>
                                </div>

                            </div>
                            <div class="checkbox-section" style="margin-top:20px;">
                                <label class="checkbox-line">
                                    <input type="checkbox" id="terms"> I Accept Terms & Conditions
                                </label>
                                <small class="error-text" id="error_terms"></small>
                            </div>


                            <div class="step-actions">
                                <button class="back-btn" onclick="goToStep(3)">← Back</button>
                                <button type="button" class="save-live-btn" onclick="saveStep4()">
                                    Save & Go Live
                                </button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@push('after-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        let basePrice = 0;

        let CGST = {{ $invoiceSetting->cgst ?? 9 }};
        let SGST = {{ $invoiceSetting->sgst ?? 9 }};
        let IGST = {{ $invoiceSetting->igst ?? 18 }};

        let cashfree;

        window.onload = function () {
            cashfree = Cashfree({
                mode: "production"
            });
        };

        function updatePrice() {

            let cgst = 0, sgst = 0, igst = 0;

            $('#gst_row').show();

            let instituteState = $('#state_id').val();
            let companyState = {{ $invoiceSetting->company_state ?? 0 }};

            let sameState = instituteState == companyState;

            if (sameState) {

                cgst = (basePrice * CGST) / 100;
                sgst = (basePrice * SGST) / 100;

                $('#cgst_row').show();
                $('#sgst_row').show();
                $('#igst_row').hide();

            } else {

                igst = (basePrice * IGST) / 100;

                $('#cgst_row').hide();
                $('#sgst_row').hide();
                $('#igst_row').show();
            }

            let total = basePrice + cgst + sgst + igst;

            $('#plan_price').text(basePrice.toFixed(2));
            $('#base_price').text(basePrice.toFixed(2));

            $('#cgst_rate').text(CGST);
            $('#sgst_rate').text(SGST);
            $('#igst_rate').text(IGST);

            $('#cgst_amount').text(cgst.toFixed(2));
            $('#sgst_amount').text(sgst.toFixed(2));
            $('#igst_amount').text(igst.toFixed(2));

            $('#total_price').text(total.toFixed(2));
        }



        const textarea = document.getElementById('description');
        const charCount = document.getElementById('charCount');

        textarea.addEventListener('input', function () {
            let length = textarea.value.length;
            charCount.textContent = length + " / 200";

            if (length > 200) {
                charCount.classList.remove('text-gray-600');
                charCount.classList.add('text-red-500');
            } else {
                charCount.classList.remove('text-red-500');
                charCount.classList.add('text-gray-600');
            }
        });


        // Simple step navigation
        function goToStep(stepNumber) {
            // Hide all steps
            document.querySelectorAll('.step-card').forEach(card => {
                card.style.display = 'none';
                card.classList.remove('active');
            });

            // Show selected step
            const targetStep = document.getElementById(`step${stepNumber}`);
            if (targetStep) {
                targetStep.style.display = 'block';
                targetStep.classList.add('active');
            }

            // Update progress bar
            document.querySelectorAll('.progress-step').forEach((dot, index) => {
                dot.classList.toggle('active', index + 1 <= stepNumber);
            });
        }

        // Show steps when user clicks "Start Listing Now"
        document.querySelector('.start-listing')?.addEventListener('click', () => {
            document.getElementById('stepsWrapper').style.display = 'block';
            goToStep(1); // Start from step 1
        });

        // Optional: You can add form validation later

        // Start Listing button click handler// Sab start buttons (multiple classes bhi add kar sakte ho)
        document.querySelectorAll('.start-listing, .next-btn, .begin-listing').forEach(btn => {
            btn.addEventListener('click', () => {
                const steps = document.getElementById('stepsWrapper');
                steps.style.display = 'block';
                steps.classList.add('slide-down');

                steps.scrollIntoView({ behavior: 'smooth' });

                setTimeout(() => {
                    window.scrollBy({ top: -100, behavior: 'smooth' });
                }, 400);


            });
        });
        // Step change pe bhi same adjustment (goToStep function mein add kar do)


        function goToStep(stepNumber) {
            // All steps hide
            document.querySelectorAll(".step-card").forEach(step => {
                step.style.display = "none";
                step.classList.remove("active");
                step.classList.remove("step-slide");
            });

            // Show selected step
            const activeStep = document.getElementById("step" + stepNumber);
            activeStep.style.display = "block";

            // Animation add
            setTimeout(() => {
                activeStep.classList.add("step-slide");
            }, 10);

            // Progress bar active update
            document.querySelectorAll(".progress-step").forEach(step => {
                step.classList.remove("active");
                if (step.dataset.step <= stepNumber) {
                    step.classList.add("active");
                }
            });

            // Scroll to top of steps smoothly
            document.getElementById("stepsWrapper").scrollIntoView({
                behavior: "smooth"
            });
        }

        function loadCities(stateID, selectedCity = null) {
            if (!stateID) {
                $('#city_id').html('<option value="">Select City</option>');
                return;
            }

            let cityUrl = "{{ url('/get-cities') }}/" + stateID;

            $.get(cityUrl, function (response) {
                let options = '<option value="">Select City</option>';

                if (response && Array.isArray(response)) {
                    response.forEach(function (city) {
                        let sel = (selectedCity == city.id) ? 'selected' : '';
                        options += `<option value="${city.id}" ${sel}>${city.name}</option>`;
                    });
                }

                $('#city_id').html(options);
            });
        }

        //     function loadSubCat(cateID, selectedSubCat = null) {
        //       const subcatDropdown = $('#subcategory_id');
        //       const subcatWrapper = $('#subcategoryWrapper'); 
        //         if (!cateID) {
        //           subcatDropdown.html('');
        //           subcatWrapper.hide();
        //           return;
        //       }


        //         let url = "{{ url('/get-subcategories') }}/" + cateID;

        //     $.get(url, function(response) {
        //         if (response && Array.isArray(response) && response.length > 0) {
        //             // Build options
        //             let options = '<option value="">Select SubCategory</option>';
        //             response.forEach(function(subcategory) {
        //                 let sel = (selectedSubCat == subcategory.id) ? 'selected' : '';
        //                 options += `<option value="${subcategory.id}" ${sel}>${subcategory.name}</option>`;
        //             });

        //             subcatDropdown.html(options);
        //             subcatWrapper.show(); // show dropdown
        //         } else {
        //             // No subcategories: hide dropdown
        //             subcatDropdown.html('');
        //             subcatWrapper.hide();
        //         }
        //     });
        // }

        let mobileExists = false;

        $('#mobile').on('blur', function () {
            let mobile = $(this).val();

            if (mobile.length === 10) {
                let mobileUrl = "{{ url('/institutes/check-mobile') }}/";
                $.get(mobileUrl, { mobile: mobile }, function (response) {

                    if (response == 1) {
                        console.log('here');
                        $('#error_mobile').html(
                            'Mobile Number already registered, <a href="{{ route("login") }}">click here to Login</a>'
                        );

                        $('#otp-btn').hide();
                        mobileExists = true;
                    } else {
                        $('#error_mobile').html('');
                        $('#error_mobile').hide();
                        $('#otp-btn').show();
                        $('#mobile').removeClass('error');
                        mobileExists = false;
                    }

                });
            }
        });


        let whatsappExists = false;

        $('#whatsapp').on('blur', function () {

            let whatsapp = $(this).val();

            if (whatsapp.length === 10) {

                $.get("{{ url('/institutes/check-whatsapp') }}", { whatsapp: whatsapp }, function (response) {

                    if (response == 1) {

                        showError('whatsapp', 'WhatsApp Number already in use, please try another number');
                        whatsappExists = true;

                    } else {

                        $('#error_whatsapp').text('');
                        $('#whatsapp').removeClass('error');
                        whatsappExists = false;

                    }

                });

            }

        });

        function loadSubCat(cateID, selectedSubCat = null) {
            const wrapper = $('#subcategoryWrapper');
            const container = $('#subcategoryCheckboxes');
            const hiddenInput = $('#subcategory_id');

            if (!cateID) {
                container.html('');
                wrapper.hide();
                hiddenInput.val('');
                return;
            }

            let url = "{{ url('/get-subcategories') }}/" + cateID;

            $.get(url, function (response) {
                if (response && Array.isArray(response) && response.length > 0) {

                    let html = '';
                    response.forEach(function (sub) {
                        let checked = '';
                        if (selectedSubCat) {
                            if (Array.isArray(selectedSubCat)) {
                                checked = selectedSubCat.includes(sub.id.toString()) ? 'checked' : '';
                            } else if (selectedSubCat == sub.id) {
                                checked = 'checked';
                            }
                        }

                        html += `
                                                                                                    <label>
                                                                                                        <input type="checkbox" 
                                                                                                               value="${sub.id}" 
                                                                                                               class="subcategory-checkbox"
                                                                                                               ${checked}>
                                                                                                        <span>${sub.name}</span>
                                                                                                    </label>
                                                                                                `;
                    });

                    container.html(html);

                    $('.subcategory-checkbox').on('change', updateSelectedSubcategories);

                    wrapper.show(); // ✅ only when data exists

                    if (selectedSubCat) {
                        updateSelectedSubcategories();
                    }

                } else {
                    // ❌ no message, just hide
                    container.html('');
                    wrapper.hide();
                    hiddenInput.val('');
                }
            });
        }
        function updateSelectedSubcategories() {
            const selected = [];
            $('.subcategory-checkbox:checked').each(function () {
                selected.push($(this).val());
            });

            $('#subcategory_id').val(selected.join(','));
        }

        function clearErrors() {

            $('.error-text').text('');
            $('input,select,textarea').removeClass('error');

        }

        function showError(field, message) {

            $('#error_' + field).text(message);

            $('#' + field).addClass('error');

        }

        $('#state_id').on('change', function () {

            let stateID = $(this).val();

            loadCities(stateID);
            updatePrice(); // 🔥 important

        });

        $('#category_id').on('change', function () {
            let cateID = $(this).val();
            loadSubCat(cateID);
        });
        function validateName(name) {
            let regex = /^[A-Za-z\s\(\)\.\-&]+$/;
            return regex.test(name);
        }

        function validateMobile(mobile) {
            let regex = /^[6-9]\d{9}$/;
            return regex.test(mobile);
        }
        function validateEmail(email) {
            let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }
        function sendOtp() {

            clearErrors();
            let mobile = $('#mobile').val();
            if (!validateMobile(mobile)) {
                showError('mobile', 'Enter valid Indian mobile number');
                return;
            }
            if (mobileExists) {
                $('#error_mobile').html(
                    'Mobile Number already registered, <a href="{{ route("login") }}">click here to Login</a>'
                );
                return;
            }

            let sendotpurl = "{{ url('/send-otp') }}";
            $.post(sendotpurl, { mobile, _token: $('meta[name=csrf-token]').attr('content') }
                , function (res) {

                    if (res.status) {

                        $('.otp-group').show();
                        $('#otp-btn').hide();

                        $('#error_mobile').html('<span style="color:green;">OTP sent successfully</span>');

                    }

                }).fail(function (xhr) {

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function (field, msg) {

                        showError(field, msg[0]);

                    });

                });
        }

        function verifyOtp() {
            clearErrors();
            let mobile = $('#mobile').val();
            let otp = $('#otp').val();
            if (otp.length != 6) {
                showError('otp', 'Enter valid OTP');
                return;
            }
            let verifyotpurl = "{{ url('/verify-otp') }}";
            $.post(verifyotpurl, { mobile, otp, _token: $('meta[name=csrf-token]').attr('content') }, function (res) {

                if (res.status) {

                    $('#mobile').prop('readonly', true);

                    $('.otp-group').hide();

                    $('.otp-btn').hide();

                    $('#error_mobile').html('<span style="color:green">Mobile Verified ✓</span>');

                }
                else {
                    showError('otp', res.message);

                }

            }).fail(function (xhr) {

                let errors = xhr.responseJSON.errors;

                $.each(errors, function (field, msg) {

                    showError(field, msg[0]);

                });

            });

        }


        function saveStep1() {

            clearErrors();

            if (mobileExists) {
                $('#error_mobile').html(
                    'Mobile Number already registered, <a href="/login">click here to Login</a>'
                );
                return; // ❌ STOP HERE
            }

            let name = $('#institute_name').val();

            if (!validateName(name)) {
                showError('name', 'Only letters allowed in name');
                return;
            }

            let data = {
                name: $('#institute_name').val(),
                state: $('#state_id').val(),
                city: $('#city_id').val(),
                mobile: $('#mobile').val(),
                profile_address: $('#profile_address').val(),
                _token: $('meta[name=csrf-token]').attr('content')
            };

            $.post("{{ url('/step1-save') }}", data, function (res) {

                if (res.status) {
                    $('#institute_id').val(res.institute_id);

                    if (res.resume) {
                        $('#resumeMsg').show();
                    }

                    goToStep(2);
                } else {
                    showError('mobile', res.message);
                }

            });
        }

        function saveStep2() {
            clearErrors();

            if (whatsappExists) {
                showError('whatsapp', 'WhatsApp Number already in use, please try another number');
                return; // ❌ STOP HERE
            }


            let subcategoryVal = $('#subcategory_id').val();
            subcategoryVal = subcategoryVal ? subcategoryVal : null;
            let data = {
                institute_id: $('#institute_id').val(),
                category_id: $('#category_id').val(),

                subcategory_id: subcategoryVal,
                description: $('#description').val(),
                whatsapp: $('#whatsapp').val(),
                _token: $('meta[name=csrf-token]').attr('content')
            };
            let step2url = "{{ url('/step2-save') }}";
            $.post(step2url, data, function (res) {

                if (res.status) {

                    goToStep(3);

                }

            }).fail(function (xhr) {

                let errors = xhr.responseJSON.errors;

                $.each(errors, function (field, msg) {

                    showError(field, msg[0]);

                });

            });

        }

        function saveStep3(plan_id) {

            let step3url = "{{ url('/step3-save') }}";

            let data = {
                institute_id: $('#institute_id').val(),
                plan_id: plan_id,
                _token: $('meta[name=csrf-token]').attr('content')
            };

            $.post(step3url, data, function (res) {

                if (res.status) {

                    let plan = res.plan;

                    // ✅ SET BASE PRICE FROM BACKEND
                    basePrice = parseFloat(plan.offered_price);

                    // ✅ SET UI
                    $('#plan_name').text(plan.name);
                    $('#plan_validity').text(plan.validity_days + ' Days');

                    // ❌ REMOVE THIS LINE (important)
                    // $('#plan_price').text(res.plan.offered_price);

                    // GST checkbox logic
                    if (basePrice == 0) {
                        $('#gstCheck').closest('.checkbox-line').hide();
                        $('#gstDetails').hide();
                    } else {
                        $('#gstCheck').closest('.checkbox-line').show();
                    }

                    // ✅ FINAL PRICE CALCULATION
                    updatePrice();

                    goToStep(4);
                }

            });

        }

        function saveStep4() {

            clearErrors();

            let email = $('#invoice_email').val();
            let wantsGSTInvoice = $('#gstCheck').is(':checked');

            if (email && !validateEmail(email)) {
                showError('invoice_email', 'Enter valid email');
                return;
            }

            // GST fields required only if invoice requested
            if (wantsGSTInvoice) {

                if (!$('#gstin').val()) {
                    showError('gstin', 'GSTIN is required');
                    return;
                }

                if (!$('#business_name').val()) {
                    showError('business_name', 'Business name is required');
                    return;
                }

                if (!$('#billing_address').val()) {
                    showError('billing_address', 'Billing address is required');
                    return;
                }
            }

            // Terms mandatory
            if (!$('#terms').is(':checked')) {
                showError('terms', 'Please accept Terms & Conditions');
                return;
            }

            let data = {
                institute_id: $('#institute_id').val(),
                gst_invoice: wantsGSTInvoice,
                gstin: $('#gstin').val(),
                business_name: $('#business_name').val(),
                billing_address: $('#billing_address').val(),
                invoice_email: $('#invoice_email').val(),
                terms: 1,
                _token: $('meta[name=csrf-token]').attr('content')
            };

            $.post("{{ url('/step4-save') }}", data, function (res) {

                if (res.status) {
                    startPayment(); // 🔥 move to backend calculation
                }

            }).fail(function (xhr) {

                let errors = xhr.responseJSON.errors;

                $.each(errors, function (field, msg) {
                    showError(field, msg[0]);
                });

            });
        }


        function startPayment() {

            let institute_id = $('#institute_id').val();

            $.post("{{ url('/create-payment') }}", {
                institute_id,
                _token: $('meta[name=csrf-token]').attr('content')
            }, function (res) {

                if (res.payment_session_id) {

                    cashfree.checkout({
                        paymentSessionId: res.payment_session_id,
                        redirectTarget: "_self"
                    });

                } else if (res.type && res.type == 'free') {

                    window.location.href = "{{ url('/free-plan-complete') }}" + "?institute_id=" + institute_id;

                } else {

                    showError('general', 'Payment initiation failed');
                }

            });
        }


        function toggleGST() {
            let box = document.getElementById("gstDetails");
            let gstCheck = document.getElementById("gstCheck");

            box.style.display = gstCheck.checked ? "block" : "none";
        }

        function showMoreFeatures(packageId) {
            const remaining = document.getElementById('remaining-features-' + packageId);
            const btn = document.getElementById('show-more-btn-' + packageId);

            if (remaining && btn) {
                remaining.classList.remove('hidden');
                btn.style.display = 'none';
            }
        }
    </script>
@endpush