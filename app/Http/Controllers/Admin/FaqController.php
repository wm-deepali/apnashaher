<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

  public function index()
{
    $faqs = Faq::orderBy('sort_order','asc')->paginate(10);
    return view('admin.faq.index', compact('faqs'));
}


    public function create()
    {
        return view('admin.faq.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required'
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => $request->status ?? 1,
            'show_on_home' => $request->show_on_home ?? 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.manage-faq.index')
            ->with('success','FAQ created successfully');
    }


    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faq.edit', compact('faq'));
    }


    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => $request->status ?? 1,
            'show_on_home' => $request->show_on_home ?? 0,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.manage-faq.index')
            ->with('success','FAQ updated successfully');
    }


    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();

        return redirect()->route('admin.manage-faq.index')
            ->with('success','FAQ deleted successfully');
    }
}