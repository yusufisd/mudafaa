<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DefenseIndustryContent extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        "countries" => "array",
        "origin" => "array",
        "seo_key" => "array",
        "category" => "array",
        "companies" => "array",
    ];

    public function Author(){
        return $this->hasOne(UserModel::class,'id','author');
    }

    public function Category()
    {
        $data = DefenseIndustryCategory::whereIn('id',$this->category)->get();
        return $data;
    }
}
