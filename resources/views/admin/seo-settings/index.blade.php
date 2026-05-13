@include('admin.top-header')

@section('page_title', 'SEO Settings')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <!-- Breadcrumb -->
        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('voyager.dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        SEO Settings
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">

                <div class="card-header d-flex align-items-center justify-content-between">

                    <h4 class="mb-0">
                        SEO Settings
                    </h4>

                </div>

                <div class="card-body">

                    @if(session('success'))

                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>

                    @endif

                    <div class="table-responsive">

                        <table class="table table-striped table-hover align-middle">

                            <thead class="thead-light">

                                <tr>
                                    <th width="5%">#</th>
                                    <th>Page Name</th>
                                    <th width="15%">Action</th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach($pages as $key => $page)

                                    <tr>

                                        <td>
                                            {{ $key + 1 }}
                                        </td>

                                        <td>

                                            <strong class="text-capitalize">
                                                {{ str_replace('-', ' ', $page) }}
                                            </strong>

                                        </td>

                                        <td>

                                            <button
                                                type="button"
                                                class="btn btn-primary btn-sm editSeoBtn"

                                                data-page="{{ $page }}"

                                                data-title="{{ $seoSettings[$page]->meta_title ?? '' }}"

                                                data-description="{{ $seoSettings[$page]->meta_description ?? '' }}"

                                                data-scripts="{{ $seoSettings[$page]->other_scripts ?? '' }}"
                                            >

                                                <i class="fa fa-edit"></i>
                                                Edit

                                            </button>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- SEO Modal -->
<div class="modal fade"
     id="seoModal"
     tabindex="-1"
     role="dialog">

    <div class="modal-dialog modal-lg"
         role="document">

        <form action="{{ route('admin.seo-settings.update') }}"
              method="POST">

            @csrf

            <input type="hidden"
                   name="page_key"
                   id="page_key">

            <div class="modal-content">

                <!-- Header -->
                <div class="modal-header">

                    <h5 class="modal-title">
                        Edit SEO Settings
                    </h5>

                    <button type="button"
                            class="close"
                            data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>

                <!-- Body -->
                <div class="modal-body">

                    <!-- Page -->
                    <div class="form-group">

                        <label>
                            Page Name
                        </label>

                        <input type="text"
                               id="page_name"
                               class="form-control"
                               readonly>

                    </div>

                    <!-- Meta Title -->
                    <div class="form-group">

                        <label>
                            Meta Title
                        </label>

                        <input type="text"
                               name="meta_title"
                               id="meta_title"
                               class="form-control">

                    </div>

                    <!-- Meta Description -->
                    <div class="form-group">

                        <label>
                            Meta Description
                        </label>

                        <textarea
                            name="meta_description"
                            id="meta_description"
                            class="form-control"
                            rows="4"
                        ></textarea>

                    </div>

                    <!-- Other Scripts -->
                    <div class="form-group"
                         id="scriptsBox"
                         style="display:none;">

                        <label>
                            Other Scripts
                        </label>

                        <textarea
                            name="other_scripts"
                            id="other_scripts"
                            class="form-control"
                            rows="6"
                        ></textarea>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fa fa-save"></i>
                        Update

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).on('click', '.editSeoBtn', function () {

        let page = $(this).data('page');
        let title = $(this).data('title');
        let description = $(this).data('description');
        let scripts = $(this).data('scripts');

        $('#page_key').val(page);

        $('#page_name').val(
            page.replaceAll('-', ' ')
        );

        $('#meta_title').val(title);

        $('#meta_description').val(description);

        $('#other_scripts').val(scripts);

        // only for homepage
        if(page === 'home'){

            $('#scriptsBox').show();

        }else{

            $('#scriptsBox').hide();

        }

        $('#seoModal').modal('show');

    });

</script>

@include('admin.footer')