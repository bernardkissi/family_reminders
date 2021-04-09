<?php

namespace App\Domains\Payment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    const  PENDING = 'pending';
    const  PROCESSING = 'processing';

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
        'status',
        'payment_id'
    ];


    protected $table = 'payments';


      /**
     *  model boot method
     *
     * @return [type] [description]
     */
    public static function boot()
    {

        parent::boot();

        static::creating(function ($payment) {
            $payment->status = self::PENDING;
        });
    }



    public function contribution()
    {

        return $this->belongsTo(Contribution::class);
    }
}
