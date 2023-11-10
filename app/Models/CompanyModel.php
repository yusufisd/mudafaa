<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $casts = [
    ];

    public function Category(){
        return $this->hasOne(CompanyCategory::class,'id','category');
    }

    public function Title(){
        return CompanyTitle::where('company_id',$this->id)->get();
    }

    public function getKeys(){
        return explode(',', $this->seo_key);
    }
}
