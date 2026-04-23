<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('page_title', setting('admin.title') . ' - ' . setting('admin.description'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!-- Voyager CSS -->
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ voyager_asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @yield('css')
    @stack('css')

    @if(__('voyager::generic.is_rtl') == 'true')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
        <link rel="stylesheet" href="{{ voyager_asset('css/rtl.css') }}">
        <link rel="stylesheet" 
href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


    @endif
</head>

<body class="voyager @if(isset($dataType) && isset($dataType->slug)){{ $dataType->slug }}@endif">

<!-- Loader -->
<div id="voyager-loader">
    <img src="{{ voyager_asset('images/logo-icon.png') }}" alt="Loader">
</div>

@php
    
    $user = Auth::user();
    $user_avatar = $user ? asset('storage/' . $user->avatar) : asset('images/default-avatar.png');
@endphp

<div class="app-container">
    <div class="fadetoblack visible-xs"></div>
    <div class="row content-container">

        {{-- Voyager default navbar --}}
        @include('vendor.voyager.partials.navbar')

        {{-- Custom sidebar --}}
        <div class="side-menu sidebar-inverse">
            @include('admin.partials.sidebar')
        </div>

        {{-- Main content --}}
        <div class="container-fluid">
            <div class="side-body padding-top">
                @yield('page_header')
                <div id="voyager-notifications"></div>
                @yield('content')
            </div>
        </div>
    </div>
</div>

{{-- Voyager JS --}}
<script src="{{ voyager_asset('js/app.js') }}"></script>
<script src="{{ voyager_asset('js/sortable.js') }}"></script>
<script src="{{ voyager_asset('js/admin.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
{{-- Flash messages --}}
<script>
@if(Session::has('alerts'))
    let alerts = {!! json_encode(Session::get('alerts')) !!};
    helpers.displayAlerts(alerts, toastr);
@endif

@if(Session::has('message'))
    let alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
    let alertMessage = {!! json_encode(Session::get('message')) !!};
    let alerter = toastr[alertType];
    if(alerter){ alerter(alertMessage); } else { toastr.error("toastr alert-type "+alertType+" is unknown"); }
@endif
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@include('voyager::media.manager')
@yield('javascript')
@stack('javascript')
<script>
    $(document).ready(function() {
    $('.treeview > a').click(function(e){
        e.preventDefault();
        var parent = $(this).parent();
        var menu = $(this).siblings('.treeview-menu');

        if(parent.hasClass('menu-open')){
            menu.slideUp(200);
            parent.removeClass('menu-open active');
        } else {
            // Close other menus
            $('.treeview.menu-open').removeClass('menu-open active').children('.treeview-menu').slideUp(200);

            menu.slideDown(200);
            parent.addClass('menu-open active');
        }
    });
});
</script>
@if(!empty(config('voyager.additional_js')))
    @foreach(config('voyager.additional_js') as $js)
        <script src="{{ asset($js) }}"></script>
    @endforeach
@endif

</body>
</html>