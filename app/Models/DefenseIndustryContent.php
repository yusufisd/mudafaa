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
        "companies" => "array",
        "multiple_image" => "array",
        
    ];

    public function Author(){
        return $this->hasOne(UserModel::class,'id','author');
    }

    public function Category()
    {
        return $this->hasOne(DefenseIndustryCategory::class,'id','category_id');
    }

    public function Mensei(){
        return CountryList::whereIn('id',$this->origin)->get();
    }

    public function Countries(){
        return CountryList::whereIn('id',$this->countries)->get();
    }

    public function GeneralCategory(){
        return $this->hasOne(DefenseIndustry::class,'id','defense_id');
    }
}
