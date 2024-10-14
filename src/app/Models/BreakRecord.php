<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'break_start_time',
        'break_end_time',
        'calculate_break_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
