<?php

namespace App\Http\Controllers\Web;

use App\Enums\EntryEnum;
use App\Http\Controllers\Controller;
use App\Models\AwardCategory;
use App\Models\Nominee;
use Illuminate\Http\Request;
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
        $exists = Nominee::where('category_id', $request->category_id)
            ->where('service_name', capitalize($request->service_name))
            ->where('contact_person_name', capitalize($request->contact_person_name))
            ->where('contact_person_phone', capitalize($request->contact_person_phone))
            ->exists();
        if ($exists) {
            return redirect()->back()->with('info', 'Nominee with submited data already exists.');
        } else {
            Nominee::create($request->except('_token'));
            return redirect()->back()->with('success', 'Your request has been submited successfull.');
        }
    }
}
