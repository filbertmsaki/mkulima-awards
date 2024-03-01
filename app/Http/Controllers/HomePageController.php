<?php

namespace App\Http\Controllers;

use App\Enums\VerifiedEnum;
use App\Jobs\ParticipationConfirmationJob;
use App\Mail\ParticipationConfirmationMail;
use App\Models\AwardCategory;
use App\Models\Contact;
use App\Models\EventSetting;
use App\Models\Nominee;
use App\Models\NomineeCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

    public function participation_confirmation($id, $category_id)
    {
        $nominee = Nominee::where('id', $id)->first();
        if ($nominee) {
            $category = AwardCategory::where('id', $category_id)->first();
            if ($category) {
                $categories = AwardCategory::orderBy('name', 'ASC')->get();
                return view('web.nominee-confirmation', compact('categories', 'nominee', 'category'));
            }
            return redirect()->route('web.index')->with('error', 'Category not found');
        }
        return redirect()->route('web.index')->with('error', 'Nominee not found');
    }


    public function participation_confirmation_store(Request $request, $id, $category_id)
    {

        $request->validate([
            'category_id' => 'required'
        ]);
        $nominee = Nominee::where('id', $id)->first();
        if ($nominee) {
            $exists = Nominee::whereHas('categories', function ($query) use ($request) {
                $query->whereIn('category_id', $request->category_id)->where('year', date('Y'));
            })->where('service_name', capitalize($nominee->service_name))
                ->where('contact_person_name', capitalize($nominee->contact_person_name))
                ->where('contact_person_phone', capitalize($nominee->contact_person_phone))
                ->exists();
            if ($exists) {
                return redirect()->back()->with('info', 'You have already verified your participation.');
            } else {
                DB::beginTransaction();
                if ($nominee) {
                    foreach ($request->category_id as  $category_id) {
                        $nominee_category = NomineeCategory::updateOrCreate([
                            'category_id' => $category_id,
                            'nominee_id' => $nominee->id,
                            'year' => date('Y')
                        ]);
                    }
                    DB::commit();
                    return redirect()->route('web.index')->with('success', 'Your request has been submited successfull.');
                }
                return redirect()->back()->with('error', 'Unknown error occur.');
            }
        }
        return redirect()->back()->with('error', 'Nominee not found');
    }

    public function  mail()
    {

        $year = 2022;
        $categories_count = AwardCategory::count();
        $details = DB::table('nominees')
            ->select(
                'award_categories.name as award_category_name',
                'award_categories.id as award_category_id',
                'nominees.service_name',
                'nominees.id'
            )
            ->join('nominee_categories', 'nominees.id', '=', 'nominee_categories.nominee_id')
            ->join('award_categories', 'nominee_categories.category_id', '=', 'award_categories.id')
            ->where('nominee_categories.year', $year)
            ->where('nominees.contact_person_email', 'jackson@shambadunia.com')
            ->first();
        $data = [
            'name' => $details->service_name,
            'total_category' => $categories_count,
            'category' => $details->award_category_name,
            'confimation_link' => route('web.participation_confirmation', ['category' =>  $details->award_category_id, 'id' =>  $details->id]),
        ];


        $email = new ParticipationConfirmationMail($data);
       $mail= Mail::to('filymsaki@gmail.com')->send($email);

        dd( $mail);
        // dispatch(new ParticipationConfirmationJob('filymsaki@gmail.com', $data));

        return view('emails.nominee-email', compact('data'));
    }
}
