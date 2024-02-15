<?php

namespace App\Http\Controllers;

use App\Models\AwardCategory;
use App\Models\Contact;
use App\Models\EventSetting;
use App\Models\Nominee;
use App\Models\NomineeCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function index()
    {

        $voting = EventSetting::where('value', 'voting')->first();
        $award_registration = EventSetting::where('value', 'award_registration')->first();
        $voting_start_date = Carbon::createFromFormat('Y-m-d H:i:s', $voting->start_date);
        $voting_end_date = Carbon::createFromFormat('Y-m-d H:i:s', $voting->end_date);
        $now = Carbon::createFromFormat('Y-m-d H:i:s',  Carbon::now());
        $voting_start_on = $voting_start_date->gt($now);
        $voting_end_on = $now->lt($voting_end_date);
        $award_registration_start_date = Carbon::createFromFormat('Y-m-d H:i:s', $award_registration->start_date);
        $award_registration_end_date = Carbon::createFromFormat('Y-m-d H:i:s', $award_registration->end_date);
        $now = Carbon::createFromFormat('Y-m-d H:i:s',  Carbon::now());
        $award_registration_start_on = $award_registration_start_date->gt($now);
        $award_registration_end_on = $now->lt($award_registration_end_date);
        $categories = AwardCategory::select('name', 'id', 'slug')->inRandomOrder()->take(8)->get();
        return view('web.index', compact('categories', 'voting', 'award_registration', 'voting_start_on', 'voting_end_on', 'award_registration_start_on', 'award_registration_end_on'));
    }

    public function nominee()
    {
        $filePath = public_path('nominee.json');

        if (file_exists($filePath)) {
            $jsonData = file_get_contents($filePath);
            $data = json_decode($jsonData, true);

            DB::beginTransaction();
            foreach ($data as $list) {
                $category = AwardCategory::where('name', $list['category_name'])->first();
                if ($category) {
                    $nominee = Nominee::updateOrCreate([
                        'entry' => $list['entry'],
                        'service_name' => $list['service_name'],
                        'company_phone' => $list['company_phone'],
                        'company_email' => $list['company_email'],
                        'contact_person_name' => $list['contact_person_name'],
                        'contact_person_phone' => $list['contact_person_phone'],
                        'contact_person_email' => $list['contact_person_email'],
                        'address' => $list['address'],
                        'description' => $list['description'],
                        'verified' => $list['verified'] == '1' ? 'yes' : 'no'
                    ]);
                    if ($nominee) {
                        $nominee_category = NomineeCategory::updateOrCreate([
                            'category_id' => $category->id,
                            'nominee_id' => $nominee->id,
                            'year' => $list['year']
                        ]);
                    }
                }
            }
            DB::commit();
            return 'done';
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    public function aboutUs()
    {
        return view('web.about-us');
    }
    public function privacy_policy()
    {
        return view('web.privacy-policy');
    }
    public function contactUs()
    {
        return view('web.contact-us');
    }
    public function contactUsStore(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);
        DB::beginTransaction();
        $ip = request()->ip();
        $agent = request()->header("User-Agent") . ' ' . $ip;
        $request->merge([
            'ip' => $ip,
            'agent' => $agent,
        ]);
        $contact = Contact::create($request->except('_token'));
        if ($contact) {
            DB::commit();
            return redirect()->back()->with('success', 'Your message has been submited successfull.');
        } else {
            DB::rollBack();
            return redirect()->back()->with('error', 'Your message has not submited.');
        }
    }
}
