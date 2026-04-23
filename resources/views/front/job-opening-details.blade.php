@extends('layouts.app')

@section('title','Job Details')


<style>

.job-container{
max-width:900px;
margin:auto;
}

.job-card{
background:rgba(255,255,255,.85);
backdrop-filter:blur(12px);
border-radius:20px;
padding:40px;
box-shadow:0 15px 40px rgba(0,0,0,.08);
}

.apply-btn{
background:linear-gradient(135deg,#6366f1,#4f46e5);
color:white;
padding:14px 28px;
border-radius:12px;
font-weight:600;
transition:.3s;
}

.apply-btn:hover{
transform:scale(1.05);
box-shadow:0 10px 25px rgba(99,102,241,.4);
}

/* Modal */

.modal-bg{
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,.6);
display:none;
align-items:center;
justify-content:center;
z-index:999;
padding:20px;
overflow-y:auto;   /* important */
}

.modal-box{
width:100%;
max-width:600px;
background:white;
padding:30px;
border-radius:16px;
max-height:90vh;   /* important */
overflow-y:auto;   /* scroll inside modal */
}


/*.modal-box{*/
/*width:600px;*/
/*background:white;*/
/*padding:30px;*/
/*border-radius:16px;*/
/*}*/

.apply-form{
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(12px);
    border-radius:20px;
    border:1px solid rgba(255,255,255,0.4);
    box-shadow:0 12px 35px rgba(0,0,0,0.08);
}

/* Inputs */
.form-input{
    width:100%;
    padding:12px 16px;
    border-radius:10px;
    border:1px solid #e5e7eb;
    background:rgba(255,255,255,0.7);
    transition:.2s;
}

.form-input:focus{
    border-color:#6366f1;
    box-shadow:0 0 0 3px rgba(99,102,241,.2);
    outline:none;
}

/* Button */
.btn-apply{
    background:linear-gradient(135deg,#6366f1,#4f46e5);
    color:white;
    font-weight:600;
    padding:14px;
    border-radius:12px;
    transition:.3s;
}

.btn-apply:hover{
    transform:scale(1.03);
    box-shadow:0 10px 25px rgba(99,102,241,.4);
}

.job-badge{
    background:#eef2ff;
    color:#4f46e5;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
}


@media (max-width: 768px) {
    .job-card {
    background: rgba(255, 255, 255, .85);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    padding: 15px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, .08);
}
.modal-box {
    width: 100%;
    max-width: 600px;
    background: white;
    padding: 10px;
    border-radius: 16px;
    max-height: 90vh;
    overflow-y: auto;
}
.apply-form {
    background: rgb(255 255 255 / 0%);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    border: 1px solid rgb(255 255 255 / 0%);
    box-shadow: 0 12px 35px rgb(0 0 0 / 0%);
}
}
</style>

@section('content')

<section class="py-8 md:py-20 px-2 md:px-0 bg-gray-50">


<div class="job-container">

<div class="job-card">

<h1 class="text-3xl font-bold mb-4">
{{ $job->job_title }}
</h1>

<div class="flex flex-col md:flex-row gap-4 text-gray-600 mb-6">


<span>📍 {{ $job->job_location }} /
{{ ucwords(str_replace('_',' ', $job->job_type)) }}</span>

<span>💼 {{ ucfirst(str_replace('_',' ', $job->employment_type)) }}</span>

<span>₹
@if($job->salary_type == 'fixed')

₹{{ $job->salary_fixed }} {{ str_replace('_',' ', $job->salary_duration) }}

@else

₹{{ $job->salary_from }} - ₹{{ $job->salary_to }} {{ str_replace('_',' ', $job->salary_duration) }}

@endif
</span>

</div>


<h3 class="text-xl font-semibold mb-2">
Job Description
</h3>

<p class="text-gray-700 mb-6">
{{ $job->overview }}
</p>

<h3 class="text-xl font-semibold mb-2">
Responsibilities
</h3>

<div class="text-gray-700 mb-6">
{!! $job->job_description !!}
</div>

<!--<ul class="list-disc ml-6 text-gray-700 mb-6">-->

<!--<li>Build reusable React components</li>-->
<!--<li>Integrate APIs with frontend</li>-->
<!--<li>Optimize website performance</li>-->
<!--<li>Collaborate with design team</li>-->

<!--</ul>-->


<h3 class="text-xl font-semibold mb-2">
Requirements
</h3>

<!--<ul class="list-disc ml-6 text-gray-700 mb-8">-->

<!--<li>2+ years experience in React</li>-->
<!--<li>Strong knowledge of JavaScript</li>-->
<!--<li>Experience with Tailwind or Bootstrap</li>-->
<!--<li>Understanding of REST APIs</li>-->

<!--</ul>-->

<div class="text-gray-700 mb-8">
{!! $job->eligibility_criteria !!}
</div>

<button class="apply-btn" onclick="openModal()">
Apply Now
</button>

</div>

</div>

</section>


<!-- APPLY MODAL -->

<div class="modal-bg" id="applyModal">

<div class="modal-box">

<div class="flex justify-between mb-4">

<h3 class="text-xl font-bold">
Apply for this Job
</h3>

<button onclick="closeModal()">✖</button>

</div>

<div class="apply-form p-0 md:p-8">




<form method="POST" enctype="multipart/form-data">

@csrf

<input type="text"
name="name"
placeholder="Full Name"
required
class="form-input mb-4">

<input type="email"
name="email"
placeholder="Email Address"
required
class="form-input mb-4">

<input type="tel"
name="phone"
placeholder="Mobile Number"
required
class="form-input mb-4">





<div class="mb-4">

<!--<label class="block text-sm font-medium text-gray-700 mb-2">-->
<!--Upload your CV-->
<!--</label>-->

<div class="relative">

<input 
type="file"
name="resume"
id="resume"
class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
onchange="updateFileName()">

<div class="form-input flex items-center justify-between">

<span id="fileName" class="text-gray-500">
Upload your CV
</span>

<span class="bg-indigo-600 text-white px-4 py-1 rounded-lg text-sm">
Browse
</span>

</div>

</div>

</div>



<textarea
name="cover_letter"
rows="4"
placeholder="Tell us why you're perfect for this role..."
class="form-input mb-4"></textarea>


<button type="submit"
class="btn-apply w-full">
Submit Application
</button>

</form>

<p class="text-xs text-center text-gray-500 mt-4">
Your information is secure with us.
</p>

</div>

</div>

</div>



<script>

function openModal(){

document.getElementById('applyModal').style.display="flex";

}

function closeModal(){

document.getElementById('applyModal').style.display="none";

}

</script>
<script>

function updateFileName(){

let input = document.getElementById("resume");
let fileName = input.files[0]?.name || "Upload your CV";

document.getElementById("fileName").innerText = fileName;

}

</script>

@endsection
