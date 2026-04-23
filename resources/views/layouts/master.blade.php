<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ApnaShaher - Institute Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preload" href="https://cdn.tailwindcss.com" as="style">
    <link rel="preload" href="your-logo.svg" as="image">
    <!-- ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
</head>
<style>
    .user-card {
    min-width: 240px;
}

.user-card img {
    border: 2px solid #e5e7eb;
}
.dashboard-top-verify{
    padding:10px; background:#fffbcc; border:1px solid #ffe58f; margin:15px 0;
}
.dash-main-card{
    font-size: 2.25rem;
    line-height: 3.45rem;
}

@media (max-width: 768px) {
    .dashboard-top-verify{
    padding:10px; background:#fffbcc; border:1px solid #ffe58f; margin:0px 0;
    text-align:center;
}
.dash-main-card{
    font-size: 22px;
    line-height: 32px;
    font-weight:800;
}
}
</style>

<body class="bg-gray-100 font-sans min-h-screen flex flex-col">


    <!-- ================= TOP HEADER ================= -->
   {{-- <header class="bg-slate-50 border-b shadow-sm">


        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-1 flex justify-between items-center">

             Logo 
           <a href="{{route('home')}}" class="logo">
                
                <img
                    src="https://apnashaher.com/admin-login-new/public/storage/uploads/all/7z7J6JUAFLAaTf3JffWL7k4qfn1wTlwD1qH4inko.svg" />
                    <p><i class="fa-solid fa-check"></i> Local institutes <i class="fa-solid fa-check"></i> Local discovery <i class="fa-solid fa-check"></i> Local trust</p>
            </a>

             Tagline (Desktop Only) 
             <div class="card-listingpage">
            <p>Helping local <strong>Institutes</strong> get discovered by real students.</p>
           
          </div>
            

             Notification Bell Starts 
            <div class="flex items-center gap-4">
                <div id="headerNotifContainer">
                   @include('partials.header-notifications', [
                        'notifications' => Auth::guard('institute')->user()->notifications()->latest()->take(5)->get(),
                        'unreadCount' => Auth::guard('institute')->user()->unreadNotifications()->count()
                    ])
                </div>
                

                @php
                    $plan = Auth::guard('institute')->user()->latestPlan->plan ?? null;
                    $hasCustomUrl = $plan && $plan->features && $plan->features->custom_profile_url;
                @endphp
                 <button onclick="{{ $hasCustomUrl ? 'openslugModal()' : 'showUpgradeAlert()' }}" class="relative px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700">
                    Generate Custom URL</button>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-2  font-medium logout-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7" />
                    </svg>
                    <span class="text-sm md:text-base">Logout</span>
                </a>
                

                <form id="logout-form" action="{{ route('institute.logout') }}" method="POST" style="display:none;">
                    @csrf
                </form>

                </div>
                </div>

        </header> --}}
<header class="bg-slate-50 border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex justify-between items-center">

        <!-- ==================== DESKTOP LOGO + TAGLINE (Mobile pe hide) ==================== -->
        <div class="hidden md:flex items-center gap-6 flex-1">
            <!-- Logo + Slogan -->
            <a href="{{route('home')}}" class="logo flex items-center gap-3">
                <img src="https://apnashaher.com/admin-login-new/public/storage/uploads/all/7z7J6JUAFLAaTf3JffWL7k4qfn1wTlwD1qH4inko.svg"
                     alt="ApnaShaher" class="h-10" />
                <p class="text-xs text-gray-600 leading-tight">
                    <i class="fa-solid fa-check"></i> Local institutes 
                    <i class="fa-solid fa-check"></i> Local discovery 
                    <i class="fa-solid fa-check"></i> Local trust
                </p>
            </a>

            <!-- Desktop Tagline -->
            <div class="card-listingpage">
                <p>Helping local <strong>Institutes</strong> get discovered by real students.</p>
            </div>
        </div>

        <!-- ==================== MOBILE LOGO (Sirf Mobile pe dikhega) ==================== -->
        <a href="{{route('home')}}" class="hidden">
            <img src="https://apnashaher.com/admin-login-new/public/storage/uploads/all/7z7J6JUAFLAaTf3JffWL7k4qfn1wTlwD1qH4inko.svg" 
                 alt="ApnaShaher" class="h-9" />
        </a>

        <!-- ==================== DESKTOP RIGHT SIDE ==================== -->
        <div class="hidden md:flex items-center gap-4">
            <!-- Notifications -->
            <div id="headerNotifContainer">
                @include('partials.header-notifications', [
                    'notifications' => Auth::guard('institute')->user()->notifications()->latest()->take(5)->get(),
                    'unreadCount' => Auth::guard('institute')->user()->unreadNotifications()->count()
                ])
            </div>

            @php
                $plan = Auth::guard('institute')->user()->latestPlan->plan ?? null;
                $hasCustomUrl = $plan && $plan->features && $plan->features->custom_profile_url;
            @endphp

            <button onclick="{{ $hasCustomUrl ? 'openslugModal()' : 'showUpgradeAlert()' }}" 
                    class="px-5 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700 transition">
                Generate Custom URL
            </button>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="flex items-center gap-2 font-medium text-gray-700 hover:text-red-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
                <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('institute.logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>

        <!-- ==================== MOBILE USER CARD ==================== -->
       <div class="md:hidden">
    <div class="user-card flex items-center gap-3 bg-white border border-gray-200 rounded-2xl px-4 py-2.5 shadow-sm w-full overflow-hidden">

        <!-- Logo -->
        <div class="w-10 h-10 flex-shrink-0">
            @if(Auth::guard('institute')->user()->logo)
                <img src="{{ asset('storage/' . Auth::guard('institute')->user()->logo) }}" 
                     alt="Logo" 
                     class="w-10 h-10 object-cover rounded-2xl border">
            @else
                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center font-bold text-xl">
                    {{ strtoupper(substr(Auth::guard('institute')->user()->name ?? 'I', 0, 1)) }}
                </div>
            @endif
        </div>

        <!-- Institute Name -->
        <div class="flex-1 min-w-0 pr-2">
            <p class="font-semibold text-gray-900 text-sm leading-tight break-words">
                {{ Auth::guard('institute')->user()->name }}
            </p>
            <p class="text-xs text-gray-500">Institute</p>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col gap-1 text-xs flex-shrink-0">
            <a href="{{ route('institute.dashboard') }}" 
               class="bg-blue-600 text-white px-3 py-1 rounded-xl font-medium hover:bg-blue-700 transition text-center whitespace-nowrap">
                Dashboard
            </a>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="text-red-600 hover:text-red-700 font-medium text-center whitespace-nowrap">
                Logout
            </a>
        </div>

    </div>
</div>


    </div>
</header>


    <!-- ================= INSTITUTE INFO HEADER ================= -->
    <div class="bg-white border-b">
        {{-- Verify Email Button --}}
        @if(!auth()->user('institute')->hasVerifiedEmail())
            <div class="dashboard-top-verify" style="">
                <p>Your email ({{ auth()->user('institute')->owner_email }}) is not verified yet.
                <form method="POST" action="{{ route('institute.verification.send') }}">
                    @csrf
                    <button type="submit" style="background:none; border:none; padding:0; color:#007bff; text-decoration:underline; cursor:pointer;">Send Verification Email</button>
                </form>
                </p>
            </div>
        @endif
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            
            
                <!-- LEFT SIDE -->
                <div class="flex items-center gap-4">
                    @if(Auth::guard('institute')->check())
                        @php
                            if($institute->logo) {
                                $logo = asset('storage/'.$institute->logo);
                            } else {
                                $logo = strtoupper(substr($institute->name,0,1));
                                $bgColor = pastelColor();
                                $textColor = '#333';
                            }
                        @endphp
                        @if(Auth::guard('institute')->user()->logo !="")
                        <img src="{{$logo}}" alt="Institute Logo" class="h-20 w-20  border">
                        @else
                        <div class="seller-logo-letter   border" style="background-color: {{$bgColor}}; color: {{$textColor}};border-radius:8px; width: 90px;
    height: 68px;" >
                            {{$logo}}
                        </div>
                        @endif
                    @else
                    <img src="https://via.placeholder.com/70" class="h-20 w-20  border" style="border-radius:8px;">
                    @endif
                    <div>
                        <h2 class="  dash-main-card" style="">
                            @if(Auth::guard('institute')->check()) {{Auth::guard('institute')->user()->name}} @endif
                        </h2>

                        <span class="inline-block mt-2 text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
    @if(Auth::guard('institute')->check())
        {{ optional(optional(Auth::guard('institute')->user()->latestPlan)->plan)->name ?? 'Free Plan' }}
    @endif
</span>
                        
                    </div>
                </div>

                <!-- RIGHT SIDE (Profile Completeness) -->
                
                <div class="w-full md:w-80">
                    @php
$percentage = 0;
$showtext = "";

// Get institute once
$institute = Auth::guard('institute')->user();

if($institute) {

    // Step 1: Registration completed
    if($institute->registration_complete) {
        $percentage += 40;
    } else {
        $showtext = "Complete your registration to improve score";
    }

    // Step 2: Profile completed
    if($institute->profile_completed) {
        $percentage += 10;
    } elseif($showtext == "") {
        $showtext = "Complete your profile to improve score";
    }

    // Step 3: Courses added
    if($institute->courses->count() > 0) {
        $percentage += 20;
    } elseif($showtext == "") {
        $showtext = "Add courses to improve score";
    }

    // Step 4: Timings added
    if($institute->timings->count() > 0) {
        $percentage += 10;
    } elseif($showtext == "") {
        $showtext = "Add working hours to improve score";
    }

    // Step 5: Social links added (all 4 required)
    if(!empty($institute->facebook_url) && !empty($institute->instagram_url) && !empty($institute->youtube_url) && !empty($institute->twitter_url)) {
        $percentage += 10;
    } elseif($showtext == "") {
        $showtext = "Add social media links to improve score";
    }

    // Step 6: Email verified
    if($institute->hasVerifiedEmail()) {
        $percentage += 10;
    } elseif($showtext == "") {
        $showtext = "Verify your Email to improve score";
    }

    // Cap at 100%
    if($percentage > 100) $percentage = 100;

    // If all steps complete, set final message
    if($percentage == 100) {
        $showtext = "Your profile is fully complete!";
    }
}
@endphp
                    <div class="flex justify-between text-sm mb-2">
                        <span class="font-medium text-gray-700">
                            Profile Completeness
                        </span>
                        <span class="text-blue-600 font-semibold">
                            {{ $percentage }}%
                        </span>
                    </div>

                    <!-- <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-3 rounded-full" style="width:78%">
                        </div>
                    </div> -->
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 h-3 rounded-full" style="width: {{ $percentage }}%;"></div>
                    </div>

                    <p class="text-xs text-gray-400 mt-2">
                        {{$showtext}}
                    </p>

                </div>

            </div>

        </div>
    </div>

    <!-- ================= TABS ================= -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-6">
            <nav class="flex space-x-6 text-sm font-medium overflow-x-auto whitespace-nowrap no-scrollbar">
                <button onclick="showTab(event,'overview')"
                    class="tab-btn active-tab py-4 border-b-2 border-blue-600 text-blue-600">Overview</button>
                <button onclick="showTab(event,'profile')"
                    class="tab-btn py-4 border-b-2 border-transparent text-gray-500">Profile</button>
                <button onclick="showTab(event,'courses')"
                    class="tab-btn py-4 border-b-2 border-transparent text-gray-500">Courses</button>
                <button onclick="showTab(event,'gallery')"
                    class="tab-btn py-4 border-b-2 border-transparent text-gray-500">Gallery</button>
                <button onclick="showTab(event,'leads')"
                    class="tab-btn py-4 border-b-2 border-transparent text-gray-500">Leads</button>
                    <button onclick="showTab(event,'notification')"
                    class="tab-btn py-4 border-b-2 border-transparent text-gray-500">Notification</button>
                <button onclick="showTab(event,'reviews')"
                    class="tab-btn py-4 border-b-2 border-transparent text-gray-500">Reviews</button>
                <button onclick="showTab(event,'plan')"
                    class="tab-btn py-4 border-b-2 border-transparent text-gray-500">Plan</button>
                <button onclick="showTab(event,'settings')"
                    class="tab-btn py-4 border-b-2 border-transparent text-gray-500">Settings</button>
            </nav>
        </div>
    </div>

@yield('content')
<div id="customUrlModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white rounded-xl p-6 w-full max-w-md">

    <h3 class="text-xl font-bold mb-4">Choose Your Custom URL</h3>

    <div class="form-group">
      <label>URL</label>
      <div class="flex items-center border rounded px-2">
        <span class="text-gray-500">apnashaher.com/</span>
        <input type="text" id="custom_slug" class="flex-1 outline-none p-2" placeholder="your-name" />
      </div>
      <small id="slug_status"></small>
    </div>

    <div class="flex justify-between mt-5">
      <button onclick="skipSlug()" class="text-gray-500">Skip</button>

      <div class="flex gap-2">
        <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
        <button onclick="saveCustomUrl()" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
      </div>
    </div>

  </div>
</div>

    <!-- ================= MOBILE FOOTER ================= -->
    <div class="fixed bottom-0 left-0 w-full bg-slate-50 border-t shadow-sm md:hidden">


        <div class="flex justify-around items-center py-2 text-xs text-gray-600">

            <!-- Browse -->
            <div class="flex flex-col items-center">
                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M3 12h18M3 6h18M3 18h18" />
                </svg>
                Browse
            </div>

            <!-- List Institute -->
            <div class="flex flex-col items-center">
                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4" />
                </svg>
                List
            </div>

            <!-- HOME (Circle Center) -->
            <div class="flex flex-col items-center -mt-6">
                <div class="bg-blue-600 text-white p-4 rounded-full shadow-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-4v-6H9v6H5a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <span class="mt-1 text-blue-600 font-semibold">Home</span>
            </div>

            <!-- Help -->
            <div class="flex flex-col items-center">
                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M8 10h.01M12 14h.01M16 10h.01M9 16h6" />
                </svg>
                Help
            </div>

            <!-- Login -->
            <div class="flex flex-col items-center">
                <svg class="w-5 h-5 mb-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
                Login
            </div>

        </div>
    </div>


    
@include('partials.dashboard-style')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
$(document).ready(function() {

    @if(session('message'))
        toastr.success("{{ session('message') }}");
    @endif

    @if(session('verified'))
        toastr.success("Your email has been successfully verified!");
    @endif

});

</script>
@include('partials.dashboard-script')


 @stack('after-scripts')
</body>

</html>