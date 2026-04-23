<form id="editCourseForm" enctype="multipart/form-data">
    @csrf
    

    <input type="hidden" name="id" value="{{ $course->id }}">
    <input type="hidden" name="institute_id" value="{{ $course->institute_id }}">
    <input type="hidden" name="plan_id" value="{{ $course->plan_id }}">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Course Name -->
        <div>
            <label class="label">Course Name *</label>
            <input type="text" name="name" value="{{ $course->name }}" class="input w-full">
            <span class="error-text text-red-600 text-sm"></span>
        </div>

        <!-- Duration -->
        <div class="flex gap-4">
            <div class="w-1/2">
                <label class="label">Duration *</label>
                <input type="text" name="duration" value="{{ $course->duration }}" class="input w-full">
                <span class="error-text text-red-600 text-sm"></span>
            </div>

            <div class="w-1/2">
                <label class="label">Duration Unit *</label>
                <select name="duration_unit" class="input w-full">
                    <option value="">Select</option>
                    <option value="Days" {{ $course->duration_unit=='Days'?'selected':'' }}>Days</option>
                    <option value="Months" {{ $course->duration_unit=='Months'?'selected':'' }}>Months</option>
                    <option value="Years" {{ $course->duration_unit=='Years'?'selected':'' }}>Years</option>
                </select>
                <span class="error-text text-red-600 text-sm"></span>
            </div>
        </div>

        <!-- Fees -->
        <div>
            <label class="label">Course Fees *</label>
            <input type="number" name="course_fee" value="{{ $course->course_fee }}" class="input w-full">
            <span class="error-text text-red-600 text-sm"></span>
        </div>

        <!-- Mode -->
        <div>
            <label class="label">Mode *</label>
            <select name="mode" class="input w-full">
                <option value="">Select</option>
                <option value="Online" {{ $course->mode=='Online'?'selected':'' }}>Online</option>
                <option value="Offline" {{ $course->mode=='Offline'?'selected':'' }}>Offline</option>
                <option value="Both (Hybrid)" {{ $course->mode=='Both (Hybrid)'?'selected':'' }}>Hybrid</option>
            </select>
            <span class="error-text text-red-600 text-sm"></span>
        </div>

        <!-- Start Date -->
        <div>
            <label class="label">Start Date</label>
            <input type="date" name="start_date" value="{{ $course->start_date }}" class="input w-full">
            <span class="error-text text-red-600 text-sm"></span>
        </div>

        <!-- Seats -->
        <div>
            <label class="label">Available Seats</label>
            <input type="number" name="available_seats" value="{{ $course->available_seats }}" class="input w-full">
            <span class="error-text text-red-600 text-sm"></span>
        </div>

        <!-- Short Desc -->
        <div class="md:col-span-2">
            <label class="label">Short Description *</label>
            <textarea name="short_desc" class="input w-full h-24">{{ $course->short_desc }}</textarea>
            <span class="error-text text-red-600 text-sm"></span>
        </div>

        <!-- Detailed -->
        <div class="md:col-span-2">
            <label class="label">Detailed Info</label>
            <textarea name="detailed_information" class="input w-full h-32">{{ $course->detailed_information }}</textarea>
            <span class="error-text text-red-600 text-sm"></span>
        </div>

        <!-- Thumbnail -->
        <div class="md:col-span-2">
            <img src="{{ $course->thumb_image }}" class="w-40 mb-2 rounded">
            <input type="file" name="thumb_image">
            <span class="error-text text-red-600 text-sm"></span>
        </div>

        <!-- Submit -->
        <div class="md:col-span-2 text-right">
            <button class="bg-indigo-600 text-white px-6 py-2 rounded-lg">
                Update Course
            </button>
        </div>
    </div>
</form>