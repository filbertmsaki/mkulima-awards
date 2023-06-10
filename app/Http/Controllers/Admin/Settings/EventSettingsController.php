<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\EventSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voting = EventSetting::where('value', 'voting')->first();
        $award_registration = EventSetting::where('value', 'award_registration')->first();
        return view('admin.settings.events.index', compact('voting', 'award_registration'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request->has('award_registration_value') && !empty($request->award_registration_value)) {

            EventSetting::updateOrCreate([
                'value' => $request->award_registration_value
            ], [
                'status' => $request->award_registration_status,
                'start_date' => Carbon::parse($request->award_registration_start_date)->startOfDay(),
                'end_date' => Carbon::parse($request->award_registration_end_date)->endOfDay(),
            ]);
        }

        if ($request->has('voting_value') && !empty($request->voting_value)) {

            EventSetting::updateOrCreate([
                'value' => $request->voting_value
            ], [
                'status' => $request->voting_status,
                'start_date' => Carbon::parse($request->voting_start_date)->startOfDay(),
                'end_date' => Carbon::parse($request->voting_end_date)->endOfDay(),
            ]);
        }

        return redirect()->back()->with('success', 'Event Settings Successful Updated.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
