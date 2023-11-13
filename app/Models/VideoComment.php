<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoComment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subComment(){
        $data = VideoComment::where('status',1)->where('is_post',0)->where('post_id',$this->id)->get();
        return $data;
    }

    public function Answers(){
        return VideoComment::where('is_post', 0)->where('post_id', $this->id)->get();
    }

    public function MainComment(){
        return $this->belongsTo(VideoComment::class, 'post_id');
    }

    public function CommentCommentsCount(){
        return VideoComment::where('is_post',0)->where('post_id',$this->id)->count();
    }

    public function CommentComments(){
        return VideoComment::where('is_post',0)->where('post_id',$this->id)->get();
    }
}
