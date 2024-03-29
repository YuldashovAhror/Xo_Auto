<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'discription',
        'video',
        'slug',
        'second_video',
        'atribute',
        'video_name',
    ];

    protected $casts = [
        'atribute' => 'array'
    ];

    public function singles()
    {
        return $this->hasMany(ServiceSingle::class, 'service_id');
    }

    public function sections()
    {
        return $this->hasMany(ServiceSection::class, 'service_id');
    }
}
