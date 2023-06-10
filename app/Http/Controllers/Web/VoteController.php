<?php

namespace App\Http\Controllers\Web;

use App\Enums\VerifiedEnum;
use App\Http\Controllers\Controller;
use App\Models\AwardCategory;
use App\Models\Nominee;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jorenvh\Share\Share;


class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!voting_period()) {
            abort(404);
        }
        $categories = Nominee::select('category_id', DB::raw('count(*) as nominees'))
            ->groupBy('category_id')->where('verified', VerifiedEnum::Yes->value)->get();
        return view('web.vote.index', compact('categories'));
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
        if (!voting_period()) {
            abort(404);
        }
        $agent = request()->header("User-Agent") . ' ' . request()->ip();
        $nominee = Nominee::where('id', $request->nominee)->first() ?? abort(404);
        $vote = Vote::where([
            'category_id' => $nominee->category->id,
            'agent' => $agent,
        ])->where('created_at', ">=", Carbon::now()->subHours(12)->format("Y-m-d H:i:s"));

        if ($vote->count() <= 0) {
            Vote::create([
                'ip' => request()->ip(),
                'nominee_id' =>  $nominee->id,
                'category_id' => $nominee->category->id,
                'agent' => $agent
            ]);
            return response()->json(['success' => trans('vote.notification.success', ['name' => $nominee->service_name, 'category' => $nominee->category->name])]);
        }
        $voted = Vote::where([
            'agent' => $agent,
            'category_id' => $nominee->category->id
        ])->first();
        $nominee_voted = Nominee::where('id', $voted->nominee_id)->first();
        return response()->json(['error' => trans('vote.notification.error', ['name' => $nominee_voted->service_name])]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!voting_period()) {
            abort(404);
         }
        $nominees = Nominee::whereHas('category', function (Builder $query) use ($id) {
            $query->where('slug', $id);
        })->where('verified', VerifiedEnum::Yes->value)->get();
        $category = AwardCategory::where('slug', $id)->latest()->first();

        $share = new Share();
        $share->currentPage('Please vote for me as a ' . '' . $category->name)
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp();


        return view('web.vote.show', compact('nominees', 'share'));
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
