<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnDictionary extends Model
{
    use HasFactory, SoftDeletes;
    protected $casts = [
        "seo_key" => "array",
        "live_date" => "date",
    ];

    public function Author(){
        return $this->hasOne(UserModel::class,'id','author');
    }

}
