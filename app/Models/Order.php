<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'machinetype_id',
        'date',
        'from',
        'to',
        'year',
        'make',
        'model',
        'name',
        'phone',
        'email',
    ];

    public function machinetypes()
    {
        return $this->belongsTo(Machinetype::class, 'machinetype_id');
    }
}
