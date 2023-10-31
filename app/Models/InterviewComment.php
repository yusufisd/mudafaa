<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewComment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function CommentCommentsCount(){
        return InterviewComment::where('is_post',0)->where('post_id',$this->id)->count();
    }

    public function CommentComments(){
        return InterviewComment::where('is_post',0)->where('post_id',$this->id)->get();
    }
}
