<?php

namespace App\Http\Controllers;

use App\Jobs\SendReminders;
use App\Models\Member;
use App\Services\Reminders\Reminder;
use App\Services\SmsGateways\Mnotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{

    /**
     *  Retrieve all members
     * 
     * @return [type] [description]
     */
    public function index(Reminder $reminder){
      return Member::all();
    }

     /**
     *  Retrieve all members to reminded tomorrow
     * 
     * @return [type] [description]
     */
    public function nextToBeReminded(Reminder $reminder){
    	return Member::reminders($reminder->nextDue());
    }

    /**
     *  Retrieve all members to be reminded today
     * 
     * @return [type] [description]
     */
    public function remindedToday(Reminder $reminder){
    	return Member::reminders($reminder->today());
    }

    /**
     *  Add new members to family
     */
    public function add(Request $request){

    	$user = Member::create([
			'name' => $request->name,
			'mobile' => $request->mobile,
			'day_to_call' => $request->day,
		]);
    }

    /**
     *  Update member 
     * 
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function update(Request $request, Member $member){

    	$member->update([
    		'name' => $request->name, 
    		'mobile' => $request->mobile, 
    		'days_to_call' => $request->day, 
    	]);
    }


    /**
     *  Delete member
     * 
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function delete(Member $member){
		$member->delete();
    }
}
