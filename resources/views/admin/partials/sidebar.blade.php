@php
    $user = Auth::user();
    $user_avatar = $user ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png');

@endphp
<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('voyager.dashboard') }}">
                    <div class="logo-icon-container">
                        <img src="{{ asset('assets/img/tlogo.png')}}" alt="Logo Icon">
                    </div>
                    <div class="title">Apnashaher </div>
                </a>
            </div><!-- .navbar-header -->

            <div class="panel widget center bgimage"
                 style="background-image:url({{ Voyager::image( Voyager::setting('admin.bg_image'), voyager_asset('images/bg.jpg') ) }}); background-size: cover; background-position: 0px;">
                <div class="dimmer"></div>
                <div class="panel-content">
                    <img src="{{ $user_avatar }}" class="avatar" alt="{{ Auth::user()->name }} avatar">
                    <h4>{{ ucwords(Auth::user()->name) }}</h4>
                    <p>{{ Auth::user()->email }}</p>

                    <a href="{{ route('voyager.profile') }}" class="btn btn-primary">{{ __('voyager::generic.profile') }}</a>
                    <div style="clear:both"></div>
                </div>
            </div>

        </div>
        <div id="adminmenu">
            <ul class="nav navbar-nav">
                <li class="{{ request()->routeIs('voyager.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('voyager.dashboard') }}">
                        <i class="voyager-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="treeview {{ request()->routeIs('admin.manage-categories.*') || request()->routeIs('admin.manage-states.*') || request()->routeIs('admin.manage-cities.*') 
                    || request()->routeIs('admin.manage-packages.*') || request()->routeIs('admin.manage-page.*')
                    || request()->routeIs('admin.manage-blog.*') || request()->routeIs('admin.manage-faq.*') || request()->routeIs('admin.manage-jobs.*') ? 'active open' : '' }}">
                     <a href="#" class="dropdown-toggle">
                        <i class="voyager-categories"></i>
                        <span>Master</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu" style="{{ request()->routeIs('admin.manage-categories.*') || request()->routeIs('admin.manage-states.*') || request()->routeIs('admin.manage-cities.*') 
                    || request()->routeIs('admin.manage-packages.*') || request()->routeIs('admin.manage-page.*')
                    || request()->routeIs('admin.manage-blog.*') || request()->routeIs('admin.manage-faq.*') || request()->routeIs('admin.manage-jobs.*')
                    ? 'display:block;' : 'display:none;' }}"> 

                        <li class="{{ request()->routeIs('admin.manage-categories.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.manage-categories.index') }}">
                                <i class="voyager-list"></i>
                                Manage Category
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.manage-states.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.manage-states.index') }}">
                                <i class="voyager-file-text"></i>
                                Manage States
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.manage-cities.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.manage-cities.index') }}">
                                <i class="voyager-file-text"></i>
                                Manage Cities
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('admin.manage-packages.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.manage-packages.index') }}">
                                <i class="voyager-file-text"></i>
                                Manage Package
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.manage-page.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.manage-page.index') }}">
                                <i class="voyager-file"></i>
                                Manage Pages
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.manage-blog.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.manage-blog.index') }}">
                                <i class="voyager-file"></i>
                                Manage Blogs
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.manage-faq.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.manage-faq.index') }}">
                                <i class="voyager-help"></i>
                                Manage FAQ
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('admin.manage-jobs.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.manage-jobs.index') }}">
                                <i class="voyager-briefcase"></i>
                                Manage Job Openings
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="treeview {{ request()->routeIs('admin.manage-institute.*') ? 'active menu-open' : '' }}">
                    <a href="#" class="dropdown-toggle">
                        <i class="voyager-book"></i>
                        <span>Institutes</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu" style="{{ request()->routeIs('admin.manage-institute.*') ? 'display:block;' : 'display:none;' }}">
                        <li class="{{ request()->routeIs('admin.manage-institute.index') ? 'active' : '' }}">
                            <a href="{{ route('admin.manage-institute.index') }}">
                                <i class="voyager-briefcase"></i> Manage Institutes
                            </a>
                        </li>
                    </ul>
                </li>
            
            
                
            </ul>
            
        </div>
    </nav>
</div>
