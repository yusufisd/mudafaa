<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        "seo_key" => "array",
    ];

    public function Author(){
        return $this->hasOne(UserModel::class,'id','author');
    }

    public function Category(){
        return $this->hasOne(VideoCategory::class,'id','category_id');
    }

    
}
