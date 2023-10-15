<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dictionary extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        "live_date" => "date",
    ];

    public function Author(){
        return $this->hasOne(UserModel::class,'id','author');
    }

    public function getKeys(){
        return explode(',', $this->seo_key);
    }
}
