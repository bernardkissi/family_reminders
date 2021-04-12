<?php

namespace App\Domains\Message\Jobs;


use App\Domains\Communication\Sms\Providers\Mnotify;
use App\Domains\Member\Member;
use App\Domains\Member\Traits\RetrieveMembers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;


class AnnounceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, RetrieveMembers;

    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public string $message, public array $ids = []){}

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mnotify $sms)
    {
        return $sms->send($this->data());
    }


    /**
     *  Get members whose calling is due
     *
     * @return [type] [description]
     */
    public function data()
    {

        return [

            'recipient' => $this->loadNum($this->ids),
            'sender' => 'kissiFamily',
            'message' => $this->message
        ];
    }
}
