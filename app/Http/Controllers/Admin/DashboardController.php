<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AwardCategory;
use App\Models\Nominee;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $current_year = Carbon::now()->format('Y');
        $nominees_count  = Nominee::whereHas('categories', function ($query) {
            $query->where('year', date('Y'));
        })->count();
        $votes_count  = Vote::whereYear('created_at', $current_year)->count();
        $categories_count = AwardCategory::count();
        return view('admin.index', compact('nominees_count', 'votes_count', 'categories_count'));
    }
}
