@extends('vendor.voyager.master')

@section('page_title', isset($institute) ? 'Edit Institute' : 'Add Institute')

@section('breadcrumbs')
<ol class="breadcrumb">
    <li>
        <a href="{{ route('voyager.dashboard') }}">
            <i class="voyager-home"></i> Dashboard
        </a>
    </li>
    <li class="active">
        {{ isset($institute) ? 'Edit Institute' : 'Add Institute' }}
    </li>
</ol>
@endsection

@section('page_header')
<h1 class="page-title">
    <i class="voyager-list"></i>
    {{ isset($institute) ? 'Edit Institute' : 'Add Institute' }}
</h1>
@stop

@section('content')

<div class="page-content container-fluid">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin-bottom:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-bordered">

                <form method="POST"
                      action="{{ isset($institute) 
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
                                    <option value="{{ $state->id }}"
                                        {{ isset($institute) && $institute->state_id == $state->id ? 'selected' : '' }}>
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
                            <input type="text" id="mobile" name="mobile" value="{{ $institute->mobile ?? '' }}" class="form-control" required>

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
                                    <option value="{{ $category->id }}"
                                        {{ isset($institute) && $institute->category_id == $category->id ? 'selected' : '' }}>
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
                            <textarea name="description" class="form-control">{{ $institute->description ?? '' }}</textarea>
                        </div>

                        <!-- Plan -->
                        <div class="form-group">
                            <label>Select Plan</label>
                            <select class="form-control" name="plan_id" id="plan_id">
                                <option value="">Select Plan</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}"
                                        data-price="{{ $package->offered_price }}"
                                        {{ (isset($institute) && optional($institute->activePlan)->plan_id == $package->id) ? 'selected' : '' }}>
                                        
                                        {{ $package->name }} - ₹{{ $package->formatted_offered_price }}/Year
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
                        <div class="form-group">
                            <label>
                                <input type="checkbox" id="gstCheck" name="gstCheck"
                                    {{ isset($institute) && $institute->gst_invoice ? 'checked' : '' }}>
                                I need a GST Invoice
                            </label>
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
                                <textarea name="billing_address" class="form-control">{{ $institute->billing_address ?? '' }}</textarea>
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

@endsection


@push('javascript')
<script>
let selectedCity = "{{ $institute->city_id ?? '' }}";
let selectedSubcategory = "{{ $institute->subcategory_id ?? '' }}";

$(document).ready(function() {

    // ✅ GST Toggle
    $('#gstCheck').change(function(){
        $('#gstDetails').toggle($(this).is(':checked'));
    }).trigger('change');

    // ✅ Payment Toggle
    function togglePaymentSection() {
        let price = parseFloat($('#plan_id option:selected').data('price')) || 0;

        if(price > 0){
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
        if(state_id) {
             let stateeurl = "{{ url('/admin/get-cities/') }}/";
              $.get(stateeurl + state_id, function(data) {
                let options = '<option value="">Select City</option>';

                data.forEach(function(city){
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
        if(category_id){
            let subcateurl = "{{ url('/admin/get-subcategories/') }}/";
            $.get(subcateurl + category_id, function(data) {
                let options = '<option value="">Select Subcategory</option>';

                data.forEach(function(sub){
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
    $('#state_id').change(function(){
        selectedCity = '';
        loadCities($(this).val());
    });

    $('#category_id').change(function(){
        selectedSubcategory = '';
        loadSubcategories($(this).val());
    });

    // ✅ Page Load (EDIT FIX)
    let state_id = $('#state_id').val();
    let category_id = $('#category_id').val();

    if(state_id){
        loadCities(state_id);
    }

    if(category_id){
        loadSubcategories(category_id);
    }

});
let mobileExists = false;

$('#mobile').on('blur', function(){
    let mobile = $(this).val();

    if(mobile.length === 10){
        let mobileUrl = "{{ url('admin/institutes/check-mobile') }}/";
        $.get(mobileUrl, { mobile: mobile }, function(response){

            if(response == 1){
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
@endpush
