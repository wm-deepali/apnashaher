<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StateController extends Controller
{

    public function index()
    {
        $states = State::with('country')->get();
        return view('admin.states.index', compact('states'));
    }

    public function create()
    {
        $countries = Country::pluck('name','id');
        return view('admin.states.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'name' => 'required'
        ]);

        State::create($request->all());

        return redirect()->route('admin.manage-states.index')->with('success','Created Successfully');
    }

    public function edit(State $manage_state)
    {
        $countries = Country::pluck('name','id');
        $state = $manage_state;
        return view('admin.states.edit', compact('state','countries'));
    }

    public function update(Request $request, State $manage_state)
    {
        $manage_state->update($request->all());

        return redirect()->route('admin.manage-states.index')->with('success','Updated Successfully');
    }

    public function destroy(State $manage_state)
    {
        $manage_state->delete();

        return redirect()->route('admin.manage-states.index')->with('success','Deleted Successfully');
    }
}