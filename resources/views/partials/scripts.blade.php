<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const swiper = new Swiper('.testimonialSlider', {
    loop: true,
    autoplay: {
      delay: 6000,
      disableOnInteraction: false,
      waitForTransition: false,
    },
    speed: 1200,
    spaceBetween: 32,
    slidesPerView: 1,
    breakpoints: {
      640: { slidesPerView: 2 },
      768: { slidesPerView: 3 },
      1024: { slidesPerView: 3 }
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
      dynamicBullets: true,
    },
    grabCursor: true,
    watchSlidesProgress: true,
    on: {
      slideChangeTransitionEnd: function () {
        if (this.autoplay.running === false) {
          this.autoplay.start();
        }
      },
      touchStart: function () {
        this.autoplay.stop();
      },
      touchEnd: function () {
        setTimeout(() => this.autoplay.start(), 3000);
      }
    }
  });

  // Hover pause/resume
  const sliderEl = document.querySelector('.testimonialSlider');
  if (sliderEl) {
  sliderEl.addEventListener('mouseenter', () => swiper.autoplay.stop());
  sliderEl.addEventListener('mouseleave', () => swiper.autoplay.start());
}
});
</script>


<script>
document.querySelectorAll(".faq-item").forEach(item => {
    item.addEventListener("click", () => {
        
        // Close all if you want only one open at a time
        document.querySelectorAll(".faq-item").forEach(i => {
            if (i !== item) {
                i.classList.remove("active");
                i.querySelector(".faq-icon").textContent = "+";
                i.querySelector(".faq-answer").style.display = "none";
            }
        });

        // Toggle current
        item.classList.toggle("active");

        let icon = item.querySelector(".faq-icon");
        let answer = item.querySelector(".faq-answer");

        if (item.classList.contains("active")) {
            icon.textContent = "-";
            answer.style.display = "block";
        } else {
            icon.textContent = "+";
            answer.style.display = "none";
        }
    });
});
</script>



<script>
// Simple step navigation
function goToStep(stepNumber) {
  // Hide all steps
  document.querySelectorAll('.step-card').forEach(card => {
    card.style.display = 'none';
    card.classList.remove('active');
  });

  // Show selected step
  const targetStep = document.getElementById(`step${stepNumber}`);
  if (targetStep) {
    targetStep.style.display = 'block';
    targetStep.classList.add('active');
  }

  // Update progress bar
  document.querySelectorAll('.progress-step').forEach((dot, index) => {
    dot.classList.toggle('active', index + 1 <= stepNumber);
  });
}

// Show steps when user clicks "Start Listing Now"
document.querySelector('.start-listing')?.addEventListener('click', () => {
  document.getElementById('stepsWrapper').style.display = 'block';
  goToStep(1); // Start from step 1
});

// Optional: You can add form validation later
</script>


    <script>
        // ==================== DATA (with subcategory for filtering) ====================
        const categories = @json(getHomeCategories());
        const baseUrl = "{{ url('/') }}"; // Laravel helper for site URL

        const subcategoriesData = @json(getHomeSubcategories());

        const sellerData = @json(getHomeSeller());

        const adImages = [
    window.innerWidth <= 768 
        ? "https://apnashaher.com/public/assets/slider/add-ban-mobile.png.png"
        : "https://apnashaher.com/public/assets/slider/add-ban.png",

    window.innerWidth <= 768 
        ? "https://apnashaher.com/public/assets/slider/add-ban1-mobile.png.png"
        : "https://apnashaher.com/public/assets/slider/add-ban1.png",
];

        
        let currentCategory = null;
        let currentSub = "All Subcategories";

        // ==================== RENDER FUNCTIONS ====================
        function renderCategories() {
            const container = document.getElementById('categoryListside');
            const containermobile = document.getElementById('categoryList');
            if(container)
            {
              container.innerHTML = '';
              categories.forEach(cat => {
                  const div = document.createElement('div');
                  div.className = `category-card ${cat.id === 1 ? 'active' : ''}`;
                  div.setAttribute('data-id', cat.id); // ✅ add this line
                  div.innerHTML = `<i class="${cat.icon}"></i><span>${cat.name}</span>`;
                  div.onclick = () => selectCategory(cat.id, div);
                  container.appendChild(div);
              });
            }
            if(containermobile)
            {
              containermobile.innerHTML = '';
              categories.forEach(cat => {
                  const div = document.createElement('div');
                  div.className = `category-card ${cat.id === 1 ? 'active' : ''}`;
                  div.setAttribute('data-id', cat.id); // ✅ add this line
                  div.innerHTML = `<i class="${cat.icon}"></i><span>${cat.name}</span>`;
                  div.onclick = () => selectCategory(cat.id, div);
                  containermobile.appendChild(div);
              });
            }
            
        }

        function selectCategory(catId, clickedElement = null) {
            // Highlight category
            currentCategory = catId; //  important
            document.querySelectorAll('.category-card').forEach(el => el.classList.remove('active'));
            if (clickedElement) clickedElement.classList.add('active');

            const catName = categories.find(c => c.id == catId).name;
            document.getElementById('activeCategoryName').textContent = catName;

            // Render subcategories with "All" as first
            const subContainer = document.getElementById('subGrid');
            const drawerSubCategoryListContainer = document.getElementById('drawerSubCategoryList');
            subContainer.innerHTML = '';
            if(drawerSubCategoryListContainer)
            {
                drawerSubCategoryListContainer.innerHTML = '';
                const subs = ["All Subcategories", ...(subcategoriesData[catId] || [])];

                subs.forEach((sub, index) => {
                    const clone = document.createElement('div');
                    clone.className = `sub-card ${index === 0 ? 'active' : ''}`;
                    clone.textContent = sub;
                    clone.onclick = () => selectSubcategory(sub, clone);
                    drawerSubCategoryListContainer.appendChild(clone);
                });

                // Make drawer subcategory list visible when category clicked
                drawerSubCategoryListContainer.classList.remove('hidden');
                document.getElementById('categoryList').classList.add('hidden'); // hide main category
            }

            const subs = ["All Subcategories", ...(subcategoriesData[catId] || [])];

            subs.forEach((sub, index) => {
                const card = document.createElement('div');
                card.className = `sub-card ${index === 0 ? 'active' : ''}`;
                card.textContent = sub;
                card.onclick = () => selectSubcategory(sub, card);
                subContainer.appendChild(card);
                
                
            });

            // Default: All selected
            currentSub = "All Subcategories";

            filterSellersBySub();
        }

        function selectSubcategory(subName, clickedElement) {
            // Highlight only this sub
            document.querySelectorAll('.sub-card').forEach(el => el.classList.remove('active'));
            clickedElement.classList.add('active');

            currentSub = subName;
            filterSellersBySub();
        }
        document.addEventListener("DOMContentLoaded", function () {
             renderCategories();
            loadHomeDefault(); // ðŸ‘ˆ FIRST LOAD LOGIC
        });
        function filterSellersBySub() {
            let filtered = sellerData;

            // Category filter
            if (currentCategory) {
                filtered = filtered.filter(s => s.category_id == currentCategory);
            }

            // Subcategory filter (use subcategory_name, NOT courses)
            if (currentSub !== "All Subcategories") {
                filtered = filtered.filter(s => s.subcategory_name === currentSub);
            }

            filtered = sortSellers([...filtered]);

            renderSellerCards(filtered);
        }
        function loadHomeDefault() {
            currentCategory = null;

            let sorted = sortSellers([...sellerData]);

            let latest10 = sorted.slice(0, 10);

            renderSellerCards(latest10);
        }
        function sortSellers(data) {

            // âœ… Step 1: Clone (VERY IMPORTANT)
            let arr = [...data];

            // âœ… Step 2: Group by plan_priority
            let groups = {};

            arr.forEach(item => {
                let key = item.plan_priority || 0;

                if (!groups[key]) {
                    groups[key] = [];
                }

                groups[key].push(item);
            });

            // âœ… Step 3: Sort plan_priority DESC
            let sortedKeys = Object.keys(groups)
                .map(Number)
                .sort((a, b) => b - a);

            // âœ… Step 4: Shuffle each group properly (Fisher-Yates)
            function shuffle(array) {
                let a = [...array];
                for (let i = a.length - 1; i > 0; i--) {
                    let j = Math.floor(Math.random() * (i + 1));
                    [a[i], a[j]] = [a[j], a[i]];
                }
                return a;
            }

            // âœ… Step 5: Merge all groups
            let final = [];

            sortedKeys.forEach(key => {
                let shuffledGroup = shuffle(groups[key]);
                final = final.concat(shuffledGroup);
            });

            return final;
        }
        function renderSellerCards(filtered) {
            const container = document.getElementById('sellerGrid');
            container.innerHTML = '';

            if (filtered.length === 0) {
                container.innerHTML = `
      <div class="no-results">
        No institutes found for this subcategory yet.<br><br>
        Please try "All Subcategories"
      </div>`;
                return;
            }

            filtered.forEach(seller => {
                const card = document.createElement('div');
                card.className = 'seller-card';

                // You can make courses dynamic if you add them to seller data
                // For now using a static example list per card (or from subcategory)
                const exampleCourses = seller.courses || []; // âœ… use courses array

               card.innerHTML = `
<div class="seller-main">

  <!-- TOP ROW (Logo + Name for mobile) -->
  <div class="seller-top">
    
    <div class="seller-logo-wrapper">
      ${seller.logo_type === 'image' 
        ? `<img src="${seller.logo}" alt="${seller.name}" class="seller-logo">`
        : `<div class="seller-logo-letter seller-logo" 
              style="background-color: ${seller.logo_bg_color}; color: ${seller.logo_text_color};">
              ${seller.logo}
           </div>`
      }
    </div>

    <div class="seller-name-row">
      <h3 class="seller-name">
        <a href="${baseUrl}/${seller.slug}">
          ${seller.name}
        </a>
        ${seller.verified ? '<i class="fas fa-check-circle verified-tick"></i>' : ''}
      </h3>
    </div>

  </div>

  <!-- CATEGORY -->
  <div class="courses-slider">
    <div class="course-chip">${seller.category_name}</div>
  </div>

  <hr>

  <!-- DESC -->
  <p class="seller-desc">${seller.desc}</p>

  <!-- LOCATION -->
  <div class="seller-location">
    <i class="fas fa-map-marker-alt"></i> 
    ${seller.location || 'Location not available'}
  </div>

</div>

<!-- SIDEBAR -->
<div class="seller-sidebar">

  <!-- Desktop Logo (mobile me hide hoga) -->
  <div class="desktop-logo">
    ${seller.logo_type === 'image' 
      ? `<img src="${seller.logo}" alt="${seller.name}" class="seller-logo">`
      : `<div class="seller-logo-letter seller-logo" 
            style="background-color: ${seller.logo_bg_color}; color: ${seller.logo_text_color};">
            ${seller.logo}
         </div>`
    }
  </div>

  ${seller.preferred ? `
    <div class="preferred-badge">
      <i class="fas fa-star"></i> Preferred Partner
    </div>
  ` : ''}

  <div class="action-buttons">
    <a href="tel:${seller.mobile}" data-id="${seller.id}" class="action-btn btn-view-contact call-click-btn">
      Call Institute
    </a>

    ${
      seller.whatsapp 
      ? `<a href="https://wa.me/${seller.whatsapp}" data-id="${seller.id}" class="action-btn btn-enquiry whatsapp-click-btn" target="_blank">
          WhatsApp Now
        </a>` 
      : ''
    }
  </div>

</div>
`;

                container.appendChild(card);
            });
        }
        function renderAdRotator() {
            const container = document.getElementById('adRotator');
            container.innerHTML = '';

            adImages.forEach((src, index) => {
                const img = document.createElement('img');
                img.src = src;
                img.className = `ad-slide ${index === 0 ? 'active' : ''}`;
                container.appendChild(img);
            });

            let current = 0;
            setInterval(() => {
                const slides = document.querySelectorAll('.ad-slide');
                slides[current].classList.remove('active');
                current = (current + 1) % adImages.length;
                slides[current].classList.add('active');
            }, 2600);
        }

        // ==================== INIT ====================
        renderCategories();
        //selectCategory(1);        // Default category + first sub (All) active
        renderAdRotator();
        
        document.addEventListener("click", function(e) {
            // Category clicked
            if (e.target.closest('.category-card')) {
                const catDiv = e.target.closest('.category-card');
                const catId = catDiv.dataset.id || catDiv.getAttribute('data-id'); // fallback
                const category = categories.find(c => c.id == catId);
                
                if (category) {
                    document.getElementById('currentSelectionSlug').value = category.slug;
                }
            }
        
            // Subcategory clicked
            if (e.target.closest('.sub-card')) {
                const subDiv = e.target.closest('.sub-card');
                const subName = subDiv.textContent;
                if (currentCategory) {
                    const subSlugMap = subcategoriesData[currentCategory + '_slugMap'] || {};
                    const subSlug = subSlugMap[subName] || '';
                    if (subSlug) {
                        document.getElementById('currentSelectionSlug').value = subSlug;
                    } else {
                        // If "All Subcategories" clicked, save category slug
                        const category = categories.find(c => c.id == currentCategory);
                        if (category) {
                            document.getElementById('currentSelectionSlug').value = category.slug;
                        }
                    }
                }
            }
        });
    </script>



    <script>
        // Basic Fade Slider Logic (no arrows, auto + clickable dots)
        let slideIndex = 1;
        showSlides(slideIndex);

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");

            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active-dot", "");
            }

            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active-dot";

            // Auto slide every 5.5 seconds
            clearTimeout(window.sliderTimer);
            window.sliderTimer = setTimeout(() => {
                showSlides(slideIndex += 1);
            }, 5500);
        }
    </script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            // Select all WhatsApp buttons (using class)
            document.querySelectorAll('.whatsapp-click-btn').forEach(function(btn) {

                btn.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent default link

                    let instituteId = this.dataset.id;
                    let url = this.href; // WhatsApp URL

                    // Prepare POST data
                    let data = new FormData();
                    data.append('institute_id', instituteId);
                    data.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                    // AJAX POST using fetch
                    fetch("{{ route('track.whatsapp') }}", {
                        method: 'POST',
                        body: data
                    })
                    .then(response => response.json())
                    .then(res => {
                        console.log('WhatsApp Click Tracked');
                        // Open WhatsApp after tracking
                        window.open(url, '_blank');
                    })
                    .catch(err => {
                        console.log('Error tracking WhatsApp click', err);
                        // fallback: still open WhatsApp
                        window.open(url, '_blank');
                    });

                });

            });

        });

        document.addEventListener('DOMContentLoaded', function () {

    // Select all Call buttons (using class)
    document.querySelectorAll('.call-click-btn').forEach(function(btn) {

        btn.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link

            let instituteId = this.dataset.id;
            let url = this.href; // tel: link

            // Prepare POST data
            let data = new FormData();
            data.append('institute_id', instituteId);
            data.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            // AJAX POST using fetch
            fetch("{{ route('track.call') }}", {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(res => {
                console.log('Call Click Tracked');
                // Initiate call after tracking
                window.location.href = url; // For tel: links
            })
            .catch(err => {
                console.log('Error tracking call click', err);
                // fallback: still initiate call
                window.location.href = url;
            });

        });

    });

});
        // Simple dropdown toggle
        document.getElementById('locationBtn').addEventListener('click', function (e) {
            e.stopPropagation();
            document.getElementById('locationMenu').classList.toggle('show');
            document.getElementById('helpMenu').classList.remove('show');
            document.getElementById('helplistings').classList.remove('show');
        });

        const helpBtn = document.getElementById('helpBtn');

        if (helpBtn) {
            helpBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            document.getElementById('helpMenu').classList.toggle('show');
            document.getElementById('locationMenu').classList.remove('show');
            document.getElementById('helplistings').classList.remove('show');


        });
        }
        const helplisting = document.getElementById('helpBtn');
        if (helplisting) {
          helplisting.addEventListener('click', function (e) {
              e.stopPropagation();
              document.getElementById('helplistings').classList.toggle('show');
              //document.getElementById('locationMenu').classList.remove('show');
              //document.getElementById('helpMenu').classList.remove('show');
          });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function () {
            document.getElementById('locationMenu').classList.remove('show');
            document.getElementById('helpMenu').classList.remove('show');
            document.getElementById('helplistings').classList.remove('show');
        });
    </script>