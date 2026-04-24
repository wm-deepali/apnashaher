@include('admin.top-header')

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
                        Manage Blogs
                    </li>
                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.manage-blog.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Blog
                </a>
            </div>

        </div>

        <!-- Content -->
        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($blogs as $blog)

                                    <tr id="row{{ $blog->id }}">

                                        <td>{{ $blog->id }}</td>

                                        <td>
                                            <strong>{{ $blog->title }}</strong>
                                        </td>

                                        <td>{{ $blog->slug }}</td>

                                        <td>
                                            @if($blog->status)
                                                <span class="badge badge-primary">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>

                                            <!-- Edit -->
                                            <a href="{{ route('admin.manage-blog.edit', $blog->id) }}"
                                                class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <!-- Delete -->
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteBlog({{ $blog->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No Blogs Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-end mt-3">
                        {{ $blogs->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>

        </div>

    </div>


</div>

@include('admin.footer')


<script>

    function deleteBlog(id) {
        Swal.fire({
            title: 'Delete Blog?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        })
            .then((result) => {

                if (result.isConfirmed) {

                    $.ajax({

                        url: "{{ url('admin/manage-blog') }}/" + id,

                        type: "DELETE",

                        data: {
                            _token: "{{ csrf_token() }}"
                        },

                        success: function (res) {

                            Swal.fire('Deleted!', res.message, 'success');

                            $("#row" + id).fadeOut(400, function () {
                                $(this).remove();
                            });

                        }

                    });

                }

            });

    }

</script>