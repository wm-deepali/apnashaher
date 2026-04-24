@include('admin.top-header')

@section('page_title', 'Manage Job Openings')

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
                        Manage Job Openings
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.manage-jobs.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Job Opening
                </a>
            </div>

        </div>


        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">

                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Job Title</th>
                                    <th>Employment Type</th>
                                    <th>Work Mode</th>
                                    <th>Location</th>
                                    <th>Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($jobs as $job)

                                    <tr>

                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ date('Y-m-d', strtotime($job->created_at)) }}</td>

                                        <td>{{ $job->job_title }}</td>

                                        <td>{{ ucfirst(str_replace('_', ' ', $job->employment_type)) }}</td>

                                        <td>{{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</td>

                                        <td>{{ $job->job_location }}</td>

                                        <td>

                                            @if($job->salary_type == 'fixed')

                                                ₹{{ number_format($job->salary_fixed) }}
                                                {{ ucfirst(str_replace('_', ' ', $job->salary_duration)) }}

                                            @else

                                                ₹{{ number_format($job->salary_from) }} -
                                                ₹{{ number_format($job->salary_to) }}
                                                {{ ucfirst(str_replace('_', ' ', $job->salary_duration)) }}

                                            @endif

                                        </td>

                                        <td>

                                            <a href="{{ route('admin.manage-jobs.edit', $job->id) }}"
                                                class="btn btn-primary btn-sm">
                                                Edit
                                            </a>

                                            <form method="POST" action="{{ route('admin.manage-jobs.destroy', $job->id) }}"
                                                style="display:inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete this job?')">
                                                    Delete
                                                </button>

                                            </form>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="8" class="text-center">
                                            No job openings found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="pull-right">
                        {{ $jobs->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')