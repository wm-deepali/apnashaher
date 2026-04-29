<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('admin.category.form', compact('categories'));
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),

            // ✅ NEW SEO FIELDS
            'title' => $request->title,
            'short_description' => $request->short_description,
            'detail_content' => $request->detail_content,

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'tags' => $request->tags,

            'is_popular' => $request->is_popular ? 1 : 0,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'icons' => $request->icons ?? ""
        ]);
        return redirect()->route('admin.manage-categories.index')
            ->with('success', 'Category Created Successfully');
    }

    // Show edit form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.category.form', compact('category', 'categories'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),

            // ✅ NEW SEO FIELDS
            'title' => $request->title,
            'short_description' => $request->short_description,
            'detail_content' => $request->detail_content,

            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'tags' => $request->tags,

            'is_popular' => $request->is_popular ? 1 : 0,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'icons' => $request->icons ?? ""
        ]);

        return redirect()->route('admin.manage-categories.index')
            ->with('success', 'Category Updated Successfully');
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.manage-categories.index')
            ->with('success', 'Category Deleted Successfully');
    }
}