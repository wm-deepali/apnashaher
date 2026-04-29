@include('admin.top-header')

@section('page_title', 'Invoice & GST Settings')

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
                    <li class="breadcrumb-item active">
                        Invoice & GST Settings
                    </li>
                </ol>
            </div>
        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Invoice & GST Settings</strong>
                </div>

                <div class="card-body">

                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.invoice-settings.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- ================= COMPANY INFO ================= -->
                        <h5 class="mb-3">Company Information</h5>

                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label>Company Name *</label>
                                <input type="text" name="company_name" class="form-control"
                                    value="{{ $setting->company_name ?? '' }}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Contact Number</label>
                                <input type="text" name="company_phone" class="form-control"
                                    value="{{ $setting->company_phone ?? '' }}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>GST Number</label>
                                <input type="text" name="company_gstin" class="form-control"
                                    value="{{ $setting->company_gstin ?? '' }}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Company Logo</label>
                                <input type="file" name="company_logo" class="form-control">
                                @if(!empty($setting->company_logo))
                                    <img src="{{ asset('storage/'.$setting->company_logo) }}" height="40" class="mt-2">
                                @endif
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Full Address *</label>
                                <textarea name="company_address" class="form-control" rows="3">{{ $setting->company_address ?? '' }}</textarea>
                            </div>

                            <!-- 🔥 STATE -->
                            <div class="col-md-4 form-group">
                                <label>State *</label>
                                <select name="company_state" id="company_state" class="form-control">
                                    <option value="">Select State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}"
                                            {{ isset($setting) && $setting->company_state == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- 🔥 CITY -->
                            <div class="col-md-4 form-group">
                                <label>City *</label>
                                <select name="company_city" id="company_city" class="form-control">
                                    <option value="">Select City</option>
                                </select>
                            </div>

                            <!-- 🔥 PINCODE -->
                            <div class="col-md-4 form-group">
                                <label>Pin Code *</label>
                                <input type="text" name="company_pincode" class="form-control"
                                    value="{{ $setting->company_pincode ?? '' }}" maxlength="6">
                            </div>

                        </div>

                        <hr>

                        <!-- ================= INVOICE SETTINGS ================= -->
                        <h5 class="mb-3">Invoice Settings</h5>

                        <div class="row">

                            <div class="col-md-4 form-group">
                                <label>Invoice Prefix</label>
                                <input type="text" name="invoice_prefix" class="form-control"
                                    value="{{ $setting->invoice_prefix ?? 'INV' }}">
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Invoice Serial</label>
                                <input type="number" name="invoice_serial" class="form-control"
                                    value="{{ $setting->invoice_serial ?? 1 }}">
                            </div>

                            <div class="col-md-4 form-group d-flex align-items-center mt-4">
                                <input type="checkbox" name="random_invoice" id="random_invoice"
                                    {{ isset($setting) && $setting->random_invoice ? 'checked' : '' }}>
                                <label class="ml-2 mb-0">Random Invoice Number</label>
                            </div>

                            <div class="col-md-4 form-group">
                                <label>Random Length</label>
                                <input type="number" name="random_length" class="form-control"
                                    value="{{ $setting->random_length ?? 6 }}">
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Terms & Conditions</label>
                                <textarea name="terms_conditions" id="terms_conditions" class="form-control">
                                    {{ $setting->terms_conditions ?? '' }}
                                </textarea>
                            </div>

                        </div>

                        <hr>

                        <!-- ================= GST SETTINGS ================= -->
                        <h5 class="mb-3">GST Settings</h5>

                        <div class="row">

                            <div class="col-md-3 form-group">
                                <label>CGST (%)</label>
                                <input type="number" step="0.01" name="cgst" class="form-control"
                                    value="{{ $setting->cgst ?? 9 }}">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>SGST (%)</label>
                                <input type="number" step="0.01" name="sgst" class="form-control"
                                    value="{{ $setting->sgst ?? 9 }}">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>IGST (%)</label>
                                <input type="number" step="0.01" name="igst" class="form-control"
                                    value="{{ $setting->igst ?? 18 }}">
                            </div>

                            <div class="col-md-3 form-group d-flex align-items-center mt-4">
                                <input type="checkbox" name="gst_enabled"
                                    {{ isset($setting) && $setting->gst_enabled ? 'checked' : '' }}>
                                <label class="ml-2 mb-0">Enable GST</label>
                            </div>

                        </div>

                        <hr>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                Save Settings
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<!-- CKEDITOR -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('terms_conditions');
</script>

<!-- 🔥 LOAD CITY -->
<script>
$(document).ready(function () {

    let selectedCity = "{{ $setting->company_city ?? '' }}";

    if ($('#company_state').val()) {
        loadCities($('#company_state').val(), selectedCity);
    }

    $('#company_state').on('change', function () {
        let stateId = $(this).val();
        loadCities(stateId, null);
    });

    function loadCities(stateId, selectedCity = null) {

        $('#company_city').html('<option>Loading...</option>');

        $.get('/get-cities/' + stateId, function (res) {

            let options = '<option value="">Select City</option>';

            res.forEach(city => {
                let selected = selectedCity == city.id ? 'selected' : '';
                options += `<option value="${city.id}" ${selected}>${city.name}</option>`;
            });

            $('#company_city').html(options);
        });
    }

});
</script>