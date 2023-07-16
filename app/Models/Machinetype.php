<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machinetype extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'name',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'machinetype_id');
    }
}
