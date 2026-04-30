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

                    <!-- 🔥 SUCCESS -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- 🔥 VALIDATION ERRORS -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.invoice-settings.store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <!-- ================= COMPANY INFO ================= -->
                        <h5 class="mb-3">Company Information</h5>

                        <div class="row">

                            <div class="col-md-6 form-group">
                                <label>Company Name *</label>
                                <input type="text" name="company_name"
                                    class="form-control @error('company_name') is-invalid @enderror"
                                    value="{{ old('company_name', $setting->company_name ?? '') }}">
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Contact Number</label>
                                <input type="text" name="company_phone" class="form-control"
                                    value="{{ old('company_phone', $setting->company_phone ?? '') }}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>GST Number</label>
                                <input type="text" name="company_gstin" class="form-control"
                                    value="{{ old('company_gstin', $setting->company_gstin ?? '') }}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Company Logo</label>
                                <input type="file" name="company_logo" class="form-control">
                                @if(!empty($setting->company_logo))
                                    <img src="{{ asset('storage/' . $setting->company_logo) }}" height="40" class="mt-2">
                                @endif
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Full Address *</label>
                                <textarea name="company_address"
                                    class="form-control @error('company_address') is-invalid @enderror"
                                    rows="3">{{ old('company_address', $setting->company_address ?? '') }}</textarea>
                                @error('company_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <hr>

                        <!-- ================= INVOICE SETTINGS ================= -->
                        <h5 class="mb-3">Invoice Settings</h5>

                        <div class="row">

                            <div class="col-md-4 form-group">
                                <label>Invoice Prefix</label>
                                <input type="text" name="invoice_prefix" class="form-control"
                                    value="{{ old('invoice_prefix', $setting->invoice_prefix ?? 'INV') }}">
                            </div>

                            <!-- 🔥 TYPE -->
                            <div class="col-md-4 form-group">
                                <label>Invoice Type</label>
                                <select name="invoice_type" id="invoice_type"
                                    class="form-control @error('invoice_type') is-invalid @enderror">

                                    <option value="serial" {{ old('invoice_type', $setting->invoice_type ?? 'serial') == 'serial' ? 'selected' : '' }}>
                                        Serial
                                    </option>

                                    <option value="random" {{ old('invoice_type', $setting->invoice_type ?? '') == 'random' ? 'selected' : '' }}>
                                        Random
                                    </option>

                                </select>
                                @error('invoice_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 🔥 SERIAL -->
                            <div class="col-md-4 form-group" id="serial_box">
                                <label>Invoice Serial</label>
                                <input type="number" name="invoice_serial"
                                    class="form-control @error('invoice_serial') is-invalid @enderror"
                                    value="{{ old('invoice_serial', $setting->invoice_serial ?? 1) }}">
                                @error('invoice_serial')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 🔥 RANDOM -->
                            <div class="col-md-4 form-group" id="random_box">
                                <label>Random Length</label>
                                <input type="number" name="random_length"
                                    class="form-control @error('random_length') is-invalid @enderror"
                                    value="{{ old('random_length', $setting->random_length ?? 6) }}">
                                @error('random_length')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Terms & Conditions</label>
                                <textarea name="terms_conditions" id="terms_conditions" class="form-control">
                                    {{ $setting->terms_conditions ?? '' }}
                                </textarea>
                            </div>

                        </div>

                        <hr>

                        <!-- ================= GST ================= -->
                        <h5 class="mb-3">GST Settings</h5>

                        <div class="row">

                            <div class="col-md-3 form-group">
                                <label>CGST (%)</label>
                                <input type="number" step="0.01" name="cgst" class="form-control"
                                    value="{{ old('cgst', $setting->cgst ?? 9) }}">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>SGST (%)</label>
                                <input type="number" step="0.01" name="sgst" class="form-control"
                                    value="{{ old('sgst', $setting->sgst ?? 9) }}">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>IGST (%)</label>
                                <input type="number" step="0.01" name="igst" class="form-control"
                                    value="{{ old('igst', $setting->igst ?? 18) }}">
                            </div>

                            <div class="col-md-3 form-group d-flex align-items-center mt-4">
                                <input type="checkbox" name="gst_enabled" {{ old('gst_enabled', $setting->gst_enabled ?? false) ? 'checked' : '' }}>
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

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<script>
    CKEDITOR.config.versionCheck = false; // 🔥 THIS LINE ADDED

    if (document.getElementById('terms_conditions')) {
        CKEDITOR.replace('terms_conditions');
    }

    // 🔥 Toggle logic
    $(document).ready(function () {

        toggleFields();

        $('#invoice_type').on('change', function () {
            toggleFields();
        });

        function toggleFields() {
            let type = $('#invoice_type').val();

            if (type === 'random') {
                $('#serial_box').hide();
                $('#random_box').show();
            } else {
                $('#serial_box').show();
                $('#random_box').hide();
            }
        }
    });
</script>