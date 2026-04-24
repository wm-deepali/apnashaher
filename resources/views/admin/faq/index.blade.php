@include('admin.top-header')

@section('page_title', 'Manage FAQ')

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
                        Manage FAQ
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.manage-faq.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add FAQ
                </a>
            </div>

        </div>


        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                    </div>

                    <table class="table table-striped table-hover">

                        <thead class="thead-light">

                            <tr>
                                <th>Date & Time</th>
                                <th>Question</th>
                                <th>Show on Home</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>


                        <tbody>

                            @foreach($faqs as $faq)

                                <tr>

                                    <td>
                                        {{ date('Y-m-d g:i A', strtotime($faq->created_at)) }}
                                    </td>

                                    <td>
                                        {{ $faq->question }}
                                    </td>

                                    <td>
                                        {{ $faq->show_on_home ? 'Yes' : 'No' }}
                                    </td>

                                    <td>
                                        {{ $faq->status ? 'Active' : 'Inactive' }}
                                    </td>


                                    <td>

                                        <a href="{{ route('admin.manage-faq.edit', $faq->id) }}"
                                            class="btn btn-primary btn-sm">
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('admin.manage-faq.destroy', $faq->id) }}"
                                            style="display:inline">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                <div class="pull-right">
                    {{ $faqs->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>

    </div>

</div>


@include('admin.footer')