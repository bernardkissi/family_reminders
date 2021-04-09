<?php

namespace App\Domains\Reminder\Jobs;

use App\Domains\Communication\Sms\Providers\Mnotify;
use App\Domains\Member\Member;
use App\Domains\Member\Traits\RetrieveMembers;
use App\Domains\Message\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendReminders
{
    use 
    Dispatchable,
    InteractsWithQueue,
    Queueable,
    SerializesModels,
    RetrieveMembers;

    public $members;
        
    /**
    * Create a new job instance.
    *
    * @return void
    */
    public function __construct(Member $members)
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
        return $sms->send($this->retrieveMembers());
    }


    /**
    *  Get members whose calling is due
    *
    * @return [type] [description]
    */
    public function retrieveMembers()
    {

        return [

            'recipient' => $this->getNumbers($this->members),
            'sender' => 'kissiFamily',
            'message' => Message::where('default', true)->first()['message']
        ];
    }
}
