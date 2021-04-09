<?php

declare(strict_types=1);

namespace App\Domains\Member\Actions;

use App\Domains\Member\Member;
use App\Domains\Reminder\Services\Reminder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MemberActions
{

    /**
     * Return all members
     *
     * @return array
     */
    public function all():array
    {
        return DB::table('members')->select('id', 'name', 'mobile', 'email')->get();
    }

    /**
     * Return all members due for reminders tomorrow
     *
     * @return Collection Illuminate\Support\Collection;
     */
    public function tomorrow():Collection
    {
        return Member::reminder((new Reminder())->nextDue());
    }

    /**
     * Return all members due for reminders today
     *
     * @return Collection Illuminate\Support\Collection;
     *
     */
    public function today():Collection
    {
        return Member::reminder((new Reminder())->today());
    }


    /**
     * Change members active days
     *
     * @param  array $ids
     * @param  string $day
     * @return void
     */
    public function switchDay(array $ids, string $day):void
    {
         DB::table('members')
            ->whereIn('id', $ids)
            ->update(['day_to_call' => $day]);
    }

    /**
     *  Create a new member
     *
     * @param  array $member
     * @return Member  App\Domains\Member\Member;
     */
    public function create(array $member):Member
    {
         $model = Member::create([
            'name' => $member->name,
            'mobile' => $member->mobile,
            'email' => $member->email,
            'day_to_call' => $member->day,
         ]);

        return $model;
    }

   /**
     *  Updates a member
     *
     * @param  array $member
     * @return Member  App\Domains\Member\Member;
     */
    public function update(Member $member):Member
    {
         $member->update([
            'name' => $member->name,
            'mobile' => $member->mobile,
            'email' =>  $member->email,
            'day_to_call' => $member->day,
         ]);

        return $member;
    }


    /**
     * Removes a member
     *
     * @param  Member $member App\Domains\Member\Member;
     * @return void
     */
    public function delete(Member $member):void
    {
        $member->delete();
    }


     /**
     * Removes a multiple members
     *
     * @param  array $ids
     * @return void
     */
    public function deleteSelected(array $ids):void
    {
         DB::table('members')
            ->whereIn('id', $ids)
            ->delete();
    }
}
