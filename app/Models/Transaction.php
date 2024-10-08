<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'category_type',
        'category_logo',
        'amount',
        'memo',
        'transaction_date',
        'user_id',
        'transaction_id'
    ];
}
