<?php

namespace App\Http\Controllers\API\Message;

use App\Domains\Communication\Sms\Providers\Mnotify;
use App\Domains\Message\Actions\MessageActions;
use App\Domains\Message\Jobs\AnnounceJob;
use App\Domains\Message\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\CreateMessageRequest;
use Illuminate\Http\Request;

class MessageController extends Controller
{
 
     /**
     * Class constructor
     *
     * @param MemberActions $action App\Domains\Member\Actions\MemberActions
     */
    public function __construct(public MessageActions $message){}


    /**
     *  Returns all messages
     *
     *
     * @return Collection Illuminate\Support\Collection
     */
    public function messages()
    {
        return $this->message->all();
        // return $this->message->send('hello');
    }

    /**
     * Create a new message
     *
     * @param  CreateMessageRequest $request [description]
     * @return [type]                        [description]
     */
    public function create(CreateMessageRequest $request)
    {
        $data = $request->validated();
        $this->message->create($data['message']);
    }

    /**
     *  Updates a message
     *
     * @param  Message  $message App\Domains\Message\Message
     * @param  CreateMessageRequest $request App\Http\Requests\Message\CreateMessageRequest;
     * @return void
     */
    public function update(Message $message, CreateMessageRequest $request)
    {
         $data = $request->validated();
         $this->message->update($message, $data['message']);
    }

    /**
     * Set Message to be default
     *
     * @param  Message $message App\Domains\Message\Message
     * @return void
     */
    public function default(Message $message)
    {
        $this->message->default($message);
    }

    /**
     * Delete a Message
     *
     * @param  Message $message App\Domains\Message\Message
     * @return void
     */
    public function delete(Message $message)
    {
        $this->message->delete($message);
    }


    /**
     * Delete a selected Messages
     *
     * @param  Request request Illuminate\Http\Request
     * @return void
     */
    public function deleteSelected(Request $request)
    {
        $this->message->deleteSelected($request->ids);
    }


    /**
     * Send messages/announcements to members
     *
     * @param  CreateMessageRequest $request App\Http\Requests\Message\CreateMessageRequest
     * @return void
     */
    public function send(CreateMessageRequest $request)
    {
        $data = $request->validated();
        AnnounceJob::dispatch($data['message'], $data['ids']);
    }
}
