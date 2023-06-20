<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
    ];

    public function abouts()
    {
        return $this->hasMany(About::class, 'year_id');
    }
}
