<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EntryEnum;
use App\Enums\VerifiedEnum;
use App\Http\Controllers\Controller;
use App\Models\AwardCategory;
use App\Models\Nominee;
use App\Models\NomineeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;

class AwardNomineesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nominees = Nominee::latest()->whereHas('categories', function ($query) {
            $query->where('year', date('Y'));
        })->get();
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
        $exists = Nominee::whereHas('categories', function ($query) use ($request) {
            $query->whereIn('category_id', $request->category_id);
        })->where('service_name', capitalize($request->service_name))
            ->where('contact_person_name', capitalize($request->contact_person_name))
            ->where('contact_person_phone', capitalize($request->contact_person_phone))
            ->exists();
        if ($exists) {
            return redirect()->back()->with('info', 'Nominee with submited data already exists.');
        } else {
            DB::beginTransaction();
            $nominee =  Nominee::updateOrCreate(
                [
                    'service_name' => $request->service_name,
                    'contact_person_name' => $request->contact_person_name,
                    'contact_person_phone' => $request->contact_person_phone,
                ],
                [
                    'entry' => $request->entry,
                    'company_phone' => $request->company_phone,
                    'company_email' => $request->company_email,
                    'contact_person_email' => $request->contact_person_email,
                    'address' => $request->address,
                    'description' => $request->description,
                    'verified' => $request->verified,
                ]
            );
            if ($nominee) {
                foreach ($request->category_id as  $category_id) {
                    $nominee_category = NomineeCategory::updateOrCreate([
                        'category_id' => $category_id,
                        'nominee_id' => $nominee->id,
                        'year' => date('Y')
                    ]);
                }
                DB::commit();
                return redirect()->back()->with('success', 'Your request has been submited successfull.');
            }
            return redirect()->back()->with('error', 'Unknown error occur.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nominees = Nominee::whereHas('categories', function ($query) use ($id) {
            $query->where('year', $id);
        })->where('verified', VerifiedEnum::Yes->value)
            ->get();
        return view('admin.nominees.show', compact('nominees', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nominee = Nominee::where('id', $id)->first();
        if ($nominee) {
            $categories = AwardCategory::orderBy('name', 'ASC')->get();

            return view('admin.nominees.edit', compact('nominee', 'categories'));
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
            $nomineeUpdate =   $nominee->update(
                [
                    'service_name' => $request->service_name,
                    'contact_person_name' => $request->contact_person_name,
                    'contact_person_phone' => $request->contact_person_phone,
                    'entry' => $request->entry,
                    'company_phone' => $request->company_phone,
                    'company_email' => $request->company_email,
                    'contact_person_email' => $request->contact_person_email,
                    'address' => $request->address,
                    'description' => $request->description,
                    'verified' => $request->verified,
                ]
            );
            if ($nomineeUpdate) {
                if (isset($request->category_id) && !empty($request->category_id)) {
                    foreach ($nominee->award_categories as $nominee_categories) {
                        $nominee_categories->delete();
                    }
                    foreach ($request->category_id as  $category_id) {
                        $nominee_category = NomineeCategory::updateOrCreate([
                            'category_id' => $category_id,
                            'nominee_id' => $nominee->id,
                            'year' => date('Y')
                        ]);
                    }
                }
                DB::commit();
                return redirect()->back()->with('success', 'Your request has been submited successfull.');
            }



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
