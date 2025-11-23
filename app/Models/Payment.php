<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $fillable = [
        'user_id',
        'gateway',
        'name_on_card',
        'amount',
        'installment',
        'due_date',
        'status',
        'raw_response',
    ];
}
