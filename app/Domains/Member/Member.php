<?php

namespace App\Domains\Member;

use App\Domains\Contribution\Contribution;
use App\Domains\Reminder\Reminder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    /**
     * Fillable properties
     *
     * @var [type]
     */
    protected $fillable = [ 'name', 'mobile', 'day_to_call', 'email'];

    /**
     *  Model Table
     *
     * @var string
     */
    protected $table = 'members';


    /**
     * Get member next Due
     *
     * @param  [type] $day [description]
     * @return [type]      [description]
     */
    public static function reminder(string $day)
    {

        return self::where('day_to_call', $day)
            ->select('id', 'name', 'email', 'day_to_call', 'mobile')
            ->get();
    }


    public function members()
    {

        return self::all();
    }


    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }


    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
