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
            return redirect()->route('web.index');
        }
        $currentYear = Carbon::now()->year;
        $nominees = Nominee::whereHas('award_categories', function ($query) use ($currentYear) {
            $query->where('year', $currentYear);
        })
            ->where('verified', VerifiedEnum::Yes->value)
            ->with('award_categories')
            ->get();

        $categories = [];
        foreach ($nominees as $nominee) {
            foreach ($nominee->categories as $category) {
                $categoryId = $category->id;
                $categorySlug = $category->slug;
                $categoryName = $category->name;

                if (!isset($categories[$categoryId])) {
                    $categories[$categoryId] = [
                        'name' => $categoryName,
                        'id' => $categoryId,
                        'slug' => $categorySlug,
                        'count' => 1,
                    ];
                } else {
                    $categories[$categoryId]['count']++;
                }
            }
        }

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
            return redirect()->route('web.index');
        }
        $agent = request()->header("User-Agent") . ' ' . request()->ip();
        $nominee = Nominee::where('id', $request->nominee)->first() ?? abort(404);
        $category = AwardCategory::where('id', $request->category_id)->first();
        $vote = Vote::where([
            'category_id' => $category->id,
            'agent' => $agent,
        ])->where('created_at', ">=", Carbon::now()->subHours(12)->format("Y-m-d H:i:s"));

        if ($vote->count() <= 0) {
            Vote::create([
                'ip' => request()->ip(),
                'nominee_id' =>  $nominee->id,
                'category_id' => $category->id,
                'agent' => $agent
            ]);
            return response()->json(['success' => trans('vote.notification.success', ['name' => $nominee->service_name, 'category' => $category->name])]);
        }
        $voted = Vote::where([
            'agent' => $agent,
            'category_id' => $category->id
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
        $currentYear = Carbon::now()->year;
        $nominees = Nominee::whereHas('categories', function (Builder $query) use ($id) {
            $query->where('slug', $id);
        })->whereHas('award_categories', function ($query) use ($currentYear) {
            $query->where('year', $currentYear);
        })->where('verified', VerifiedEnum::Yes->value)->get();
        $category = AwardCategory::where('slug', $id)->latest()->first();
        $share = new Share();
        $share->currentPage('Please vote for me as a ' . '' . $category->name)
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp();


        return view('web.vote.show', compact('nominees', 'share', 'category'));
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
