<?php

declare(strict_types=1);

namespace App\Domains\Message\Actions;

use App\Domains\Communication\Sms\Providers\Mnotify;
use App\Domains\Member\Member;
use App\Domains\Message\Message;

class MessageActions
{
    /**
     * Returns all messages
     *
     * @return array
     */
    public function all():array
    {
        return DB::table('messages')->select('id', 'message', 'default')->get();
    }

    /**
     * Sending messages
     *
     * @param  string  $message
     * @param  Mnotify $sms App\Domains\Communication\Sms\Providers\Mnotify
     * @return array
     */
    public function send(string $message, Mnotify $sms):array
    {
        return $sms->send($this->data($message));
    }

    /**
     * Create new messsage
     *
     * @param  string $message
     * @return void
     */
    public function create(string $message): void
    {
        $message = Message::create([
            'message' => $message,
            'default' => true
        ]);
    }

    /**
     * Update message
     *
     * @param  Message $msg  App\Domains\Message\Message;
     * @param  array   $data
     * @return void
     */
    public function update(Message $msg, array $data): void
    {
        $msg->update(['message' => $data->message, 'default' => $data->default]);
    }

    /**
     * Setting message default
     *
     * @param  Message $msg App\Domains\Message\Message;
     * @return void
     */
    public function default(Message $msg): void
    {
        $msg->update(['default' => true]);
    }

    /**
     * Delete Message
     *
     * @param  Message $msg App\Domains\Message\Message;
     * @return void
     */
    public function delete(Message $msg): void
    {
        $message->delete();
    }


    /**
     * Formatting data into message required data
     *
     * @param  string $message
     * @return array
     */
    protected function data(string $message): array
    {
        $members = Member::select('mobile')->get();
        $numbers = collect($members)->map(function ($member) {
            return $member->mobile;
        })->toArray();

        return [

            'recipient' => $numbers,
            'sender' => 'kissiFamily',
            'message' => $message
        ];
    }
}
