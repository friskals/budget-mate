<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'name',
        'limit',
        'category_id',
        'day_of_month',
        'user_id',
        'budget_id'
    ];

    use HasFactory;
}