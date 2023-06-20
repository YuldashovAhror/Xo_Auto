<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'year_id',
        'name',
        'discription',
        'link',
    ];

    public function year()
    {
        return $this->belongsTo(Year::class);
    }
}
