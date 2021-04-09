<?php

namespace App\Domains\Message\Jobs;

use App\Domains\Communication\Sms\Providers\Mnotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AnnouncementsDispatch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $members;
    public $announcement;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($members, $announcement)
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
        return $sms->send($this->retrieveMembers($this->members));
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
            'message' => $this->annoucement
        ];
    }
}
