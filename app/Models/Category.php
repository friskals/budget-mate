<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon_id',
        'name',
        'type',
        'user_id',
        'category_id',
        'icon_id'
    ];
}
