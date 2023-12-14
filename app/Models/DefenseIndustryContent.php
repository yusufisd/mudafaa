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
        "tags" => "array",
        "seo_key" => "array",
        "companies" => "array",
        "multiple_image" => "array",
        "live_time" => 'datetime'
        
    ];

    public function Author(){
        return $this->hasOne(UserModel::class,'id','author');
    }

    public function Category()
    {
        return $this->hasOne(DefenseIndustryCategory::class,'id','category_id');
    }

    public function Mensei(){
        if($this->origin != null){
            return CountryList::whereIn('id',$this->origin)->get();
        }else{
            return [];
        }
    }

    public function Countries(){
        if($this->countries){
            return CountryList::whereIn('id',$this->countries)->get();
        }else{
            return [];
        }
    }

    public function Companies(){
        return Company::whereIn('id',$this->companies ?? [])->get();
    }

    public function GeneralCategory(){
        return $this->hasOne(DefenseIndustry::class,'id','defense_id');
    }

    public function ImageCounter(){
        $data = DefenseIndustryContent::find($this->id);
        if($data->multiple_image == null){
            return 0;
        }else{
            return count($data->multiple_image);

        }
    }

    public function getKeys(){
        return explode(',', $this->seo_key);
    }
   
}
