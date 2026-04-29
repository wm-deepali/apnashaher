@include('admin.top-header')

@section('page_title', 'New Listings')

<div class="main-section">
@include('admin.header')

<div class="app-content content container-fluid">

    <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">
        <h4 class="ml-2">New Listings</h4>
    </div>

    <div class="card">
        <div class="card-body">

            <!-- FILTER -->
            <form method="GET" class="mb-4">

    <div class="row">

        <!-- CATEGORY -->
        <div class="col-md-2">
            <label>Category</label>
            <select name="category_id" class="form-control">
                <option value="">All</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- SUBCATEGORY -->
        <div class="col-md-2">
            <label>Sub Category</label>
            <select name="subcategory_id" class="form-control">
                <option value="">All</option>
            </select>
        </div>

        <!-- SUBSCRIPTION -->
        <div class="col-md-2">
            <label>Subscription</label>
            <select name="package_id" class="form-control">
                <option value="">All</option>
                @foreach($packages as $pkg)
                    <option value="{{ $pkg->id }}"
                        {{ request('package_id') == $pkg->id ? 'selected' : '' }}>
                        {{ $pkg->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- DATE FROM -->
        <div class="col-md-2">
            <label>From</label>
            <input type="date" name="from" class="form-control"
                   value="{{ request('from') }}">
        </div>

        <!-- DATE TO -->
        <div class="col-md-2">
            <label>To</label>
            <input type="date" name="to" class="form-control"
                   value="{{ request('to') }}">
        </div>

        <!-- SEARCH -->
        <div class="col-md-2">
            <label>Search</label>
            <input type="text" name="search" class="form-control"
                   placeholder="Name / Mobile / Email"
                   value="{{ request('search') }}">
        </div>

    </div>

    <div class="mt-3">
        <button class="btn btn-primary">Apply Filters</button>
        <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
    </div>

</form>

          <table id="cityTable" class="table table-striped table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Logo</th>
                                    <th>Institute Name</th>
                                    <th>Contact Detail</th>
                                    <th>Location</th>
                                    <th>Subscription</th>
                                    <th>Valid Till</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            
                            <tbody>
                                @foreach($institutes as $institute)
<tr>

    <!-- Date -->
    <td>{{ date('d M Y, h:i A', strtotime($institute->created_at)) }}</td>

    <!-- Logo -->
    <td>
        @if($institute->logo)
            <img src="{{ asset('storage/'.$institute->logo) }}" width="50" height="50" style="border-radius:6px;">
        @else
            <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&q=80&w=800" width="50">
        @endif
    </td>

    <!-- Name -->
    <td>{{ $institute->name }}</td>

    <!-- Contact -->
    <td>
    {{ $institute->mobile }} <br>
{{ $institute->owner_email ?? '-' }}
    </td>

    <!-- Location -->
    <td>
        {{ $institute->city->name ?? '' }}, {{ $institute->state->name ?? '' }}
    </td>

    <!-- Subscription -->
    <td>
        {{ $institute->latestPlan->plan->name ?? '-' }}
    </td>

    <!-- Valid Till -->
    <td>
        {{ isset($institute->latestPlan) ? \Carbon\Carbon::parse($institute->latestPlan->expiry_date)->format('d M Y') : '-' }}
    </td>

    <!-- Status -->
    <td>
        @if($institute->status == "approved")
            <span class="badge badge-success">Approved</span>
        @else
            <span class="badge badge-warning">Pending</span>
        @endif
    </td>

    <!-- Actions -->
    <td>
    <div class="dropdown">
        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
            Actions
        </button>

        <div class="dropdown-menu">

            <!-- View -->
            <a class="dropdown-item" href="{{ route('admin.manage-institute.show', $institute->id) }}">
                👁 View Details
            </a>

            <!-- Edit -->
            <a class="dropdown-item" href="{{ route('admin.institutes-full.edit', $institute->id) }}">
                ✏ Edit
            </a>

            <!-- Profile -->
            <button class="dropdown-item loadModal" data-id="{{ $institute->id }}">
                👤 Edit Profile
            </button>

            <!-- Invoice (only if paid) -->
            @if(isset($institute->payments) && $institute->payments->count() > 0 && $institute->payments->first()->amount > 0)
                <a class="dropdown-item" href="{{ route('admin.invoice.show', $institute->payments->first()->id) }}">
                    🧾 View Invoice
                </a>
            @endif

            <div class="dropdown-divider"></div>

            <!-- Delete -->
            <form action="{{ route('admin.manage-institute.destroy', $institute->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="dropdown-item text-danger"
                        onclick="return confirm('Delete this institute?')">
                    🗑 Delete
                </button>
            </form>

        </div>
    </div>
</td>

</tr>
@endforeach
                        

                            </tbody>

                        </table>
   <div class="mt-3 d-flex justify-content-end">
    {{ $institutes->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>

        </div>
    </div>

</div>
</div>


<div id="modalContainer"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.loadModal', function () {

        let id = $(this).data('id');
        let profileurl = "{{url('admin/get-institute-profile')}}/";
        $.ajax({
            url: profileurl + id,
            type: 'GET',

            success: function (html) {

                // Purana modal remove karo (important)
                $('#modalContainer').html('');

                // Naya modal inject karo
                $('#modalContainer').html(html);

                // Show modal
                $('#profileModal').modal('show');
            }
        });

    });
    $(document).on('click', '#saveProfileBtn', function () {

        let formData = $('#profileForm').serialize();

        $.ajax({
            url: "{{ route('admin.institute.profile.update') }}",
            type: "POST",
            data: formData,

            success: function (res) {
                toastr.success('Profile Updated Successfully');
                $('#profileModal').modal('hide');
            },

            error: function (xhr) {
                let errors = xhr.responseJSON.errors;

                $('.error').text('');

                $.each(errors, function (key, value) {
                    $('.' + key + '_error').text(value[0]);
                });
            }
        });

    });
</script>

<script>
$('select[name="category_id"]').on('change', function () {

    let categoryId = $(this).val();

    if (!categoryId) return;

    $.get('/get-subcategories/' + categoryId, function (data) {

        let options = '<option value="">All</option>';

        data.forEach(function (item) {
            options += `<option value="${item.id}">${item.name}</option>`;
        });

        $('select[name="subcategory_id"]').html(options);
    });

});
</script>
@include('admin.footer')