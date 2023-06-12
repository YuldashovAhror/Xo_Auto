<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSingle extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'photo',
        'icon',
        'name',
        'discription',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
