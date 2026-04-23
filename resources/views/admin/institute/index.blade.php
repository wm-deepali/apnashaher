@extends('vendor.voyager.master')

@section('page_title', 'Manage Institutes')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage Institutes</li>
    </ol>
@endsection
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>
       Manage Institutes
    </h1>
@stop

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<div class="page-content browse container-fluid">
<a href="{{ route('admin.institutes-full.create') }}" class="btn btn-success">Add Listing</a>
    
    <div class="panel panel-bordered">
        <div class="panel-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover no-footer">
                    <thead>
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

                        <td>{{$institute->category->name ?? ""}} @if(isset($institute->subcategory)) ({{$institute->subcategory->name ?? ""}}) @endif</td>
                         
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
                            <form action="{{ route('admin.manage-institute.approve',$institute->id) }}" 
                                method="POST" 
                                style="display:inline-block">
                                @csrf
                                <button class="btn btn-warning btn-sm">
                                    Approve
                                </button>
                            </form>
                        @endif
                        </td>
                        <td>

                        <a href="{{ route('admin.manage-institute.show',$institute->id) }}"
                        class="btn btn-primary btn-sm" title="View">
                         <i class="voyager-eye"></i>
                        </a>
                        <a href="{{ route('admin.institutes-full.edit',$institute->id) }}"
                        class="btn btn-primary btn-sm" title="Edit">
                         <i class="voyager-edit"></i>
                        </a>
                        <button class="btn btn-primary loadModal" data-id="{{$institute->id}}" title="Add/Edit Profile">
                            <i class="voyager-person"></i>
                        </button>
                        <form action="{{ route('admin.manage-institute.destroy',$institute->id) }}"
                        method="POST"
                        style="display:inline-block">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Delete this category?')"  title="Delete">
                        <i class="voyager-trash"></i>
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

<div id="modalContainer"></div>
@endsection
@push('javascript')
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
@endpush