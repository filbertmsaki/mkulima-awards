<?php

namespace App\Console\Commands;

use App\Jobs\ParticipationConfirmationJob;
use App\Models\AwardCategory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ParticipationConfirmationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'participation:confirmation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to verify participation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $year = 2022;
        $categories_count = AwardCategory::count();
        $details = DB::table('nominees')
            ->select(
                'award_categories.name as award_category_name',
                'award_categories.id as award_category_id',
                'nominees.service_name',
                'nominees.company_email',
                'nominees.contact_person_email',
                'nominees.id'
            )
            ->join('nominee_categories', 'nominees.id', '=', 'nominee_categories.nominee_id')
            ->join('award_categories', 'nominee_categories.category_id', '=', 'award_categories.id')
            ->where('nominee_categories.year', $year)
            ->where('nominees.contact_person_email', 'jackson@shambadunia.com')
            ->get();


        $groups = $details->chunk(50);
        foreach ($groups as $index =>  $group_detail) {

            foreach ($group_detail as $detail) {
                $delay = now()->addHours($index); // Delay increases for each group

                if ($detail->contact_person_email) {
                    $email = $detail->contact_person_email;
                } else if ($detail->company_email) {
                    $email = $detail->company_email;
                } else {
                    $email = null;
                }
                if ($email == "jackson@shambadunia.com") {
                    $data = [
                        'name' => $detail->service_name,
                        'total_category' => $categories_count,
                        'category' => $detail->award_category_name,
                        'confimation_link' => route('web.participation_confirmation', ['category' =>  $detail->award_category_id, 'id' =>  $detail->id]),
                    ];
                    dispatch(new ParticipationConfirmationJob($email, $data))->delay($delay);
                }
            }
        }
    }
}
