<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'name',
        'phone',
        'discription',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
