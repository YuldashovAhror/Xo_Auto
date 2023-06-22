<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpCenter extends Model
{
    use HasFactory;

    protected $fillable = [
        'video',
        'second_video',
        'atribute',
        'video_name',
    ];

    protected $casts = [
        'atribute' => 'array'
    ];
}
