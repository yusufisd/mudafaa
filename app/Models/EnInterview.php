<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnInterview extends Model
{
    use HasFactory,SoftDeletes;
    protected $casts = [
        "seo_key" => "array",
        "live_time" => 'datetime'

    ];
    protected $guarded = [];

    public function Author(){
        return $this->hasOne(UserModel::class,'id','author');
    }

    public function commentCount(){
        return InterviewComment::where('post_id',$this->id)->where('status',1)->count();
    }

    public function comments(){
        return InterviewComment::where('post_id',$this->id)->where('status',1)->get();
    }

    public function getKeys(){
        return explode(',', $this->seo_key);
    }

    public function CommentCommentsCount(){
        return InterviewComment::where('is_post',0)->where('post_id',$this->id)->count();
    }

    public function CommentComments(){
        return InterviewComment::where('is_post',0)->where('post_id',$this->id)->get();
    }
}
