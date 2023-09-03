<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnCurrentNews extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        "seo_key" => "array",
        "tags" => "array",
    ];
}
