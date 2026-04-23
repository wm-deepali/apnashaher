<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::with('state')->get();
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
         $states = State::pluck('name','id');
        return view('admin.cities.create', compact('states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required',
            'slug' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'slug', 'is_registered', 'is_popular', 'is_launching', 'meta_title', 'meta_description', 'state_id']);

        // Checkbox defaults
        $data['is_registered'] = $request->has('is_registered') ? 1 : 0;
        $data['is_popular'] = $request->has('is_popular') ? 1 : 0;
        $data['is_launching'] = $request->has('is_launching') ? 1 : 0;

        // Image handling
        if ($data['is_popular'] && $request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cities', 'public');
        }

        // Slug logic
        if (!$data['is_launching']) {
            $data['slug'] = Str::slug($request->name); // auto generate
        } else {
            $data['slug'] = $request->slug ?? Str::slug($request->name); // use admin input if given
        }

        City::create($data);

        return redirect()->route('admin.manage-cities.index')->with('success','Created Successfully');
    }

    public function edit(City $manage_city)
    {
        $states = State::pluck('name','id');
        $city = $manage_city;
        return view('admin.cities.edit', compact('city', 'states'));
    }

    public function update(Request $request, City $manage_city)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required',
            'slug' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'slug', 'is_registered', 'is_popular', 'is_launching', 'meta_title', 'meta_description','state_id']);

        // Checkbox defaults
        $data['is_registered'] = $request->has('is_registered') ? 1 : 0;
        $data['is_popular'] = $request->has('is_popular') ? 1 : 0;
        $data['is_launching'] = $request->has('is_launching') ? 1 : 0;

        // Image handling
        if ($data['is_popular'] && $request->hasFile('image')) {
            if ($manage_city->image) {
                Storage::disk('public')->delete($manage_city->image);
            }
            $data['image'] = $request->file('image')->store('cities', 'public');
        } elseif (!$data['is_popular']) {
            $data['image'] = null; // remove image if not popular
        }

        // Slug logic
        if (!$data['is_launching']) {
            $data['slug'] = Str::slug($request->name); // auto generate
        } else {
            $data['slug'] = $request->slug ?? Str::slug($request->name); // use admin input if given
        }

        $manage_city->update($data);

        return redirect()->route('admin.manage-cities.index')->with('success','Updated Successfully');
    }

    public function destroy(City $manage_city)
    {
        if ($manage_city->image) {
            Storage::disk('public')->delete($manage_city->image);
        }
        $manage_city->delete();
        return redirect()->route('admin.manage-cities.index')->with('success','Deleted Successfully');
    }
}