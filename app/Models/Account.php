<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'initial_balance',
        'icon_id',
        'account_id',
        'user_id'
    ];

    protected $appends =['icon'];
}
