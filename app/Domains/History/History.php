<?php

namespace App\Domains\History;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;


    protected $fillable = [

        'status',
        'code',
        '_id',
        'total_sent',
        'contacts',
        'total_rejected',
        'numbers_sent',
        'credit_used'
    ];
}
