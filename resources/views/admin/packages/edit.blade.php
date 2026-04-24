@include('admin.top-header')

@section('page_title', 'Manage Package')

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
                        <a href="{{ route('admin.manage-packages.index') }}">Manage Packages</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit Package
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Package</strong>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.manage-packages.update', $package->id) }}" method="POST">

                        @csrf
                        @method('PUT')

                        @include('admin.packages._form')

                        <div class="mt-4">

                            <button class="btn btn-success">
                                Update
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')