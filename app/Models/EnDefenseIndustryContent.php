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

    public function GeneralCategory(){
        return $this->hasOne(EnDefenseIndustry::class,'id','defense_id');
    }

    public function Category()
    {
        return $this->hasOne(EnDefenseIndustryCategory::class,'id','category_id');
    }

    public function Companies(){
        return Company::whereIn('id',$this->companies ?? [])->get();
    }

    public function Mensei(){
        return CountryList::whereIn('id',$this->origin ?? [])->get();
    }

    public function Countries(){
        return CountryList::whereIn('id',$this->countries ?? [])->get();
    }

    public function getKeys(){
        return explode(',', $this->seo_key);
    }

}
