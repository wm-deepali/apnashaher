@include('admin.top-header')

@section('page_title', 'Manage State')

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
                        Manage States
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.manage-states.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add State
                </a>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">


                        <table id="statesTable" class="table table-striped table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($states as $state)

                                    <tr>

                                        <td>{{ $state->id }}</td>
                                        <td>{{ $state->country->name }}</td>
                                        <td>{{ $state->name }}</td>

                                        <td>

                                            <a href="{{ route('admin.manage-states.edit', $state->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.manage-states.destroy', $state->id) }}"
                                                method="POST" style="display:inline-block">

                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete this state?')">
                                                    Delete
                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @endforeach

                        </table>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#statesTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true
        });
    });
</script>
@include('admin.footer')