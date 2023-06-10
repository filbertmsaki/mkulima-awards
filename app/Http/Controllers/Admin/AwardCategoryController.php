<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AwardCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AwardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = AwardCategory::orderBy('name', 'ASC')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        DB::beginTransaction();
        AwardCategory::create($request->except('_token', 'files'));
        DB::commit();
        return redirect()->route('admin.award-category.index')->with('success', 'Award Category Successful Created.');
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
    public function edit($id)
    {
        $category = AwardCategory::where('id', $id)->first();
        if ($category) {
            return view('admin.categories.edit', compact('category'));
        }
        return redirect()->route('admin.award-category.index')->with('error', 'Data Not Found.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $category = AwardCategory::where('id', $id)->first();
        if ($category) {
            $category->update($request->except('_token', 'id','files','_method'));
            return redirect()->back()->with('success', 'Award Category Successful Updated.');

        }
        return redirect()->route('admin.award-category.index')->with('error', 'Data Not Found.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = AwardCategory::where('id', $id)->first();
        if ($category) {
            $category->delete();
            return redirect()->route('admin.award-category.index')->with('success', 'Award Category Successful Deleted.');
        }
        return redirect()->route('admin.award-category.index')->with('error', 'Data Not Found.');
    }
}
