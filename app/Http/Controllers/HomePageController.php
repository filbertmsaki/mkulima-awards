<?php

namespace App\Http\Controllers;

use App\Models\AwardCategory;
use App\Models\Contact;
use App\Models\EventSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePageController extends Controller
{
    public function index()
    {

        return "DONE";
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
        return view('web.index', compact('categories', 'voting', 'award_registration', 'voting_start_on', 'voting_end_on','award_registration_start_on', 'award_registration_end_on'));
    }
    public function aboutUs()
    {
        return view('web.about-us');
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
