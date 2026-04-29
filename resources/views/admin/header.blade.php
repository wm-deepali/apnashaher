<!-- fixed-top-->
<div class="row d-none">
    <div class="col-10">

        @if(session('success'))
            <div class="alert alert-info alert-dismissible fade in">
                <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade in">
                <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</div>

<!-- fixed-top-->

<div id='cssmenu'>
    <ul class="pt-0">

        <!-- DASHBOARD -->
        <li class="{{ request()->routeIs('voyager.dashboard') ? 'active' : '' }}">
            <a href="{{ route('voyager.dashboard') }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
        </li>

        <!-- MASTERS -->
        <li class="{{ request()->routeIs(
    'admin.manage-categories.*',
    'admin.manage-states.*',
    'admin.manage-cities.*',
    'admin.manage-packages.*',
    'admin.manage-page.*',
    'admin.manage-blog.*',
    'admin.manage-faq.*',
    'admin.manage-jobs.*'
) ? 'active open' : '' }}">

            <a href="#">
                <i class="fa-solid fa-layer-group"></i> Masters
            </a>

            <ul>

                <li class="{{ request()->routeIs('admin.manage-categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage-categories.index') }}">
                        <i class="fa-solid fa-tags"></i> Manage Categories
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.manage-states.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage-states.index') }}">
                        <i class="fa-solid fa-map"></i> Manage States
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.manage-cities.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage-cities.index') }}">
                        <i class="fa-solid fa-city"></i> Manage Cities
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.manage-packages.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage-packages.index') }}">
                        <i class="fa-solid fa-box-open"></i> Manage Packages
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.manage-page.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage-page.index') }}">
                        <i class="fa-solid fa-file-lines"></i> Manage Pages
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.manage-blog.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage-blog.index') }}">
                        <i class="fa-solid fa-blog"></i> Manage Blogs
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.manage-faq.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage-faq.index') }}">
                        <i class="fa-solid fa-circle-question"></i> Manage FAQ
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.manage-jobs.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage-jobs.index') }}">
                        <i class="fa-solid fa-briefcase"></i> Manage Job Openings
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.invoice-settings.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.invoice-settings.index') }}">
                        <i class="fa-solid fa-file-invoice"></i> Invoice & GST Settings
                    </a>
                </li>

            </ul>
        </li>

        <!-- INSTITUTES -->


        <li class="{{ request()->routeIs(
    'admin.institute.new.*',
    'admin.institute.published.*',
    'admin.institute.subscriptions.*'
) ? 'active open' : '' }}">

            <a href="#">
                <i class="fa-solid fa-building"></i> Institutes
            </a>

            <ul>

                <!-- NEW LISTINGS -->
                <li class="{{ request()->routeIs('admin.institute.new.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.institute.new.index') }}">
                        <i class="fa-solid fa-clock"></i> New Listings
                    </a>
                </li>

                <!-- PUBLISHED LISTINGS -->
                <li class="{{ request()->routeIs('admin.institute.published.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.institute.published.index') }}">
                        <i class="fa-solid fa-check-circle"></i> Published Listings
                    </a>
                </li>

                <!-- SUBSCRIPTIONS -->
                <li class="{{ request()->routeIs('admin.institute.subscriptions.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.institute.subscriptions.index') }}">
                        <i class="fa-solid fa-file-invoice-dollar"></i> Subscriptions
                    </a>
                </li>

            </ul>
        </li>


    </ul>
</div>