<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     *  Fillable properties
     * 
     * @var array
     */
    protected $fillable = ['message', 'default'];


    /**
     *	model boot method
     * 
     * @return [type] [description]
     */
    public static function boot(){

    	parent::boot();

    	static::creating(function ($message){

    		if($message->default){
				$message->where('default', true)->update(['default' => false]);
    		}
    	});

    	static::updating(function($message){

    		if($message->default){
				$message->where('default', true)->update(['default' => false]);
    		}
    	});
    }


    /**
     * Set default attribute
     * 
     * @param [type] $value [description]
     */
    public function setDefaultAttribute($value){

    	$this->attributes['default'] = ($value === 'true' || $value ? true : false);
    }


    /**
     * Set Route key
     * 
     * @return [type] [description]
     */
    public function getRouteKeyName(){

    	return 'id';
    }


    
}
