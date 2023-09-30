<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnDefenseIndustryContent extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        "countries" => "array",
        "origin" => "array",
        "tags" => "array",
        "seo_key" => "array",
        "companies" => "array",
        "multiple_image" => "array",
        
    ];
}
