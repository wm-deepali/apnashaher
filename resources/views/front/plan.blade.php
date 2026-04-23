@extends('layouts.app')
@section('title', 'Packages')
@push('styles')

@endpush
<style>
    .plan-page{
        width:80% ;
        padding:40px ;
    }
    .contact-section{
        padding:40px;
    }
     @media (min-width: 769px) {
        .mobile-view-card{
            display:none;
        }
    }
    
    @media (max-width: 768px) {
        
        .desktop-view-card{
            display:none;
        }
        .plan-page{
        width:95% !important ;
        padding:0px ;
    }
    .contact-section{
        padding:0px;
    }
    .step-card {
    border: 1px solid #e0e7f0;
    border-radius: 16px;
    padding: 10px !important;
    position: relative;
}
.pricing-cards-container{
    gap:50px !important;
}
    }
</style>
@section('content')
<section class="contact-section bg-white min-h-screen">
<div class="step-card plan-page">
    

    <h4 class="text-3xl font-bold text-gray-900 text-center mb-3">Choose the Right Visibility Plan for Your
    Institute</h4>
    <p class="text-center text-gray-600 mb-10">Select the plan that best matches your institute's growth goals
    </p>

    <div class="pricing-cards-container grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 max-w-6xl mx-auto">
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
            <span class="text-5xl font-extrabold text-blue-700">₹{{$package->formatted_offered_price }}</span>
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
                <span>{{ ucfirst($package->features->search_visibility) }} Search Visibility</span>
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
                <span>Custom Profile URL<br/>(<span style="font-size:13px;">(www.apnashaher.com/your-own-url</span>)</span>
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
            <button
                class="w-full py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg">
                Choose Standard
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
                <span class="text-5xl font-extrabold text-gray-900">₹{{$package->formatted_offered_price }}</span>
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
                      <span>{{ ucfirst($package->features->search_visibility) }} Search Visibility</span>
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
                      <span>{{ ucfirst($package->features->support_type) }} </span>
                    </li>

                    <li {!! $package->features->profile_performance_insight ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                        {!! $package->features->profile_performance_insight ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                        <span>Profile Performance Insight</span>
                    </li>
                    <li {!! $package->features->custom_profile_url ? 'class="flex items-start gap-3"' : 'class="flex items-start gap-3 opacity-50"' !!}>
                        {!! $package->features->custom_profile_url ? '<span class="text-green-500 text-xl">✔</span>' : '<span class="text-gray-400 text-xl">✘</span>' !!}
                        <span>Custom Profile URL<br/>(<span style="font-size:13px;">(www.apnashaher.com/your-own-url</span>)</span>
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
            <button  
                class="w-full py-4 bg-gray-100 text-gray-800 font-semibold rounded-xl hover:bg-gray-200 transition">
                Start {{$package->name}}
            </button>
            </div>
        </div>
        @endif
        @endforeach
        @endif
    
    </div>

    </div>
</section>
@endsection