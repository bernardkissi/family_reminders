<?php

namespace App\Domains\Member;

use App\Domains\Contribution\Contribution;
use App\Domains\Reminder\Reminder;
use Database\Factories\MemberFactory;
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

    
    /**
     *  Contributions relationship
     *
     * @return hasMany
     */
    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }


    /**
     * Reminders relationship
     *
     * @return hasMany
     */
    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return MemberFactory::new();
    }
}
