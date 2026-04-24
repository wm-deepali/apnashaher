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
                                    <th>Name</th>
                                    <th>Category/Subcategory</th>
                                    <th>Is Registration Completed </th>
                                    <th>Is Profile Completed</th>
                                    <th>Total Courses</th>
                                    <th>Plan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($institutes as $institute)

                                    <tr>

                                        <td>{{ date('Y-m-d g:i A', strtotime($institute->created_at)) }}</td>

                                        <td>{{$institute->name}}</td>

                                        <td>{{$institute->category->name ?? ""}} @if(isset($institute->subcategory))
                                        ({{$institute->subcategory->name ?? ""}}) @endif</td>

                                        <td>
                                            @if($institute->registration_complete)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-secondary">No</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($institute->profile_completed)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-secondary">No</span>
                                            @endif
                                        </td>
                                        <td>{{$institute->courses->count() ?? 0}}</td>
                                        <td>{{$institute->latestPlan->plan->name ?? ""}}</td>
                                        <td>
                                            @if($institute->status == "approved")
                                                <span class="badge badge-success">Approved</span>
                                            @else
                                                <form action="{{ route('admin.manage-institute.approve', $institute->id) }}"
                                                    method="POST" style="display:inline-block">
                                                    @csrf
                                                    <button class="btn btn-warning btn-sm">
                                                        Approve
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                        <td>

                                            <!-- View -->
                                            <a href="{{ route('admin.manage-institute.show', $institute->id) }}"
                                                class="btn btn-primary btn-sm" title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('admin.institutes-full.edit', $institute->id) }}"
                                                class="btn btn-primary btn-sm" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <!-- Profile -->
                                            <button class="btn btn-primary btn-sm loadModal" data-id="{{$institute->id}}"
                                                title="Add/Edit Profile">
                                                <i class="fa fa-user"></i>
                                            </button>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.manage-institute.destroy', $institute->id) }}"
                                                method="POST" style="display:inline-block">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete this category?')" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </form>

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