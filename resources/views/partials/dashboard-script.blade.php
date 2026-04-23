<script>
    function openEditCourseModal(courseId) {
 
  document.getElementById('editCourseModal').classList.remove('hidden');
  document.getElementById('editCourseModal').classList.add('flex');
}

function closeEditModal() {
  document.getElementById('editCourseModal').classList.add('hidden');
  document.getElementById('editCourseModal').classList.remove('flex');
}

// Close on backdrop click
document.getElementById('editCourseModal')?.addEventListener('click', function(e) {
  if (e.target === this) closeEditModal();
});
</script>

<script>
    let currentType = '';
let currentValue = '';

function openChangeModal(type, value, title) {
  currentType = type;
  currentValue = value;

  document.getElementById('modalTitle').textContent = `Change ${title}`;
  document.getElementById('modalCurrent').textContent = value;
  document.getElementById('modalLabel').textContent = `New ${title}`;
  document.getElementById('modalInput').value = '';
  document.getElementById('modalInput').placeholder = type === 'email' ? 'new@example.com' : '+91 XXXXXXXXXX';
  document.getElementById('otpSection').classList.add('hidden');
  document.getElementById('actionBtn').textContent = type === 'email' ? 'Send OTP' : 'Send OTP';
  document.getElementById('modalStatus').classList.add('hidden');

  document.getElementById('changeModal').classList.remove('hidden');
}

document.addEventListener("DOMContentLoaded", function () {

  window.closeModal = function () {
    document.getElementById('changeModal').classList.add('hidden');
  };

});
document.querySelectorAll('#otpSection input').forEach((input, i, arr) => {
  input.addEventListener('input', () => {
    if (input.value && arr[i + 1]) arr[i + 1].focus();
  });
});
let resendCooldown = 30;
let timerInterval;

async function resendOtpRequest() {
  const btn = document.getElementById('resendBtnRequest');
  const timer = document.getElementById('Requesttimer');

  // Prevent multiple clicks
  if (btn.disabled) return;

  btn.disabled = true;

  let input = document.getElementById('modalInput').value;

  let res = await fetch("{{route('request-update.send-otp')}}", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
      type: currentType,
      value: input
    })
  });

  let data = await res.json();

  if (data.success) {
    startResendTimer();
  }
}

// Timer function
function startResendTimer() {
 const btn = document.getElementById('resendBtnRequest');
  const timer = document.getElementById('Requesttimer');

  let timeLeft = resendCooldown;

  timer.textContent = `(${timeLeft}s)`;

  timerInterval = setInterval(() => {
    timeLeft--;
    timer.textContent = `(${timeLeft}s)`;

    if (timeLeft <= 0) {
      clearInterval(timerInterval);
      btn.disabled = false;
      timer.textContent = '';
    }
  }, 1000);
}

async function handleAction() {
  const btn = document.getElementById('actionBtn');
  const status = document.getElementById('modalStatus');
  const input = document.getElementById('modalInput').value.trim();

  if (!input) {
    status.textContent = 'Please enter a value';
    status.className = 'text-red-600 text-center';
    return;
  }

  // STEP 1: Send OTP
  if (btn.textContent === 'Send OTP') {

    let res = await fetch("{{route('request-update.send-otp')}}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({
        type: currentType,
        value: input
      })
    });

    let data = await res.json();

    if (data.success) {
      document.getElementById('otpSection').classList.remove('hidden');
      btn.textContent = 'Verify OTP';

      status.textContent = 'OTP sent successfully!';
      status.className = 'text-green-600 text-center';
    }

  } else {
    // STEP 2: Verify OTP
    const otp = Array.from(document.querySelectorAll('#otpSection input'))
      .map(i => i.value)
      .join('');

    let res = await fetch("{{route('request-update.verify-update')}}", {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ otp })
    });

    let data = await res.json();

    if (data.success) {

      if (data.type === 'mobile') {
        document.getElementById('currentMobile').textContent = '+91 ' + data.value;
      }

      if (data.type === 'whatsapp') {
        document.getElementById('currentWhatsApp').textContent = '+91 ' + data.value;
      }

      if (data.type === 'email') {
        document.getElementById('currentEmail').textContent = data.value;
      }

      status.textContent = 'Updated Successfully!';
      status.className = 'text-green-600 text-center';

      setTimeout(closeModal, 1500);

    } else {
      status.textContent = data.message;
      status.className = 'text-red-600 text-center';
    }
  }
}

// Close modal on outside click
document.getElementById('changeModal').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});
</script>
    <!-- ================= SCRIPT ================= -->
    <script>
        function showTab(event, tabId) {

            // Hide all tab content
            document.querySelectorAll('.tab-content').forEach(el => {
                el.classList.add('hidden');
            });

            // Show selected tab content
            document.getElementById(tabId).classList.remove('hidden');

            // Reset all tab buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('border-blue-600', 'text-blue-600');
                btn.classList.remove('border-transparent', 'text-gray-500');
                btn.classList.add('border-transparent', 'text-gray-500');
            });

            // Activate clicked tab
            event.currentTarget.classList.remove('border-transparent', 'text-gray-500');
            event.currentTarget.classList.add('border-blue-600', 'text-blue-600');
        }
    </script>

    <script>
        function toggleNotification() {
            const dropdown = document.getElementById("notificationDropdown");
            dropdown.classList.toggle("hidden");
        }
        // Open notification modal and mark as read
        function openNotifModal(title, date, message, notifId){
            // Open your existing notification modal
            showNotification(title, date, message, 'Unread', notifId);

            // Hide dropdown after click
            document.getElementById('notificationDropdown').classList.add('hidden');

            // Update badge & mark as read via AJAX
            fetch("{{ url('/notifications') }}/" + notifId + "/read", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            }).then(res => res.json())
            .then(data => {
                if(data.success){
                    // Decrease badge count
                    let badge = document.getElementById('notifBadge');
                    if(badge){
                        let count = parseInt(badge.innerText);
                        count = count > 0 ? count - 1 : 0;
                        if(count === 0){
                            badge.remove();
                        } else {
                            badge.innerText = count;
                        }
                    }
                }
            });
        }

        document.addEventListener("click", function (event) {
            const dropdown = document.getElementById("notificationDropdown");
            const button = event.target.closest("button");

            if (!event.target.closest(".relative")) {
                dropdown.classList.add("hidden");
            }
        });
    </script>
    <script>
       function openLead(name, course, phone, date, message) {
  // Fill details
  document.getElementById('detailName').textContent = name;
  document.getElementById('detailCourse').textContent = course;
  
  // Make phone clickable
  const phoneLink = document.getElementById('detailPhoneLink');
  phoneLink.textContent = phone;
  phoneLink.href = `tel:${phone}`;

  document.getElementById('detailDate').textContent = date;
  document.getElementById('detailMessage').textContent = message;

  // Slide in drawer
  document.getElementById('leadDetailDrawer').classList.remove('translate-x-full');
  document.getElementById('leadDetailDrawer').classList.add('translate-x-0');

  // Show backdrop only on mobile
  if (window.innerWidth < 1024) {
    document.getElementById('drawerBackdrop').classList.remove('hidden');
  }
}

function closeLead() {
  // Slide out drawer
  document.getElementById('leadDetailDrawer').classList.remove('translate-x-0');
  document.getElementById('leadDetailDrawer').classList.add('translate-x-full');

  // Hide backdrop
  document.getElementById('drawerBackdrop').classList.add('hidden');
}
    </script>
    <script>
        // Donut Chart (Total Sales)
        var salesOptions = {
            series: [2346, 2108, 1204],
            chart: { type: 'donut', height: 280 },
            labels: ['Direct', 'Referral', 'Affiliate'],
            colors: ['#3b82f6', '#f87171', '#22d3ee'],
            legend: { show: false },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Sales',
                                formatter: function () { return '5658'; }
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false }
        };
        var salesChart = new ApexCharts(document.querySelector("#salesDonutChart"), salesOptions);
        salesChart.render();

        // Net Income - Bar + Line combo (monthly)
        var incomeOptions = {
            series: [{
                name: 'Income',
                type: 'column',
                data: [5.0, 3.75, 2.5, 6.25, 5.0, 9.5]  // Jan to Jun example
            }, {
                name: 'Trend',
                type: 'line',
                data: [4.8, 3.9, 2.8, 6.0, 5.2, 9.0]
            }],
            chart: { type: 'line', height: 280, toolbar: { show: false } },
            stroke: { width: [0, 3] },
            colors: ['#6366f1', '#10b981'],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']
            },
            yaxis: { title: { text: '' } },
            legend: { show: false }
        };
        var incomeChart = new ApexCharts(document.querySelector("#netIncomeChart"), incomeOptions);
        incomeChart.render();

        // Earning by Location - Horizontal Bar with %
        var locationOptions = {
            series: [{
                data: [28, 21, 18, 12]  // India, UK, USA, China
            }],
            chart: { type: 'bar', height: 280, toolbar: { show: false } },
            plotOptions: {
                bar: { horizontal: true, borderRadius: 6, barHeight: '70%' }
            },
            colors: ['#3b82f6', '#ef4444', '#06b6d4', '#10b981'],
            dataLabels: {
                enabled: true,
                formatter: function (val) { return val + "%"; },
                style: { colors: ['#000'] }
            },
            xaxis: { categories: ['India', 'UK', 'USA', 'China'], labels: { show: false } },
            yaxis: { labels: { style: { fontSize: '14px' } } }
        };
        var locationChart = new ApexCharts(document.querySelector("#locationChart"), locationOptions);
        locationChart.render();
    </script>
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
            sliderEl.addEventListener('mouseenter', () => swiper.autoplay.stop());
            sliderEl.addEventListener('mouseleave', () => swiper.autoplay.start());
        });
    </script>

<script>
    let currentImageIndex = 0;
const galleryImages = [
  "https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&q=80&w=1200",
  "https://plus.unsplash.com/premium_photo-1681248156471-5682ce52c46c?auto=format&fit=crop&q=80&w=1200",
  "https://plus.unsplash.com/premium_photo-1661763874747-405eb7388c58?auto=format&fit=crop&q=80&w=1200",
  "https://plus.unsplash.com/premium_photo-1663040197283-fae88b360dad?auto=format&fit=crop&q=80&w=1200",
  "https://images.unsplash.com/photo-1758270705518-b61b40527e76?auto=format&fit=crop&q=80&w=1200",
  "https://plus.unsplash.com/premium_photo-1682787494977-d013bb5a8773?auto=format&fit=crop&q=80&w=1200"
];

const galleryThumbs = document.querySelectorAll('#gallery img');

galleryThumbs.forEach((thumb, index) => {
  thumb.addEventListener('click', () => {
    currentImageIndex = index;
    showLightbox();
  });
});

function showLightbox() {
  const modal = document.getElementById('lightbox');
  const img = document.getElementById('lightboxImg');
  const caption = document.getElementById('lightboxCaption');
  
  img.src = galleryImages[currentImageIndex];
  caption.textContent = `Image ${currentImageIndex + 1} of ${galleryImages.length}`;
  
  modal.classList.remove('hidden');
  modal.classList.add('flex');
}

function closeLightbox() {
  document.getElementById('lightbox').classList.add('hidden');
  document.getElementById('lightbox').classList.remove('flex');
}

function nextImage() {
  currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
  showLightbox();
}

function prevImage() {
  currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
  showLightbox();
}

// Close on ESC key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') closeLightbox();
});
</script>

<script>
function showNotification(title, date, message, status, notifId) {
    document.getElementById('notifModalTitle').innerText = title;
    document.getElementById('notifModalDate').innerText = date;
    document.getElementById('notifModalHeadline').innerText = title;
    document.getElementById('notifModalMessage').innerText = message;
    document.getElementById('notifModalStatus').innerText = status;
    document.getElementById('notifModal').classList.remove('hidden');

  const statusEl = document.getElementById('notifModalStatus');
  statusEl.textContent = status;
  statusEl.className = status === 'Unread' 
    ? 'bg-red-100 text-red-700 px-4 py-1.5 rounded-full text-sm font-medium'
    : 'bg-green-100 text-green-700 px-4 py-1.5 rounded-full text-sm font-medium';

  document.getElementById('notifModal').classList.add('flex');


   // If unread, mark as read via AJAX
    if(status === 'Unread' && notifId){
        fetch("{{ url('/notifications') }}/" + notifId + "/read", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        }).then(res => res.json())
        .then(data => {
            if(data.success){
                // Update badge in table
                const row = document.querySelector(`[data-notif-id='${notifId}']`);
                if(row){
                    const badge = row.querySelector('.notif-status');
                    badge.innerText = 'Read';
                    badge.classList.remove('bg-red-100','text-red-700');
                    badge.classList.add('bg-green-100','text-green-700');
                }
                // Update modal status
                document.getElementById('notifModalStatus').innerText = 'Read';
                document.getElementById('notifModalStatus').classList.remove('bg-red-100','text-red-700');
                document.getElementById('notifModalStatus').classList.add('bg-green-100','text-green-700');
            }
        });
    }

}

function closeNotifModal() {
  document.getElementById('notifModal').classList.add('hidden');
  document.getElementById('notifModal').classList.remove('flex');
}

// Backdrop click to close (optional)
document.getElementById('notifModal')?.addEventListener('click', function(e) {
  if (e.target === this) closeNotifModal();
});



function openslugModal(){
  $('#customUrlModal').removeClass('hidden').addClass('flex');
}
function showUpgradeAlert() {
     toastr.error('Upgrade your plan to use this feature');
}
function closeModal(){
  $('#customUrlModal').addClass('hidden');
}

function skipSlug(){
  closeModal();
}
let slugTimer;

$('#custom_slug').on('input', function(){

    let slug = $(this).val();

    if(slug.length < 3){
        $('#slug_status').text('Minimum 3 characters').css('color','orange');
        return;
    }

    slugTimer = setTimeout(() => {

        $.get("{{ url('institute/check-slug') }}", {slug:slug}, function(res){

            if(res.available){
                $('#slug_status').text('✅ Available').css('color','green');
            } else {
                $('#slug_status').text('❌ Already taken').css('color','red');
            }

        });

    }, 500);

});
function saveCustomUrl(){

    let slug = $('#custom_slug').val();

    if(!slug){
        $('#slug_status').text('Enter URL').css('color','red');
        return;
    }

    $.post("{{ url('institute/save-slug') }}", {
        slug: slug,
        _token:$('meta[name=csrf-token]').attr('content')
    }, function(res){

        if(res.status){
            toastr.success("Url added successfully");
            closeModal();
        }

    }).fail(function(xhr){
        $('#slug_status').text(xhr.responseJSON.message).css('color','red');
    });
}


function loadCities(stateID, selectedCity = null) {
    if(!stateID) {
        $('#city_id').html('<option value="">Select City</option>');
        return;
    }

    let cityUrl = "{{ url('/get-cities') }}/" + stateID;

    $.get(cityUrl, function(response) {
        let options = '<option value="">Select City</option>';

        if(response && Array.isArray(response)) {
            response.forEach(function(city) {
                let sel = (selectedCity == city.id) ? 'selected' : '';
                options += `<option value="${city.id}" ${sel}>${city.name}</option>`;
            });
        }

        $('#city_id').html(options);
    });
}
$('#state_id').on('change', function() {
        let stateID = $(this).val();
        loadCities(stateID);
  });
</script>