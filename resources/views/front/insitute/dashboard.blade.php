@extends('layouts.master')
@section('title', 'Institute Dashboard')
@section('content')
  <style>
    .timing-card {
      background: #fff;
      border: 1px solid #ddd;
      padding: 12px;
      border-radius: 10px;
      margin-bottom: 12px;
    }

    .timing-row {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .timing-time {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .active-check {
      display: flex;
      align-items: center;
      gap: 5px;
    }
  </style>
  <!-- ================= CONTENT ================= -->
  <main class="flex-1 max-w-7xl mx-auto px-1 sm:px-6 py-6 sm:py-8 space-y-8 pb-24 md:pb-8 " style="width: 100%;">


    @if($isExpiringSoon)

      <div
        class="bg-yellow-100 border border-yellow-300 text-yellow-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
        <div>
          Your subscription is expiring soon, Please renew to keep getting benefits.
        </div>

        <a href="{{ route('plans') }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg">
          Renew Now
        </a>
      </div>

    @endif

    <!-- OVERVIEW -->
    <div id="overview" class="tab-content">
      @if($isExpired)

        <div
          class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
          <div>
            Please renew your subscription to continue.
          </div>

          <a href="{{ route('plans') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
            Renew Now
          </a>
        </div>
      @else

        <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6">Last 7 Days Performance</h2>

        <!-- Stats Cards (top row - same as before but better styling) -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 md:gap-6 mb-8">
          <div class="card bg-white p-5 rounded-xl shadow-md border border-gray-100">
            <p class="text-sm text-gray-600 font-medium">Total Views</p>
            <h2 class="text-2xl font-bold text-gray-900 mt-1">{{$institute->views ?? 0}}</h2>
          </div>
          <div class="card bg-white p-5 rounded-xl shadow-md border border-gray-100">
            <p class="text-sm text-gray-600 font-medium">Total Clicks</p>
            <h2 class="text-2xl font-bold text-gray-900 mt-1">{{$institute->total_clicks ?? 0}}</h2>
          </div>
          <div class="card bg-white p-5 rounded-xl shadow-md border border-gray-100">
            <p class="text-sm text-gray-600 font-medium">Total Calls</p>
            <h2 class="text-2xl font-bold text-gray-900 mt-1">{{$institute->total_calls ?? 0}}</h2>
          </div>
          <div class="card bg-white p-5 rounded-xl shadow-md border border-gray-100">
            <p class="text-sm text-gray-600 font-medium">WhatsApp Connect</p>
            <h2 class="text-2xl font-bold text-gray-900 mt-1">{{$institute->whatsApp_connect ?? 0}}</h2>
          </div>
        </div>

        <!-- Charts Grid - same as screenshot layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

          <!-- 1. Donut Chart - Total Sales (circular with segments + legend below) -->
          <div class="card bg-white p-6 rounded-xl shadow-md border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Total Sales</h3>
            <div id="salesDonutChart" class="h-64 flex justify-center"></div>

            <!-- Legend below like screenshot -->
            <div class="mt-4 flex flex-wrap justify-center gap-6 text-sm">
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                <span>Direct Sales $2346</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-red-400"></span>
                <span>Referral Sales $2108</span>
              </div>
              <div class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-cyan-400"></span>
                <span>Affiliate Sales $1204</span>
              </div>
            </div>
          </div>

          <!-- 2. Line/Bar Chart - Net Income (monthly bars + line trend) -->
          <div class="card bg-white p-6 rounded-xl shadow-md border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Net Income</h3>
            <div id="netIncomeChart" class="h-64"></div>
            <p class="text-center text-sm text-gray-500 mt-2">Sales for this month</p>
          </div>

          <!-- 3. Horizontal Bar - Earning by Location with % -->
          <div class="card bg-white p-6 rounded-xl shadow-md border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Earning by Location</h3>
            <div id="locationChart" class="h-64"></div>
          </div>
        </div>

      @endif
    </div>

    <!-- PROFILE -->
    <div id="profile" class="tab-content hidden">

      @if($isExpired)

        <div
          class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
          <div>
            Please renew your subscription to continue.
          </div>

          <a href="{{ route('plans') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
            Renew Now
          </a>
        </div>
      @else
        <div class="bg-white rounded-2xl shadow-xl border p-3 pt-4 pb-4 md:p-10">

          <div class="grid grid-cols-1 md:grid-cols-12 gap-10">

            <!-- LEFT SIDE (8 Columns) -->
            <div class="md:col-span-8 space-y-10">

              <!-- Institute Info -->
              <div>
                <form id="instituteForm" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{ $institute->id }}">
                  <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Institute Info</h3>
                    <button type="submit"
                      class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700">
                      Update Now
                    </button>
                  </div>

                  <div class="grid md:grid-cols-2 gap-6">
                    <input type="text" name="name" value="{{ $institute->name }}" class="input"
                      placeholder="Institute Name">
                    <input type="text" name="owner_name" value="{{ $institute->owner_name }}" class="input"
                      placeholder="Owner Name">
                    <select class="input" id="designation" name="designation" required>
                      <option value="">Select Designation</option>
                      <option value="Director" {{$institute->designation == "Director" ? 'selected' : ""}}>Director</option>
                      <option value="Manager" {{$institute->designation == "Manager" ? 'selected' : ""}}>Manager</option>
                      <option value="Founder" {{$institute->designation == "Founder" ? 'selected' : ""}}>Founder</option>
                      <option value="Principal" {{$institute->designation == "Principal" ? 'selected' : ""}}>Principal
                      </option>
                      <option value="Others" {{$institute->designation == "Others" ? 'selected' : ""}}>Others</option>
                    </select>
                    <input type="number" name="established_year" value="{{$institute->established_year ?? ''}}"
                      class="input" placeholder="Established Year">
                    <input type="text" name="registration_number" value="{{ $institute->registration_number ?? '' }}"
                      class="input" placeholder="Registration Number">
                    <div>

                      <input type="url" name="website" value="{{ $institute->website ?? '' }}" class="input"
                        placeholder="Website">

                      <p class="text-xs text-gray-500 mt-1">
                        Example: https://www.xyz.com
                      </p>
                    </div>
                    <textarea name="description" class="input md:col-span-2"
                      placeholder="Short Description">{{ $institute->description ?? '' }}</textarea>
                    <textarea name="detailed_information" class="input md:col-span-2"
                      placeholder="Detail Content">{{ $institute->detailed_information ?? '' }}</textarea>
                    <input type="text" name="profile_address" value="{{ $institute->profile_address ?? '' }}"
                      class="input md:col-span-2" placeholder="Institute Address">
                    <input type="text" name="country" value="{{ $institute->country ?? '' }}" class="input"
                      placeholder="Country">
                    <select id="state_id" name="state_id" class="input" required>
                      <option value="">Select State</option>
                      @if(isset($states) && count($states) > 0)
                        @foreach($states as $state)
                          <option value="{{$state->id}}" {{$institute->state_id == $state->id ? 'selected' : ""}}>{{$state->name}}
                          </option>
                        @endforeach
                      @endif
                      <!-- Add more -->
                    </select>
                    <select id="city_id" name="city_id" class="input" required>
                      <option value="">Select City</option>
                      @if(isset($cities) && count($cities) > 0)
                        @foreach($cities as $city)
                          <option value="{{$city->id}}" {{$institute->city_id == $city->id ? 'selected' : ""}}>{{$city->name}}
                          </option>
                        @endforeach
                      @endif
                      <!-- Add more -->
                    </select>

                    <input type="text" name="zipcode" value="{{ $institute->zipcode ?? '' }}" class="input"
                      placeholder="Pin Code">
                  </div>

                  <div class="mt-6">
                    <label class="text-sm block mb-2">Institute Logo</label>
                    <input type="file" name="logo">
                  </div>
                </form>
              </div>
              <!-- Separator -->
              <div class="border-t border-gray-200 pt-8"></div>

              <!-- Social Media -->
              <div>
                <form id="socialForm">
                  @csrf
                  <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Social Media</h3>
                    <button type="submit"
                      class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700">
                      Update Now
                    </button>
                  </div>

                  <div class="grid md:grid-cols-2 gap-6">

                    <input type="hidden" name="social_ins_id" value="{{ $institute->id }}">

                    <!-- Facebook -->
                    <div>
                      <input name="facebook_url" value="{{ $institute->facebook_url ?? '' }}" class="input"
                        placeholder="Facebook">
                      <p class="text-xs text-gray-500 mt-1">
                        Example: https://www.facebook.com/username
                      </p>

                    </div>

                    <!-- LinkedIn -->
                    <div>
                      <input name="linkedin_url" value="{{ $institute->linkedin_url ?? '' }}" class="input"
                        placeholder="LinkedIn">
                      <p class="text-xs text-gray-500 mt-1">
                        Example: https://www.linkedin.com/in/username
                      </p>

                    </div>

                    <!-- Google (Note: Google Plus is outdated) -->
                    <div>

                      <input name="google_url" value="{{ $institute->google_url ?? '' }}" class="input"
                        placeholder="Google Business Profile">
                      <p class="text-xs text-gray-500 mt-1">
                        Example: https://g.page/your-business-name
                      </p>
                    </div>

                    <div>
                      <input name="twitter_url" value="{{ $institute->twitter_url ?? '' }}" class="input"
                        placeholder="Twitter">

                      <p class="text-xs text-gray-500 mt-1">
                        Example: https://twitter.com/username
                      </p>

                    </div>
                    <div>
                      <input name="instagram_url" value="{{ $institute->instagram_url ?? '' }}" class="input"
                        placeholder="Instagram">

                      <p class="text-xs text-gray-500 mt-1">
                        Example: https://www.instagram.com/username
                      </p>

                    </div>
                    <div>
                      <input name="instagram_url" value="{{ $institute->instagram_url ?? '' }}" class="input"
                        placeholder="Instagram">

                      <p class="text-xs text-gray-500 mt-1">
                        Example: https://www.instagram.com/username
                      </p>

                    </div>


                  </div>
                </form>
              </div>

            </div>

            <!-- RIGHT SIDE (Timing - 4 Columns) -->
            <div class="md:col-span-4 relative">

              <!-- Vertical Divider (Desktop Only) -->
              <div class="hidden md:block absolute left-0 top-0 h-full w-px bg-gray-200"></div>

              <div class="md:pl-8 space-y-6">
                <form id="timingForm">
                  @csrf
                  <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold">Timing & Working Hours</h3>
                    <button type="button" id="updateTimingsBtn"
                      class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700">
                      Update Now
                    </button>
                  </div>

                  <div class="grid grid-cols-1 gap-4">
                    <div class="timing-cards" id="timingCards">

                      @foreach($timings as $day => $timing)
                        <div class="timing-card">
                          <span class="day-name">{{ $day }}</span>
                          <div class="timing-row">
                            <div class="timing-time">
                              <input type="time" class="input" name="timings[{{ $day }}][open_time]"
                                value="{{ $timing->open_time }}">
                              <span>to</span>
                              <input type="time" class="input" name="timings[{{ $day }}][close_time]"
                                value="{{ $timing->close_time }}">
                            </div>

                            <label class="active-check">
                              <input type="checkbox" class="input" name="timings[{{ $day }}][is_active]" value="1" {{ $timing->is_active ? 'checked' : '' }}>
                              On
                            </label>
                          </div>
                        </div>
                      @endforeach
                      <span class="note-text"><b>Note:</b> For any Off Days, Please remove the tick from checkbox </span>

                    </div>

                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      @endif
    </div>


    <!-- COURSES -->
    <div id="courses" class="tab-content hidden space-y-10">

      @if($isExpired)

        <div
          class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
          <div>
            Please renew your subscription to continue.
          </div>

          <a href="{{ route('plans') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
            Renew Now
          </a>
        </div>
      @else
        <!-- Add New Course Form -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-3 pt-4 pb-4 md:p-8">
          @if($remainingCourses > 0)
            <h3 class="text-xl font-bold text-gray-800 mb-6">Add New Course</h3>

            <form id="courseForm" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="institute_id" value="{{ $institute->id }}">
              <input type="hidden" name="plan_id" value="{{ $institute->latestPlan->plan->id ?? '' }}">

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Course Name -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Course Name *</label>
                  <input type="text" name="name" class="input w-full" placeholder="e.g. Full Stack Web Development" required>
                  <span class="error-text text-red-600 text-sm mt-1 block"></span>
                </div>

                <!-- Duration + Unit -->
                <div class="flex gap-4">
                  <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Duration *</label>
                    <input type="text" name="duration" class="input w-full" placeholder="e.g. 6 Months" required>
                    <span class="error-text text-red-600 text-sm mt-1 block"></span>
                  </div>
                  <div class="w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Duration Unit *</label>
                    <select name="duration_unit" class="input w-full" required>
                      <option value="">Select Unit</option>
                      <option value="Days">Days</option>
                      <option value="Months">Months</option>
                      <option value="Years">Years</option>
                    </select>
                    <span class="error-text text-red-600 text-sm mt-1 block"></span>
                  </div>
                </div>

                <!-- Fees -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Course Fees (₹) *</label>
                  <input type="number" name="course_fee" class="input w-full" placeholder="e.g. 25000" required>
                  <span class="error-text text-red-600 text-sm mt-1 block"></span>
                </div>

                <!-- Mode -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Mode *</label>
                  <select name="mode" class="input w-full" required>
                    <option value="">Select Mode</option>
                    <option value="Online">Online</option>
                    <option value="Offline">Offline</option>
                    <option value="Both (Hybrid)">Both (Hybrid)</option>
                  </select>
                  <span class="error-text text-red-600 text-sm mt-1 block"></span>
                </div>

                <!-- Start Date -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                  <input type="date" name="start_date" class="input w-full">
                  <span class="error-text text-red-600 text-sm mt-1 block"></span>
                </div>

                <!-- Available Seats -->
                <div>
                  <label class="block text-sm font-medium text-gray-700 mb-1">Available Seats *</label>
                  <input type="number" name="available_seats" class="input w-full" placeholder="e.g. 30" required>
                  <span class="error-text text-red-600 text-sm mt-1 block"></span>
                </div>

                <!-- Short Description -->
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Short Description *</label>
                  <textarea name="short_desc" class="input w-full h-24" placeholder="Brief overview of the course..."
                    required></textarea>
                  <span class="error-text text-red-600 text-sm mt-1 block"></span>
                </div>

                <!-- Detailed Content (optional) -->
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Detailed Content / Syllabus</label>
                  <textarea name="detailed_information" class="input w-full h-32"
                    placeholder="Full syllabus, topics, outcomes..."></textarea>
                  <span class="error-text text-red-600 text-sm mt-1 block"></span>
                </div>

                <!-- Course Thumbnail -->
                <div class="md:col-span-2">
                  <label class="block text-sm font-medium text-gray-700 mb-1">Course Thumbnail Image</label>
                  <input type="file" name="thumb_image" accept="image/*"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                  <p class="text-xs text-gray-500 mt-1">Recommended: 400x200 px, JPG/PNG</p>
                  <span class="error-text text-red-600 text-sm mt-1 block"></span>
                </div>

                <!-- Submit -->
                <div class="md:col-span-2 flex justify-end mt-4">
                  <button type="submit"
                    class="bg-blue-600 text-white px-8 py-3 rounded-xl font-medium hover:bg-blue-700 transition shadow-md">
                    Add Course
                  </button>
                </div>
              </div>
            </form>
          @else

            <!-- ❌ Limit Reached -->
            <div class="text-center py-10">

              <h3 class="text-xl font-bold text-gray-800 mb-4">
                Course Limit Reached
              </h3>

              @if($isMaxPlan)

                <!-- 🔴 MAX PLAN -->
                <p class="text-gray-600 mb-6">
                  Please Contact Support, If You want to Add More Courses
                </p>

                <a href="{{ route('contact-us') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg">
                  Contact Support
                </a>

              @else

                <!-- 🟡 NORMAL UPGRADE -->
                <p class="text-gray-600 mb-6">
                  Upgrade your Plan to Add More Courses
                </p>

                <a href="{{ route('plans') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg">
                  Upgrade Now
                </a>

              @endif

            </div>

          @endif
        </div>

        <!-- Your Courses Grid -->
        <!-- Your Courses Section -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 md:p-8">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-gray-900">Your Courses</h3>
            <span class="text-sm text-gray-600">Total: {{count($courses) ?? 0}} active courses</span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @forelse($courses as $course)
              <!-- Professional Course Card -->
              <div
                class="course-card group bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-md hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                <!-- Thumbnail -->
                <div class="relative">
                  @if($course->thumb_image)
                    <img src="{{ asset('storage/' . $course->thumb_image) }}" alt="{{$course->name}}" class="course-image">
                  @else
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=800"
                      alt="Course Thumbnail"
                      class="w-full h-52 object-cover transition-transform duration-500 group-hover:scale-105">
                  @endif
                  <span
                    class="absolute top-4 right-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-md">
                    Active
                  </span>
                </div>

                <!-- Content -->
                <div class="p-6 space-y-5">
                  <!-- Title -->
                  <h4 class="text-xl font-bold text-gray-900 line-clamp-2 leading-tight">
                    {{ $course->name }}
                  </h4>

                  <!-- Mode Badge (light pastel) -->
                  <div
                    class="inline-block bg-gradient-to-r from-blue-50 to-cyan-50 px-4 py-1.5 rounded-full text-sm font-medium text-blue-800 border border-blue-100">
                    Learning Mode: {{ $course->mode }}
                  </div>

                  <!-- Description -->
                  <p class="text-gray-700 text-sm leading-relaxed line-clamp-3">
                    {{ $course->short_desc ?? '' }}
                  </p>

                  <!-- Duration & Fees -->
                  <div class="flex items-center justify-between pt-2">
                    <div>
                      <span class="text-sm text-gray-600">Duration</span>
                      <p class="text-base font-semibold text-gray-900">{{ $course->duration }} {{ $course->duration_unit }}
                      </p>
                    </div>
                    <div class="text-right">
                      <span class="text-sm text-gray-600">Fees</span>
                      <p class="text-xl font-bold text-indigo-700">₹{{ $course->course_fee }}</p>
                    </div>
                  </div>

                  <!-- Actions -->
                  <div class="pt-4 flex items-center justify-between border-t border-gray-100">
                    <span class="text-sm text-gray-600 font-medium">
                      Available Seat: <span class="text-gray-900">{{ $course->available_seats }}</span>
                    </span>
                    <div class="flex gap-5">
                      <button data-url="{{ route('institute.courses.edit', $course->id) }}"
                        class="editCourseBtn  text-blue-600 hover:text-blue-800 font-semibold transition">
                        Edit
                      </button>
                      <button data-id="{{ $course->id }}" data-url="{{ route('institute.courses.destroy', $course->id) }}"
                        class="deleteCourseBtn text-red-600 hover:text-red-800 font-semibold transition">
                        Delete
                      </button>

                    </div>
                  </div>
                </div>
              </div>
            @empty
              <p>No courses available.</p>
            @endforelse


            <!-- You can duplicate the above card block for more courses -->

          </div>
        </div>

        <div id="editCourseModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 hidden">
          <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">

            <!-- Header -->
            <div class="bg-gradient-to-r from-indigo-600 to-blue-700 p-6 text-white flex justify-between items-center">
              <h3 class="text-xl font-bold">Edit Course</h3>
              <button onclick="closeEditModal()" class="text-3xl">&times;</button>
            </div>

            <!-- Dynamic Content -->
            <div id="editModalContent" class="p-6">
              <!-- AJAX content will come here -->
            </div>

          </div>
        </div>

      @endif
    </div>

    <!-- GALLERY -->
    <div id="gallery" class="tab-content hidden space-y-10">

      @if($isExpired)

        <div
          class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
          <div>
            Please renew your subscription to continue.
          </div>

          <a href="{{ route('plans') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
            Renew Now
          </a>
        </div>
      @else

        <!-- Upload Section -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 md:p-8">
          <h3 class="text-xl font-bold text-gray-800 mb-6">Add New Images to Gallery</h3>
          <form id="galleryForm" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload Images (multiple allowed)</label>
                <input type="file" id="images" name="images[]" multiple accept="image/jpeg,image/png,image/webp,image/avif"
                  class="block w-full text-sm text-gray-500 
                               file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 
                               file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 
                               hover:file:bg-blue-100 transition cursor-pointer">
                <p class="text-xs text-gray-500 mt-2">JPG, PNG • Max 5MB each • Up to 10 at once</p>
                <div id="errorBox" class="text-red-500 text-sm mt-2"></div>
              </div>

              <div class="flex justify-end">
                <button type="submit"
                  class="bg-blue-600 text-white px-8 py-3 rounded-xl font-medium hover:bg-blue-700 transition shadow-md">
                  Upload Images
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Gallery Grid -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 md:p-8">
          <h3 class="text-xl font-bold text-gray-800 mb-6">Your Gallery ({{count($galleries)}} Images)</h3>

          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse($galleries as $gallery)
              <div
                class="relative group overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 cursor-pointer">
                <img src="{{ asset('storage/' . $gallery->image) }}"
                  class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">
                <button data-id="{{ $gallery->id }}"
                  class="delete-gallery-btn absolute top-2 right-2 bg-red-500 text-white text-xs px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity shadow-md">
                  Delete
                </button>
              </div>
            @empty
              <p>No Gallery Images Found.</p>
            @endforelse




          </div>
        </div>

      @endif
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black/90 hidden z-50 flex items-center justify-center">
      <button onclick="closeLightbox()"
        class="absolute top-6 right-6 text-white text-4xl font-light hover:text-gray-300 transition">&times;</button>

      <button onclick="prevImage()"
        class="absolute left-6 text-white text-5xl hover:text-gray-300 transition">&lsaquo;</button>
      <button onclick="nextImage()"
        class="absolute right-6 text-white text-5xl hover:text-gray-300 transition">&rsaquo;</button>

      <img id="lightboxImg" src="" class="max-w-[90%] max-h-[90%] object-contain rounded-lg shadow-2xl"
        alt="Gallery Image">

      <p id="lightboxCaption" class="absolute bottom-8 text-white text-lg bg-black/50 px-6 py-2 rounded-full"></p>
    </div>

    <!-- ================= BANNERS / SLIDERS ================= -->
    <div id="banners" class="tab-content hidden space-y-10">

      @if($isExpired)

        <div
          class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
          <div>
            Please renew your subscription to continue.
          </div>

          <a href="{{ route('plans') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
            Renew Now
          </a>
        </div>
      @else

        <!-- Upload Section -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 md:p-8">
          <h3 class="text-xl font-bold text-gray-800 mb-6">Add New Banner / Slider</h3>

          <form id="bannerForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="institute_id" value="{{ $institute->id }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

              <!-- Image -->
              <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Banner Image *</label>
                <input type="file" name="image" required accept="image/*" class="block w-full text-sm text-gray-500 
                            file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 
                            file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 
                            hover:file:bg-blue-100 transition cursor-pointer">
              </div>

              <!-- Title -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title (optional)</label>
                <input type="text" name="title" class="input w-full" placeholder="Banner Title">
              </div>

              <!-- Link -->
              <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Redirect Link (optional)</label>
                <input type="url" name="link" class="input w-full" placeholder="https://example.com">
              </div>

              <!-- Submit -->
              <div class="md:col-span-2 flex justify-end">
                <button type="submit"
                  class="bg-blue-600 text-white px-8 py-3 rounded-xl font-medium hover:bg-blue-700 transition shadow-md">
                  Upload Banner
                </button>
              </div>

            </div>
          </form>
        </div>

        <!-- Banner Grid -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 md:p-8">
          <h3 class="text-xl font-bold text-gray-800 mb-6">
            Your Banners ({{ count($banners) ?? 0 }})
          </h3>

          <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">

            @forelse($banners as $banner)
              <div class="relative group overflow-hidden rounded-xl shadow-sm hover:shadow-lg transition-all duration-300">

                <img src="{{ asset('storage/' . $banner->image) }}"
                  class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105">

                <!-- Overlay -->
                <div
                  class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex flex-col justify-center items-center gap-2">

                  @if($banner->title)
                    <span class="text-white text-sm font-semibold text-center px-2">
                      {{ $banner->title }}
                    </span>
                  @endif

                  <div class="flex gap-2">
                    <button data-id="{{ $banner->id }}"
                      class="delete-banner bg-red-500 text-white text-xs px-3 py-1 rounded-full shadow">
                      Delete
                    </button>
                  </div>

                </div>

              </div>
            @empty
              <p class="col-span-4 text-center text-gray-500">No Banners Found.</p>
            @endforelse

          </div>
        </div>

      @endif
    </div>

    <!-- LEADS SECTION -->
    <div id="leads" class="tab-content hidden flex flex-col h-full w-full bg-gray-50 overflow-hidden">

      @if($isExpired)

        <div
          class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
          <div>
            Please renew your subscription to continue.
          </div>

          <a href="{{ route('plans') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
            Renew Now
          </a>
        </div>
      @else

        <!-- MAIN TABLE AREA - full width by default -->
        <div id="leadsTableContainer" class="flex-1 bg-white overflow-y-auto transition-all duration-400 ease-in-out"
          style="background: #4325e712;">

          <!-- Header -->
          <div class="p-5 sm:p-6 border-b bg-gradient-to-r from-gray-50 to-white sticky top-0 z-10">
            <div class="flex items-center justify-between">
              <h2 class="text-xl sm:text-2xl font-bold text-gray-800">Leads</h2>
              <span class="text-sm text-gray-500 hidden sm:block">Recent enquiries</span>
            </div>
          </div>

          <!-- Table -->
          <div class="p-4 sm:p-6">
            <div class="bg-white rounded-xl border  overflow-hidden">
              <table class="w-full text-sm min-w-full divide-y divide-gray-200 table-fixed">
                <thead class="bg-gray-50">
                  <tr>
                    <th class="px-6 py-4 text-left font-semibold text-gray-700 uppercase tracking-wider w-1/4">Name</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-700 uppercase tracking-wider w-1/4">Email</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-700 uppercase tracking-wider w-1/4">Course</th>
                    <th
                      class="px-6 py-4 text-left font-semibold text-gray-700 uppercase tracking-wider w-1/5 hidden sm:table-cell">
                      Phone</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-700 uppercase tracking-wider w-1/5">Date</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                  @foreach($leads as $enquiry)
                    <tr onclick="openLead(
                                          '{{ $enquiry->name }}', 
                                          '{{ $enquiry->course->name ?? '' }}', 
                                          '{{ $enquiry->phone }}', 
                                          '{{ $enquiry->created_at->format('d M Y') }}',
                                          '{{ $enquiry->message }}'
                                        )" class="hover:bg-blue-50/70 cursor-pointer transition-colors duration-150">
                      <td class="px-6 py-4 font-medium text-gray-900">{{ $enquiry->name }}</td>
                      <td class="px-6 py-4 font-medium text-gray-900">{{ $enquiry->email }}</td>
                      <td class="px-6 py-4 text-gray-600">{{ $enquiry->course->name ?? "" }}</td>
                      <td class="px-6 py-4 text-gray-600 hidden sm:table-cell">{{ $enquiry->phone }}</td>
                      <td class="px-6 py-4 text-gray-500">{{ $enquiry->created_at->format('d M') }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- RIGHT DRAWER / DETAIL PANEL (glassmorphic + glossy card style) -->
        <div id="leadDetailDrawer"
          class="fixed inset-y-0 right-0 w-full max-w-md lg:max-w-lg bg-white/90 backdrop-blur-xl border-l border-gray-200/50 shadow-2xl transform translate-x-full transition-transform duration-400 ease-in-out z-40 overflow-y-auto">

          <!-- Drawer Header -->
          <div
            class="sticky top-0 z-10 bg-white/80 backdrop-blur-md border-b border-gray-200/50 px-6 py-5 flex items-center justify-between">
            <h3 class="text-xl font-semibold text-gray-900">Lead Details</h3>
            <button onclick="closeLead()" class="text-gray-500 hover:text-gray-800 text-3xl leading-none">&times;</button>
          </div>

          <!-- Drawer Content - glossy card feel -->
          <div class="p-6 space-y-8">
            <div class="bg-white/70 backdrop-blur-sm rounded-xl border border-white/40 shadow-lg p-6 space-y-6">
              <div>
                <p class="text-xs text-gray-600 uppercase tracking-wider mb-1 font-medium">Name</p>
                <p id="detailName" class="text-lg font-semibold text-gray-900"></p>
              </div>
              <div>
                <p class="text-xs text-gray-600 uppercase tracking-wider mb-1 font-medium">Interested Course</p>
                <p id="detailCourse" class="text-lg font-semibold text-gray-900"></p>
              </div>
              <div>
                <p class="text-xs text-gray-600 uppercase tracking-wider mb-1 font-medium">Phone Number</p>
                <a id="detailPhoneLink" href="#" class="text-lg font-semibold text-blue-600 hover:underline"></a>
              </div>
              <div>
                <p class="text-xs text-gray-600 uppercase tracking-wider mb-1 font-medium">Enquiry Date</p>
                <p id="detailDate" class="text-lg font-semibold text-gray-900"></p>
              </div>
              <div>
                <p class="text-xs text-gray-600 uppercase tracking-wider mb-1 font-medium">Message</p>
                <p id="detailMessage" class="text-lg font-semibold text-gray-900"></p>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-2 gap-4">
              <button
                class="bg-green-600 text-white py-3.5 rounded-xl font-medium hover:bg-green-700 transition shadow-md flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                Call Now
              </button>
              <button
                class="bg-green-500 text-white py-3.5 rounded-xl font-medium hover:bg-green-600 transition shadow-md flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                WhatsApp
              </button>
            </div>
          </div>
        </div>

        <!-- Optional backdrop for mobile (click to close) -->
        <div id="drawerBackdrop" class="fixed inset-0 bg-black/40 z-30 hidden lg:hidden" onclick="closeLead()"></div>

      @endif
    </div>


    <!-- NOTIFICATION TAB -->
    <div id="notification" class="tab-content hidden ">

      @if($isExpired)

        <div
          class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
          <div>
            Please renew your subscription to continue.
          </div>

          <a href="{{ route('plans') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
            Renew Now
          </a>
        </div>
      @else

        <div class=" mx-auto">

          <!-- Heading -->
          <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center md:text-left">Notifications</h2>

          <!-- Notification Table -->
          <div class="notif-table-container bg-white rounded-xl border shadow-sm overflow-hidden">
            <table class="notif-table w-full text-sm">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-4 text-left font-semibold text-gray-700 uppercase tracking-wider w-1/5">Date</th>
                  <th class="px-6 py-4 text-left font-semibold text-gray-700 uppercase tracking-wider w-1/4">Title</th>
                  <th
                    class="px-6 py-4 text-left font-semibold text-gray-700 uppercase tracking-wider w-1/2 hidden md:table-cell">
                    Message</th>
                  <th class="px-6 py-4 text-left font-semibold text-gray-700 uppercase tracking-wider w-1/12">Status</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                @forelse ($notifications as $notif)
                  @php
                    $data = $notif->data;
                    $status = $notif->read_at ? 'Read' : 'Unread';
                    $statusClass = $notif->read_at ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
                  @endphp
                  <tr class="notif-row hover:bg-blue-50/50 cursor-pointer transition-colors" data-notif-id="{{ $notif->id }}"
                    onclick="showNotification(
                                              '{{ $data['message_title'] ?? $data['type'] }}',
                                              '{{ $notif->created_at->format('d M Y') }}',
                                              '{{ $data['message'] ?? '' }}',
                                              '{{ $status }}',
                                              '{{ $notif->id }}'
                                          )">
                    <td class="px-6 py-4 text-gray-600">{{ $notif->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 font-medium text-gray-900">{{ $data['message_title'] ?? $data['type'] }}</td>
                    <td class="px-6 py-4 text-gray-600 hidden md:table-cell truncate">{{ $data['message'] ?? '' }}</td>
                    <td class="px-6 py-4">
                      <span
                        class="notif-status {{ $statusClass }} px-3 py-1 rounded-full text-xs font-medium">{{ $status }}</span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center py-8 text-gray-500">No notifications yet.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Empty State (optional) -->
          <!-- <div class="text-center py-12 text-gray-500" id="noNotifications" style="display:none;">
                      <p class="text-lg">No new notifications yet.</p>
                      <p class="mt-2">We'll notify you when something important happens.</p>
                    </div> -->
        </div>

      @endif
    </div>

    <!-- Notification Detail Modal -->
    <div id="notifModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 hidden">
      <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 overflow-hidden">

        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white flex justify-between items-center">
          <h3 id="notifModalTitle" class="text-xl font-bold">Notification</h3>
          <button onclick="closeNotifModal()"
            class="text-white text-3xl leading-none hover:text-gray-200">&times;</button>
        </div>

        <!-- Modal Body -->
        <div class="p-8 space-y-6">
          <div>
            <p class="text-xs text-gray-500 uppercase mb-1">Date</p>
            <p id="notifModalDate" class="font-medium text-gray-900"></p>
          </div>

          <div>
            <p class="text-xs text-gray-500 uppercase mb-1">Title</p>
            <p id="notifModalHeadline" class="text-xl font-bold text-gray-900"></p>
          </div>

          <div>
            <p class="text-xs text-gray-500 uppercase mb-1">Message</p>
            <p id="notifModalMessage" class="text-gray-700 leading-relaxed"></p>
          </div>

          <div>
            <p class="text-xs text-gray-500 uppercase mb-1">Status</p>
            <span id="notifModalStatus" class="px-4 py-1.5 rounded-full text-sm font-medium"></span>
          </div>
        </div>

        <!-- Footer -->
        <div class="p-6 border-t bg-gray-50 flex justify-end">
          <button onclick="closeNotifModal()"
            class="px-8 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition">
            Close
          </button>
        </div>
      </div>
    </div>

    <!-- MOBILE DRAWER -->
    <div id="mobileDrawer" class="fixed inset-0 bg-black/40 hidden z-50 lg:hidden">

      <div class="absolute bottom-0 left-0 right-0 bg-white rounded-t-2xl p-6
                            transform translate-y-full transition-transform duration-300" id="drawerContent">

        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold">Lead Details</h3>
          <button onclick="closeLead()" class="text-gray-400 hover:text-red-500 text-xl">&times;</button>
        </div>

        <div class="space-y-4">
          <div>
            <p class="text-sm text-gray-500">Name</p>
            <p id="mDetailName" class="font-medium"></p>
          </div>

          <div>
            <p class="text-sm text-gray-500">Course</p>
            <p id="mDetailCourse" class="font-medium"></p>
          </div>

          <div>
            <p class="text-sm text-gray-500">Phone</p>
            <p id="mDetailPhone" class="font-medium"></p>
          </div>

          <div>
            <p class="text-sm text-gray-500">Date</p>
            <p id="mDetailDate" class="font-medium"></p>
          </div>
        </div>

      </div>


    </div>


    <!-- REVIEWS -->
    <div id="reviews" class="tab-content hidden m-0">

    @if($isExpired)

      <div
        class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
        <div>
          Please renew your subscription to continue.
        </div>

        <a href="{{ route('plans') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
          Renew Now
        </a>
      </div>
      @else

      <div class="swiper  px-4">
        <div class="swiper-wrapper ">

          @forelse($reviews as $review)
            <div class="swiper-slide">
              <div
                class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-blue-200 group h-full flex flex-col">
                <div class="flex items-center gap-4 mb-6">
                  <img src="https://ashtonwell.com/public/assets/images/adnanahmed.avif" alt="Adnan Ahmed"
                    class="w-16 h-16 rounded-full object-cover ring-4 ring-blue-100">
                  <div>
                    <h4 class="font-bold text-gray-900 text-lg">{{$review->name}}</h4>
                    <p class="text-sm text-gray-600" style="font-weight: 700;">
                      {{date('d F Y', strtotime($review->created_at))}}
                    </p>
                  </div>
                </div>
                <div class="flex gap-1 mb-5">
                  @if($review->rating > 0)
                    @for($i = 1; $i <= 5; $i++)
                      @if($i <= floor($review->rating))
                        {{-- Full Star --}}
                        <i class="fas fa-star text-yellow-500 text-xl"></i>
                      @elseif($i - $review->rating < 1)
                        {{-- Half Star --}}
                        <i class="fas fa-star-half-alt text-yellow-500 text-xl"></i>
                      @else
                        {{-- Empty Star --}}
                        <i class="far fa-star text-gray-400 text-xl"></i>
                      @endif
                    @endfor
                  @else
                    {{-- No rating --}}
                    @for($i = 1; $i <= 5; $i++)
                      <i class="far fa-star text-gray-400 text-xl"></i>
                    @endfor
                  @endif
                </div>
                <p class="text-gray-700 italic leading-relaxed flex-grow">
                  "{{$review->review}}"
                </p>
                <div class="mt-6 text-blue-200 text-6xl opacity-30">
                  <i class="fas fa-quote-right"></i>
                </div>
              </div>
            </div>
          @empty
            <p>No Reviews Found.</p>
          @endforelse





        </div>


      </div>

       @endif
    </div>

    <!-- PLAN -->
    <div id="plan" class="tab-content hidden">

    @if($isExpired)

      <div
        class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
        <div>
          Please renew your subscription to continue.
        </div>

        <a href="{{ route('plans') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
          Renew Now
        </a>
      </div>
      @else

      <div class="max-w-4xl mx-auto">
        <!-- <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Your Current Subscription</h2> -->

        <!-- Current Plan Card - Professional look -->
        {{-- <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden relative">
          <!-- Popular Badge (top-right corner) -->
          @php
          $plan = $institute->latestPlan;
          $package = $plan->plan;
          $features = $plan->plan->features ?? null;
          @endphp
          <div
            class="absolute top-0 right-0 bg-gradient-to-r from-orange-400 to-orange-500 text-white text-xs font-bold px-6 py-1.5 rounded-bl-xl shadow-md transform rotate-12 translate-x-4 translate-y-2">
            {{$package->is_popular ? 'POPULAR' : ''}}
          </div>

          <!-- Header Section -->
          @if($features)
          <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">
            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-3xl font-bold">{{$package->name ?? ''}}</h3>
                <p class="text-blue-100 mt-1">Most Chosen by Institutes</p>
              </div>
              <div class="text-right">
                <p class="text-4xl font-bold">₹{{$package->offered_price ?? ''}}</p>
                <p class="text-blue-200 text-sm">/ year</p>
              </div>
            </div>

            <!-- Current Plan Badge -->
            <div
              class="mt-6 inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-white font-medium text-sm border border-white/30">
              Current Plan • {{$plan->expiry_date > now() ? 'Active' : 'Expired'}}
            </div>
          </div>
          @endif

          <!-- Features List -->
          <div class="p-8">
            <ul class="space-y-4 text-gray-700">
              <li class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{$features->apnashaher_listing ? 'ApnaShaher Listing' : ''}} +
                  {{ucfirst($features->search_visibility)}}Search Visibility</span>
              </li>
              <li class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ucfirst($features->contact_display ?? "")}} Contact Details Display
                  {{$features->call_whatsapp_button ? '+ WhatsApp/Call CTA' : ''}}</span>
              </li>
              <li class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ucfirst($features->profile_editing ?? "")}} Profile Editing {{$features->preferred_institute_badge
                  ? '+ Preferred Institute Badge' : ''}}</span>
              </li>

              <li class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Up to {{$features->courses_programs}} Courses/Programs {{$features->verified_badge ? '+ Verified
                  Badge' : ''}}</span>
              </li>

              @if($features->promotional_banner_placement || $features->profile_performance_insight)
              <li class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{$features->promotional_banner_placement ? 'Preferred Placement' : ''}}
                  {{$features->profile_performance_insight ? '+ Profile Analytics' : ''}}</span>
              </li>
              @endif
              @if($features->featured_in_category_listings)
              <li class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>Featured In Category Listings</span>
              </li>
              @endif

              @if($features->ai_profile_description_generator || $features->custom_profile_url)
              <li class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{$features->ai_profile_description_generator ? 'AI Description' : ''}}
                  {{$features->custom_profile_url ? '+ Custom Profile URL' : ''}}</span>

              </li>
              @endif
              <li class="flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{$features->support_type ?? ""}}</span>
              </li>
            </ul>

            <!-- Expiry & Upgrade -->
            <div class="mt-10 pt-6 border-t border-gray-200">
              <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                  <p class="text-gray-600">Expiry Date</p>
                  <p class="text-xl font-semibold text-gray-900">{{ \Carbon\Carbon::parse($plan->expiry_date)->format('d M
                    Y') }}</p>
                </div>
                <a href="{{route('plans')}}"
                  class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-xl font-medium hover:from-blue-700 hover:to-indigo-700 transition-all shadow-md">
                  Upgrade to Featured Plan →
                </a>
              </div>
              <p class="text-sm text-gray-500 mt-3 text-center sm:text-left">
                Unlock priority support, featured category placement & more.
              </p>
            </div>
          </div>
        </div> --}}
        <div class="bg-white rounded-3xl shadow-xl border border-gray-200 overflow-hidden relative">

          @php
            $latestPlanRelation = $institute->latestPlan;           // ye relation hai
            $plan = $latestPlanRelation?->plan;                     // actual Plan model
            $features = $plan?->features;
            $isPopular = $plan?->is_popular ?? false;
            $isFreePlan = !$plan || $plan->name === 'Free' || ($latestPlanRelation?->amount ?? 0) == 0;
          @endphp

          <!-- Popular Badge -->
          @if($isPopular)
            <div
              class="absolute top-0 right-0 bg-gradient-to-r from-orange-400 to-orange-500 text-white text-xs font-bold px-6 py-1.5 rounded-bl-2xl shadow-md transform rotate-12 translate-x-3 translate-y-2">
              POPULAR
            </div>
          @endif

          <!-- Header Section -->
          <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">
            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-3xl font-bold">
                  {{ $plan?->name ?? 'Free Plan' }}
                </h3>
                <p class="text-blue-100 mt-1">
                  {{ $isFreePlan ? 'Basic Access' : 'Most Chosen by Institutes' }}
                </p>
              </div>
              <div class="text-right">
                <p class="text-4xl font-bold">₹{{ $plan?->offered_price ?? '0' }}</p>
                <p class="text-blue-200 text-sm">/ year</p>
              </div>
            </div>

            <!-- Current Plan Status -->
            <div
              class="mt-6 inline-block bg-white/20 backdrop-blur-sm px-5 py-2 rounded-full text-white font-medium text-sm border border-white/30">
              Current Plan •
              @if($latestPlanRelation)
                {{ $latestPlanRelation->expiry_date > now() ? 'Active' : 'Expired' }}
              @else
                Free Forever
              @endif
            </div>
          </div>

          <!-- Features List -->
          <div class="p-8">
            @if($features)
              <ul class="space-y-4 text-gray-700">
                <li class="flex items-center gap-3">
                  <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>ApnaShaher Listing + {{ ucfirst($features->search_visibility ?? 'Standard') }} Search
                    Visibility</span>
                </li>

                <li class="flex items-center gap-3">
                  <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  <span>{{ ucfirst($features->profile_editing ?? 'Limited') }} Profile Editing</span>
                </li>

                @if($features->courses_programs ?? 0 > 0)
                  <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Up to {{ $features->courses_programs }} Courses / Programs</span>
                  </li>
                @endif

                @if($features->verified_badge)
                  <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Verified Badge</span>
                  </li>
                @endif

                @if($features->support_type)
                  <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ ucfirst($features->support_type) }} Support</span>
                  </li>
                @endif

                @if($features->custom_profile_url)
                  <li class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Custom Profile URL</span>
                  </li>
                @endif
              </ul>

            @else
              <!-- Free Plan Message -->
              <div class="py-12 text-center">
                <div class="mx-auto w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-5">
                  <i class="fas fa-gift text-4xl text-gray-400"></i>
                </div>
                <p class="text-xl font-semibold text-gray-700">You are on Free Plan</p>
                <p class="text-gray-500 mt-3 max-w-xs mx-auto">
                  Upgrade your plan to unlock premium features like Featured Listing, Verified Badge, Analytics & more.
                </p>
              </div>
            @endif

            <!-- Expiry & Upgrade -->
            <div class="mt-10 pt-6 border-t border-gray-200">
              <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                  <p class="text-gray-500 text-sm">Expiry Date</p>
                  <p class="text-xl font-semibold text-gray-900">
                    @if($latestPlanRelation)
                      {{ \Carbon\Carbon::parse($latestPlanRelation->expiry_date)->format('d M Y') }}
                    @else
                      Lifetime (Free)
                    @endif
                  </p>
                </div>
                @if($isExpired)

                  <a href="{{ route('plans') }}"
                    class="bg-red-600 text-white px-8 py-3.5 rounded-2xl font-semibold shadow-md">
                    Renew Now →
                  </a>

                @elseif($canUpgrade)

                  <a href="{{ route('plans') }}"
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3.5 rounded-2xl font-semibold shadow-md">
                    Upgrade Plan →
                  </a>

                @endif
              </div>
            </div>
          </div>
        </div>
        <!-- Optional small note below -->
        <p class="text-center text-sm text-gray-500 mt-8">
          Need help choosing? Contact support or explore all plans.
        </p>
      </div>

      @endif
    </div>

    <!-- INVOICES -->
    <div id="invoices" class="tab-content hidden">

    @if($isExpired)

      <div
        class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
        <div>
          Please renew your subscription to continue.
        </div>

        <a href="{{ route('plans') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
          Renew Now
        </a>
      </div>
      @else

      <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-6 md:p-8">

        <div class="flex justify-between items-center mb-6">
          <h3 class="text-xl font-bold text-gray-800">Invoices</h3>
        </div>

        @if(isset($invoices) && count($invoices) > 0)

          <div class="overflow-x-auto">
            <table class="w-full text-sm border rounded-lg overflow-hidden">

              <thead class="bg-gray-100">
                <tr>
                  <th class="px-4 py-3 text-left">Invoice No</th>
                  <th class="px-4 py-3 text-left">Plan</th>
                  <th class="px-4 py-3 text-left">Base</th>
                  <th class="px-4 py-3 text-left">GST</th>
                  <th class="px-4 py-3 text-left">Total</th>
                  <th class="px-4 py-3 text-left">Status</th>
                  <th class="px-4 py-3 text-left">Action</th>
                </tr>
              </thead>

              <tbody>

                @foreach($invoices as $invoice)

                  <tr class="border-b">

                    <td class="px-4 py-3 font-medium">
                      {{ $invoice->invoice_number }}
                    </td>

                    <td class="px-4 py-3">
                      {{ $invoice->payment->instituteplan->plan->name ?? '-' }}
                    </td>

                    <td class="px-4 py-3">
                      ₹{{ number_format($invoice->base_amount, 2) }}
                    </td>

                    <!-- GST -->
                    <td class="px-4 py-3 text-sm">

                      @if($invoice->cgst > 0)
                        CGST: ₹{{ number_format($invoice->cgst, 2) }}<br>
                        SGST: ₹{{ number_format($invoice->sgst, 2) }}
                      @endif

                      @if($invoice->igst > 0)
                        IGST: ₹{{ number_format($invoice->igst, 2) }}
                      @endif

                    </td>

                    <td class="px-4 py-3 font-semibold">
                      ₹{{ number_format($invoice->total, 2) }}
                    </td>

                    <td class="px-4 py-3">
                      <span
                        class="px-3 py-1 text-xs rounded-full
                                                              {{ $invoice->payment->status == 'paid' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ ucfirst($invoice->payment->status) }}
                      </span>
                    </td>

                    <!-- ACTION -->
                    <td class="px-4 py-3">

                      <a href="{{ route('invoice.show', $invoice->payment_id) }}"
                        class="bg-blue-600 text-white px-3 py-1 rounded text-sm">
                        View
                      </a>

                    </td>

                  </tr>

                @endforeach

              </tbody>

            </table>
          </div>

        @else

          <div class="text-center py-10 text-gray-500">
            No invoices found.
          </div>

        @endif

      </div>

      @endif
    </div>

    <!-- SETTINGS -->
    <div id="settings" class="tab-content hidden ">

    @if($isExpired)

      <div
        class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center mb-6">
        <div>
          Please renew your subscription to continue.
        </div>

        <a href="{{ route('plans') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
          Renew Now
        </a>
      </div>
      @else

      <div class="max-w-3xl mx-auto space-y-8">

        <!-- Header -->
        <div class="text-center md:text-left">
          <h2 class="text-2xl font-bold text-gray-800">Account Settings</h2>
          <p class="text-gray-600 mt-1">Manage your contact information securely. OTP verification required for mobile &
            WhatsApp changes.</p>
        </div>

        <!-- Contact Cards -->
        <div class="grid gap-6">

          <!-- Mobile Card -->
          <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-6">
              <div class="flex items-start justify-between">
                <div>
                  <h3 class="text-lg font-semibold text-gray-800">Mobile Number</h3>
                  <p id="currentMobile" class="text-gray-700 mt-1 text-xl font-medium">+91 {{ $institute->mobile }}</p>
                </div>
                <button onclick="openChangeModal('mobile', '{{$institute->mobile}}', 'Mobile Number')"
                  class="px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                  Change
                </button>
              </div>
              <p class="text-xs text-gray-500 mt-3">Used for login, alerts & student calls</p>
            </div>
          </div>

          @if($institute->owner_email != "")
            <!-- Email Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
              <div class="p-6">
                <div class="flex items-start justify-between">
                  <div>
                    <h3 class="text-lg font-semibold text-gray-800">Email Address</h3>
                    <p id="currentEmail" class="text-gray-700 mt-1 text-xl font-medium">{{ $institute->owner_email ?? "" }}
                    </p>
                  </div>
                  <button onclick="openChangeModal('email', '{{$institute->owner_email ?? ''}}', 'Email Address')"
                    class="px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    Change
                  </button>
                </div>
                <p class="text-xs text-gray-500 mt-3">Used for notifications & recovery</p>
              </div>
            </div>
          @endif

          @if($institute->whatsapp != "")
            <!-- WhatsApp Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
              <div class="p-6">
                <div class="flex items-start justify-between">
                  <div>
                    <h3 class="text-lg font-semibold text-gray-800">WhatsApp Number</h3>
                    <p id="currentWhatsApp" class="text-gray-700 mt-1 text-xl font-medium"> +91 {{ $institute->whatsapp }}
                    </p>
                  </div>
                  <button onclick="openChangeModal('whatsapp', '{{$institute->whatsapp}}', 'WhatsApp Number')"
                    class="px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                    Change
                  </button>
                </div>
                <p class="text-xs text-gray-500 mt-3">For direct student communication</p>
              </div>
            </div>
          @endif

        </div>

        <!-- Note -->
        <p class="text-sm text-gray-500 text-center md:text-left">
          All changes require OTP verification for security. Changes reflect instantly after verification.
        </p>
      </div>

      @endif
    </div>

    
    <!-- Change Modal -->
    <div id="changeModal" class="fixed inset-0 bg-black/60 flex items-center justify-center z-50 hidden">
      <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 overflow-hidden transform transition-all scale-95">

        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white">
          <div class="flex justify-between items-center">
            <h3 id="modalTitle" class="text-xl font-semibold">Change Mobile Number</h3>
            <button onclick="closeModal()" class="text-white/80 hover:text-white text-2xl">&times;</button>
          </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6 space-y-6">

          <!-- Current Value -->
          <div>
            <label class="block text-sm font-medium text-gray-600">Current Value</label>
            <p id="modalCurrent" class="mt-1 text-gray-900 font-medium"></p>
          </div>

          <!-- New Value Input -->
          <div>
            <label id="modalLabel" class="block text-sm font-medium text-gray-700">New Value</label>
            <input id="modalInput" type="text"
              class="mt-1 block w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
              placeholder="Enter new number/email">
          </div>

          <!-- OTP Section (hidden initially) -->
          <div id="otpSection" class="hidden space-y-4">
            <label class="block text-sm font-medium text-gray-700">Enter OTP</label>
            <div class="flex gap-3">
              <input type="text" maxlength="1"
                class="w-12 h-12 text-center text-xl border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
              <input type="text" maxlength="1"
                class="w-12 h-12 text-center text-xl border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
              <input type="text" maxlength="1"
                class="w-12 h-12 text-center text-xl border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
              <input type="text" maxlength="1"
                class="w-12 h-12 text-center text-xl border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
            <p class="text-xs text-gray-500">OTP sent to your current number/email. Didn't receive? <button
                onclick="resendOtpRequest()" id="resendBtnRequest" class="text-blue-600 hover:underline">Resend</button>
            </p>
            <span id="Requesttimer" class="ml-2 text-gray-400"></span>
          </div>

          <!-- Action Buttons -->
          <div class="flex gap-4 pt-4">
            <button onclick="closeModal()"
              class="flex-1 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50">
              Cancel
            </button>
            <button id="actionBtn" onclick="handleAction()"
              class="flex-1 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
              Send OTP
            </button>
          </div>

          <!-- Status Message -->
          <p id="modalStatus" class="text-center text-sm hidden"></p>
        </div>
      </div>
    </div>

  </main>
@endsection
@push('after-scripts')

  <script>
    document.addEventListener("DOMContentLoaded", function () {

      const urlParams = new URLSearchParams(window.location.search);
      const tab = urlParams.get('tab');

      if (tab) {
        // find correct button and trigger click
        let btn = document.querySelector(`.tab-btn[onclick*="${tab}"]`);
        if (btn) btn.click();
      }

    });
  </script>

  <script>
    $('input, select, textarea').on('input change', function () {
      $(this).removeClass('border-red-500');
      $(this).next('.error-text').remove();
    });
    $('#instituteForm').submit(function (e) {
      e.preventDefault();

      let id = $(this).find('input[name="id"]').val();
      let formData = new FormData(this);
      let updateurl = "{{ url('institute/update-profile/') }}";
      $.ajax({
        url: updateurl + '/' + id,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,

        beforeSend: function () {
          $('.error-text').remove();
          $('input, select, textarea').removeClass('border-red-500');
        },

        success: function (res) {
          toastr.success(res.message);
        },

        error: function (xhr) {

          $('.error-text').remove();

          if (xhr.status === 422) {
            let errors = xhr.responseJSON.errors;

            // purane errors remove karo
            $('.error-text').remove();

            $.each(errors, function (key, value) {
              let input = $('[name="' + key + '"]');

              // input ke baad simple block error
              input.after(
                '<small class="error-text text-red-500 text-xs block mt-1">'
                + value[0] +
                '</small>'
              );
            });
          }
        }
      });
    });
    // ✅ Social Media Update
    $('#socialForm').submit(function (e) {
      e.preventDefault();

      let id = $(this).find('input[name="social_ins_id"]').val();

      let updatesocialurl = "{{ url('institute/social-update') }}";
      $.ajax({
        url: updatesocialurl + '/' + id,
        type: "POST",
        data: $(this).serialize(),

        beforeSend: function () {
          $('.error-text').remove();
          $('input, select, textarea').removeClass('border-red-500');
        },

        success: function (res) {
          toastr.success(res.message);
        },

        error: function (xhr) {

          $('.error-text').remove();

          if (xhr.status === 422) {
            let errors = xhr.responseJSON.errors;

            // purane errors remove karo
            $('.error-text').remove();

            $.each(errors, function (key, value) {
              let input = $('[name="' + key + '"]');

              // input ke baad simple block error
              input.after(
                '<small class="error-text text-red-500 text-xs block mt-1">'
                + value[0] +
                '</small>'
              );
            });
          }
        }
      });
    });

    $(document).ready(function () {

      $('#updateTimingsBtn').click(function (e) {
        e.preventDefault();

        var formData = $('#timingForm').serialize();

        $.ajax({
          url: '{{ route("institute.timings.update", $institute->id) }}', // your update route
          type: 'POST',
          data: formData,

          success: function (res) {
            toastr.success(res.message);
          },

          error: function (xhr) {



            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;

              // purane errors remove karo


              $.each(errors, function (key, value) {
                toastr.error(value[0]);

              });
            }
          }
        });
      });

    });


    $(document).ready(function () {

      $('#courseForm').submit(function (e) {
        e.preventDefault();

        var form = $(this)[0];
        var formData = new FormData(form);

        // Clear previous errors
        $(form).find('.error-text').text('');

        $.ajax({
          url: '{{ route("institute.courses.save") }}',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            toastr.success('Course added successfully!');
            setTimeout(() => {
              location.reload();
            }, 800);
          },
          error: function (xhr) {
            if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;
              $.each(errors, function (key, messages) {
                let input = $('[name="' + key + '"]');
                if (input.length) {
                  input.next('.error-text').text(messages[0]);
                }
              });
              toastr.error('Please fix the errors in the form.');
            } else {
              toastr.error('An unexpected error occurred.');
            }
          }
        });
      });

    });
    $(document).on('click', '.editCourseBtn', function () {

      let url = $(this).data('url');

      $('#editCourseModal').removeClass('hidden');

      $.get(url, function (response) {
        $('#editModalContent').html(response);
      });
    });

    function closeEditModal() {
      document.getElementById('editCourseModal').classList.add('hidden');
    }
    const updateCourseRoute = "{{ route('institute.courses.update') }}";
    $(document).on('submit', '#editCourseForm', function (e) {
      e.preventDefault();

      let form = $(this);
      let id = form.find('input[name="id"]').val();



      let formData = new FormData(this);

      // Clear old errors
      form.find('.error-text').text('');

      $.ajax({
        url: updateCourseRoute,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (response) {
          toastr.success('Course Updated Successfully');

          setTimeout(() => {
            location.reload();
          }, 1200);
        },

        error: function (xhr) {

          if (xhr.status === 422) {
            let errors = xhr.responseJSON.errors;

            $.each(errors, function (key, value) {
              let input = form.find(`[name="${key}"]`);
              input.next('.error-text').text(value[0]);
            });

            toastr.error('Please fix the errors');
          } else {
            toastr.error('Something went wrong');
          }
        }
      });
    });

    document.addEventListener("DOMContentLoaded", function () {
      document.querySelectorAll(".deleteCourseBtn").forEach(button => {
        button.addEventListener("click", function () {
          let url = this.dataset.url;
          let card = this.closest(".course-card");

          if (confirm("Are you sure you want to delete this course?")) {
            fetch(url, {
              method: "DELETE",
              headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Accept": "application/json"
              }
            })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  toastr.success('Course deleted Successfully');
                  card.remove(); // remove card from UI
                } else {
                  toastr.error("Failed to delete course.");
                }
              })
              .catch(error => {
                console.error(error);
                toastr.error("Something went wrong.");
              });
          }
        });
      });
    });
  </script>
  <script>
    $('#galleryForm').on('submit', function (e) {
      e.preventDefault();

      let files = $('#images')[0].files;
      let errorBox = $('#errorBox');
      errorBox.html('');

      // ✅ Frontend Validation
      if (files.length === 0) {
        errorBox.html("Please select at least one image.");
        return;
      }

      if (files.length > 10) {
        errorBox.html("You can upload maximum 10 images at a time.");
        return;
      }

      let formData = new FormData();

      for (let i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
      }

      $.ajax({
        url: "{{ route('gallery.storegallery') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function (response) {
          toastr.success(response.message);
          $('#galleryForm')[0].reset();
          location.reload(); // optional
        },
        error: function (xhr) {
          let errors = xhr.responseJSON.errors;
          let msg = '';

          $.each(errors, function (key, value) {
            msg += value[0] + '<br>';
          });

          errorBox.html(msg);
        }
      });
    });

    $(document).on('click', '.delete-gallery-btn', function () {
      if (!confirm('Are you sure you want to delete this image?')) return;

      let id = $(this).data('id');
      let button = $(this);
      let gallerydeleteurl = "{{ url('institute/gallery') }}";

      $.ajax({
        url: gallerydeleteurl + '/' + id,
        type: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function (response) {
          toastr.success(response.message);
          // Remove image from DOM
          button.closest('div').remove();
        },
        error: function (xhr) {
          toastr.error('Failed to delete image.');
        }
      });
    });

    // Upload Banner
    $('#bannerForm').submit(function (e) {
      e.preventDefault();

      let formData = new FormData(this);

      $.ajax({
        url: "{{ route('institute.banners.store') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,

        success: function (res) {
          toastr.success(res.message);
          location.reload();
        },

        error: function (xhr) {
          toastr.error('Something went wrong');
        }
      });
    });

    // Delete Banner
    $(document).on('click', '.delete-banner', function () {
      let id = $(this).data('id');

      if (confirm('Delete this banner?')) {
        $.ajax({
          url: "/institute/banners/" + id,
          type: "DELETE",
          data: {
            _token: "{{ csrf_token() }}"
          },
          success: function (res) {
            toastr.success(res.message);
            location.reload();
          }
        });
      }
    });


  </script>

@endpush