<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnCurrentNewsCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        "seo_key" => "array"
    ];

    public function adet(){
        return EnCurrentNews::where('status', 1)->whereJsonContains('category_id', $this->id)->count();
    }
    public function getKeys(){
        return explode(',', $this->seo_key);
    }
}
