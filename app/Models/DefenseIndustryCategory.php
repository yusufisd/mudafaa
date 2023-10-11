<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DefenseIndustryCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        "seo_key" => "array"
    ];

    public function adet(){
        return DefenseIndustryContent::where('category_id',$this->id)->count();
    }

    public function defense(){
        return $this->hasOne(DefenseIndustry::class,'id','defense_id');
    }
}
