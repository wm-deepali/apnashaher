@extends('layouts.app')
@section('title', 'Profile')

@push('styles')
 <style>
    .error-text{
      color:#e74c3c;
      font-size:13px;
      margin-top:4px;
      display:block;
    }
    .help-text{
        margin-left: 7px;
        font-size: 12px;
        color: #221f1f;
    }
    

.input-error{
border-color:#e74c3c;
}
   .timing-card {
  background:#fff;
  border:1px solid #ddd;
  padding:12px;
  border-radius:10px;
  margin-bottom:12px;
}

.timing-row {
  display:flex;
  align-items:center;
  gap:20px;
}

.timing-time {
  display:flex;
  align-items:center;
  gap:10px;
}

.active-check{
  display:flex;
  align-items:center;
  gap:5px;
}

.remove-timing-btn{
  background:#ffdddd;
  border:none;
  color:red;
  padding:6px 12px;
  border-radius:6px;
  cursor:pointer;
}

.add-timing-btn{
  margin-top:10px;
}

.day-name{
  width: 200px;
}
  </style>
  <style>
    .profile-complete-section {
      background: linear-gradient(135deg, #f8fbff 0%, #f0f7ff 100%);
      padding: 60px 20px;
      min-height: 100vh;
    }

    .profile-container {
      max-width: 920px;
      margin: 0 auto;
      background: white;
      border-radius: 20px;
      box-shadow: 0 15px 50px rgba(21, 101, 192, 0.12);
      overflow: hidden;
      border: 1px solid #e3f2fd;
    }

    .profile-title {
      font-size: 2.3rem;
      font-weight: 800;
      color: #0d1117;
      text-align: center;
      padding: 40px 30px 10px;
    }

    .profile-subtitle {
      text-align: center;
      color: #555;
      font-size: 1.1rem;
      margin-bottom: 40px;
      padding: 0 30px;
    }

    /* Accordion */
    .accordion-wrapper {
      padding: 0 30px 40px;
    }

    .accordion-item {
      margin-bottom: 18px;
      border: 1px solid #e3f2fd;
      border-radius: 14px;
      overflow: hidden;
      background: #ffffff;
      transition: all 0.3s ease;
    }

    .accordion-item.active {
      border-color: #1565c0;
      box-shadow: 0 10px 30px rgba(21, 101, 192, 0.15);
    }
    .note-text
    {
      color: green;
      font-size: 12px;
      margin: 10px 0 20px 0;
    }
    .accordion-item.locked {
      opacity: 0.6;
      background: #f9f9f9;
    }

    .accordion-header {
      width: 100%;
      padding: 22px 30px;
      background: #f8fbff;
      border: none;
      text-align: left;
      font-size: 1.35rem;
      font-weight: 600;
      color: #1565c0;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
      align-items: center;
      transition: all 0.3s ease;
    }

    .accordion-item.locked .accordion-header {
      cursor: not-allowed;
      color: #888;
    }

    .accordion-header span {
      width: 300px;
    }

    .accordion-header:hover:not(.locked) {
      background: #e3f2fd;
    }

    .accordion-icon {
      font-size: 1.5rem;
      transition: transform 0.3s ease;
    }

    .accordion-item.active .accordion-icon {
      transform: rotate(180deg);
    }

    .lock-icon {
      font-size: 1.3rem;
      color: #888;
      margin-left: 10px;
    }

    .locked-text {
      width: 200px;
      text-align: end;
      font-size: 0.95rem;
      color: #888;
      margin-left: 12px;
    }

    .accordion-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.45s ease, padding 0.3s ease;
      padding: 0 30px;
    }

    .accordion-item.active .accordion-content {
      max-height: 3000px;
      padding: 30px;
    }

    /* Form Styling (same as before) */
    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 24px;
    }

    .form-group.full {
      grid-column: 1 / -1;
    }

    .form-label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #333;
      font-size: 0.98rem;
    }

    .form-input,
    .form-select,
    .form-textarea,
    .form-file {
      width: 100%;
      padding: 14px 16px;
      border: 1.5px solid #bbdefb;
      border-radius: 10px;
      font-size: 1rem;
      transition: border 0.25s;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
      border-color: #1565c0;
      outline: none;
      box-shadow: 0 0 0 3px rgba(21, 101, 192, 0.12);
    }

    .form-textarea {
      resize: vertical;
      min-height: 120px;
    }

    .social-links-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
    }

    

    /* Course & Timing (same) */
    .course-list,
    .timing-cards {
      margin-bottom: 24px;
    }

    .course-card,
    .timing-card {
      background: #f8fbff;
      border: 1px solid #e3f2fd;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 16px;

    }

    .course-header,
    .timing-card {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 16px;
      gap: 30px;
    }

    .remove-course-btn,
    .remove-timing-btn {
      background: #ffebee;
      color: #c62828;
      border: none;
      padding: 6px 14px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 0.9rem;
    }

    .add-course-btn,
    .add-timing-btn {
      background: #e3f2fd;
      color: #1565c0;
      border: none;
      padding: 14px 28px;
      border-radius: 50px;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.3s;
    }

    .add-course-btn:hover,
    .add-timing-btn:hover {
      background: #bbdefb;
    }

    .timing-time {
      display: flex;
      align-items: center;
      gap: 12px;
      flex: 1;
    }

    .time-input {
      padding: 10px 14px;
      border: 1.5px solid #bbdefb;
      border-radius: 8px;
      width: 150px;
    }

    /* Final Button */
    .final-actions {
      padding: 0 30px 40px;
      text-align: center;
    }

    .btn-save {
      background: linear-gradient(90deg, #1565c0, #42a5f5);
      color: white;
      border: none;
      padding: 16px 60px;
      font-size: 1.2rem;
      font-weight: 600;
      border-radius: 50px;
      cursor: pointer;
      box-shadow: 0 8px 25px rgba(21, 101, 192, 0.3);
      transition: all 0.3s;
    }

    .btn-save:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 35px rgba(21, 101, 192, 0.4);
    }

    .accordion-actions {
      margin-top: 30px;
      text-align: right;
    }

    .btn-next {
      background: #1565c0;
      color: white;
      border: none;
      padding: 14px 36px;
      font-size: 1.05rem;
      font-weight: 600;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s;
    }

    .btn-next:hover {
      background: #0d47a1;
    }
    .duration-wrapper {
    display: flex;
    gap: 10px;
}
@media (max-width: 600px) {
  .social-links-grid {
    grid-template-columns: 1fr;
  }
  .profile-complete-section {
    background: none;
    padding: 20px 8px;
    min-height: 100vh;
}
.accordion-wrapper {
    padding: 0 0px 8px;
}
}
  </style>
@endpush
@section('content')
<section class="profile-complete-section">
    <div class="profile-container">
      <h1 class="profile-title">Complete Your Institute Profile</h1>
      <p class="profile-subtitle">Fill step-by-step — next section unlocks & opens automatically.</p>

      <!-- Accordion Wrapper -->
      <div class="accordion-wrapper">

        <!-- 1. Profile -->
        <div class="accordion-item active" id="accordion-profile">
          <button class="accordion-header">
            <span>1. Profile Information</span>
            <i class="fas fa-chevron-down accordion-icon"></i>
          </button>
          <div class="accordion-content">
            <div class="form-grid">
              <div class="form-group">
                <label class="form-label">Owner Name *</label>
                <input type="text" class="form-input" id="owner-name" name="owner_name" value="{{$institute->owner_name ?? ''}}" required>
                <span class="error-text owner_name_error"></span>
              </div>

              <div class="form-group">
                <label class="form-label">Designation *</label>
                <select class="form-select" id="designation"  name="designation" required>
                  <option value="">Select Designation</option>
                  <option value="Director" {{$institute->designation == "Director" ? 'selected' : ""}}>Director</option>
                  <option value="Manager" {{$institute->designation == "Manager" ? 'selected' : ""}}>Manager</option>
                  <option value="Founder" {{$institute->designation == "Founder" ? 'selected' : ""}}>Founder</option>
                  <option value="Principal" {{$institute->designation == "Principal" ? 'selected' : ""}}>Principal</option>
                  <option value="Others" {{$institute->designation == "Others" ? 'selected' : ""}}>Others</option>
                </select>
                <span class="error-text designation_error"></span>
              </div>

              <div class="form-group">
                <label class="form-label">Email ID *</label>
                <input type="email" class="form-input" id="email" value="{{$institute->owner_email ?? ''}}" name="email" required>
                <span class="error-text email_error"></span>
              </div>

              <div class="form-group">
                <label class="form-label">Established Year *</label>
                <input type="number" class="form-input" id="est-year" value="{{$institute->established_year ?? ''}}"min="1900" max="2026" name="est_year" required>
                <span class="error-text est_year_error"></span>
              </div>

              <div class="form-group full">
                <label class="form-label">Detailed Information About the Institute *</label>
                <textarea class="form-textarea" id="institute-desc" name="institute_desc" rows="5" required>{{$institute->detailed_information ?? ''}}</textarea>
                <span class="error-text institute_desc_error"></span>
                
              </div>

              <div class="form-group">
                <label class="form-label">Website (optional)</label>
                <input type="url" class="form-input" placeholder="https://example.com" title="Please enter a valid URL starting with http:// or https://" pattern="https?://.+" id="website" value="{{$institute->website ?? ''}}">
                  <span class="error-text" id="websiteError"></span>
                   <span class="help-text">Enter a valid URL (e.g., https://www.xyz.com)</span>
              </div>
              
                

              

              <div class="form-group full">
                <label class="form-label">Social Links (optional)</label>
                <div class="social-links-grid">
                  <div class="form-group">
                  <input type="url" class="form-input small" id="fb" placeholder="Facebook URL" value="{{$institute->facebook_url ?? ''}}"> 
                  <span class="error-text" id="fbError"></span>
                  <span class="help-text">Enter a valid URL (e.g., https://www.facebook.com/username)</span>
                </div>
                <div class="form-group">
                    <input type="url" class="form-input small" id="ig" placeholder="Instagram URL" value="{{$institute->instagram_url ?? ''}}">
                    <span class="error-text" id="igError"></span>
                    <span class="help-text">Enter a valid URL (e.g., https://www.instagram.com/username)</span>
                </div>
                <div class="form-group">
                  <input type="url" class="form-input small" id="yt" placeholder="YouTube URL" value="{{$institute->youtube_url ?? ''}}">
                  <span class="error-text" id="ytError"></span>
                  <span class="help-text">Enter a valid URL (e.g., https://youtube.com/@yourname)</span>
                </div>
                <div class="form-group">
                  <input type="url" class="form-input small" id="twitter" placeholder="Twitter / X URL" value="{{$institute->twitter_url ?? ''}}">
                  <span class="error-text" id="twitterError"></span>
                  <span class="help-text">Enter a valid URL (e.g., https://twitter.com/username)</span>
                </div>
                  
                  
                 
                </div>
              </div>
            </div>

            <div class="accordion-actions">
              <button class="btn-next" id="saveProfileBtn">Save Profile & Continue</button>
            </div>
          </div>
        </div>

        <!-- 2. Courses -->
        <div class="accordion-item @if($institute->profile_completed) active @else locked @endif" id="accordion-courses">
          <button class="accordion-header" @if(!$institute->profile_completed) disabled @endif>
            <span>2. Courses & Programs</span>
            @if(!$institute->profile_completed)
            <i class="fas fa-lock lock-icon"></i>
            <span class="locked-text">Complete Profile First</span>
            @endif
          </button>
          <div class="accordion-content">
            <div class="course-list" id="courseList">
              <div class="course-card" data-course-id="1">
                <div class="course-header">
                  <h4>Course / Program 1</h4>
                  <button class="remove-course-btn">Remove</button>
                </div>

                <div class="form-grid">
                  <div class="form-group full">
                    <label class="form-label">Course / Program Name *</label>
                    <input type="text" class="form-input course-name" required>
                  </div>
                  <div class="form-group full">
                    <label class="form-label">Course Detail</label>
                    <textarea class="form-textarea course-desc" id="course-desc" rows="5" required></textarea>
                  </div>
                  <div class="form-group duration-wrapper" style="display: flex; gap: 10px;">
                    <div style="flex: 1;">
                        <label class="form-label">Duration (optional)</label>
                        <input type="number" class="form-input duration" placeholder="Enter value">
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Duration Unit (optional)</label>
                        <select class="form-select duration_unit">
                            <option value="">Select Unit</option>
                            <option value="Days">Days</option>
                            <option value="Months">Months</option>
                            <option value="Years">Years</option>
                        </select>
                    </div>
                </div>
                  <div class="form-group">
                    <label class="form-label">Mode *</label>
                    <select class="form-select mode" required>
                      <option value="">Select Mode</option>
                      <option value="Online">Online</option>
                      <option value="Offline">Offline</option>
                      <option value="Both (Hybrid)">Both (Hybrid)</option>
                    </select>
                  </div>
                  <div class="form-group full">
                    <label class="form-label">Upload Course Image (optional)</label>
                    <input type="file" class="form-file" accept="image/*">
                  </div>
                </div>
              </div>
            </div>

            <button class="add-course-btn" id="addCourseBtn">
              <i class="fas fa-plus"></i> Add Another Course
            </button>

            <div class="accordion-actions">
              <button class="btn-next" id="saveCoursesBtn">Save Courses & Continue</button>
            </div>
          </div>
        </div>

        <!-- 3. Timing -->
        <div class="accordion-item locked" id="accordion-timing">
          <button class="accordion-header" disabled>
            <span>3. Timing & Schedule</span>
            <i class="fas fa-lock lock-icon"></i>
            <span class="locked-text">Add at least 1 Course First</span>
          </button>
          <div class="accordion-content">
            <p class="timing-note">Set your institute's operating days and timings</p>
           
          <div class="timing-cards" id="timingCards">

  <!-- AUTO DAY LIST -->
  <div class="timing-card">
    <div class="timing-row">
      <span class="day-name">Monday</span>

      <div class="timing-time">
        <input type="time" class="time-input open-time" value="09:00">
        <span>to</span>
        <input type="time" class="time-input close-time" value="18:00">
      </div>

      <label class="active-check">
        <input type="checkbox" class="is_active" value="1" checked>
        Active
      </label>
    </div>
  </div>

  <div class="timing-card">
    <div class="timing-row">
      <span class="day-name">Tuesday</span>

      <div class="timing-time">
        <input type="time" class="time-input open-time" value="09:00">
        <span>to</span>
        <input type="time" class="time-input close-time" value="18:00">
      </div>

      <label class="active-check">
        <input type="checkbox"  class="is_active" value="1" checked>
        Active
      </label>
    </div>
  </div>

  <div class="timing-card">
    <div class="timing-row">
      <span class="day-name">Wednesday</span>

      <div class="timing-time">
        <input type="time" class="time-input open-time" value="09:00">
        <span>to</span>
        <input type="time" class="time-input close-time" value="18:00">
      </div>

      <label class="active-check">
        <input type="checkbox" class="is_active" value="1" checked>
        Active
      </label>
    </div>
  </div>

  <div class="timing-card">
    <div class="timing-row">
      <span class="day-name">Thursday</span>

      <div class="timing-time">
        <input type="time" class="time-input open-time" value="09:00">
        <span>to</span>
        <input type="time" class="time-input close-time" value="18:00">
      </div>

      <label class="active-check">
        <input type="checkbox" class="is_active" value="1" checked>
        Active
      </label>
    </div>
  </div>

  <div class="timing-card">
    <div class="timing-row">
      <span class="day-name">Friday</span>

      <div class="timing-time">
        <input type="time" class="time-input open-time" value="09:00">
        <span>to</span>
        <input type="time" class="time-input close-time" value="18:00">
      </div>

      <label class="active-check">
        <input type="checkbox"  class="is_active" value="1" checked>
        Active
      </label>
    </div>
  </div>

  <div class="timing-card">
    <div class="timing-row">
      <span class="day-name">Saturday</span>

      <div class="timing-time">
        <input type="time" class="time-input open-time" value="10:00">
        <span>to</span>
        <input type="time" class="time-input close-time" value="17:00">
      </div>

      <label class="active-check">
        <input type="checkbox" class="is_active" value="1" checked>
        Active
      </label>
    </div>
  </div>

  <div class="timing-card">
    <div class="timing-row">
      <span class="day-name">Sunday</span>

      <div class="timing-time">
        <input type="time" class="time-input open-time" value="00:00">
        <span>to</span>
        <input type="time" class="time-input close-time" value="00:00">
      </div>

      <label class="active-check">
        <input type="checkbox" class="is_active" value="1">
        Active
      </label>
    </div>
  </div>
   <span class="note-text"><b>Note:</b> For any Off Days, Please remove the tick from checkbox </span>

</div>

<!-- <button class="add-timing-btn" id="addTimingBtn">
  <i class="fas fa-plus"></i> Add Custom Slot
</button> -->



          </div>
        </div>

      </div>

      <!-- Final Save -->
      <div class="final-actions">
        <button class="btn-save" id="saveAndExit">Save & Exit</button>
      </div>
    </div>
  </section>

@endsection
@push('after-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    const MAX_COURSES = {{$remainingCourses}};
$(document).ready(function(){

/* -------------------- ERROR HANDLING -------------------- */

function clearErrors(){
    $('.error-text').text('');
    $('.form-input, .form-select, .form-textarea').removeClass('input-error');
}

function showErrors(errors){

    let firstErrorField = null;

    $.each(errors,function(field,message){

        $("."+field+"_error").text(message[0]);
        $("[name='"+field+"']").addClass("input-error");

        if(!firstErrorField){
            firstErrorField = $("[name='"+field+"']");
        }

    });

    if(firstErrorField){
        $('html, body').animate({
            scrollTop:firstErrorField.offset().top-120
        },400);
    }
}

$(document).on('keyup change','.form-input, .form-select, .form-textarea',function(){

    let fieldName = $(this).attr("name");

    $(this).removeClass("input-error");

    if(fieldName){
        $("."+fieldName+"_error").text('');
    }

});


/* -------------------- VALIDATIONS -------------------- */

function validateProfile(){

    let errors={};

    if($("#owner-name").val().trim()==""){
        errors.owner_name=["Owner name is required"];
    }

    if($("#designation").val()==""){
        errors.designation=["Please select designation"];
    }

    if($("#email").val()==""){
        errors.email=["Email is required"];
    }

    if($("#est-year").val()==""){
        errors.est_year=["Established year required"];
    }

    if($("#institute-desc").val().trim()==""){
        errors.institute_desc=["Institute description required"];
    }

    if(Object.keys(errors).length>0){
        showErrors(errors);
        return false;
    }

    return true;
}


function validateCourses(){

    let valid=true;

    $(".course-card").each(function(){

        let name = $(this).find(".course-name").val();
        let mode = $(this).find(".mode").val();

        if(name.trim()==""){

            toastr.error("Course name is required");
            valid=false;
            return false;

        }

        if(mode==""){

            toastr.error("Please select course mode");
            valid=false;
            return false;

        }

    });

    return valid;

}


function validateTiming(){

    let valid=false;

    $(".timing-card").each(function(){

        if($(this).find("input[type=checkbox]").is(":checked")){
            valid=true;
        }

    });

    if(!valid){
        toastr.error("Please activate at least one working day");
    }

    return valid;
}


/* -------------------- ACCORDION -------------------- */

function autoCloseAndOpen(currentId, nextId) {
    const current = document.getElementById(currentId);
    const next = document.getElementById(nextId);

    // Close current accordion
    current.classList.remove('active');

    // Unlock next accordion
    next.classList.remove('locked');
    const header = next.querySelector('.accordion-header');
    header.removeAttribute('disabled');

    // Remove lock icon/text if exists
    next.querySelector('.lock-icon')?.remove();
    next.querySelector('.locked-text')?.remove();

    // Open next accordion
    next.classList.add('active');

    // Scroll into view after a tiny delay so accordion content is rendered
    setTimeout(() => {
        const yOffset = -500; // adjust if you have a fixed header
        const y = next.getBoundingClientRect().top + window.pageYOffset + yOffset;
        window.scrollTo({ top: y, behavior: 'smooth' });
    }, 300); // 300ms gives time for accordion to expand
}

document.querySelectorAll('.accordion-header').forEach(header => {

    header.addEventListener('click', () => {

        const item = header.parentElement;

        if (!item.classList.contains('locked')) {
            item.classList.toggle('active');
        }

    });

});


/* -------------------- ADD COURSE -------------------- */

$("#addCourseBtn").click(function(){

    const list = document.getElementById('courseList');
    const count = list.children.length + 1;
    const currentCount = list.children.length;
    
    if(currentCount >= MAX_COURSES){
        toastr.warning("Maximum " + MAX_COURSES + " courses allowed");
        return;
    }
    const newIndex = currentCount + 1;
    const newCard = document.createElement('div');

    newCard.className = 'course-card';

    newCard.innerHTML = `
    <div class="course-header">
        <h4>Course / Program ${newIndex}</h4>
        <button class="remove-course-btn">Remove</button>
    </div>

    <div class="form-grid">

        <div class="form-group full">
            <label class="form-label">Course / Program Name *</label>
            <input type="text" class="form-input course-name">
        </div>

        <div class="form-group full">
            <label class="form-label">Course Detail</label>
            <textarea class="form-textarea course-desc" rows="5"></textarea>
        </div>

        <div class="form-group duration-wrapper" style="display: flex; gap: 10px;">
    <div style="flex: 1;">
        <label class="form-label">Duration (optional)</label>
        <input type="number" class="form-input duration" placeholder="Enter value">
    </div>
    <div style="flex: 1;">
        <label class="form-label">Duration Unit (optional)</label>
        <select class="form-select duration_unit">
            <option value="">Select Unit</option>
            <option value="Days">Days</option>
            <option value="Months">Months</option>
            <option value="Years">Years</option>
        </select>
    </div>
</div>
        <div class="form-group">
            <label class="form-label">Mode *</label>
            <select class="form-select mode">
                 <option value="">Select Mode</option>
                  <option value="Online">Online</option>
                  <option value="Offline">Offline</option>
                  <option value="Both (Hybrid)">Both (Hybrid)</option>
            </select>
        </div>

        <div class="form-group full">
            <label class="form-label">Upload Course Image</label>
            <input type="file" class="form-file" accept="image/*">
        </div>

    </div>
    `;

    list.appendChild(newCard);

});


/* -------------------- REMOVE COURSE -------------------- */

$(document).on("click",".remove-course-btn",function(){
     // Check if only 1 course left
    if($("#courseList .course-card").length === 1){
        toastr.warning("At least one course required");
        return; // exit function, remove nahi hoga
    }
    $(this).closest(".course-card").remove();
    // Re-number all courses
    $("#courseList .course-card").each(function(index){
        $(this).find("h4").text("Course / Program " + (index + 1));
    });

});


/* -------------------- SAVE FUNCTIONS -------------------- */

function saveProfileData(callback){

    $.ajax({

        url:"{{ url('/institute/profile/save') }}",
        type:"POST",

        data:{
            owner_name:$("#owner-name").val(),
            designation:$("#designation").val(),
            email:$("#email").val(),
            est_year:$("#est-year").val(),
            institute_desc:$("#institute-desc").val(),
            website:$("#website").val(),
            fb:$("#fb").val(),
            ig:$("#ig").val(),
            yt:$("#yt").val(),
            twitter:$("#twitter").val(),
            _token:$('meta[name="csrf-token"]').attr('content')
        },

        success:function(res){

            if(res.status){

                if(callback){
                    callback();
                }

            }

        },
        error:function(xhr){
            // Clear previous errors
            $('.error-text').text('');

            if(xhr.status === 422){ // validation error
                let errors = xhr.responseJSON.errors;
                $.each(errors, function(key, value){
                    // show the first error for each field
                    $('#' + key + 'Error').text(value[0]);
                });
            } else {
                alert('Something went wrong!');
            }
        }

    });

}


function saveCoursesData(callback){

    let formData = new FormData();

    $(".course-card").each(function(index){

        formData.append("courses["+index+"][name]",$(this).find(".course-name").val());
        formData.append("courses["+index+"][detail]",$(this).find(".course-desc").val());
        formData.append("courses["+index+"][duration]",$(this).find(".duration").val());
        formData.append("courses["+index+"][duration_unit]",$(this).find(".duration_unit").val());
        formData.append("courses["+index+"][mode]",$(this).find(".mode").val());

        let image=$(this).find("input[type=file]")[0].files[0];

        if(image){
            formData.append("courses["+index+"][image]",image);
        }

    });

    formData.append("_token",$('meta[name="csrf-token"]').attr('content'));

    $.ajax({

        url:"{{ url('institute/courses/save') }}",
        type:"POST",
        data:formData,
        processData:false,
        contentType:false,

        success:function(res){

            if(res.status){

                if(callback){
                    callback();
                }

            }

        }

    });

}


function saveTimingData(){

    let timings=[];

    $(".timing-card").each(function(){

        timings.push({

            day:$(this).find(".day-name").text(),
            open:$(this).find(".open-time").val(),
            close:$(this).find(".close-time").val(),
            active:$(this).find(".is_active").is(":checked") ? 1 : 0

        });

    });

    $.ajax({

        url:"{{ url('/institute/timing/save') }}",
        type:"POST",

        data:{
            timings:timings,
            _token:$('meta[name="csrf-token"]').attr('content')
        },

        success:function(res){

            if(res.status){

                toastr.success("Profile completed successfully!");

                window.location.href="{{ url('/institute/dashboard') }}";

            }

        }

    });

}


/* -------------------- STEP BUTTONS -------------------- */

$("#saveProfileBtn").click(function(){

    clearErrors();

    if(!validateProfile()){
        return;
    }

    saveProfileData(function(){

        toastr.success("Profile saved!");

        autoCloseAndOpen('accordion-profile','accordion-courses');

    });

});


$("#saveCoursesBtn").click(function(){

    if(!validateCourses()){
        return;
    }

    saveCoursesData(function(){

        toastr.success("Courses saved!");

        autoCloseAndOpen('accordion-courses','accordion-timing');

    });

});


/* -------------------- SAVE & EXIT -------------------- */

$("#saveAndExit").click(function(){

    clearErrors();

    // Step 1: Validate profile
    if(!validateProfile()){
        $("#accordion-profile").addClass("active");
        return;
    }

    // Step 2: Save profile first
    saveProfileData(function(){

        // Step 3: Check if any courses exist
        let hasCourses = false;

          $(".course-card").each(function(){
              let name = $(this).find(".course-name").val().trim();
              if(name !== ""){
                  hasCourses = true;
                  return false; // break loop
              }
          });

        if(hasCourses){
            // Validate courses if they exist
            if(!validateCourses()){
                $("#accordion-courses").addClass("active");
                return;
            }

            saveCoursesData(function(){

                // Check if timings exist
                let hasTiming = $(".timing-card input.is_active:checked").length > 0;

                if(hasTiming){
                    saveTimingData(); // Save timing if at least one day active
                } else {
                    toastr.success("Profile and courses saved successfully!");
                    window.location.href="{{ url('/institute/dashboard') }}";
                }

            });

        } else {
            // No courses, just save profile and redirect
            toastr.success("Profile saved successfully!");
            window.location.href="{{ url('/institute/dashboard') }}";
        }

    });

});

});
  </script>
@endpush