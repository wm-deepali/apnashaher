<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        return view('front.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|regex:/^\+?[0-9]{10,15}$/',
            'subject' => 'required|string|max:255',
            'message' => 'required|min:10'
        ]);

        Contact::create($request->all());

        return back()->with('success', 'Message sent successfully!');
    }
}
