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

                    <form method="POST" action="{{ isset($institute)
    ? route('admin.institutes-full.update', $institute->id)
    : route('admin.institutes-full.store') }}">

                        @csrf
                        @if(isset($institute))
                            @method('PUT')
                        @endif

                        <div class="panel-body">

                            <input type="hidden" name="ins_plan_id" class="form-control"
                                value="{{ $institute->activePlan->id ?? '' }}">

                            <input type="hidden" name="payment_id" class="form-control"
                                value="{{ $institute->activePlan->payment->id ?? '' }}">
                            <!-- Institute Name -->
                            <div class="form-group">
                                <label>Institute Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ $institute->name ?? '' }}"
                                    required>
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
                                        <option value="{{ $state->id }}" {{ isset($institute) && $institute->state_id == $state->id ? 'selected' : '' }}> {{ $state->name }}
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
                                <input type="text" id="mobile" name="mobile" value="{{ $institute->mobile ?? '' }}"
                                    class="form-control" required>

                                <small id="mobileError" style="color:red; display:none;">
                                    Mobile already exists!
                                </small>
                            </div>

                            <!-- WhatsApp -->
                            <div class="form-group">
                                <label>WhatsApp</label>
                                <input type="text" name="whatsapp" class="form-control"
                                    value="{{ $institute->whatsapp ?? '' }}">
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
                                <label>Subcategory</label>
                                <select class="form-control" id="subcategory_id" name="subcategory_id">
                                    <option value="">Select Subcategory</option>
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description"
                                    class="form-control">{{ $institute->description ?? '' }}</textarea>
                            </div>

                            <!-- Plan -->
                            <div class="form-group">
                                <label>Select Plan</label>
                                <select class="form-control" name="plan_id" id="plan_id">
                                    <option value="">Select Plan</option>
                                    @foreach($packages as $package)
                                        <option value="{{ $package->id }}" data-price="{{ $package->offered_price }}" {{ (isset($institute) && optional($institute->activePlan)->plan_id == $package->id) ? 'selected' : '' }}> {{ $package->name }} -
                                            ₹{{ $package->formatted_offered_price }}/Year
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="paymentSection" style="display:none;">

                                <div class="form-group">
                                    <label>Transaction ID *</label>
                                    <input type="text" name="transaction_id" id="transaction_id" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Payment Method *</label>
                                    <select name="payment_method" id="payment_method" class="form-control">
                                        <option value="">Select Method</option>
                                        <option value="upi">UPI</option>
                                        <option value="card">Card</option>
                                        <option value="netbanking">Net Banking</option>
                                        <option value="cash">Cash</option>
                                    </select>
                                </div>

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

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($institute) ? 'Update' : 'Save' }}
                            </button>
                            <a href="{{ route('admin.manage-institute.index') }}" class="btn btn-default">
                                Cancel
                            </a>
                        </div>

                    </form>


                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

            if (price > 0) {
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

        function loadSubcategories(category_id) {
            if (category_id) {
                let subcateurl = "{{ url('/admin/get-subcategories/') }}/";
                $.get(subcateurl + category_id, function (data) {
                    let options = '<option value="">Select Subcategory</option>';

                    data.forEach(function (sub) {
                        options += `<option value="${sub.id}" 
                        ${sub.id == selectedSubcategory ? 'selected' : ''}>
                        ${sub.name}
                    </option>`;
                    });

                    $('#subcategory_id').html(options);
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
</script>

@include('admin.footer')