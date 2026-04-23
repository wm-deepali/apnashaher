<style>
    .main-header {
    background: #fff;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.main-container {
    width: 95%;
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Logo */
.logo {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.logo img {
    height: 45px;
}

.logo p {
    font-size: 12px;
    margin: 0;
    color: #555;
}

/* Search */
.search-container {
    position: relative;
    width: 40%;
}

.search-bar {
    width: 100%;
    padding: 10px 15px 10px 35px;
    border-radius: 25px;
    border: 1px solid #ddd;
    outline: none;
}

.search-icon {
    position: absolute;
    top: 50%;
    left: 12px;
    transform: translateY(-50%);
    color: #888;
}

/* Right section */
.right-section {
    display: flex;
    align-items: center;
}

/* Button */
/*.list-btn {*/
/*    background: linear-gradient(135deg, #0d6efd, #42a5f5);*/
/*    color: #fff;*/
/*    border: none;*/
/*    padding: 10px 18px;*/
/*    font-size: 14px;*/
/*    font-weight: 600;*/
/*    border-radius: 8px;*/
/*    cursor: pointer;*/
/*    transition: 0.3s;*/
/*    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25);*/
/*    display: flex;*/
/*    align-items: center;*/
/*    gap: 6px;*/
/*}*/

.list-btn:hover {
    transform: translateY(-2px);
}

/* Mobile Search Icon (hidden desktop) */
.mobile-search-icon {
    display: none;
}

/* 🔥 MOBILE VIEW */
@media (max-width: 768px) {
    .mobile-search-icon{
        display:none;
    }
    
    .main-container{
        flex-direction:row;
        flex-wrap:nowrap !important;
    }

    .logo p {
        display: none;
    }

.logo img{

    height:33px;
}
    .search-container {
        display: none;
        width: 100%;
        margin-top: 10px;
    }

    .search-container.active {
        display: block;
        animation: slideDown 0.3s ease;
    }

    .mobile-search-icon {
        display: flex;
        gap:5px;
        /*flex-direction:column;*/
        align-items:center;
        font-size: 14px;
        /*margin-right: 10px;*/
        cursor: pointer;
        /*background: #f1f5f9;*/
        /*padding: 8px 10px;*/
        border-radius: 8px;
    }

    .right-section {
        display: flex;
        align-items: center;
        gap:10px;
        
    }

    .top-header-list-btn {
        display:none;
        padding: 8px 12px;
        font-size: 13px;
    }

    .main-container {
        flex-wrap: wrap;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
}

/* NORMAL MOBILE HEADER */

@media (min-width: 769px) {
    .mobile-top-header {
    display: none !important;
}
}

/* MOBILE VIEW */
@media (max-width: 768px) {

    .mobile-top-header {
        display: block;
        text-align: center;
        padding: 12px;
        background: #fff;
    }

.top-logo{
    display:flex;
    flex-direction: column;
    align-items:center;
    margin-bottom:15px;
}
.top-logo p{
    font-size:12px;
}
    .top-logo img {
        height: 40px;
        /*margin-bottom: 10px;*/
    }

    .top-search input {
        width: 100%;
        padding: 10px;
        border-radius: 25px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
    }

    .top-btn {
        display: block;
        background: linear-gradient(135deg, #0d6efd, #42a5f5);
        color: #fff;
        padding: 10px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
    }

    /* STICKY HEADER DEFAULT HIDE */
    .main-header {
        position: fixed;
        top: -100px;
        width: 100%;
        transition: 0.3s;
    }

    /* SHOW WHEN SCROLL */
    .main-header.active {
        top: 0;
    }
     .top-actions-card {
        display: flex;
        justify-content: space-between;
        background: #f8fafc; /* light pastel */
        border-radius: 3px;
        padding: 10px;
        /*box-shadow: 0 4px 12px rgba(0,0,0,0.05);*/
    }

    /* ITEM */
    .action-item {
        /*flex: 1;*/
        text-align: center;
        font-size: 12px;
        color: #444;
        cursor: pointer;
        display: flex;
        /*flex-direction: column;*/
        align-items: center;
        gap: 4px;
        transition: 0.3s;
    }

    .action-item i {
        font-size: 16px;
        /*background: #ffffff;*/
        padding: 4px;
        /*border-radius: 10px;*/
        /*box-shadow: 0 2px 6px rgba(0,0,0,0.08);*/
    }

    .action-item:hover {
        transform: translateY(-2px);
    }
}

/* SEARCH DROPDOWN */
.mobile-search-box {
    display: none;
    padding: 10px;
    background: #fff;
    border-top: 1px solid #eee;
}

.mobile-search-box.active {
    display: block;
    animation: slideDown 0.3s ease;
}

.mobile-search-box input {
    width: 100%;
    padding: 10px;
    border-radius: 25px;
    border: 1px solid #ddd;
}


.mobile-search-box1 {
    display: none;
    
    padding: 10px;
    background: #fff;
    border-top: 1px solid #eee;
}

.mobile-search-box1.active {
    display: block;
    animation: slideDown 0.3s ease;
}

.mobile-search-box1 input {
    width: 100%;
    padding: 10px;
    border-radius: 25px;
    border: 1px solid #ddd;
}
/* LOCATION POPUP */
.location-popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 999;
}

.location-popup.active {
    display: flex;
}

.location-content {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    width: 80%;
    text-align: center;
}

.location-content ul {
    list-style: none;
    padding: 0;
}

.location-content li {
    padding: 10px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

/* DRAWER MENU */
.mobile-drawer {
    position: fixed;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: #fff;
    z-index: 1000;
    transition: 0.3s;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
}

.mobile-drawer.active {
    left: 0;
}

.drawer-content {
    padding: 15px;
}

.drawer-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    border-bottom:1px solid gray;
    padding-bottom:10px;
}

.drawer-content a {
    display: block;
    text-align:start;
    padding: 10px 0;
    border-bottom: 1px solid #eee;
    text-decoration: none;
    color: #333;
}

/* ANIMATION */
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px);}
    to { opacity: 1; transform: translateY(0);}
}

.drawer-profile-card {
  background: #f5f7fb;
  padding: 15px;
  border-bottom: 1px solid #ddd;
}

.profile-top {
  display: flex;
  align-items: center;
  gap: 10px;
}

.profile-logo {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  object-fit: cover;
}

.profile-info h5 {
  margin: 0;
  font-size: 16px;
}

.dashboard-btn {
  display: block;
  margin-top: 10px;
  text-align: center !important;
  background: #007bff !important;
  color: #fff !important;
  padding: 8px;
  border-radius: 6px;
  text-decoration: none;
  font-size: 14px;
}


</style>
<!-- NORMAL MOBILE HEADER -->
<div class="mobile-top-header" id="mobileTopHeader">
    
    <div class="top-logo">
         <a href="{{route('home')}}" class="logo">
        <img src="https://apnashaher.com/7z7J6JUAFLAaTf3JffWL7k4qfn1wTlwD1qH4inko.svg" />
        <p>✔ Local institutes ✔ Local discovery ✔ Local trust</p>
        </a>
    </div>

   

     <div class="top-actions-card">

        <div class="action-item" onclick="toggleSearch()">
            <i class="fas fa-search"></i>
            <span>Search</span>
        </div>

        <div class="action-item" onclick="toggleLocation()">
            <i class="fas fa-location"></i>
            <span>Location</span>
        </div>

        <div class="action-item" onclick="window.location.href='{{route('list-your-institute')}}'">
            <i class="fas fa-plus"></i>
            <span>List Institute</span>
        </div>

        <div class="action-item" onclick="toggleMenu()">
            <i class="fas fa-bars"></i>
            <span>Menu</span>
        </div>

    </div>
    <div class="mobile-search-box" id="mobileSearchBox">
    <input type="text" placeholder="Search institutes, courses..." />
</div>




</div>

<header class="main-header">
    <div class="main-container">

        <!-- Logo -->
        <a href="{{route('home')}}" class="logo">
            <img src="https://apnashaher.com/7z7J6JUAFLAaTf3JffWL7k4qfn1wTlwD1qH4inko.svg" />
            <p>✔ Local institutes ✔ Local discovery ✔ Local trust</p>
        </a>

        <!-- Search -->
        <div class="search-container">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="search-bar"
                placeholder="Search for coaching Institutes, Courses, Exams..." />
        </div>

        <!-- Right Section -->
<!--        <div class="right-section">-->

            <!-- Mobile Search Icon -->
<!--            <div class="mobile-search-icon" onclick="toggleSearch()">-->
<!--                <i class="fas fa-search"></i>-->
<!--                Search-->
<!--            </div>-->
<!--            <div class="mobile-search-icon" onclick="toggleSearch()">-->
<!--<i class="fas fa-location"></i>-->
<!--                Location-->
<!--            </div>-->

            <!-- Button -->
<!--            <a href="{{route('list-your-institute')}}">-->
<!--                <button class="list-btn">-->
<!--                    <i class="fas fa-plus"></i> List Your Institute-->
<!--                </button>-->
<!--            </a>-->

<!--        </div>-->
<div class="right-section">
    <div class="mobile-search-icon" onclick="toggleHeaderSearch()">
        <i class="fas fa-search"></i>
        Search
    </div>
    
    <div class="mobile-search-icon" onclick="toggleLocation()">
            @php
                $topcities = topcities();
                
            @endphp
        <i class="fas fa-location-dot"></i>
        {{ $topcities->where('slug', request()->path())->first()->name ?? "Location" }}
    </div>

    <a href="{{route('list-your-institute')}}">
        <button class="list-btn top-header-list-btn">
            <i class="fas fa-plus"></i> List Your Institute
        </button>
    </a>
</div>
<!-- Header Search Dropdown (for sticky header search icon) -->


    </div>
    <div class="mobile-search-box1" id="headerSearchBox" style="display: none; padding: 10px 15px; background: #fff; border-top: 1px solid #eee;">
    <input type="text" 
           class="search-bar" 
           placeholder="Search institutes, courses..." 
           style="width: 100%;">
</div>
</header>
<div class="location-popup" id="locationPopup">
    <div class="location-content">
        <div class="d-flex justify-content-between" style="display:flex; justify-content:space-between;padding-bottom:10px; font-weight:600;">
             <h4>Select Location</h4>
             <button onclick="closeLocation()">Close</button>
        </div>
        <hr>
       
        <ul>
             @if(isset($topcities) && count($topcities) > 0)
                    @foreach($topcities as $topcity)
                       <li> <a href="/{{$topcity->slug}}" onclick="changeCity(event, '{{$topcity->slug}}')" class="dropdown-item">
                            {{ $topcity->name }}
                        </a></li>
                    @endforeach
                    @endif
            
        </ul>
       
    </div>
</div>
<div class="mobile-drawer" id="mobileDrawer">
  <div class="drawer-content">

    <!-- 🔥 Top Profile Card -->
    

    <!-- Header -->
    <div class="drawer-header">
      <h4>Menu</h4>
      <span onclick="toggleMenu()">✖</span>
    </div>
<div class="drawer-profile-card">
      <div class="profile-top">
        <img src="https://apnashaher.com/7z7J6JUAFLAaTf3JffWL7k4qfn1wTlwD1qH4inko.svg" alt="logo" class="profile-logo">
        
        <div class="profile-info">
          <h5>{{ auth()->user()->name ?? 'Web Mingo IT Solutions Private Limited' }}</h5>
        </div>
      </div>

      <a href="{{route('institute.dashboard')}}" class="dashboard-btn">
        Go to Dashboard
      </a>
    </div>
    <div class="" style="    height: 70vh;
    overflow: auto;">
    <!-- Menu Links -->
    <a href="{{route('home')}}">Home</a>
    <a href="{{route('institute.dashboard')}}">My Dashboard</a>
    <a href="#">Enquiries</a>
    <a href="{{route('about-us')}}">About Us</a>
    <a href="{{route('why-us')}}">Why ApnaShaher</a>
    <a href="{{route('career')}}">Career with Us</a>
    <a href="{{route('blogs')}}">Blogs</a>
    <a href="{{route('contact-us')}}">Contact Us</a>
    <a href="{{route('institute-benifit')}}">Institute Benefits</a>
    <a href="{{route('list-your-institute')}}">List Your Institute (Free)</a>
    <a href="{{route('advertise-with-us')}}">Advertise with Us</a>
    <a href="{{route('plans')}}">Pricing & Plans</a>
    <a href="{{route('login')}}">Login & Signup</a>
    <a href="{{route('faqs')}}">FAQ</a> 
    <a href="{{route('seller-supports')}}">Institute Support</a>

    @php
      $pages = footerpages();
    @endphp

    @if(isset($pages) && count($pages) > 0)
      @foreach($pages as $page)
        <a href="{{ route('page.show', ['slug' => $page->slug]) }}">
          {{$page->title}}
        </a> 
      @endforeach
    @endif

  </div>
  </div>
</div>


<script>

// 🔍 Search toggle
function toggleSearch() {
    document.getElementById("mobileSearchBox").classList.toggle("active");
}

// 📍 Location open
function toggleLocation() {
    document.getElementById("locationPopup").classList.add("active");
}

// 📍 Close location
function closeLocation() {
    document.getElementById("locationPopup").classList.remove("active");
}

// 📍 Set location
function setLocation(city) {
    alert("Selected: " + city);
    closeLocation();
}

// ☰ Drawer toggle
function toggleMenu() {
    document.getElementById("mobileDrawer").classList.toggle("active");
}

// ❗ Close drawer on outside click
window.addEventListener("click", function(e) {
    let drawer = document.getElementById("mobileDrawer");
    if (!drawer.contains(e.target) && !e.target.closest(".action-item")) {
        drawer.classList.remove("active");
    }
});

</script>



<script>
window.addEventListener("scroll", function () {
    const header = document.querySelector(".main-header");
    const topHeader = document.getElementById("mobileTopHeader");

    if (window.scrollY > 120) {
        header.classList.add("active");
        topHeader.style.display = "none";
    } else {
        header.classList.remove("active");
        topHeader.style.display = "block";
    }
});
</script>
<script>
// 🔍 Toggle Top Mobile Search (already existing)
function toggleSearch() {
    const searchBox = document.getElementById("mobileSearchBox");
    searchBox.classList.toggle("active");
}

// 🔍 Toggle Header Search (new - for right section search icon)
function toggleHeaderSearch() {
    const headerSearch = document.getElementById("headerSearchBox");
    
    if (headerSearch.style.display === "none" || headerSearch.style.display === "") {
        headerSearch.style.display = "block";
    } else {
        headerSearch.style.display = "none";
    }
}

// 📍 Location
function toggleLocation() {
    document.getElementById("locationPopup").classList.add("active");
}

function closeLocation() {
    document.getElementById("locationPopup").classList.remove("active");
}

function setLocation(city) {
    alert("Selected: " + city);
    closeLocation();
}

// ☰ Drawer Menu
function toggleMenu() {
    document.getElementById("mobileDrawer").classList.toggle("active");
}

// Close drawer when clicking outside
window.addEventListener("click", function(e) {
    let drawer = document.getElementById("mobileDrawer");
    if (!drawer.contains(e.target) && !e.target.closest(".action-item")) {
        drawer.classList.remove("active");
    }
});
</script>



