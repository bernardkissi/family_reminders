<?php

namespace App\Http\Controllers;

use App\Jobs\SendReminders;
use App\Models\Member;
use App\Services\Reminders\Reminder;
use App\Services\SmsGateways\Mnotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MembersController extends Controller
{

    public $reminder;
    public $request;

    public function __construct(Request $request, Reminder $reminder)
    {
        $this->reminder = $reminder;
        $this->request = $request;
    }
    /**
     *  Retrieve all members
     *
     * @return [type] [description]
     */
    public function index()
    {
        return DB::table('members')->select('id', 'name', 'mobile', 'email')->get();
    }

     /**
     *  Retrieve all members to reminded tomorrow
     *
     * @return [type] [description]
     */
    public function nextToBeReminded()
    {
        return Member::reminder($this->reminder->nextDue());
    }

    /**
     *  Retrieve all members to be reminded today
     *
     * @return [type] [description]
     */
    public function remindedToday()
    {
        return Member::reminder($this->reminder->today());
    }

    /**
     *  Add new members to family
     */
    public function add()
    {

        $user = Member::create([
            'name' => $this->request->name,
            'mobile' => $this->request->mobile,
            //'email' => $this->request->email,
            'day_to_call' => $this->request->day,
        ]);
    }

    /**
     *  Update member
     *
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function update(Member $member)
    {

        $member->update([
            'name' => $this->request->name,
            'mobile' => $this->request->mobile,
            //'email' =>  $this->request->email,
            'day_to_call' => $this->request->day,
        ]);

        return $member;
    }


    /**
     *  Update multiple contacts
     *
     * @return [type] [description]
     */
    public function updateMultiple()
    {
        DB::table('members')
                    ->whereIn('id', $this->request->ids)
                    ->update(['day_to_call' => $this->request->day]);
    }


    /**
     *  Delete multiple contacts
     *
     * @return [type] [description]
     */
    public function deleteMultiple()
    {
        DB::table('members')
                    ->whereIn('id', $this->request->ids)
                    ->delete();
    }

    /**
     *  Delete member
     *
     * @param  Member $member [description]
     * @return [type]         [description]
     */
    public function delete(Member $member)
    {
        $member->delete();
    }
}
