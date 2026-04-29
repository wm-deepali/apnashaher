@include('admin.top-header')

<style>
    .form-check {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
    }

    .form-check-input {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }

    .form-check-label {
        margin: 0;
        cursor: pointer;
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

    .subcategory-multi-select label {
        display: flex;
        align-items: center;
    }
</style>

@section('page_title', isset($institute) ? 'Edit Institute' : 'Add Institute')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('voyager.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.manage-institute.index') }}">Manage Institute</a>
                    </li>

                    <li class="breadcrumb-item active">
                        {{ isset($institute) ? 'Edit Institute' : 'Add Institute' }}
                    </li>

                </ol>
            </div>

        </div>


        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong> {{ isset($institute) ? 'Edit Institute' : 'Add Institute' }}</strong>
                </div>

                <div class="card-body">

                    <!-- ✅ TABS -->
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#basic">Basic Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#courses">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#gallery">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#banners">Banners</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#timings">Timings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#plans">Plans</a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <!-- ================= BASIC TAB ================= -->
                        <div id="basic" class="tab-pane fade show active">

                            <form method="POST" action="{{ isset($institute)
    ? route('admin.institutes-full.update', $institute->id)
    : route('admin.institutes-full.store') }}">
                                @csrf
                                @if(isset($institute)) @method('PUT') @endif

                                <div class="panel-body">

                                    <input type="hidden" name="ins_plan_id" class="form-control"
                                        value="{{ $institute->activePlan->id ?? '' }}">

                                    <input type="hidden" name="payment_id" class="form-control"
                                        value="{{ $institute->activePlan->payment->id ?? '' }}">
                                    <!-- Institute Name -->
                                    <div class="form-group">
                                        <label>Institute Name *</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $institute->name ?? '' }}" required>
                                    </div>

                                    <!-- Country -->
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" class="form-control" value="India" readonly>
                                    </div>

                                    <!-- State -->
                                    <div class="form-group">
                                        <label>State *</label>
                                        <select class="form-control" id="state_id" name="state_id" required>
                                            <option value="">Select State</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}" {{ isset($institute) && $institute->state_id == $state->id ? 'selected' : '' }}>
                                                    {{ $state->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- City -->
                                    <div class="form-group">
                                        <label>City *</label>
                                        <select class="form-control" id="city_id" name="city_id" required>
                                            <option value="">Select City</option>
                                        </select>
                                    </div>

                                    <!-- Mobile -->
                                    <div class="form-group">
                                        <label>Mobile *</label>
                                        <input type="text" id="mobile" name="mobile"
                                            value="{{ $institute->mobile ?? '' }}" class="form-control" required>

                                        <small id="mobileError" style="color:red; display:none;">
                                            Mobile already exists!
                                        </small>
                                    </div>

                                    <!-- WhatsApp -->
                                    <div class="form-group">
                                        <label>WhatsApp</label>
                                        <input type="text" id="whatsapp" name="whatsapp" class="form-control"
                                            value="{{ $institute->whatsapp ?? '' }}">

                                        <small id="whatsappError" style="color:red; display:none;">
                                            WhatsApp already exists!
                                        </small>
                                    </div>

                                    <!-- Category -->
                                    <div class="form-group">
                                        <label>Category *</label>
                                        <select class="form-control" id="category_id" name="category_id" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ isset($institute) && $institute->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Subcategory -->
                                    <div class="form-group">
                                        <label>Sub Categories</label>

                                        <div id="subcategoryContainer"
                                            class="subcategory-multi-select border border-gray-300 rounded-xl p-4 bg-white min-h-[140px] max-h-[320px] overflow-auto">

                                            <div id="subcategoryCheckboxes" class="space-y-3">
                                                <!-- Dynamic checkboxes will come here -->
                                            </div>
                                        </div>


                                        <!-- Hidden input to store selected IDs -->
                                        <input type="hidden" name="subcategory_id" id="subcategory_id">
                                    </div>

                                    <!-- Description -->
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description"
                                            class="form-control">{{ $institute->description ?? '' }}</textarea>
                                    </div>

                                    <!-- GST -->

                                    <div class="form-check mb-4">
                                        <input type="checkbox" id="gstCheck" name="gstCheck" class="form-check-input" {{ isset($institute) && $institute->gst_invoice ? 'checked' : '' }}>
                                        <label class="form-check-label"> I need a GST Invoice</label>
                                    </div>

                                    <!-- GST Details -->
                                    <div id="gstDetails" style="display:none;">
                                        <div class="form-group">
                                            <label>GSTIN</label>
                                            <input type="text" name="gstin" class="form-control"
                                                value="{{ $institute->gstin ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Business Name</label>
                                            <input type="text" name="business_name" class="form-control"
                                                value="{{ $institute->business_name ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Billing Address</label>
                                            <textarea name="billing_address"
                                                class="form-control">{{ $institute->billing_address ?? '' }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Email for Invoice</label>
                                            <input type="email" name="invoice_email" class="form-control"
                                                value="{{ $institute->invoice_email ?? '' }}">
                                        </div>
                                    </div>

                                    <!-- Terms -->


                                </div>

                                <button class="btn btn-primary">Save</button>

                            </form>

                        </div>

                        <!-- ================= COURSES ================= -->
                        <div id="courses" class="tab-pane fade">

                            <!-- ================= ADD COURSE ================= -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-light">
                                    <strong id="courseFormTitle">Add Course</strong>
                                </div>

                                <div class="card-body">

                                    @if($remainingCourses > 0)

                                        <form id="courseForm" method="POST"
                                            action="{{ route('admin.manage-institute.course.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="institute_id" value="{{ $institute->id }}">
                                            <input type="hidden" name="plan_id"
                                                value="{{ optional(optional($institute->latestPlan)->plan)->id }}">
                                            <input type="hidden" name="id" id="course_id">

                                            <div class="row">

                                                <!-- Course Name -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Course Name *</label>
                                                        <input type="text" name="name" class="form-control" required>
                                                    </div>
                                                </div>

                                                <!-- Mode -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Mode *</label>
                                                        <select name="mode" class="form-control" required>
                                                            <option value="">Select</option>
                                                            <option>Online</option>
                                                            <option>Offline</option>
                                                            <option>Hybrid</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Duration -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Duration *</label>
                                                        <input type="number" name="duration" class="form-control">
                                                    </div>
                                                </div>

                                                <!-- Duration Unit -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Duration Unit *</label>
                                                        <select name="duration_unit" class="form-control">
                                                            <option>Days</option>
                                                            <option>Months</option>
                                                            <option>Years</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Fees -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Course Fees *</label>
                                                        <input type="number" name="course_fee" class="form-control">
                                                    </div>
                                                </div>

                                                <!-- Seats -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Available Seats *</label>
                                                        <input type="number" name="available_seats" class="form-control">
                                                    </div>
                                                </div>

                                                <!-- Start Date -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Start Date</label>
                                                        <input type="date" name="start_date" class="form-control">
                                                    </div>
                                                </div>

                                                <!-- Image -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Course Image</label>
                                                        <input type="file" name="thumb_image" class="form-control">
                                                    </div>
                                                </div>

                                                <!-- Short Desc -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Short Description *</label>
                                                        <textarea name="short_desc" class="form-control"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Detailed Content -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Detailed Content</label>
                                                        <textarea name="detailed_information"
                                                            class="form-control"></textarea>
                                                    </div>
                                                </div>

                                                <!-- Submit -->
                                                <div class="col-md-12 text-right">
                                                    <button id="courseSubmitBtn" class="btn btn-primary px-4">Add
                                                        Course</button>
                                                </div>

                                            </div>

                                        </form>

                                    @else
                                        <div class="alert alert-warning text-center">
                                            Course limit reached
                                        </div>
                                    @endif

                                </div>
                            </div>


                            <!-- ================= COURSE LIST ================= -->
                            <div class="card shadow-sm">
                                <div class="card-header bg-light d-flex justify-content-between">
                                    <strong>Courses</strong>
                                    <span>Total: {{ count($courses) }}</span>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">

                                        <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Mode</th>
                                                <th>Duration</th>
                                                <th>Fees</th>
                                                <th>Seats</th>
                                                <th width="120">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse($courses as $course)
                                                <tr>

                                                    <td>
                                                        <strong>{{ $course->name }}</strong><br>
                                                        <small class="text-muted">{{ $course->short_desc }}</small>
                                                    </td>

                                                    <td>{{ $course->mode }}</td>
                                                    <td>{{ $course->duration }} {{ $course->duration_unit }}</td>
                                                    <td>₹{{ $course->course_fee }}</td>
                                                    <td>{{ $course->available_seats }}</td>

                                                    <td>
                                                        <button class="btn btn-sm btn-info editCourseBtn"
                                                            data-url="{{ route('admin.manage-institute.course.edit', $course->id) }}">
                                                            Edit
                                                        </button>

                                                        <button class="btn btn-sm btn-danger deleteCourseBtn"
                                                            data-url="{{ route('admin.manage-institute.course.destroy', $course->id) }}">
                                                            Delete
                                                        </button>
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted">No courses</td>
                                                </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        </div>

                        <!-- ================= GALLERY ================= -->
                        <div id="gallery" class="tab-pane fade">

                            <div class="card shadow-sm mb-4">
                                <div class="card-header">
                                    <strong>Upload Images</strong>
                                </div>

                                <div class="card-body">

                                    <form id="galleryForm" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="institute_id" value="{{ $institute->id }}">

                                        <div class="form-group">
                                            <label>Select Images</label>
                                            <input type="file" name="images[]" multiple class="form-control">
                                            <small class="text-muted">You can upload multiple images</small>
                                        </div>

                                        <button class="btn btn-success">Upload</button>

                                    </form>

                                </div>
                            </div>


                            <!-- GALLERY GRID -->
                            <div class="card shadow-sm">
                                <div class="card-header d-flex justify-content-between">
                                    <strong>Gallery</strong>
                                    <span>Total: {{ count($galleries) }}</span>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        @forelse($galleries as $img)
                                            <div class="col-md-3 mb-3">

                                                <div class="border p-2 text-center position-relative">

                                                    <img src="{{ asset('storage/' . $img->image) }}" class="img-fluid mb-2"
                                                        style="height:150px; object-fit:cover;">

                                                    <button class="btn btn-sm btn-danger deleteGalleryBtn"
                                                        data-id="{{ $img->id }}">
                                                        Delete
                                                    </button>

                                                </div>

                                            </div>
                                        @empty
                                            <p class="text-muted">No images found</p>
                                        @endforelse

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- ================= BANNERS ================= -->
                        <div id="banners" class="tab-pane fade">

                            <!-- Upload -->
                            <div class="card shadow-sm mb-4">
                                <div class="card-header">
                                    <strong>Add Banner / Slider</strong>
                                </div>

                                <div class="card-body">

                                    <form id="bannerForm" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="institute_id" value="{{ $institute->id }}">

                                        <div class="row">

                                            <div class="col-md-6">
                                                <label>Banner Image *</label>
                                                <input type="file" name="image" class="form-control" required>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control">
                                            </div>

                                            <div class="col-md-6 mt-3">
                                                <label>Redirect Link</label>
                                                <input type="url" name="link" class="form-control">
                                            </div>

                                            <div class="col-md-12 text-right mt-3">
                                                <button class="btn btn-primary">Upload Banner</button>
                                            </div>

                                        </div>

                                    </form>

                                </div>
                            </div>


                            <!-- Banner List -->
                            <div class="card shadow-sm">
                                <div class="card-header d-flex justify-content-between">
                                    <strong>Banners</strong>
                                    <span>Total: {{ count($banners) ?? 0 }}</span>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        @forelse($banners as $banner)
                                            <div class="col-md-3 mb-3">

                                                <div class="border p-2 text-center position-relative">

                                                    <img src="{{ asset('storage/' . $banner->image) }}"
                                                        class="img-fluid mb-2" style="height:150px; object-fit:cover;">

                                                    <button class="btn btn-sm btn-danger deleteBannerBtn"
                                                        data-id="{{ $banner->id }}">
                                                        Delete
                                                    </button>

                                                </div>

                                            </div>
                                        @empty
                                            <p class="text-muted">No banners found</p>
                                        @endforelse

                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- ================= TIMINGS ================= -->
                        <div id="timings" class="tab-pane fade">

                            <div class="card shadow-sm">
                                <div class="card-header d-flex justify-content-between">
                                    <strong>Timing & Working Hours</strong>
                                </div>

                                <div class="card-body">

                                    <form method="POST" action="{{ route('admin.manage-institute.timings.update') }}">
                                        @csrf

                                        <input type="hidden" name="institute_id" value="{{ $institute->id }}">

                                        <div class="row">

                                            @foreach($timings as $day => $t)
                                                <div class="col-md-6 mb-3">

                                                    <div class="border rounded p-3 h-100">

                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <strong>{{ $day }}</strong>

                                                            <label class="mb-0">
                                                                <input type="checkbox" name="timings[{{ $day }}][is_active]"
                                                                    value="1" {{ $t->is_active ? 'checked' : '' }}>
                                                                Active
                                                            </label>
                                                        </div>

                                                        <div class="form-row">

                                                            <div class="col">
                                                                <label>Open</label>
                                                                <input type="time" name="timings[{{ $day }}][open_time]"
                                                                    value="{{ $t->open_time }}" class="form-control">
                                                            </div>

                                                            <div class="col">
                                                                <label>Close</label>
                                                                <input type="time" name="timings[{{ $day }}][close_time]"
                                                                    value="{{ $t->close_time }}" class="form-control">
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="text-right mt-3">
                                            <button class="btn btn-primary">Save Timings</button>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>


                        <div id="plans" class="tab-pane fade">

                            <br>

                            <div class="mb-3">
                                <button class="btn btn-success" data-toggle="modal" data-target="#upgradePlanModal">
                                    Upgrade Plan
                                </button>
                            </div>

                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>Plan</th>
                                        <th>Price</th>
                                        <th>Start Date</th>
                                        <th>Expiry Date</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($institute->plans as $plan)

                                        <tr>

                                            <td>{{ $plan->plan->name ?? '' }}</td>

                                            <td>{{ $plan->price }}</td>

                                            <td>{{ $plan->start_date->format('d M Y') }}</td>

                                            <td>{{ $plan->expiry_date->format('d M Y') }}</td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>

</div>


<div class="modal fade" id="upgradePlanModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4>Upgrade Plan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <select id="plan_id" class="form-control mb-3">
                    <option value="">Select Plan</option>
                    @foreach(\App\Models\Package::all() as $pkg)
                        <option value="{{ $pkg->id }}">
                            {{ $pkg->name }} - ₹{{ $pkg->offered_price }}
                        </option>
                    @endforeach
                </select>

                <!-- 🔥 Payment Method -->
                <select id="payment_method" class="form-control mb-3">
                    <option value="">Select Method</option>
                    <option value="upi">UPI</option>
                    <option value="card">Card</option>
                    <option value="netbanking">Net Banking</option>
                    <option value="cash">Cash</option>
                </select>

                <!-- 🔥 Transaction ID -->
                <input type="text" id="transaction_id" class="form-control mb-3"
                    placeholder="Transaction ID (optional for cash)">

                <button onclick="adminUpgrade({{ $institute->id }})" class="btn btn-primary w-100">
                    Submit
                </button>

            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    let selectedCity = "{{ $institute->city_id ?? '' }}";
    let selectedSubcategory = "{{ $institute->subcategory_id ?? '' }}";

    $(document).ready(function () {

        // ✅ GST Toggle
        $('#gstCheck').change(function () {
            $('#gstDetails').toggle($(this).is(':checked'));
        }).trigger('change');

        // ✅ Payment Toggle
        function togglePaymentSection() {
            let price = parseFloat($('#plan_id option:selected').data('price')) || 0;

            if (price > 0 || $('#transaction_id').val()) {
                $('#paymentSection').show();
                $('#transaction_id').attr('required', true);
                $('#payment_method').attr('required', true);
            } else {
                $('#paymentSection').hide();
                $('#transaction_id').removeAttr('required');
                $('#payment_method').removeAttr('required');
            }
        }

        $('#plan_id').change(togglePaymentSection);
        togglePaymentSection(); // page load

        // Load cities based on selected state
        function loadCities(state_id) {
            $('#city_id').html('<option value="">Loading...</option>');
            if (state_id) {
                let stateeurl = "{{ url('/admin/get-cities/') }}/";
                $.get(stateeurl + state_id, function (data) {
                    let options = '<option value="">Select City</option>';

                    data.forEach(function (city) {
                        options += `<option value="${city.id}" 
                        ${city.id == selectedCity ? 'selected' : ''}>
                        ${city.name}
                    </option>`;
                    });
                    $('#city_id').html(options);
                });
            }
        }

        $(document).on('change', '.subcat-checkbox', function () {
            updateSelectedSubcategories();
        });

        function updateSelectedSubcategories() {
            let selected = [];

            $('.subcat-checkbox:checked').each(function () {
                selected.push($(this).val());
            });

            $('#subcategory_id').val(selected.join(','));
        }

        function loadSubcategories(category_id) {
            if (category_id) {
                let subcateurl = "{{ url('/admin/get-subcategories/') }}/";

                $.get(subcateurl + category_id, function (data) {

                    let html = '';
                    let selected = (selectedSubcategory || '').split(',');

                    data.forEach(function (sub) {
                        let checked = selected.includes(String(sub.id)) ? 'checked' : '';

                        html += `
                    <label>
                        <input type="checkbox" value="${sub.id}" ${checked} class="subcat-checkbox">
                        <span>${sub.name}</span>
                    </label>
                `;
                    });

                    $('#subcategoryCheckboxes').html(html);

                    updateSelectedSubcategories();
                });
            }
        }

        // ✅ Change Events
        $('#state_id').change(function () {
            selectedCity = '';
            loadCities($(this).val());
        });

        $('#category_id').change(function () {
            selectedSubcategory = '';
            loadSubcategories($(this).val());
        });

        // ✅ Page Load (EDIT FIX)
        let state_id = $('#state_id').val();
        let category_id = $('#category_id').val();

        if (state_id) {
            loadCities(state_id);
        }

        if (category_id) {
            loadSubcategories(category_id);
        }

    });
    let mobileExists = false;

    $('#mobile').on('blur', function () {
        let mobile = $(this).val();

        if (mobile.length === 10) {
            let mobileUrl = "{{ url('admin/institutes/check-mobile') }}/";
            $.get(mobileUrl, { mobile: mobile }, function (response) {

                if (response == 1) {
                    $('#mobileError').show();
                    mobileExists = true;
                } else {
                    $('#mobileError').hide();
                    mobileExists = false;
                }

            });
        }
    });

    let whatsappExists = false;

    $('#whatsapp').on('blur', function () {
        let whatsapp = $(this).val();

        if (whatsapp.length === 10) {
            let url = "{{ url('admin/institutes/check-whatsapp') }}";

            $.get(url, { whatsapp: whatsapp }, function (response) {

                if (response == 1) {
                    $('#whatsappError').show();
                    whatsappExists = true;
                } else {
                    $('#whatsappError').hide();
                    whatsappExists = false;
                }

            });
        }
    });

    $('form').on('submit', function (e) {
        if (mobileExists) {
            alert("Mobile number already exists!");
            e.preventDefault();
        }

        if (whatsappExists) {
            alert("WhatsApp number already exists!");
            e.preventDefault();
        }
    });
</script>

<script>
    $('.nav-tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $(document).on('click', '.editCourseBtn', function () {

        let url = $(this).data('url');

        $.get(url, function (res) {

            $('#course_id').val(res.id);
            $('input[name="name"]').val(res.name);
            $('select[name="mode"]').val(res.mode);
            $('input[name="duration"]').val(res.duration);
            $('select[name="duration_unit"]').val(res.duration_unit);
            $('input[name="course_fee"]').val(res.course_fee);
            $('input[name="available_seats"]').val(res.available_seats);
            $('input[name="start_date"]').val(res.start_date);
            $('textarea[name="short_desc"]').val(res.short_desc);
            $('textarea[name="detailed_information"]').val(res.detailed_information);

            // 🔥 CHANGE FORM ACTION
            $('#courseForm').attr('action', '/admin/manage-institute/course/update/' + res.id);

            // 🔥 CHANGE HEADING + BUTTON
            $('#courseFormTitle').text('Edit Course');
            $('#courseSubmitBtn').text('Update Course');

        });

    });

    $(document).on('click', '.deleteCourseBtn', function () {

        let url = $(this).data('url');
        let row = $(this).closest('tr'); // table row

        if (confirm('Are you sure you want to delete this course?')) {

            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (res) {

                    // remove row from UI
                    row.fadeOut(300, function () {
                        $(this).remove();
                    });

                    alert('Course deleted successfully');

                },
                error: function () {
                    alert('Something went wrong');
                }
            });

        }

    });


    // 🔥 UPLOAD (AJAX)
    $('#galleryForm').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.manage-institute.gallery.store') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,

            success: function (res) {
                alert('Uploaded successfully');
                location.reload(); // simple refresh
            },

            error: function (err) {
                alert('Upload failed');
            }
        });
    });


    // 🔥 DELETE
    $(document).on('click', '.deleteGalleryBtn', function () {

        let id = $(this).data('id');
        let box = $(this).closest('.col-md-3, .group');

        if (confirm('Delete image?')) {

            $.ajax({
                url: '/admin/manage-institute/gallery/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },

                success: function () {
                    box.fadeOut(300, function () {
                        $(this).remove();
                    });
                }
            });

        }

    });

    function adminUpgrade(instituteId) {

        let planId = document.getElementById('plan_id').value;
        let method = document.getElementById('payment_method').value;
        let txn = document.getElementById('transaction_id').value;

        if (!planId) {
            alert('Select plan');
            return;
        }

        if (!method) {
            alert('Select payment method');
            return;
        }

        if (method !== 'cash' && !txn) {
            alert('Transaction ID required');
            return;
        }

        fetch('/admin/upgrade-plan', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                institute_id: instituteId,
                plan_id: planId,
                method: method,
                transaction_id: txn
            })
        })
            .then(res => res.json())
            .then(data => {

                if (!data.status) {
                    alert(data.message);
                    return;
                }

                alert('Plan upgraded successfully');
                location.reload();
            });
    }

    // 🔥 BANNER UPLOAD
    $('#bannerForm').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('admin.manage-institute.banner.store') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (res) {
                alert('Banner uploaded');
                location.reload();
            },

            error: function () {
                alert('Upload failed');
            }
        });
    });


    // 🔥 DELETE BANNER
    $(document).on('click', '.deleteBannerBtn', function () {

        let id = $(this).data('id');
        let box = $(this).closest('.col-md-3');

        if (confirm('Delete banner?')) {

            $.ajax({
                url: '/admin/manage-institute/banner/' + id,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },

                success: function () {
                    box.fadeOut(300, function () {
                        $(this).remove();
                    });
                }
            });

        }

    });

</script>