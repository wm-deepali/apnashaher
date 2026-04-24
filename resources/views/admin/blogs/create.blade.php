@include('admin.top-header')

@section('page_title', 'Manage Blogs')
<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('voyager.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.manage-blog.index') }}">Manage Blogs</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Add Blog
                    </li>

                </ol>
            </div>

        </div>


        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Add Blog</strong>
                </div>

                <div class="card-body">
                    @include('admin.blogs._form')


                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')