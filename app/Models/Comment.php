<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Product(){
        return $this->hasOne(CurrentNews::class,'id','post_id');
    }

    public function CommentCommentsCount(){
        return Comment::where('is_post',0)->where('post_id',$this->id)->count();
    }

    public function CommentComments(){
        return Comment::where('is_post',0)->where('post_id',$this->id)->get();
    }
}
 