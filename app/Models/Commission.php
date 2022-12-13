<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'commissions';
    protected $fillable = [
        'user_id',
        'user_name',
        'card',
        'treatment',
        'productcourse',
        'product',
        'course',
        'service',
        'commission'
    ];
}
