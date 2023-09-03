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
        "category_id" => "array",
        "tags" => "array",
    ];

    public function Category()
    {
        $data = CurrentNewsCategory::whereIn('id',$this->category_id)->get();
        return $data;
    }

    public function Author()
    {
        return $this->hasOne(UserModel::class, 'id', 'author_id');
    }
}
