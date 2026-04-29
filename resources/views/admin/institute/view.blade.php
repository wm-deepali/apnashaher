@include('admin.top-header')

<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" as="style"
    onload="this.onload=null;this.rel='stylesheet'">

<style>
    .analytics-box {
        background: #fff;
        padding: 15px;
        border-radius: 10px;
    }

    .analytics-tabs {
        margin-bottom: 15px;
    }

    .tab-btn {
        padding: 6px 12px;
        border: none;
        background: #eee;
        margin-right: 5px;
        border-radius: 15px;
        cursor: pointer;
    }

    .tab-btn.active {
        background: #007bff;
        color: #fff;
    }

    .analytics-tab {
        display: none;
    }

    .analytics-tab.active {
        display: block;
    }

    .analytics-card {
        background: #f8f9fa;
        padding: 10px;
        margin-bottom: 8px;
        border-radius: 6px;
    }

    .rating-section {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 20px;
    }

    .star-rating {
        display: flex;
        gap: 4px;
        font-size: 1.4rem;
        color: #f59e0b;
    }

    .gallery-container {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        padding: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .gallery-title {
        font-size: 20px;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 20px;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    @media (min-width: 640px) {
        .gallery-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .gallery-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        cursor: pointer;
        transition: 0.3s;
    }

    .gallery-item:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .gallery-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .gallery-item:hover .gallery-img {
        transform: scale(1.05);
    }

    .delete-btn {
        position: absolute;
        top: 8px;
        right: 8px;
        background: red;
        color: white;
        font-size: 12px;
        padding: 5px 10px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        opacity: 0;
        transition: 0.3s;
    }

    .gallery-item:hover .delete-btn {
        opacity: 1;
    }
</style>

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <!-- Breadcrumb -->
        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('voyager.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.manage-institute.index') }}">Manage Institutes</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Institute Details
                    </li>

                </ol>
            </div>

        </div>

        <!-- Content -->
        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">
                <div class="card-body">

                    {{-- BASIC INFO --}}
                    <h4><b>Basic Registration Info</b></h4>

                    <table class="table table-striped table-hover">

                        <tr>
                            <th>Listing Id</th>
                            <td>#{{ $institute->listing_id }}</td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td>{{ ucfirst($institute->name) }}</td>
                        </tr>

                        <tr>
                            <th>Mobile</th>
                            <td>{{ $institute->mobile }}</td>
                        </tr>

                        <tr>
                            <th>Description</th>
                            <td>{{ $institute->description }}</td>
                        </tr>

                        <tr>
                            <th>Profile Address</th>
                            <td>{{ $institute->profile_address }}</td>
                        </tr>

                        <tr>
                            <th>Whatsapp</th>
                            <td>{{ $institute->whatsapp }}</td>
                        </tr>

                        @if($institute->gst_invoice)
                            <tr>
                                <th>GST Number</th>
                                <td>{{ $institute->gstin }}</td>
                            </tr>
                            <tr>
                                <th>Business Name</th>
                                <td>{{ ucfirst($institute->business_name) }}</td>
                            </tr>
                            <tr>
                                <th>Billing Address</th>
                                <td>{{ $institute->billing_address }}</td>
                            </tr>
                            <tr>
                                <th>Invoice Email</th>
                                <td>{{ $institute->invoice_email }}</td>
                            </tr>
                        @endif

                        <tr>
                            <th>State/City</th>
                            <td>{{ $institute->state->name ?? "-" }}<br>{{ $institute->city->name ?? "-" }}</td>
                        </tr>

                        <tr>
                            <th>Category</th>
                            <td>
                                {{ $institute->category->name ?? '' }}
                                @if($institute->subcategory)
                                    ({{ $institute->subcategory->name ?? '' }})
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>
                                @if($institute->status == "approved")
                                    <span class="badge badge-success">Approved</span>
                                @else
                                    {{ ucfirst($institute->status) }}
                                    <form action="{{ route('admin.manage-institute.approve', $institute->id) }}"
                                        method="POST" style="display:inline-block">
                                        @csrf
                                        <button class="btn btn-warning btn-sm">Approve Now</button>
                                    </form>
                                @endif
                            </td>
                        </tr>

                    </table>

                    {{-- TABS --}}

                    <ul class="nav nav-tabs mb-3" role="tablist">

                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#profile">Profile</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#courses">Courses</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#plans">Plans</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#payments">Payments</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#timings">Timings</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#gallery">Gallery</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#leads">Leads</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#reviews">Reviews</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#analytics">Analytics</a>
                        </li>

                    </ul>


                    <div class="tab-content">

                        {{-- PROFILE TAB --}}

                        <div id="profile" class="tab-pane fade show active">

                            <br>

                            <table class="table table-bordered">

                                <tr>
                                    <th>Owner Name</th>
                                    <td>{{ ucfirst($institute->owner_name) }}</td>
                                </tr>

                                <tr>
                                    <th>Designation</th>
                                    <td>{{ $institute->designation }}</td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td>{{ $institute->owner_email }}</td>
                                </tr>

                                <tr>
                                    <th>Established Year</th>
                                    <td>{{ $institute->established_year }}</td>
                                </tr>

                                <tr>
                                    <th>Website</th>
                                    <td>
                                        @if($institute->website)
                                            <a href="{{ $institute->website }}" target="_blank">
                                                {{ $institute->website }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Facebook</th>
                                    <td>
                                        @if($institute->facebook_url)
                                            <a href="{{ $institute->facebook_url }}" target="_blank">
                                                {{ $institute->facebook_url }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Instagram</th>
                                    <td>
                                        @if($institute->instagram_url)
                                            <a href="{{ $institute->instagram_url }}" target="_blank">
                                                {{ $institute->instagram_url }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Youtube</th>
                                    <td>
                                        @if($institute->youtube_url)
                                            <a href="{{ $institute->youtube_url }}" target="_blank">
                                                {{ $institute->youtube_url }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Twitter</th>
                                    <td>
                                        @if($institute->twitter_url)
                                            <a href="{{ $institute->twitter_url }}" target="_blank">
                                                {{ $institute->twitter_url }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                                <tr>
                                    <th>Detailed Information</th>
                                    <td>{{ $institute->detailed_information }}</td>
                                </tr>

                            </table>

                        </div>


                        {{-- COURSES TAB --}}

                        <div id="courses" class="tab-pane fade">

                            <br>

                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Course Name</th>
                                        <th>Duration</th>
                                        <th>Mode</th>
                                        <th>Fee</th>
                                        <th>Seats</th>
                                        <th>Start Date</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($institute->courses as $course)

                                        <tr>

                                            <td>
                                                @if($course->image)
                                                    <img src="{{ asset('storage/' . $course->image) }}"
                                                        alt="{{ $course->name }}" width="80"
                                                        style="border-radius:5px; object-fit:cover;">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </td>

                                            <td>{{ $course->name }}</td>

                                            <td>{{ $course->duration ?? "" }} {{ $course->duration_unit ?? "" }}</td>

                                            <td>{{ $course->mode }}</td>

                                            <td>{{ $course->course_fee }}</td>

                                            <td>{{ $course->available_seats }}</td>

                                            <td>{{ $course->start_date }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal"
                                                    data-target="#shortDescModal" data-desc="{{ $course->short_desc }}">
                                                    Short Description
                                                </button>

                                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#detailModal"
                                                    data-detail="{{ $course->detailed_information }}">
                                                    Detailed Info
                                                </button>
                                            </td>

                                            <td>

                                                <button class="btn btn-primary btn-sm editCourseBtn"
                                                    data-id="{{ $course->id }}">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <button type="submit" class="btn btn-danger btn-sm deleteCourseBtn"
                                                    data-url="{{ route('admin.manage-institute.course.destroy', $course->id) }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

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
                        <div id="payments" class="tab-pane fade">

                            <br>

                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Payment ID</th>
                                        <th>Base</th>
                                        <th>GST</th>
                                        <th>Total</th>
                                        <th>Method</th>
                                        <th>Status</th>
                                        <th>Invoice</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($institute->payments as $payment)

                                        <tr>

                                            <td>{{ $payment->order_id }}</td>

                                            <td>{{ $payment->payment_id ?? '-'}}</td>

                                            <!-- BASE -->
                                            <td>₹{{ number_format($payment->amount, 2) }}</td>

                                            <!-- GST -->
                                            <td>
                                                @if($payment->cgst > 0)
                                                    CGST: ₹{{ number_format($payment->cgst, 2) }}<br>
                                                    SGST: ₹{{ number_format($payment->sgst, 2) }}
                                                @endif

                                                @if($payment->igst > 0)
                                                    IGST: ₹{{ number_format($payment->igst, 2) }}
                                                @endif
                                            </td>

                                            <!-- TOTAL -->
                                            <td><strong>₹{{ number_format($payment->total, 2) }}</strong></td>

                                            <td>{{ ucfirst($payment->method ?? '-') }}</td>

                                            <td>
                                                @if($payment->status == 'success')
                                                    <span class="badge badge-success">Success</span>
                                                @else
                                                    <span class="badge badge-danger">Failed</span>
                                                @endif
                                            </td>

                                            <!-- 🔥 INVOICE BUTTON -->
                                            <td>
                                                @if($payment->status == 'success')
                                                    <a href="{{ route('admin.invoice.show', $payment->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        View Invoice
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>

                                        </tr>

                                    @endforeach
                                </tbody>

                            </table>

                        </div>
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

                                            @foreach($institute->timings as $day => $t)
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
                        <div id="gallery" class="tab-pane fade">
                            <div class="gallery-container">
                                <h3 class="gallery-title">
                                    Gallery ({{count($institute->galleries)}} Images)
                                </h3>

                                <div class="gallery-grid">
                                    @forelse($institute->galleries as $gallery)
                                        <div class="gallery-item">
                                            <img src="{{ asset('storage/' . $gallery->image) }}" class="gallery-img">

                                            <button class="delete-btn deleteGalleryBtn" data-id="{{ $gallery->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    @empty
                                        <p>No Gallery Images Found.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div id="leads" class="tab-pane fade">

                            <br>
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Course</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($institute->leads as $lead)

                                        <tr>

                                            <td>{{ $lead->created_at->format('d M Y, h:i A') }}</td>

                                            <td>{{ $lead->name }}</td>
                                            <td>{{ $lead->email }}</td>

                                            <td>{{ $lead->message }}</td>

                                            <td>{{ $lead->course->name ?? "" }}</td>

                                            <td>{{ $lead->message }}</td>
                                            <td>



                                                <form action="{{ route('admin.manage-institute.lead.destroy', $lead->id) }}"
                                                    method="POST" style="display:inline-block"
                                                    onsubmit="return confirm('Delete this enquiry?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </form>

                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                        <div id="reviews" class="tab-pane fade">

                            <br>
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($institute->reviews as $review)

                                        <tr>

                                            <td>{{ $review->created_at->format('d M Y, h:i A') }}</td>

                                            <td>{{ $review->name }}</td>

                                            <td>{{ $review->mobile }}</td>
                                            <td>
                                                @if($review->rating > 0)
                                                    <div class="star-rating">
                                                        <span class="stars">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= floor($review->rating))
                                                                    <i class="fas fa-star"></i>
                                                                @elseif($i - $review->rating < 1)
                                                                    <i class="fas fa-star-half-alt"></i>
                                                                @else
                                                                    <i class="far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="star-rating">
                                                        No rating
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $review->review ?? "" }}</td>
                                            <td>
                                                @if($review->status == "approved")
                                                    <span class="badge badge-success">Approved</span>
                                                @else
                                                    {{ucfirst($review->status)}}
                                                    <form
                                                        action="{{ route('admin.manage-institute.approve-review', $review->id) }}"
                                                        method="POST" style="display:inline-block">
                                                        @csrf
                                                        <button class="btn btn-warning btn-sm">
                                                            Approve Now
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>



                                                <form
                                                    action="{{ route('admin.manage-institute.review.destroy', $review->id) }}"
                                                    method="POST" style="display:inline-block"
                                                    onsubmit="return confirm('Delete this review?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                </form>

                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                        <div id="analytics" class="tab-pane fade">

                            <br>

                            <div class="analytics-box">

                                <h4>Analytics</h4>

                                <!-- Buttons -->
                                <div class="analytics-tabs">
                                    <button class="tab-btn active" data-tab="7">7 Days</button>
                                    <button class="tab-btn" data-tab="15">15 Days</button>
                                    <button class="tab-btn" data-tab="30">30 Days</button>
                                    <button class="tab-btn" data-tab="all">All Time</button>
                                </div>

                                <!-- 7 Days -->
                                <div class="analytics-tab active" id="tab-7">
                                    <div class="analytics-card">📞 Calls:
                                        {{ data_get($institute, 'analytics_data.7.calls', 0) }}
                                    </div>
                                    <div class="analytics-card">💬 WhatsApp:
                                        {{ data_get($institute, 'analytics_data.7.whatsapp', 0) }}
                                    </div>
                                    <div class="analytics-card">👁 Views:
                                        {{ data_get($institute, 'analytics_data.7.views', 0) }}
                                    </div>
                                </div>

                                <!-- 15 Days -->
                                <div class="analytics-tab" id="tab-15">
                                    <div class="analytics-card">📞 Calls:
                                        {{ data_get($institute, 'analytics_data.15.calls', 0) }}
                                    </div>
                                    <div class="analytics-card">💬 WhatsApp:
                                        {{ data_get($institute, 'analytics_data.15.whatsapp', 0) }}
                                    </div>
                                    <div class="analytics-card">👁 Views:
                                        {{ data_get($institute, 'analytics_data.15.views', 0) }}
                                    </div>
                                </div>

                                <!-- 30 Days -->
                                <div class="analytics-tab" id="tab-30">
                                    <div class="analytics-card">📞 Calls:
                                        {{ data_get($institute, 'analytics_data.30.calls', 0) }}
                                    </div>
                                    <div class="analytics-card">💬 WhatsApp:
                                        {{ data_get($institute, 'analytics_data.30.whatsapp', 0) }}
                                    </div>
                                    <div class="analytics-card">👁 Views:
                                        {{ data_get($institute, 'analytics_data.30.views', 0) }}
                                    </div>
                                </div>

                                <!-- All Time -->
                                <div class="analytics-tab" id="tab-all">
                                    <div class="analytics-card">📞 Calls:
                                        {{ data_get($institute, 'analytics_data.all.calls', 0) }}
                                    </div>
                                    <div class="analytics-card">💬 WhatsApp:
                                        {{ data_get($institute, 'analytics_data.all.whatsapp', 0) }}
                                    </div>
                                    <div class="analytics-card">👁 Views:
                                        {{ data_get($institute, 'analytics_data.all.views', 0) }}
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>


                </div>
            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="shortDescModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Short Description</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p id="shortDescContent"></p>
            </div>

        </div>
    </div>
</div>


<!-- Detailed Info Modal -->
<div class="modal fade" id="detailModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Detailed Information</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p id="detailContent"></p>
            </div>

        </div>
    </div>
</div>

<!-- Course Modal --->
<div class="modal fade" id="editCourseModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4>Edit Course</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" id="editCourseBody">

                <!-- AJAX form will load here -->

            </div>

        </div>
    </div>
</div>

<!--- Update Timing Modal ---->
<div class="modal fade" id="editTimingModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4>Edit Timing</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body" id="editTimingBody">

                Loading...

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

<!-- jQuery FIRST -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>

    $('#shortDescModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var desc = button.data('desc');

        $('#shortDescContent').text(desc);

    });


    $('#detailModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var detail = button.data('detail');

        $('#detailContent').text(detail);

    });

</script>
<script>


    $(document).on('click', '.editCourseBtn', function () {

        let course_id = $(this).data('id');

        console.log(course_id); // check click working

        $('#editCourseModal').modal('show');

        $.ajax({
            url: "{{ url('admin/manage-institute/course') }}/" + course_id + "/edit",

            type: "GET",

            success: function (response) {

                $('#editCourseBody').html(response);

            },

            error: function () {

                alert("Error loading course");

            }

        });

    });

</script>
<script>

    $(document).on('submit', '#courseUpdateForm', function (e) {

        e.preventDefault();

        let formData = new FormData(this);
        let course_id = $(this).data('id');

        $.ajax({

            url: "{{ url('admin/manage-institute/course/update') }}/" + course_id,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (res) {

                alert(res.message);

                location.reload();

            }

        });

    });

</script>
<script>

    $(document).on('click', '.editTimingBtn', function () {

        let timing_id = $(this).data('id');

        $('#editTimingModal').modal('show');

        $.ajax({

            url: "{{ url('admin/manage-institute/timing') }}/" + timing_id + "/edit",

            type: "GET",

            success: function (response) {

                $('#editTimingBody').html(response);

            }

        });

    });

    $(document).on('submit', '#timingUpdateForm', function (e) {

        e.preventDefault();

        let form = $(this);
        let formData = new FormData(this);

        $.ajax({

            url: form.attr('action'),
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,

            success: function (res) {

                alert(res.message);
                location.reload();

            }

        });

    });
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {

            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.analytics-tab').forEach(t => t.classList.remove('active'));

            this.classList.add('active');
            document.getElementById('tab-' + this.dataset.tab).classList.add('active');
        });
    });
</script>

<script>
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
</script>

@include('admin.footer')