<style>
/*    .mobile-footer {*/
/*    position: fixed;*/
/*    bottom: 0;*/
/*    left: 0;*/
/*    width: 100%;*/
/*    background: #fff;*/
/*    display: none;*/
/*    justify-content: space-around;*/
/*    align-items: center;*/
/*    padding: 8px 0;*/
/*    border-top: 1px solid #eee;*/
/*    box-shadow: 0 -4px 15px rgba(0,0,0,0.08);*/
/*    z-index: 999;*/
/*}*/

.mobile-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background: #fff;
    display: none;
    justify-content: space-around;
    align-items: center;
    padding: 8px 0 calc(8px + env(safe-area-inset-bottom));
    border-top: 1px solid #eee;
    box-shadow: 0 -4px 15px rgba(0,0,0,0.08);
    z-index: 999;
}

/* Footer item */
.footer-item {
    text-decoration: none;
    color: #777;
    font-size: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: 0.3s;
}

.footer-item i {
    font-size: 18px;
    margin-bottom: 3px;
}

/* Active state */
.footer-item.active {
    color: #0d6efd;
}

/* Hover */
.footer-item:hover {
    color: #0d6efd;
}

/* Highlight center button */
.footer-item.highlight {
    background: linear-gradient(135deg, #0d6efd, #42a5f5);
    color: #fff;
    /*padding: 8px 10px;*/
   width: 50px;
    height: 50px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius: 50%;
    margin-top: -35px;
    box-shadow: 0 4px 12px rgba(13,110,253,0.4);
}

.footer-item.highlight i {
    font-size: 20px;
}

/* MOBILE ONLY */
@media (max-width: 768px) {
    .mobile-footer {
        display: flex;
    }

    body {
        padding-bottom: 70px; /* footer overlap fix */
    }
    .app-mode-footer{
        display:flex;
        flex-direction:column;
        gap:5px;
        align-items:center;
    }
}

.customdrawer-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    opacity: 0;
    visibility: hidden;
    transition: 0.3s;
    z-index: 998;
}

.customdrawer-drawer {
    position: fixed;
    top: 0;
    left: -100%;
    width: 85%;
    max-width: 320px;
    height: 100%;
    background: #fff;
    z-index: 999;
    transition: 0.3s;
    display: flex;
    flex-direction: column;
}

.customdrawer-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid #eee;
    font-weight: 600;
}

.customdrawer-header span {
    cursor: pointer;
    font-size: 18px;
}

.customdrawer-body {
    padding: 15px;
    overflow-y: auto;
}

/* Cards */
.customdrawer-card {
    background: #f8fafc;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 10px;
    cursor: pointer;
    text-align: start;
    font-weight: 500;
    transition: 0.2s;
}

.customdrawer-card:hover {
    background: #6366f1;
    color: #fff;
}

/* Back button */
.customdrawer-back {
    margin-bottom: 10px;
    font-weight: 600;
    cursor: pointer;
}

/* Hide sub initially */
.customdrawer-sub-list {
    display: none;
}


</style>

<!-- MOBILE FOOTER MENU -->
<div class="mobile-footer">

    <a href="{{route('home')}}" class="footer-item active">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>

    <a href="javascript:void(0)" class="footer-item" onclick="customdrawerOpen()">
    <i class="fas fa-th-large"></i>
    <span>Browse</span>
</a>


    @if(Auth::guard('institute')->check())
    <div class="app-mode-footer">
        <a href="{{route('list-your-institute')}}" class="footer-item highlight">
            <i class="fas fa-plus"></i>
            <!--<span>List</span>-->
        </a>
        <a href="{{route('list-your-institute')}}" class="footer-item">
            <!--<i class="fas fa-plus"></i>-->
            <span>List</span>
        </a>
        </div>

        <a href="{{route('login')}}" class="footer-item">
            <i class="fas fa-sign-in-alt"></i>
            <span>Sign-In</span>
        </a>
    @else
        <a href="{{route('institute.dashboard')}}" class="footer-item">
            <i class="fas fa-user"></i>
            <span>Dashboard</span>
        </a>

        <a href="#" class="footer-item">
            <i class="fas fa-envelope"></i>
            <span>Enquiries</span>
        </a>
    @endif

    <a href="#" class="footer-item">
        <i class="fas fa-headset"></i>
        <span>Support</span>
    </a>

</div>

<div class="customdrawer-overlay" onclick="customdrawerClose()"></div>

<div class="customdrawer-drawer">

    <!-- Header -->
    <div class="customdrawer-header">
        <h4>Browse Categories</h4>
        <span onclick="customdrawerClose()">✖</span>
    </div>

    <!-- Categories -->
    <div class="customdrawer-body">

        <!-- Main Categories -->
        <div class="customdrawer-category-list" id="mainCategory">
           @php 
                $drawcategories = getDreawerCategories();
            @endphp
            @foreach($drawcategories as $category)
                <div class="customdrawer-card" 
                     onclick="handleCategoryClick('{{ $category->id }}', '{{ $category->slug }}', {{ $category->children->count() }})">
                    {{ $category->name }}
                </div>
            @endforeach
            
        </div>
       @foreach($drawcategories as $category)
        <div class="customdrawer-sub-list" id="cat-{{ $category->id }}" style="display:none;">
            <div class="customdrawer-back" onclick="showMain()">← Back</div>
    
            @foreach($category->children as $child)
                <div class="customdrawer-card" onclick="navigateToSub('{{ $category->slug }}','{{ $child->slug }}')">
                    {{ $child->name }}
                </div>
            @endforeach
        </div>
    @endforeach
       

    </div>

</div>

<footer class="apna-footer bg-[#0f1e3a] text-gray-300 pt-16 pb-6">
  <div class="apna-footer-container max-w-7xl mx-auto px-6 lg:px-8">

    <!-- Popular Cities - Single Row, 5 Cities -->
  

    <!-- Products & Services Categories (as in your screenshot) -->
   

    
    <!-- Explore / Buyer / Seller / Quick / Important Links -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-10">
        <!-- Brand / About ApnaShaher -->
  <div>
    <h3 class="apna-footer-heading">APNASHAHER.COM</h3>
    <p class="apna-footer-text mt-3">
      ApnaShaher is a local-first platform helping students discover trusted educational institutes in different cities of India,   
      and enabling institutes to get discovered by nearby learners. 
      its re-launched under <strong>Web Mingo IT Solutions Private Limited</strong>
    
    </p>
    <p class="apna-footer-text mt-2">
      Helping local institutes get discovered since 2008.
    </p>
  </div>
  
      <div>
        <h3 class="apna-footer-heading">Explore Us</h3>
        <ul class="apna-footer-list mt-3">
          <li><a href="{{route('about-us')}}"> About Us</a></li>
          <li><a href="{{route('why-us')}}">Why ApnaShaher</a> </li>
          <li><a href="{{route('career')}}">Career with Us</a></li>
          <li><a href="{{route('blogs')}}">Blogs</a> </li>
          <li><a href="{{route('contact-us')}}"> Contact Us</a> </li>
          <li>Follow us :</li>
          <li class="flex gap-6 mt-4">
            <a href="#" class="apna-social"><i class="fab fa-facebook-f text-xl"></i></a>
            <a href="#" class="apna-social"><i class="fab fa-instagram text-xl"></i></a>
            <!--<i class="fab fa-linkedin-in"></i>-->
            <a href="#" class="apna-social"><i class="fab fa-linkedin-in text-xl"></i></a>
            <a href="#" class="apna-social"><i class="fab fa-youtube text-xl"></i></a>
            
            <a href="#" class="apna-social"><i class="fa-brands fa-x-twitter text-xl"></i></a>
          </li>
        </ul>
      </div>

      <div>
        <h3 class="apna-footer-heading">For Institutes</h3>
        <ul class="apna-footer-list mt-3">
          <li><a href="{{route('institute-benifit')}}"> Institute Benefits</a></li>
          <li><a href="{{route('list-your-institute')}}">List Your Institute (Free)</a> </li>
          <li><a href="{{route('advertise-with-us')}}"> Advertise with Us</a> </li>
          <li><a href="{{route('plans')}}">Pricing & Plans</a></li>
          <li><a href="{{route('login')}}">Login & Signup</a> </li>
        </ul>
      </div>

      <div>
        <h3 class="apna-footer-heading">Help & Support</h3>
        <ul class="apna-footer-list mt-3">
          <li><a href="{{route('faqs')}}">FAQ</a> </li>
          <li><a href="{{route('seller-supports')}}"> Institute Support</a></li>
          <li>Share your Feedback</li>
          <li>Report an Issue</li>
         
        </ul>
      </div>
      <div>
        <h3 class="apna-footer-heading">Legal & Policies</h3>
        <ul class="apna-footer-list mt-3">
          <!-- <li><a href="{{route('terms-conditions')}}">Terms of Use</a> </li> -->
          @php
            $pages = footerpages();
            
          @endphp
          @if(isset($pages) && count($pages) > 0)
          @foreach($pages as $page)
          <li><a href="{{ route('page.show', ['slug' => $page->slug]) }}">{{$page->title}}</a> </li>
          @endforeach
          @endif
          
        </ul>
      </div>
    </div>

    <!-- Horizontal Divider before Disclaimer -->
    <hr class="apna-divider my-6 border-gray-700">

    <!-- Disclaimer & Copyright -->
    <div class="text-center text-sm text-gray-400">
      <p>
        DISCLAIMER: ApnaShaher provides institute listings for informational purposes only. Details are shared by institutes and may change. 
        Users are advised to verify information independently.
      </p>
        <hr class="apna-divider my-6 border-gray-700">
      <p class="mt-3">
        ©2008-2026 ApnaShaher.com. All rights reserved.
      </p>
    </div>
  </div>
</footer>

    <script>
function customdrawerOpen() {
    document.querySelector('.customdrawer-drawer').style.left = "0";
    document.querySelector('.customdrawer-overlay').style.opacity = "1";
    document.querySelector('.customdrawer-overlay').style.visibility = "visible";
}

function customdrawerClose() {
    document.querySelector('.customdrawer-drawer').style.left = "-100%";
    document.querySelector('.customdrawer-overlay').style.opacity = "0";
    document.querySelector('.customdrawer-overlay').style.visibility = "hidden";
}
function handleCategoryClick(catId, catSlug, hasChildren) {
    if (hasChildren) {
        // Show subcategory drawer
        document.getElementById('mainCategory').style.display = 'none';
        document.getElementById('cat-' + catId).style.display = 'block';
    } else {
        // Navigate directly to category page
        window.location.href = `{{ url('/') }}/${catSlug}-institutes`;
    }
}

function navigateToSub(catSlug, subSlug) {
   
    // Navigate to category + subcategory page
    window.location.href = `{{ url('/') }}/${subSlug}-institutes`;
}

function showMain() {
    // Go back to main category drawer
    document.querySelectorAll('.customdrawer-sub-list').forEach(el => el.style.display = 'none');
    document.getElementById('mainCategory').style.display = 'block';
}
</script>

