<?php

namespace App\Domains\Reminder;

use App\Domains\Member\Member;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    /**
     * Fillable description
     * 
     * @var array
     */
    protected $fillable = [ 'status', 'member_id'];

    /**
     * Members and reminders relationship
     * 
     * @return [type] [description]
     */
    public function members(){
    	return $this->belongsTo(Member::class);
    }
}
