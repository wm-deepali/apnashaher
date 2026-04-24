<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateBlog($request);

        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {

            $image = $request->file('image')->store('blogs', 'public');
            $data['image'] = $image;

        }

        Blog::create($data);

        return redirect()->route('admin.manage-blog.index')
            ->with('success', 'Blog Created');
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
    public function edit(Blog $manage_blog)
    {
        $blog = $manage_blog;
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $manage_blog)
    {
        $data = $this->validateBlog($request);
        $blog = $manage_blog;

        if ($request->hasFile('image')) {

            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            $data['image'] = $request->file('image')->store('blogs', 'public');
        }


        $blog->update($data);

        return redirect()->route('admin.manage-blog.index')
            ->with('success', 'Blog Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $manage_blog)
    {
        $manage_blog->delete();

        return response()->json([
            'status' => true,
            'message' => 'Blog Deleted Successfully'
        ]);
    }
    protected function validateBlog(Request $request)
    {
        return $request->validate([
            'title' => 'required|string|max:255',

            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'content' => 'nullable|string',

            'meta_title' => 'nullable|string|max:255',

            'meta_description' => 'nullable|string|max:500',

            'meta_keywords' => 'nullable|string|max:255',

            'status' => 'required|boolean'
        ]);
    }

}
