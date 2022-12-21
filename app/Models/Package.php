<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'packages';
    protected $fillable = [
        'package',
        'treatment',
        'price',
        'method',
        'commission_rate',
        'commission_amount',
    ];
}
