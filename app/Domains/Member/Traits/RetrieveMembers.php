<?php

namespace App\Domains\Member\Traits;

use App\Domains\Member\Member;
use Illuminate\Support\Facades\DB;

trait RetrieveMembers
{
    public function getNumbers($members)
    {
        return collect($this->members)->map(function ($member) {
            return $member->mobile;
        })->toArray();
    }

    public function loadNum($ids)
    {
    	if($ids){
            $members = DB::table('members')
            ->whereIn('id', $ids)->get();
        }

        if(!$ids){
             $members = Member::select('mobile')->get();
        }

       return collect($members)->map(function ($member) {
            return $member->mobile;
        })->toArray();

    }
    	

}
