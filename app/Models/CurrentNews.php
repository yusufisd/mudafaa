<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentNews extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        "seo_key" => "array",
        "tags" => "array",
    ];

    public function Category()
    {
        return $this->hasOne(CurrentNewsCategory::class,'id','category_id');
    }

    public function Author()
    {
        return $this->hasOne(UserModel::class, 'id', 'author_id');
    }
}
