<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MonthlyContributionJob implements ShouldQueue
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
    public function handle(Mnotify $sms)
    {
       $this->sms->send($this->retrieveMembers());
    }

     /**
     *  Get members whose calling is due
     * 
     * @return [type] [description]
     */
    public function retrieveMembers(){

        return [
            
            'recipient' => $this->getNumbers($this->members),
            'sender' => 'kissiFamily',
            'message' => $this->defaultMessage()
        ];
    }
}
