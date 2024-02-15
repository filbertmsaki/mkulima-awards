<?php

namespace App\Http\Controllers\Web;

use App\Enums\EntryEnum;
use App\Http\Controllers\Controller;
use App\Models\AwardCategory;
use App\Models\Nominee;
use App\Models\NomineeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;

class AwardCategoriesController extends Controller
{
    public function categories()
    {
        $categories = AwardCategory::orderBy('name', 'ASC')->get();
        return view('web.awards.categories', compact('categories'));
    }
    public function category($slug)
    {
        $category = AwardCategory::where('slug', $slug)->first();
        if ($category) {
            return view('web.awards.category', compact('category'));
        }
        return redirect()->back()->with('error', 'Category not found');
    }

    public function registration()
    {
        if (!award_registration_period()) {
            return redirect()->route('web.index');
        }
        $categories = AwardCategory::orderBy('name', 'ASC')->get();
        return view('web.awards.registration', compact('categories'));
    }
    public function registration_store(Request $request)
    {
        if (!award_registration_period()) {
            abort(404);
        }
        $request->validate([
            'category_id' => 'required',
            'entry' => [new Enum(EntryEnum::class)],
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
}
