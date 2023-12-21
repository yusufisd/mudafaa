<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnTopbar extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        "start_time" => 'datetime',
        "finish_time" => 'datetime'

    ];
}
