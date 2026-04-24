@include('admin.top-header')

@section('page_title', 'Manage Cities')

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
                        Manage Cities
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.manage-cities.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add City
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
                                    <th>ID</th>
                                    <th>State</th>
                                    <th>Name</th>
                                    <th>Registered</th>
                                    <th>Popular</th>
                                    <th>Launching</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cities as $city)
                                    <tr>
                                        <td>{{ $city->id }}</td>
                                        <td>{{ $city->state->name ?? "" }}</td>
                                        <td>{{ $city->name }}</td>
                                        <td>{{ $city->is_registered ? 'Yes' : 'No' }}</td>
                                        <td>{{ $city->is_popular ? 'Yes' : 'No' }}</td>
                                        <td>{{ $city->is_launching ? 'Yes' : 'No' }}</td>
                                        <td>
                                            @if($city->image)
                                                <img src="{{ asset('storage/' . $city->image) }}" width="80">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.manage-cities.edit', $city->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>

                                            <form action="{{ route('admin.manage-cities.destroy', $city->id) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete this city?')">Delete</button>
                                            </form>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#cityTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true
        });
    });
</script>
@include('admin.footer')
