<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    CONST  PENDING = 'pending';
	CONST  PROCESSING = 'processing';

    /**
     *  Fillable properties
     * 
     * @var array
     */
    protected $fillable = [
    	'name',
    	'amount', 
    	'tx_ref', 
    	'payment_type', 
    	'status'
    ];


    protected $table = 'payments';


      /**
     *	model boot method
     * 
     * @return [type] [description]
     */
    public static function boot(){

    	parent::boot();

    	static::creating(function ($payment){
    		$payment->status = self::PENDING;
    		$payment->tx_ref = mt_rand(100000, 999999);
    	});
    }



    public function contribution(){

    	return $this->belongsTo(Contribution::class);
    }

}
