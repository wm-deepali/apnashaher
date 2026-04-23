<div class="row">

    <!-- Left Column -->
    <div class="col-md-6">

        <h4><b>Basic Details</b></h4>
        <hr>

        <div class="form-group">
            <label>Package Name</label>
            <input type="text" name="name" class="form-control"
                value="{{ $package->name ?? old('name') }}" required>
        </div>

        <div class="form-group">
            <label>Package Title</label>
            <input type="text" name="title" class="form-control"
                value="{{ $package->title ?? old('title') }}">
        </div>

        <div class="form-group">
            <label>MRP</label>
            <input type="number" step="0.01" id="mrp" name="mrp"
                class="form-control"
                value="{{ $package->mrp ?? old('mrp') }}">
        </div>

        <div class="form-group">
            <label>Discount Type</label>
            <select name="discount_type" id="discount_type" class="form-control">

                <option value="">Select</option>

                <option value="flat"
                {{ (isset($package) && $package->discount_type=='flat') ? 'selected' : '' }}>
                Flat
                </option>

                <option value="percentage"
                {{ (isset($package) && $package->discount_type=='percentage') ? 'selected' : '' }}>
                Percentage
                </option>

            </select>
        </div>

        <div class="form-group">
            <label>Discount Value</label>
            <input type="number" step="0.01"
                id="discount_value"
                name="discount_value"
                class="form-control"
                value="{{ $package->discount_value ?? old('discount_value') }}">
        </div>

        <div class="form-group">
            <label>Offered Price</label>
            <input type="number" step="0.01"
                id="offered_price"
                name="offered_price"
                class="form-control"
                value="{{ $package->offered_price ?? old('offered_price') }}"
                readonly>
        </div>

        <div class="form-group">
            <label>Validity (Days)</label>
            <input type="number"
                name="validity_days"
                class="form-control"
                value="{{ $package->validity_days ?? old('validity_days') }}"
                required>
        </div>

        <div class="form-check mt-2">
            <input type="checkbox" name="is_popular" value="1"
            class="form-check-input"
            {{ (isset($package) && $package->is_popular) ? 'checked' : '' }}>
            <label class="form-check-label">Show as Popular</label>
        </div>

    </div>


    <!-- Right Column -->
    <div class="col-md-6">

        <h4><b>Features</b></h4>
        <hr>

        <div class="form-group">
            <label>Search Visibility</label>

            <select name="search_visibility" class="form-control">

                <option value="limited"  {{ (isset($package->features) && $package->features->search_visibility == "limited") ? 'selected' : '' }}>Limited Search Visibility</option>

                <option value="improved" {{ (isset($package->features) && $package->features->search_visibility == "improved") ? 'selected' : '' }}>Improved Search Visibility</option>

                <option value="top" {{ (isset($package->features) && $package->features->search_visibility == "top") ? 'selected' : '' }}>Top Search Placement</option>

            </select>

        </div>


        <!-- <div class="form-group">
            <label>Contact Display</label>

            <select name="contact_display" class="form-control">

                <option value="basic" {{ (isset($package->features) && $package->features->contact_display == "basic") ? 'selected' : '' }}>Basic Contact Display</option>

                <option value="full" {{ (isset($package->features) && $package->features->contact_display == "full") ? 'selected' : '' }}>Full Contact Detail</option>

            </select>

        </div> -->


        <div class="form-group">
            <label>Profile Editing</label>

            <select name="profile_editing" class="form-control">

                <option value="basic" {{ (isset($package->features) && $package->features->profile_editing == "basic") ? 'selected' : '' }}>Basic Profile Editing</option>

                <option value="advance" {{ (isset($package->features) && $package->features->profile_editing == "advance") ? 'selected' : '' }}>Advance Profile Editing</option>

            </select>

        </div>


        <div class="form-group">
            <label>Support Type</label>

            <select name="support_type" class="form-control">

                <option value="Email Support Only" {{ (isset($package->features) && $package->features->support_type == "Email Support Only") ? 'selected' : '' }}>Email Support Only</option>

                <option value="Call & WhatsApp Support" {{ (isset($package->features) && $package->features->support_type == "Call & WhatsApp Support") ? 'selected' : '' }}>Call & WhatsApp Support</option>

                <option value="Priority Support (Call, WhatsApp & Email)" {{ (isset($package->features) && $package->features->support_type == "Priority Support (Call, WhatsApp & Email)") ? 'selected' : '' }}>Priority Support (WhatsApp, Call, Email)</option>

            </select>

        </div>
        <div class="form-group">
            <label>Courses / Programs</label>

            <input type="number" name="courses_programs" class="form-control" value="{{$package->features->courses_programs ?? ''}}">


        </div>


        <br>


        <div class="form-check">
            <input type="checkbox" name="apnashaher_listing" value="1"
            class="form-check-input"
            {{ (isset($package->features) && $package->features->apnashaher_listing) ? 'checked' : '' }}>
            <label class="form-check-label">ApnaShaher Listing</label>
        </div>


        <!-- <div class="form-check">
            <input type="checkbox" name="call_whatsapp_button" value="1"
            class="form-check-input"
            {{ (isset($package->features) && $package->features->call_whatsapp_button) ? 'checked' : '' }}>
            <label class="form-check-label">Calls & WhatsApp Button</label>
        </div> -->


        <div class="form-check">
            <input type="checkbox" name="verified_badge" value="1"
            class="form-check-input"
            {{ (isset($package->features) && $package->features->verified_badge) ? 'checked' : '' }}>
            <label class="form-check-label">Verified Badge</label>
        </div>


        <div class="form-check">
            <input type="checkbox" name="custom_profile_url" value="1"
            class="form-check-input"
            {{ (isset($package->features) && $package->features->custom_profile_url) ? 'checked' : '' }}>
            <label class="form-check-label">Custom Profile URL</label>
        </div>

        <div class="form-check">
            <input type="checkbox" name="preferred_institute_badge" value="1"
            class="form-check-input"
            {{ (isset($package->features) && $package->features->preferred_institute_badge) ? 'checked' : '' }}>
            <label class="form-check-label">Preferred Institute Badge</label>
        </div>

        <div class="form-check">
            <input type="checkbox" name="profile_performance_insight" value="1"
            class="form-check-input"
            {{ (isset($package->features) && $package->features->profile_performance_insight) ? 'checked' : '' }}>
            <label class="form-check-label">Profile Performance Insight</label>
        </div>

        <div class="form-check">
            <input type="checkbox" name="featured_in_category_listings" value="1"
            class="form-check-input"
            {{ (isset($package->features) && $package->features->featured_in_category_listings) ? 'checked' : '' }}>
            <label class="form-check-label">Featured in Category Listings</label>
        </div>

        <div class="form-check">
            <input type="checkbox" name="promotional_banner_placement" value="1"
            class="form-check-input"
            {{ (isset($package->features) && $package->features->promotional_banner_placement) ? 'checked' : '' }}>
            <label class="form-check-label">Promotional Banner Placement</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="ai_profile_description_generator" value="1"
            class="form-check-input"
            {{ (isset($package->features) && $package->features->ai_profile_description_generator) ? 'checked' : '' }}>
            <label class="form-check-label">AI Profile Description Generator</label>
        </div>

    </div>

</div>
@push('javascript')
<script>

function calculatePrice(){

    let mrp = parseFloat(document.getElementById('mrp').value) || 0;
    let discountType = document.getElementById('discount_type').value;
    let discountValue = parseFloat(document.getElementById('discount_value').value) || 0;

    let offered = mrp;

    if(discountType === 'flat'){
        offered = mrp - discountValue;
    }

    if(discountType === 'percentage'){
        offered = mrp - (mrp * discountValue / 100);
    }

    if(offered < 0){
        offered = 0;
    }

    document.getElementById('offered_price').value = offered.toFixed(2);
}

document.getElementById('mrp').addEventListener('keyup',calculatePrice);
document.getElementById('discount_type').addEventListener('change',calculatePrice);
document.getElementById('discount_value').addEventListener('keyup',calculatePrice);

</script>
@endpush