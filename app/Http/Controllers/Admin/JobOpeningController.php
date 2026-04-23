<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobOpening;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class JobOpeningController extends Controller
{

    public function index()
    {
        $jobs = JobOpening::latest()->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }


    public function create()
    {
        return view('admin.jobs.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'job_title' => 'required|string|max:255',
            'employment_type' => 'required',
            'job_location' => 'nullable|string|max:255',
                'job_type' => 'required',

            'salary_type' => 'required',
            'salary_fixed' => 'nullable|numeric',
            'salary_from' => 'nullable|numeric',
            'salary_to' => 'nullable|numeric',
            'salary_duration' => 'required',
        ]);
        


        $slug = Str::slug($request->job_title);

        // Ensure slug is unique
        $count = JobOpening::where('slug', $slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . time();
        }


        JobOpening::create([

            'job_title' => $request->job_title,
            'slug' => $slug,
            'employment_type' => $request->employment_type,
            'job_location' => $request->job_location,
    'job_type' => $request->job_type,

            'salary_type' => $request->salary_type,
            'salary_fixed' => $request->salary_type == 'fixed' ? $request->salary_fixed : null,
            'salary_from' => $request->salary_type == 'range' ? $request->salary_from : null,
            'salary_to' => $request->salary_type == 'range' ? $request->salary_to : null,
            'salary_duration' => $request->salary_duration,

            'overview' => $request->overview,
            'job_description' => $request->job_description,
            'eligibility_criteria' => $request->eligibility_criteria,
        ]);


        return redirect()
            ->route('admin.manage-jobs.index')
            ->with('success', 'Job added successfully');
    }



    public function edit($id)
    {
        $job = JobOpening::findOrFail($id);
        return view('admin.jobs.edit', compact('job'));
    }



    public function update(Request $request, $id)
    {

        $request->validate([
            'job_title' => 'required|string|max:255',
            'employment_type' => 'required',
            'job_location' => 'nullable|string|max:255',
                'job_type' => 'required',
            'salary_type' => 'required',
            'salary_fixed' => 'nullable|numeric',
            'salary_from' => 'nullable|numeric',
            'salary_to' => 'nullable|numeric',
            'salary_duration' => 'required',
        ]);


        $job = JobOpening::findOrFail($id);

        $slug = Str::slug($request->job_title);

        // Avoid duplicate slug except current record
        $count = JobOpening::where('slug', $slug)
            ->where('id', '!=', $id)
            ->count();

        if ($count > 0) {
            $slug = $slug . '-' . time();
        }


        $job->update([

            'job_title' => $request->job_title,
            'slug' => $slug,
            'employment_type' => $request->employment_type,
            'job_location' => $request->job_location,
    'job_type' => $request->job_type,

            'salary_type' => $request->salary_type,
            'salary_fixed' => $request->salary_type == 'fixed' ? $request->salary_fixed : null,
            'salary_from' => $request->salary_type == 'range' ? $request->salary_from : null,
            'salary_to' => $request->salary_type == 'range' ? $request->salary_to : null,
            'salary_duration' => $request->salary_duration,

            'overview' => $request->overview,
            'job_description' => $request->job_description,
            'eligibility_criteria' => $request->eligibility_criteria,
        ]);


        return redirect()
            ->route('admin.manage-jobs.index')
            ->with('success', 'Job updated successfully');
    }



    public function destroy($id)
    {

        $job = JobOpening::findOrFail($id);

        $job->delete();

        return redirect()
            ->route('admin.manage-jobs.index')
            ->with('success', 'Job deleted successfully');
    }

}