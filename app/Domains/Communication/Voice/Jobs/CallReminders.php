<?php

namespace App\Domains\Communication\Voice\Jobs;

use App\Domains\Communication\Voice\Providers\VoiceMnotify;
use App\Domains\Member\Traits\RetrieveMembers;
use App\Domains\Reminder\Services\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CallReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, RetrieveMembers;

    public $members;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($members)
    {
        $this->members = $members;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(VoiceMnotify $voice, Reminder $reminder)
    {
        dd($voice->call($this->getNumbers($this->members)));
        
    }
}
