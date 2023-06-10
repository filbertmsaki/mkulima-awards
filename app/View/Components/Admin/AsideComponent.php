<?php

namespace App\View\Components\Admin;

use App\Models\Vote;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class AsideComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public $vote_years;
    public function __construct()
    {
        $vote_years = Vote::select(
            DB::raw("count(id) as total_votes"),
            DB::raw("(YEAR(created_at)) year")
        )
            ->groupBy('year')->orderBy('year','DESC')->get();

        $this->vote_years = $vote_years;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.aside-component');
    }
}
