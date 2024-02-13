<?php

namespace App\Http\Controllers;

use App\Models\AwardCategory;
use App\Models\Contact;
use App\Models\EventSetting;
use App\Models\User;
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

        // Retrieve all existing award categories
        $existingAwards = AwardCategory::all();

        // Delete each existing award category
        foreach ($existingAwards as $award) {
            $award->delete();
        }
        $user = User::where('id', '9e0f55d1-4194-4ba4-be19-e1968509a9e7')->first();
        $awardsList = [
            "Best Farmer of The Year (Individual)",
            "Best Local Farmers Support Bank of The Year",
            "Agricultural International Development Partner Of The Year",
            "Agricultural Brand | Equipment’s Of The Year",
            "Agricultural Brand | Farm Inputs Of The Year",
            "Agriculctural Brand | Seeds Company Of The Year",
            "Agricultural Insurance Company Of The Year",
            "Agricultural Produce Processor Of The Year",
            "Agricultural Innovative Solution Of The Year",
            "Agricultural Influencer Of The Year",
            "Agricultural Woman achiever of the year",
            "Livestock Farmer Of The Year",
            "Fish Farmer Of The Year",
            "Dairy Farm Of The Year",
            "Poultry Farm Of The Year",
            "Agricultural Consultant Company Of The Year |Agribusiness Support (BDS)",
            "Innovative Agri-finance Development Institution Of The Year",
            "Best Farmers Group/ Association of the Year",
            "Public Agricultural Institute Of The Year",
            "Public Private Support",
            "Farmers Most Supportive Private Institute of the year",
            "Best International Farmers Support Bank Of The Year",
            "Agricultural Local Development Partner Of The Year",
            "Best Farmer of The Year (Company)",
            "Agricultural Food Processing Initiative Of The Year",
            "Innovative Agricultural Technology of the Year",
            "Outstanding Agricultural Extension Officer",
            "Environmental Conservation Champion",
            "Water Management Excellence Award",
            "Organic Farming Pioneer",
            "Food Processing and Value Addition Award",
            "Climate-Smart Agriculture Advocate",
            "Seedling Production and Reforestation Award",
            "Innovative Crop Production",
            "Sustainable Fisheries Management Award",
            "Sustainable Tourism in Agriculture",
            "Inclusive Agribusiness Champion",
            "Best Post-Harvest Handling and Storage Practices",
            "Excellence in Agri-Export"
        ];

        foreach ($awardsList  as $award) {
            AwardCategory::updateOrCreate([
                'name' => $award
            ], ['created_by' => $user->id]);
        }

        return view('web.index', compact('categories', 'voting', 'award_registration', 'voting_start_on', 'voting_end_on', 'award_registration_start_on', 'award_registration_end_on'));
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
