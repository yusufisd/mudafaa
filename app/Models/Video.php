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

    public function getKeys(){
        return explode(',', $this->seo_key);
    }

    public function CommentCount()
    {
        return VideoComment::where('is_post', 1)
            ->where('post_id', $this->id)
            ->where('status', 1)
            ->count();
    }

    public function AdminCommentCount()
    {
        return VideoComment::where('is_post', 1)
            ->where('post_id', $this->id)
            ->count();
    }

    public function comments()
    {
        return VideoComment::where('is_post', 1)
            ->where('post_id', $this->id)
            ->where('status', 1)
            ->get();
    }

    
}
