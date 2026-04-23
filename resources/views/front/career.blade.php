@extends('layouts.app')
@section('title', 'Careers at ApnaShaher')

@push('styles')
<style>

body{
    background: linear-gradient(180deg,#f0f4ff,#ffffff);
}

/* Glass Card */
.glass-card{
    background: rgba(255,255,255,0.75);
    backdrop-filter: blur(14px);
    border-radius:20px;
    border:1px solid rgba(255,255,255,0.4);
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    transition:0.35s;
}

.glass-card:hover{
    transform:translateY(-6px);
    box-shadow:0 20px 50px rgba(0,0,0,0.15);
}

/* Apply Form */
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

</style>
@endpush


@section('content')

<!-- HERO -->
<section class="py-7 md:py-20 px-2 md:px-0 text-center">
    <h1 class="text-2xl md:text-5xl font-bold mb-4">
        Careers at <span class="text-indigo-600">ApnaShaher.com</span>
    </h1>

    <p class="text-gray-600 text-sm md:text-lg max-w-2xl mx-auto">
        Join our mission to help local institutes grow and connect with students.
    </p>
</section>



<section class="pb-20">
<div class="max-w-7xl mx-auto px-2 md:px-6">


<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

<!-- JOB LIST -->
<div class="lg:col-span-2 space-y-6">

<h2 class="text-3xl font-bold mb-6">Current Openings</h2>




@foreach($jobs as $job)

<div class="glass-card p-3 md:p-6">

<div class="flex flex-col md:flex-row justify-between items-start gap-2">


<div>

<h3 class="text-xl font-semibold mb-2">
{{ $job->job_title }}
</h3>

<div class="flex gap-3 mb-3 text-sm">

<span class="job-badge">
📍 {{ $job->job_location }}
</span>

<span class="job-badge">
💼 {{ ucfirst(str_replace('_',' ', $job->employment_type)) }}
</span>

</div>

<p class="text-gray-600">
{{ $job->overview }}
</p>

</div>

<a href="{{ route('job-opening-details', $job->slug) }}" class="text-indigo-600 font-semibold" style="white-space:nowrap;">
Apply →
</a>

</div>

</div>

@endforeach

</div>


<!-- APPLY FORM -->
<div>

<div class="apply-form p-2 md:p-8 sticky top-24">


<h3 class="text-2xl font-bold mb-6">
Quick Apply
</h3>

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


<select name="position"
class="form-input mb-4"
required>

<option value="">Select Position</option>

@foreach($jobs as $job)
<option>{{ $job['title'] }}</option>
@endforeach

</select>


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
</div>
</section>
<script>

function updateFileName(){

let input = document.getElementById("resume");
let fileName = input.files[0]?.name || "Upload your CV";

document.getElementById("fileName").innerText = fileName;

}

</script>


@endsection
