<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EntryEnum;
use App\Enums\VerifiedEnum;
use App\Http\Controllers\Controller;
use App\Models\AwardCategory;
use App\Models\Nominee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class AwardNomineesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nominees = Nominee::latest()->get();
        return view('admin.nominees.index', compact('nominees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = AwardCategory::orderBy('name', 'ASC')->get();
        return view('admin.nominees.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'entry' => [new Enum(EntryEnum::class)],
            'verified' => [new Enum(VerifiedEnum::class)],
            'service_name' => 'required',
            'contact_person_name' => 'required',
            'contact_person_phone' => 'required',
            'contact_person_email' => 'required',
        ]);
        $exists = Nominee::where('category_id', $request->category_id)
            ->where('service_name', capitalize($request->service_name))
            ->where('contact_person_name', capitalize($request->contact_person_name))
            ->where('contact_person_phone', capitalize($request->contact_person_phone))
            ->exists();
        if ($exists) {
            return redirect()->back()->with('info', 'Nominee with submited data already exists.');
        } else {
            Nominee::create($request->except('_token'));
            return redirect()->route('admin.award-nominee.index')->with('success', 'Nominee successful Created.');
        }
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
        $nominee = Nominee::where('id', $id)->first();
        if ($nominee) {
            $categories = AwardCategory::orderBy('name', 'ASC')->get();

            return view('admin.nominees.edit', compact('nominee','categories'));
        }
        return redirect()->route('admin.award-nominee.index')->with('error', 'Data Not Found.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $nominee = Nominee::where('id', $id)->first();
        if ($nominee) {
            $nominee->update($request->except('_token', 'id','files','_method'));
            
            return redirect()->back()->with('success', 'Nominee Successful Updated.');

        }
        return redirect()->route('admin.award-nominee.index')->with('error', 'Data Not Found.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nominee = Nominee::where('id', $id)->first();
        if ($nominee) {
            $nominee->delete();
            return redirect()->route('admin.award-nominee.index')->with('success', 'Award Nominee Successful Deleted.');
        }
        return redirect()->route('admin.award-nominee.index')->with('error', 'Data Not Found.');
    }
}
