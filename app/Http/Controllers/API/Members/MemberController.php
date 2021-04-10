<?php

namespace App\Http\Controllers\API\Members;

use App\Domains\Member\Actions\MemberActions;
use App\Domains\Member\Member;
use App\Http\Controllers\Controller;
use App\Http\Requests\Member\CreateMemberRequest;
use App\Http\Requests\Member\SwitchDayRequest;
use App\Http\Requests\Member\UpdateMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{

   
    /**
     * Class constructor
     *
     * @param MemberActions $action App\Domains\Member\Actions\MemberActions
     */
    public function __construct(public MemberActions $members){}

    /**
     *  Returns all members
     *
     * @return Collection Illuminate\Support\Collection
     */
    public function members()
    {
        return $this->members->all();
    }

    /**
     * Returns members due for tomorrow
     *
     * @return Collection Illuminate\Support\Collection
     */
    public function tomorrow()
    {
        return $this->members->tomorrow();
    }

    /**
     *  Returns members due for today
     * 
     * @return Collection Illuminate\Support\Collection
     */
    public function today()
    {
        return $this->members->today();
    }


    /**
     *  Switch member active day
     * 
     * @param  Request $request Illuminate\Http\Request
     * @return object  
     */
    public function switchDay(SwitchDayRequest $request)
    {
        $data = $request->validated();
        $this->members->switchDay($data->ids, $data->day);
    }


    /**
     * Create new members
     * 
     * @param  CreateMemberRequest $request  App\Http\Requests\CreateMemberRequest
     * @return void 
     */
    public function create(CreateMemberRequest $request)
    {
        $data = $request->validated();
        $this->members->create($data);
    }


    /**
     * Update existing members
     * 
     * @param  Member  $member App\Domains\Member\Member
     * @param  UpdateMemberRequest $request App\Http\Requests\Member\UpdateMemberRequest
     * @return void  
     */
    public function update(Member $member, UpdateMemberRequest $request)
    {
        $data = $request->validated();
        $this->members->update($member, $data);
    }


    /**
     * Delete member 
     * 
     * @param  Member $member  App\Domains\Member\Member
     * @return void  
     */
    public function delete(Member $member)
    {
        $this->members->delete($member);
    }


    /**
     * Delete selected members
     * 
     * @param  Request $requestIlluminate\Http\Request;
     * @return void  
     */
    public function deleteSelected(Request $request)
    {
        $this->members->deleteSelected($request->ids);
    }

}
