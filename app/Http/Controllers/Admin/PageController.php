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
        // Only show published pages (status = 1)
        $pages = Page::where('status', 1)->orderBy('title')->get();

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
        ]);

        Page::create($request->all());

        return redirect()->route('admin.manage-page.index')->with('success', 'Page created successfully!');
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
        ]);

        $page->update($request->all());

        return redirect()->route('admin.manage-page.index', $page->id)->with('success', 'Page updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);
        $page->delete();
         return redirect()->route('admin.manage-page.index', $page->id)->with('success', 'Page deleted successfully!');
    }
}
