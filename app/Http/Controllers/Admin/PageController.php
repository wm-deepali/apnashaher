<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::where('status', 1)
            ->orderBy('title')
            ->get();

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required|string|max:255',

            'slug'  => 'required|string|max:255|unique:pages,slug',

            'content' => 'required',

            'meta_title' => 'nullable|string|max:255',

            'meta_description' => 'nullable|string',

        ]);

        Page::create([

            'title' => $request->title,

            'slug' => $request->slug,

            'content' => $request->content,

            'status' => $request->status ?? 1,

            'meta_title' => $request->meta_title,

            'meta_description' => $request->meta_description,

        ]);

        return redirect()
            ->route('admin.manage-page.index')
            ->with('success', 'Page created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page = Page::findOrFail($id);

        return view('admin.pages.form', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page = Page::findOrFail($id);

        $request->validate([

            'title' => 'required|string|max:255',

            'slug'  => 'required|string|max:255|unique:pages,slug,' . $page->id,

            'content' => 'required',

            'meta_title' => 'nullable|string|max:255',

            'meta_description' => 'nullable|string',

        ]);

        $page->update([

            'title' => $request->title,

            'slug' => $request->slug,

            'content' => $request->content,

            'status' => $request->status ?? 1,

            'meta_title' => $request->meta_title,

            'meta_description' => $request->meta_description,

        ]);

        return redirect()
            ->route('admin.manage-page.index')
            ->with('success', 'Page updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);

        $page->delete();

        return redirect()
            ->route('admin.manage-page.index')
            ->with('success', 'Page deleted successfully!');
    }
}