<?php

namespace App\Jobs;

use App\Mail\ParticipationConfirmationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ParticipationConfirmationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $send_mail;
    protected $details;

    /**
     * Create a new job instance.
     */
    public function __construct($send_mail, $details)
    {
        $this->send_mail = $send_mail;
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new ParticipationConfirmationMail($this->details);
        Mail::to($this->send_mail)->send($email);
    }
}
