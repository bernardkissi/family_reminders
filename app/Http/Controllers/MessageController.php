<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Message;
use App\Services\SmsGateways\Mnotify;
use Illuminate\Http\Request;

class MessageController extends Controller
{
     /**
     *  Retrieve all messages
     * 
     * @return [type] [description]
     */
    public function index(){
    	return Message::all();
    }


    /**
     * [send description]
     * @param  Request $request [description]
     * @param  Mnotify $sms     [description]
     * @return [type]           [description]
     */
    public function sendMessage(Request $request, Mnotify $sms){
    	return $sms->send($this->retrieveMembers($request));
    }

    /**
     *  Add new members
     */
    public function add(Request $request){

    	$message = Message::create([
			'message' => $request->message,
			'default' => true
		]);
    }


    /**
     *  Update member 
     * 
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function update(Request $request, Message $message){
    	$message->update(['message' => $request->msg, 'default' => $message->default]);
    }


    /**
     *  Update member 
     * 
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function setDefault(Request $request, Message $message){
    	$message->update(['default' => true]);
    }


    /**
     *  Delete member
     * 
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function delete(Message $message){
		$message->delete();
    }


    /**
     *  Get members whose calling is due
     * 
     * @return [type] [description]
     */
    protected function retrieveMembers($request){

    	$members = Member::all();
        $numbers = collect($members)->map(function ($member){
            return $member->mobile;
        })->toArray();

        return [

            'recipient' => $numbers,
            'sender' => 'kissiFamily',
            'message' => $request->message
        ];
    }
}
