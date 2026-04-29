@include('admin.top-header')

@section('page_title', 'Manage Institutes')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('voyager.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Manage Institutes
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.institutes-full.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Listing
                </a>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">


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

                    </div>

                    <div class="pull-right">
                        {{ $institutes->links('pagination::bootstrap-5') }}
                    </div>

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
@include('admin.footer')