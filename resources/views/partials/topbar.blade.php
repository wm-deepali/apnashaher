@php
    use Illuminate\Support\Str;
@endphp
<style>
    .category-drawer {
        display: none; 
        /* or visibility:hidden / transformX etc. depending on your implementation */
    }

    .category-drawer.open {
        display: block;
    }
 

    .category-list, .drawer-body {
        display: flex;
        flex-direction: column;
    }
</style>
<div class="top-bar">
    <div class="top-container">
        <div class="punch-line">
            Helping local <span
                style="color: #fff182; font-weight: 700;  cursor: pointer;">Institutes</span> get
            discovered by real students.
        </div>

        <div class="top-right">
            @php
                $topcities = topcities();
               
             
        
            $scity = $cityslug ?? null;
            $cityName = $scity 
        ? optional($topcities->where('slug', $scity)->first())->name ?? 'All'
        : 'All';
            @endphp
            <div class="location-dropdown">
                <button class="location-btn" id="locationBtn">
                    {{ $cityName }}
                    <i class="fas fa-chevron-down" style="font-size:0.8rem;"></i>
                </button>
                <div class="dropdown-menu" id="locationMenu">
                    
                    <p style="color:black;border-bottom:1px solid #d7d3d3;padding: 15px;">Change Location </p>
                    <a href="#" onclick="setall()" class="dropdown-item">
                        All
                    </a>
                    @if(isset($topcities) && count($topcities) > 0)
                    @foreach($topcities as $topcity)
                        <a href="#" onclick="changeCity(event, '{{ Str::slug($topcity->name) }}')" class="dropdown-item">
                            {{ $topcity->name }}
                        </a>
                    @endforeach
                    @endif
                   <input type="hidden" value="{{$scity}}" id="currentcityslug">
                   <input type="hidden" value="" id="currentSelectionSlug">
                </div>
            </div>

            <div class="help-dropdown">
                <a href="{{route('seller-supports')}}" >
                <button class="help-btn" >
                    <i class="fa-solid fa-headset" style="font-size:0.8rem;"></i>
                    <!--<i class="fas fa-chevron-down" style="font-size:0.8rem;"></i>-->
                    Help & Support
                    
                </button>
                </a>
                <!--<div class="dropdown-menu" id="helpMenu">-->
                <!--    <a href="{{route('faqs')}}" class="dropdown-item">FAQ</a>-->
                <!--    <a href="{{route('contact-us')}}" class="dropdown-item">Contact Us</a>-->
                <!--    <a href="{{route('seller-supports')}}" class="dropdown-item">Seller Support</a>-->
                <!--</div>-->
            </div>
            <div class="help-dropdown">
                
                @if(Auth::guard('institute')->check())
                <a href="{{route('institute.dashboard')}}" >
                <button class="help-btn" style="border:1px solid #fff;" >
                    <i class="fa-solid fa-user"  style="font-size:0.8rem;"></i>
                    <!--<i class="fa-solid fa-headset" style="font-size:0.8rem;"></i>-->
                   
                   Dashboard
                </button>
                </a>
                @else
                <a href="{{route('login')}}" >
                <button class="help-btn" style="border:1px solid #fff;" >
                    <i class="fa-solid fa-arrow-right-to-bracket"  style="font-size:0.8rem;"></i>
                    <!--<i class="fa-solid fa-headset" style="font-size:0.8rem;"></i>-->
                   
                   Institute Login
                </button>
                </a>
                @endif
                
                <!--<div class="dropdown-menu" id="helplistings">-->
                <!--    <a href="{{route('login')}}" class="dropdown-item">Log In</a>-->
                <!--    <a href="{{route('list-your-institute')}}" class="dropdown-item">List your Institute</a>-->
                <!--    <a href="{{route('institute-benifit')}}" class="dropdown-item">Listing Benefits</a>-->
                <!--    <a href="{{route('faqs')}}" class="dropdown-item">FAQ</a>-->
                <!--</div>-->
            </div>
        </div>
    </div>
</div>
@push('after-scripts')
<script>
function changeCity(e, citySlug) {
    e.preventDefault();

    // Current path ko lowercase me le lo
    const currentPath = window.location.pathname.toLowerCase();

    // Remove leading/trailing slashes
    let path = currentPath.replace(/^\/|\/$/g, '');

    let newUrl = '/'; // Default URL

    // Home page
    if (path === '' || path === 'home') {
        newUrl = `/educational-institute-in-${citySlug}`;
    }
    // Listing page (category slug pattern)
    else if (!path.startsWith('legal-policies') && !path.includes('/')) {
        // Agar already city added
        if (path.includes('-in-')) {
            path = path.split('-in-')[0];
        }
        newUrl = `/${path}-in-${citySlug}`;
    }
    // Any other page (details or other slugs)
    else {
        newUrl = `/educational-institute-in-${citySlug}`;
    }

    // Redirect
    window.location.href = newUrl;
}
</script>
<script>
function setall() {
    let path = window.location.pathname;

    // case 1: home with city → go to base home
    if (path.includes('educational-institute-in-')) {
        window.location.href = "{{ url('/') }}";
        return;
    }

    // case 2: remove "-in-city" from any URL
    const newPath = path.replace(/-in-[a-z0-9-]+$/, '');

    window.location.href = "{{ url('/') }}" + newPath;
}
</script>
@endpush