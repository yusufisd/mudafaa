<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnCompanyModel extends Model
{
    use HasFactory,SoftDeletes;
    protected $casts = [
        "seo_key" => "array",
    ];

    public function getKeys(){
        return explode(',', $this->seo_key);
    }

    public function Title(){
        return EnCompanyTitle::where('company_id',$this->id)->get();
    }
}
