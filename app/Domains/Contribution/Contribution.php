<?php

namespace App\Domains\Contribution;

use App\Domains\Payment\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contribution extends Model
{
    use HasFactory;

    /**
     * Fillable properties
     * 
     * @var array
     */
    protected $fillable = [ 
    	'title', 
    	'description', 
    	'starts', 
    	'expires_on', 
    	'expires_at',
    	'min',
    	'pause',
    	'slug'
    ];


    protected $table = 'contributions';


      /**
     *	model boot method
     * 
     * @return [type] [description]
     */
    public static function boot(){

    	parent::boot();

    	static::created(function ($contribute){
    		$contribute->where('id', $contribute->id)
    			->update(['slug' => Str::slug($contribute->title)]);
    	});
    }


    public function member(){
		return $this->hasMany(Payment::class);
    }


    public function payments(){
    	return $this->hasMany(Payment::class);
    }

    /**
    * Set Route key
    * 
    * @return [type] [description]
    */
    public function getRouteKeyName(){

    	return 'slug';
    }

}
