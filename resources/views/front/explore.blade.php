@extends('layouts.app')
@section('title', 'Institute Listing')
@push('styles')
<style>
        .listing-page-section {
            background: #f8f9fc;
            padding: 60px 20px;
        }

        .listing-container {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 40px;
        }

        @media (max-width: 1100px) {
            .listing-container {
                grid-template-columns: 1fr;
            }

            .listing-sidebar {
                position: static;
            }
        }

        /* Sidebar */
        .listing-sidebar {
            position: sticky;
            top: 100px;
            align-self: start;
            z-index: 10;
        }

        .sidebar-title {
            font-size: 1.45rem;
            font-weight: 700;
            color: #1565c0;
            margin-bottom: 22px;
            padding-bottom: 14px;
            border-bottom: 3px solid #bbdefb;
        }

        .category-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .category-card {
            background: #e3f2fd;
            border-radius: 14px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            cursor: pointer;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .category-card:hover,
        .category-card.active {
            background: #bbdefb;
            border-color: #1565c0;
            transform: translateX(8px);
            box-shadow: 0 8px 20px rgba(21, 101, 192, 0.15);
        }

        .category-card i {
            font-size: 1.8rem;
            color: #1565c0;
            width: 36px;
        }

        .category-card span {
            font-weight: 600;
            color: #0d1117;
            font-size: 1.08rem;
        }

        /* Header */
        .listing-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
                margin-bottom: 10px;
    border-bottom: 1px solid #80808038;
    padding-bottom: 15px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .listing-title {
            font-size: 24px;
            font-weight: 800;
            color: #0d1117;
        }

        .listing-count {
            background: #e3f2fd;
            color: #1565c0;
            padding: 6px 18px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.05rem;
        }

        .sort-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sort-label {
            font-weight: 600;
            color: #555;
            font-size: 1rem;
        }

        .sort-select {
            padding: 10px 20px;
            border: 1.5px solid #bbdefb;
            border-radius: 30px;
            background: white;
            font-size: 1rem;
            cursor: pointer;
            min-width: 180px;
        }

        /* Sub Categories */
        .sub-categories-section {
            margin-bottom: 20px;
        }

        .sub-title {
            font-size: 1.55rem;
            font-weight: 700;
            color: #0d1117;
            margin-bottom: 18px;
        }

        .sub-grid {
             width:950px;
            display: flex;
            grid-template-columns: repeat(auto-fit, minmax(165px, 1fr));
            gap: 14px;
        }

        .sub-card {
            height: 45px;
            width: fit-content !important;
            white-space: nowrap;
            background: #f0f7ff;
            padding: 16px 20px;
            border-radius: 7px;
            text-align: center;
            font-weight: 600;
            color: #1565c0;
            font-size: 1.02rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .sub-card:hover {
            background: #d1e6ff;
            transform: translateY(-3px);
        }

        .sub-card.active {
            background: #1565c0;
            color: white;
            box-shadow: 0 6px 18px rgba(21, 101, 192, 0.3);
        }

        /* Institute Cards Grid */
        .institute-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 26px;
        }

        /* ==================== INSTITUTE CARD (SAME AS SELLER CARD) ==================== */
        .institute-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 6px 22px rgba(0, 0, 0, 0.08);
            transition: all 0.38s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #f0f4f8;
            display: flex;
            flex-direction: row;
            min-height: 220px;
        }

        .institute-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 18px 40px rgba(21, 101, 192, 0.20);
            border-color: #bbdefb;
        }

        /* Left - Main Content (70%) */
        .institute-main {
            flex: 1;
            padding: 28px 24px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .institute-name-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .institute-name {
            font-size: 1.38rem;
            font-weight: 700;
            color: #0d1117;
            margin: 0;
        }

        .verified-tick {
            color: #1da1f2;
            font-size: 1.4rem;
            line-height: 1;
        }

        .institute-desc {
            font-size: 0.98rem;
            color: #444;
            line-height: 1.48;
            margin: 0;
        }

        /* Courses Chips */
        .courses-slider {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 6px 0;
            scrollbar-width: thin;
        }

        .courses-slider::-webkit-scrollbar {
            height: 6px;
        }

        .courses-slider::-webkit-scrollbar-thumb {
            background: #bbdefb;
            border-radius: 10px;
        }

        .course-chip {
            background: #e3f2fd;
            color: #1565c0;
            font-size: 0.88rem;
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 30px;
            white-space: nowrap;
            flex-shrink: 0;
            transition: all 0.25s;
        }

        .course-chip:hover {
            background: #bbdefb;
        }

        /* Right Sidebar (30%) */
        .institute-sidebar {
            width: 280px;
            background: #f8fbff;
            border-left: 1px solid #e8f0fa;
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 18px;
            text-align: center;
            justify-content: center;
        }

        .institute-logo {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            object-fit: contain;
            border: 4px solid white;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
        }

        .institute-location {
            font-size: 0.94rem;
            color: #1565c0;
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 6px;
            line-height: 1.4;
        }

        .preferred-badge {
            background: #e3f2fd;
            color: #1565c0;
            font-size: 0.84rem;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 30px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .action-btn {
            padding: 10px 0;
            font-size: 0.92rem;
            font-weight: 600;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.25s;
            border: none;
        }

        .btn-view-contact {
            background: #1565c0;
            color: white;
        }

        .btn-view-contact:hover {
            background: #0d47a1;
        }

        .btn-enquiry {
            background: white;
            color: #1565c0;
            border: 2px solid #1565c0;
        }

        .btn-enquiry:hover {
            background: #f0f7ff;
        }

        /* Responsive */
        @media (max-width: 1100px) {
            .institute-card {
                flex-direction: column;
            }

            .institute-sidebar {
                width: 100%;
                border-left: none;
                border-top: 1px solid #e8f0fa;
            }
        }

        /* No Results */
        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
            color: #777;
            font-size: 1.2rem;
            background: #f8fbff;
            border-radius: 16px;
            border: 2px dashed #bbdefb;
        }

        .listing-bredcrumb {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .listing-bredcrumb p {
            margin: 0px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .listing-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .sort-wrapper {
                width: 100%;
                justify-content: flex-start;
            }
        }
        
        /* Mobile Top Section */
.institute-top {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.institute-logo-wrapper {
    flex-shrink: 0;
}

.institute-logo {
    width: 55px;
    height: 55px;
    object-fit: contain;
    border-radius: 8px;
}

.institute-logo-letter {
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    font-weight: bold;
    border-radius: 8px;
}

/* Desktop Sidebar Logo */
.desktop-logo {
    display: none;           /* Default hide on mobile */
}

@media (min-width: 768px) {
    .desktop-logo {
        display: block;
        margin-bottom: 16px;
    }
    
    .institute-logo-wrapper {
        display: none;       /* Hide mobile top on desktop */
    }
    
    .institute-sidebar {
        margin-left: 20px;
    }
   
}
@media (max-width: 768px) {
    .listing-page-section {
    background: #f8f9fc;
    padding: 40px 10px;
}
.sub-categories-section{
    display:none !important;
}
.institute-logo-letter {
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    font-weight: bold;
    border-radius: 8px;
}
   
   .sort-select {
    padding: 10px 20px;
    border: 1.5px solid #bbdefb;
    border-radius: 35px;
    background: white;
    font-size: 1rem;
    cursor: pointer;
    min-width: 77%;
}
}

 
/* =============== MOBILE DRAWER =============== */
.mobile-browse-btn-wrapper {
    padding: 12px 15px;
    background: #fff;
    border-bottom: 1px solid #eee;
}

.mobile-browse-btn {
    width: 100%;
    padding: 14px;
    background: #3b82f6;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.mobile-category-drawer {
    position: fixed;
    top: 0;
    left: -100%;
    width: 85%;
    max-width: 320px;
    height: 100vh;
    background: white;
    z-index: 1000;
    transition: left 0.4s ease;
    box-shadow: 4px 0 15px rgba(0,0,0,0.2);
    overflow-y: auto;
}

.mobile-category-drawer.active {
    left: 0;
}

.drawer-header {
    padding: 16px 20px;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8fafc;
}

.drawer-header h3 {
    margin: 0;
    font-size: 18px;
}

.close-drawer {
    font-size: 24px;
    cursor: pointer;
    color: #64748b;
}

.drawer-content {
    padding: 15px;
}

.drawer-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 999;
    display: none;
}

.drawer-overlay.active {
    display: block;
}

/* Category cards inside drawer (same style as sidebar) */
#mobileCategoryList .category-card {
    margin-bottom: 8px;
}
    </style>
 @endpush
@section('content')
  <!-- ==================== LISTING PAGE - FINAL VERSION (NO SEARCH, CATEGORY FILTER + SORTING) ==================== -->
    <!--<section class="listing-page-section">-->
    <!--    <div class="listing-container">-->

            <!-- Left Sidebar - Categories (Sticky on desktop) -->
    <!--        <aside class="listing-sidebar">-->
    <!--            <h3 class="sidebar-title">Categories</h3>-->
    <!--            <div class="category-list" id="listingCategoryList"></div>-->
    <!--        </aside>-->

            <!-- Main Content Area -->
    <!--        <div class="listing-main">-->
    <!--            <div class="listing-bredcrumb">-->
    <!--                <p style="color: #0d47a1;">Home</p>-->
    <!--                <p>></p>-->
    <!--                <p>Best Boarding Schools in India</p>-->
    <!--            </div>-->
                <!-- Header with Title + Count + Sorting -->
    <!--            <div class="listing-header">-->

    <!--                <div class="header-left">-->
    <!--                    <h1 class="listing-title" id="activeListingTitle"></h1>-->
    <!--                    <span class="listing-count" id="listingCount"></span>-->
    <!--                </div>-->

    <!--                <div class="sort-wrapper">-->
    <!--                    <label class="sort-label">Sort By:</label>-->
    <!--                    <select class="sort-select" id="sortListing">-->
    <!--                        <option value="relevance">Relevance</option>-->
    <!--                        <option value="verified">Verified Institutes</option>-->
    <!--                        <option value="preferred">Preferred Institutes</option>-->
    <!--                        <option value="most-viewed">Most Viewed</option>-->
    <!--                        <option value="recent">Recently Added</option>-->
    <!--                        <option value="az">A - Z</option>-->
    <!--                        <option value="za">Z - A</option>-->
    <!--                    </select>-->
    <!--                </div>-->
    <!--            </div>-->

                <!-- Sub Categories -->
    <!--            <div class="sub-categories-section" id="listingSubCategories">-->
                    <!-- <h4 class="sub-title" id="activeListingCategory">All Subcategories</h4> -->

    <!--                <div class="sub-grid" id="listingSubGrid"></div>-->
    <!--            </div>-->

                <!-- Institute Cards Grid -->
    <!--            <div class="institute-grid" id="listingInstituteGrid"></div>-->

                <!-- No Results -->
    <!--            <div class="no-results" id="noResults" style="display:none;">-->
    <!--                No institutes found for selected category / subcategory.-->
    <!--            </div>-->

    <!--        </div>-->

    <!--    </div>-->
    <!--</section>-->
    
    <!-- ==================== HERO SECTION ==================== -->
<section class="hero-section py-16 md:py-24 bg-gradient-to-br from-blue-600 via-indigo-600 to-blue-700 text-white relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-4 md:px-6 relative z-10">
    
    <div class="text-center max-w-4xl mx-auto">
      
      <!-- Main Heading -->
      <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight tracking-tight mb-6">
        Find the Best Institutes Near You
      </h1>

      <!-- Subtitle -->
      <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto leading-relaxed">
        Discover top-rated coaching centers, schools &amp; training institutes with verified reviews and real student success stories.
      </p>

      

    </div>
  </div>

  <!-- Background Decorative Elements -->
  <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(255,255,255,0.15),transparent)]"></div>
  <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
</section>
    
    <section class="listing-page-section">
    <div class="listing-container">

        <!-- ==================== MOBILE BROWSE BUTTON ==================== -->
        <div class="mobile-browse-btn-wrapper md:hidden">
            <button onclick="toggleCategoryDrawer()" 
                    class="mobile-browse-btn">
                <i class="fas fa-bars"></i> Browse Categories
            </button>
        </div>

        <!-- Left Sidebar - Categories (Desktop only) -->
        <aside class="listing-sidebar hidden md:block">
            <h3 class="sidebar-title">Categories</h3>
            <div class="category-list" id="listingCategoryList"></div>
        </aside>

        <!-- Main Content Area -->
        <div class="listing-main">
            <div class="listing-bredcrumb">
                <p style="color: #0d47a1;">Home</p>
                <p>></p>
                <p>Best Boarding Schools in India</p>
            </div>

            <!-- Header with Title + Count + Sorting -->
            <div class="listing-header">
                <div class="header-left">
                    <h1><span  class="listing-title" id="activeListingTitle"></span>  <span class="listing-count" id="listingCount"></span> </h1>
                    <!--<h1 class="listing-title" id="activeListingTitle"></h1>-->
                    <!--<span class="listing-count" id="listingCount"></span>-->
                </div>
                <div class="sort-wrapper">
                    <label class="sort-label">Sort By:</label>
                    <select class="sort-select" id="sortListing">
                        <option value="relevance">Relevance</option>
                        <option value="verified">Verified Institutes</option>
                        <option value="preferred">Preferred Institutes</option>
                        <option value="most-viewed">Most Viewed</option>
                        <option value="recent">Recently Added</option>
                        <option value="az">A - Z</option>
                        <option value="za">Z - A</option>
                    </select>
                </div>
            </div>

            <!-- Sub Categories -->
            <div class="sub-categories-section" id="listingSubCategories">
                <div class="sub-grid" id="listingSubGrid"></div>
            </div>

            <!-- Institute Cards Grid -->
            <div class="institute-grid" id="listingInstituteGrid"></div>
            
            

            <!-- No Results -->
            <div class="no-results" id="noResults" style="display:none;">
                No institutes found for selected category / subcategory.
            </div>
        </div>
    </div>
</section>
<!-- ==================== MOBILE CATEGORY DRAWER ==================== -->
<div class="mobile-category-drawer" id="mobileCategoryDrawer">
    <div class="drawer-header">
        <h3>Browse Categories</h3>
        <span onclick="toggleCategoryDrawer()" class="close-drawer">✕</span>
    </div>
    <div class="drawer-content">
        <div class="category-list" id="mobileCategoryList"></div>
    </div>
</div>

<!-- Overlay -->
<div class="drawer-overlay" id="drawerOverlay" onclick="toggleCategoryDrawer()"></div>

    <!-- ==================== COMPLETE CUSTOM CSS ==================== -->


   <script>
   /* ====== DYNAMIC DATA FROM BACKEND ====== */
const listingcategories = @json(listingCategories());
const listingsubcategoriesData = @json(listingSubcategories());
const instituteData = @json(listingInstitutes());
console.log("Institutes:", instituteData);
const baseUrl1 = "{{ url('/') }}"; // Laravel helper for site URL

/* ==================== MOBILE CATEGORY DRAWER ==================== */

function toggleCategoryDrawer() {
    document.getElementById('mobileCategoryDrawer').classList.toggle('active');
    document.getElementById('drawerOverlay').classList.toggle('active');
}

function renderMobileCategories() {
    const container = document.getElementById('mobileCategoryList');
    container.innerHTML = '';

    listingcategories.forEach(cat => {
        const div = document.createElement('div');
        div.className = 'category-card';
        div.dataset.id = cat.id;

        div.innerHTML = `
            <i class="${cat.icon || 'fas fa-chevron-right'}"></i>
            <span>${cat.name} (${cat.institutes_count || 0})</span>
        `;

       
        
        div.onclick = () => {
            const targetUrl = `${baseUrl1}/${cat.slug}-institutes`;
            window.location.href = targetUrl;
        };

        container.appendChild(div);
    });
}


const originalRender = renderListingCategories;

renderListingCategories = function() {
    originalRender();           // Desktop sidebar render
    renderMobileCategories();   // Mobile drawer render
};

/* ====== INIT ====== */
renderListingCategories();     // ← Yeh line important hai
renderDefaultInstitutes();



const originalRenderListingCategories = renderListingCategories;
renderListingCategories = function() {
    originalRenderListingCategories();   
    renderMobileCategories();            // Mobile drawer
};
renderMobileCategories();
   </script>

<script>


/* ====== RENDER CATEGORIES ====== */
function renderListingCategories() {
    const container = document.getElementById('listingCategoryList');
    container.innerHTML = '';
    listingcategories.forEach(cat => {
        const div = document.createElement('div');
        div.className = `category-card`;
        div.innerHTML = `<i class="${cat.icon}"></i><span>${cat.name} (${cat.count})</span>`;
        div.onclick = () => {
            const catData = listingcategories.find(c => c.id === cat.id);
        
            if(catData && catData.slug){
                const targetUrl = `${baseUrl1}/${catData.slug}-institutes`;
        
                // prevent same URL reload
                if (window.location.pathname === new URL(targetUrl).pathname) {
                    return;
                }
        
                window.location.href = targetUrl;
            } else {
                // fallback (agar slug na ho)
                selectListingCategory(cat.id, div);
            }
        };
        container.appendChild(div);
    });
    renderMobileCategories();
}

/* ====== CATEGORY SELECT ====== */
function selectListingCategory(catId, clicked) {
    // highlight
    document.querySelectorAll('.category-card').forEach(el => {
        el.classList.remove('active');
    });
    clicked.classList.add('active');

    const cat = listingcategories.find(c => c.id === catId);
    
    document.getElementById('activeListingTitle').textContent = `Best ${cat.name} In India`;
    
    //document.getElementById('listingCount').textContent = `${cat.count}`;
    

    // render subcategories
    const subContainer = document.getElementById('listingSubGrid');
    subContainer.innerHTML = '';
    const subs = [{id:null, name:"All"}, ...(listingsubcategoriesData[catId] || [])];
    subs.forEach((sub, idx) => {
        const card = document.createElement('div');
        card.className = `sub-card ${idx===0?'active':''}`;
        card.textContent = sub.name;
        card.dataset.id = sub.id; // ⭐ important
        

        card.onclick = () => {
            document.querySelectorAll('.sub-card').forEach(el=>{
                el.classList.remove('active');
            });

            card.classList.add('active');

            const subId = card.dataset.id !== null ? Number(card.dataset.id) : null;
            // 👉 FIND SUBCATEGORY
            const sub = (listingsubcategoriesData[catId] || []).find(s => s.id == subId);
        
            if(sub){
                // 👉 URL CHANGE
                window.location.href = `${baseUrl1}/${sub.slug}-institutes`;
            }
            //filterAndRenderInstitutes(catId, subId);
        };
        subContainer.appendChild(card);
    });

    // default first subcategory
    filterAndRenderInstitutes(catId, null);
}

/* ====== FILTER + SORT + RENDER ====== */
function filterAndRenderInstitutes(catId, subId=null) {
    let filtered = [...instituteData];

    console.log("Filtering:", filtered); // debug
    if(catId){
        filtered = filtered.filter(i => i.category_id == catId);
    }

    if(subId !== null){
        filtered = filtered.filter(i => i.subcategory_id == subId);
    }else {
        // "All" select hai → include all, chahe subcategory null ho ya nahi
        filtered = filtered; // no filter on subcategory
        console.log("all: " +filtered);
    }
    console.log("After filter:", filtered.length); // debug
    // Shuffle first
    filtered = filtered.sort(() => Math.random() - 0.5);

    // MAIN LOGIC: recent + plan priority
    filtered.sort((a, b) => {
        const dateDiff = new Date(b.added) - new Date(a.added);
        if (dateDiff !== 0) return dateDiff;

        return b.amount - a.amount;
    });
    const sortVal = document.getElementById('sortListing').value;

    if(sortVal === 'verified'){
        filtered = filtered.filter(i => i.verified == true);
    }
    else if(sortVal === 'preferred'){
        filtered = filtered.filter(i => i.preferred == true);
    }
    else if(sortVal === 'most-viewed'){
        filtered.sort((a,b)=> (b.views || 0) - (a.views || 0));
    }
    else if(sortVal === 'recent'){
        filtered.sort((a,b)=> new Date(b.added) - new Date(a.added));
    }
    else if(sortVal === 'az'){
        filtered.sort((a,b)=> a.name.localeCompare(b.name));
    }
    else if(sortVal === 'za'){
        filtered.sort((a,b)=> b.name.localeCompare(a.name));
    }

    // count update
    document.getElementById('listingCount').textContent = filtered.length;

    renderInstitutes(filtered);
}
function renderDefaultInstitutes() {
    document.getElementById('activeListingTitle').textContent = "All Institutes in India";
    
    // hide subcategories
    document.getElementById('listingSubGrid').innerHTML = '';

    let filtered = [...instituteData];
    document.getElementById('listingCount').textContent = `${filtered.length}`;
    // Shuffle
    filtered = filtered.sort(() => Math.random() - 0.5);

    // Sort: recent + plan priority
    filtered.sort((a, b) => {
        // First: recent
        const dateDiff = new Date(b.added) - new Date(a.added);
        if (dateDiff !== 0) return dateDiff;

        // Then: plan amount
        return b.amount - a.amount;
    });

    renderInstitutes(filtered);
}

/* ====== RENDER INSTITUTE CARDS ====== */
function renderInstitutes(data){
    const container = document.getElementById('listingInstituteGrid');
    container.innerHTML = '';

    if(data.length===0){
        container.innerHTML = `<div>No institutes found for this subcategory yet. Try "All Subcategories"</div>`;
        return;
    }

    data.forEach(inst => {
                const card = document.createElement('div');
                card.className = 'institute-card';

                const exampleCourses = [
                    inst.sub || "Main Course",
                    "Online Classes",
                    "Weekend Batch",
                    "Crash Course",
                    "Doubt Sessions"
                ];

              card.innerHTML = `
<div class="institute-main">
  
  <!-- TOP ROW (Logo + Name) - Visible on Mobile -->
  <div class="institute-top">
    <div class="institute-logo-wrapper">
      ${inst.logo_type === 'image'
        ? `<img src="${inst.logo}" alt="${inst.name}" class="institute-logo">`
        : `<div class="institute-logo-letter institute-logo"
              style="background-color: ${inst.logo_bg_color}; color: ${inst.logo_text_color};">
              ${inst.logo}
           </div>`
      }
    </div>
    
    <div class="institute-name-row">
      <h3 class="institute-name">
        <a href="${baseUrl1}/${inst.slug}">
          ${inst.name}
        </a>
        ${inst.verified ? '<i class="fas fa-check-circle verified-tick"></i>' : ''}
      </h3>
    </div>
  </div>

  <!-- CATEGORY -->
  <div class="courses-slider">
    <div class="course-chip">${inst.category_name}</div>
  </div>

  <hr>

  <!-- DESCRIPTION -->
  <p class="institute-desc">
    ${inst.desc || 'Explore our comprehensive web directory featuring businesses, innovative products, essential services, and thriving startups. Connect, discover, and grow all in one convenient platform!'}
  </p>

  <!-- LOCATION -->
  <div class="institute-location">
    <i class="fas fa-map-marker-alt"></i>
    ${inst.location || 'Location not available'}
  </div>

</div>

<!-- SIDEBAR (Desktop Logo + Badges + Buttons) -->
<div class="institute-sidebar">

  <!-- Desktop Logo (Mobile pe hide hoga) -->
  <div class="desktop-logo">
    ${inst.logo_type === 'image'
      ? `<img src="${inst.logo}" alt="${inst.name}" class="institute-logo">`
      : `<div class="institute-logo-letter institute-logo"
            style="background-color: ${inst.logo_bg_color}; color: ${inst.logo_text_color};">
            ${inst.logo}
         </div>`
    }
  </div>

  <!-- Preferred Badge -->
  ${inst.preferred ? `
    <div class="preferred-badge">
      <i class="fas fa-star"></i> Preferred Institute
    </div>
  ` : ''}

  <!-- Action Buttons -->
  <div class="action-buttons">
    <a href="tel:${inst.mobile}" 
       data-id="${inst.id}" 
       class="action-btn btn-view-contact call-click-btn">
      Call Institute
    </a>
    
    ${inst.whatsapp 
      ? `<a href="https://wa.me/${inst.whatsapp}" 
           data-id="${inst.id}" 
           class="action-btn btn-enquiry whatsapp-click-btn" 
           target="_blank">
          WhatsApp Now
        </a>` 
      : ''}
  </div>

</div>
`;
                container.appendChild(card);
            });
        }


/* ====== SORT DROPDOWN ====== */
document.getElementById('sortListing').addEventListener('change',()=>{
    const activeCat = document.querySelector('.category-card.active');
    const catId = listingcategories.find(c=>c.name===activeCat.textContent.split(' (')[0]).id;
    const activeSubEl = document.querySelector('.sub-card.active');
    const subId = activeSubEl ? Number(activeSubEl.dataset.id) || null : null;

    filterAndRenderInstitutes(catId, subId);
});

/* ====== INIT ====== */
renderListingCategories();
renderDefaultInstitutes();
</script>



    <!-- Horizontal Divider after Cities -->
@endsection