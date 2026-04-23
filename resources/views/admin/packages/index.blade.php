@extends('vendor.voyager.master')

@section('page_title', 'Manage Package')
@section('breadcrumbs')
    <ol class="breadcrumb">
        <li><a href="{{ route('voyager.dashboard') }}"><i class="voyager-home"></i> Dashboard</a></li>
        <li class="active">Manage Packages</li>
    </ol>
@endsection
@section('page_header')
    <h1 class="page-title">
        <i class="voyager-list"></i>
       Manage Package
    </h1>
@stop
@section('content')
<div class="page-content browse container-fluid">

    <a href="{{ route('admin.manage-packages.create') }}" class="btn btn-success">
    Add Package
    </a>
    <div class="panel panel-bordered">
        <div class="panel-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover  no-footer">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Mrp</th>
                                <th>Discount</th>
                                <th>Offered Price</th>
                                <th>Validity (Days)</th>
                                <th>Popular</th>
                                <th>Features</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                            <tr>
                                <td>{{ $package->id }}</td>
                                <td>{{ $package->name }}</td>
                                <td>{{ $package->title }}</td>
                                <td>{{ $package->mrp ?? '-' }}</td>
                                <td>{{ $package->discount_value ?? '-' }}</td>
                                <td>{{ $package->offered_price ?? '-' }}</td>
                                <td>{{ $package->validity_days ?? '-' }}</td>
                                <td>{{ $package->is_popular ? 'Yes' : 'No' }}</td>
                               <td>
                                @if($package->features)
                                <ul style="padding-left: 0; list-style: none;">
                                    <li>
                                        {!! $package->features->apnashaher_listing ? '<span style="color:green;">&#10004;</span>' : '<span style="color:red;">&#10008;</span>' !!}
                                        ApnaShaher Listing
                                    </li>
                                    <!-- <li>
                                        {!! $package->features->call_whatsapp_button ? '<span style="color:green;">&#10004;</span>' : '<span style="color:red;">&#10008;</span>' !!}
                                        Calls & WhatsApp Button
                                    </li> -->
                                    <li>
                                        {!! $package->features->verified_badge ? '<span style="color:green;">&#10004;</span>' : '<span style="color:red;">&#10008;</span>' !!}
                                        Verified Badge
                                    </li>
                                    <li>
                                        {!! $package->features->profile_performance_insight ? '<span style="color:green;">&#10004;</span>' : '<span style="color:red;">&#10008;</span>' !!}
                                        Profile Performance Insight
                                    </li>
                                    <li>
                                        {!! $package->features->featured_in_category_listings ? '<span style="color:green;">&#10004;</span>' : '<span style="color:red;">&#10008;</span>' !!}
                                        Featured in Category Listings
                                    </li>
                                    <li>
                                        {!! $package->features->promotional_banner_placement ? '<span style="color:green;">&#10004;</span>' : '<span style="color:red;">&#10008;</span>' !!}
                                        Promotional Banner Placement
                                    </li>
                                    <li>
                                        {!! $package->features->preferred_institute_badge ? '<span style="color:green;">&#10004;</span>' : '<span style="color:red;">&#10008;</span>' !!}
                                        Preferred Institute Badge
                                    </li>
                                    <li>
                                        {!! $package->features->ai_profile_description_generator ? '<span style="color:green;">&#10004;</span>' : '<span style="color:red;">&#10008;</span>' !!}
                                         AI Profile Description Generator
                                    </li>

                                    <li>
                                        {!! $package->features->custom_profile_url ? '<span style="color:green;">&#10004;</span>' : '<span style="color:red;">&#10008;</span>' !!}
                                        Custom Profile URL
                                    </li>
                                   
                                    <li>
                                        <span style="color:blue;">{{ ucfirst($package->features->search_visibility) }}</span> - Search Visibility
                                    </li>
                                    <!-- <li>
                                        <span style="color:blue;">{{ ucfirst($package->features->contact_display) }}</span> - Contact Display
                                    </li> -->
                                    <li>
                                        <span style="color:blue;">{{ ucfirst(str_replace('_',' ',$package->features->profile_editing)) }}</span> - Profile Editing
                                    </li>
                                    <li>
                                        <span style="color:blue;">{{ ucfirst(str_replace('_',' ',$package->features->support_type)) }}</span>
                                    </li>
                                     <li>
                                        <span style="color:blue;">{{ $package->features->courses_programs ? "Upto ".$package->features->courses_programs : "No" }}</span> - Courses/Programs
                                    </li>

        </ul>
    @else
        <span>No Features</span>
    @endif
</td>
                                <td>
                                    <a href="{{ route('admin.manage-packages.edit', $package->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('admin.manage-packages.destroy', $package->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this package?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


            </div>

            <div class="pull-right">
                {{ $packages->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>

</div>

@stop