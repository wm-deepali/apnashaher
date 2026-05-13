@include('admin.top-header')

@section('page_title', 'Incomplete Listings')

<div class="main-section">
@include('admin.header')

<div class="app-content content container-fluid">

    <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">
        <h4 class="ml-2">Incomplete Listings</h4>
    </div>

    <div class="card">
        <div class="card-body">

            <!-- FILTER (same as published) -->
            <form method="GET" class="mb-4">

                <div class="row">

                    <!-- CATEGORY -->
                    <div class="col-md-2">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">All</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- SUBCATEGORY -->
                    <div class="col-md-2">
                        <label>Sub Category</label>
                        <select name="subcategory_id" class="form-control">
                            <option value="">All</option>
                        </select>
                    </div>

                    <!-- DATE FROM -->
                    <div class="col-md-2">
                        <label>From</label>
                        <input type="date" name="from" class="form-control"
                               value="{{ request('from') }}">
                    </div>

                    <!-- DATE TO -->
                    <div class="col-md-2">
                        <label>To</label>
                        <input type="date" name="to" class="form-control"
                               value="{{ request('to') }}">
                    </div>

                    <!-- SEARCH -->
                    <div class="col-md-3">
                        <label>Search</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Name / Mobile / Email"
                               value="{{ request('search') }}">
                    </div>

                </div>

                <div class="mt-3">
                    <button class="btn btn-primary">Apply Filters</button>
                    <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
                </div>

            </form>

            <!-- TABLE -->
            <table class="table table-striped table-hover">

                <thead class="thead-light">
                    <tr>
                        <th>Date</th>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Location</th>
                        <th>Progress</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($institutes as $institute)
                        <tr>

                            <!-- Date -->
                            <td>{{ date('d M Y', strtotime($institute->created_at)) }}</td>

                            <!-- Logo -->
                           <td>
    @if($institute->logo)

        <img src="{{ asset('storage/'.$institute->logo) }}"
             width="50"
             height="50"
             style="border-radius:50%; object-fit:cover;">

    @else

        <div style="
            width:50px;
            height:50px;
            border-radius:50%;
            background:#0d6efd;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:700;
            font-size:20px;
            text-transform:uppercase;
        ">
            {{ substr($institute->name ?? 'A', 0, 1) }}
        </div>

    @endif
</td>

                            <!-- Name -->
                            <td>{{ $institute->name ?? '-' }}</td>

                            <!-- Mobile -->
                            <td>{{ $institute->mobile }}</td>

                            <!-- Location -->
                            <td>
                                {{ $institute->city->name ?? '-' }},
                                {{ $institute->state->name ?? '-' }}
                            </td>

                            <!-- Progress -->
                            <td>
                                @if(!$institute->category_id)
                                    <span class="badge badge-warning">Step 1</span>
                                @elseif(!$institute->description)
                                    <span class="badge badge-info">Step 2</span>
                                @elseif(!$institute->latestPlan)
                                    <span class="badge badge-primary">Step 3</span>
                                @else
                                    <span class="badge badge-secondary">Step 4</span>
                                @endif
                            </td>

                            <!-- Action -->
                            <td>
                                <a href="{{ route('admin.institutes-full.edit', $institute->id) }}"
                                   class="btn btn-sm btn-primary">
                                    Complete
                                </a>
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

            <div class="mt-3 d-flex justify-content-end">
                {{ $institutes->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>
</div>

@include('admin.footer')