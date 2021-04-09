<?php

namespace App\Domains\Tracking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackMessage extends Model
{
    use HasFactory;

    protected $fillable = [

    	'_id',
    	'status',
    	'recipient',
    	'date_sent',
    	'campaign_id',
    	'message'
    ];
}

