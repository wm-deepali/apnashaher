@include('admin.top-header')

@section('page_title', 'Manage States')

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
                        <a href="{{ route('admin.manage-states.index') }}">Manage States</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Add State
                    </li>

                </ol>
            </div>

        </div>


        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Add State</strong>
                </div>

                <div class="card-body">


                    <form action="{{ route('admin.manage-states.store') }}" method="POST">

                        @csrf

                        @include('admin.states._form')
                        <div class="mt-4">

                            <button class="btn btn-success">
                                Save
                            </button>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')