<?php

namespace App\Models;

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
    protected $fillable = [ 'name', 'mobile', 'day_to_call'];

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
  	public static function reminders($day){

  		return self::where('day_to_call', $day)->get();
  	}


  	public function members(){

  		return self::all();
  	}


  	public function contributions(){
    	return $this->hasMany(Contribution::class);
    }


    public function reminders(){
    	return $this->hasMany(Reminder::class);
    }
}
