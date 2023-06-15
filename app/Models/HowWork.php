<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HowWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'name',
        'discription',
        'ok',
    ];
}
