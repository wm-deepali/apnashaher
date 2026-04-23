<!-- Hero Slider + Ad Section -->
<style>
    .ad-card{
        padding:10px;
    }
     .list-unstyled{
         gap:20px;
     }
     .mobile-style{
         height:290px;
     }
     .ad-card{
         height:290px;
     }
      .slideshow-container {
    position: relative;
    max-width: 100%;
    margin: auto;
    overflow: hidden;
    height: 290px;          
}
    @media (max-width: 768px) {
 .ad-card{
        padding:0px;
        height:auto;
    }
    .list-unstyled{
        /*flex-direction:column;*/
    }
    .list-unstyled{
         gap:20px;
     }
     .list-unstyled li{
         display:flex;
         flex-direction:column;
         align-items:center;
     }
      .list-unstyled li span{
         width:30px;
         height:30px;
         border-radius:50%;
         background:#fff;
         display:flex;
         align-items:center;
         justify-content:center;
     }
     .mobile-style{
         padding-bottom:36px;
     }
     .seller-logo-wrapper{
         height: 145px;
     }
 }
 


/* Slides */
.mySlides {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 1.2s ease-in-out;   /* Fade effect */
    display: none;
}

.mySlides.active {
    opacity: 1;
    display: block;
}

/* Images */
.mySlides img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Dots */
.dots-container {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}

.dot {
    cursor: pointer;
    height: 12px;
    width: 12px;
    background-color: rgba(255,255,255,0.6);
    border-radius: 50%;
    transition: background-color 0.3s;
}

.dot.active {
    background-color: #fff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
}
</style>
 
<section class="hero-section">
    <div class="hero-container">
        <!-- Left - Slider (8/12 width on large screens) -->
        <div class="slider-wrapper">
          {{--  <div class="slideshow-container">
                 Slide 1 
                <div class="mySlides fade">
                    <img src="{{ asset('assets/slider/slider1.jpg')}}"
                        alt="Education Banner 1" style="width:100%; height:100%; ">

                </div>

                 Slide 2 
                <div class="mySlides fade">
                    <img src="{{ asset('assets/slider/slider2.jpg')}}"
                        alt="Education Banner 2" style="width:100%; height:100%; ">

                </div>

                 Slide 3 
                <div class="mySlides fade">
                    <img src="{{ asset('assets/slider/slider3.jpg')}}"
                        alt="Education Banner 3" style="width:100%; height:100%; ">
                     <div class="slide-text">
        <h2>List Your Institute Today</h2>
        <p>Reach thousands of genuine students</p>
        </div> -->
                </div>

                 Dots / Progress Indicators 
                <div class="dots-container">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div> --}}
        <div class="slideshow-container">

    <!-- Slide 1 -->
    <div class="mySlides fade">
        <img src="{{ asset('assets/slider/apnashaher-banner.jpg
') }}" 
             alt="Education Banner 1" 
             style="width:100%; height:100%; object-fit: inherit;">
    </div>

    <!-- Slide 2 -->
    <div class="mySlides fade">
        <img src="{{ asset('assets/slider/webmingo-apnashaher-banner.jpg') }}" 
             alt="Education Banner 2" 
             style="width:100%; height:100%; object-fit: inherit;">
    </div>

    <!-- Slide 3 -->
    <div class="mySlides fade">
        <img src="{{ asset('assets/slider/slider3.jpg') }}" 
             alt="Education Banner 3" 
             style="width:100%; height:100%; object-fit: inherit;">
    </div>

    <!-- Dots -->
    <div class="dots-container">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

</div>
        </div>

        <!-- Right - Advertisement (4/12 width) -->
        <div class="ad-wrapper">
            <div class="ad-card bg-white border border-light-subtle rounded-3 shadow-sm overflow-hidden  mx-auto" style="
    align-items: center;
    display: flex;
    flex-direction: column;
    width: 100%;
    
" >
    <div class="p-4 text-center mobile-style" style="
    align-items: center;
    display: flex;
    flex-direction: column;
    width: 100%;
    background: #eaedff
">
        <h4 class="fw-bold mb-3 baner-head" style="">
            Own or Manage an Institute?
        </h4>

        <p class="text-muted mb-4" style="font-size: 0.95rem; line-height: 1.5;">
            Create your profile and get discovered by students nearby.
        </p>

        <ul class="list-unstyled mb-4 text-start d-inline-block d-flex" style="display:flex; justify-content:center;">
            <li class="mb-2" style="font-size: 0.92rem; font-weight: 500;">
                <span class="text-success me-2 fw-bold">✔</span>Free Listing
            </li>
            <li class="mb-2" style="font-size: 0.92rem; font-weight: 500;">
                <span class="text-success me-2 fw-bold">✔</span>Verified visibility
            </li>
            <li style="font-size: 0.92rem; font-weight: 500;">
                <span class="text-success me-2 fw-bold">✔</span>Upgrade anytime
            </li>
        </ul>

        <a href="{{route('list-your-institute')}}" 
           class="btn btn-sm px-4 py-2 fw-semibold text-white rounded-pill shadow-sm d-inline-block"
           style="background: linear-gradient(135deg, #6366f1, #4f46e5); font-size: 0.95rem; transition: all 0.25s ease;">
            List Your Institute
        </a>
    </div>
</div>


    <style>
        .ad-card {
            transition: all 0.3s ease;
        }
        .ad-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0,0,0,0.08) !important;
        }
        .ad-card .btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.3);
        }
    </style>

        </div>
    </div>
</section>
<script>
    let slideIndex = 0;
let timer;

function showSlides() {
    const slides = document.getElementsByClassName("mySlides");
    const dots = document.getElementsByClassName("dot");

    // Hide all slides
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
        dots[i].classList.remove("active");
    }

    slideIndex++;
    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    slides[slideIndex - 1].classList.add("active");
    dots[slideIndex - 1].classList.add("active");

    // Auto slide every 5 seconds
    clearTimeout(timer);
    timer = setTimeout(showSlides, 5000);
}

// Manual slide change
function currentSlide(n) {
    slideIndex = n - 1;
    showSlides();
}

// Initialize
document.addEventListener("DOMContentLoaded", function() {
    showSlides();
});
</script>