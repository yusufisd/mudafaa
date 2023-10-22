<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentNews extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        "category_id" => "array",
        "live_time" => 'datetime'

    ];

    public function Category()
    {
        $data = CurrentNewsCategory::whereIn('id',$this->category_id)->get();
        return $data;
    }

    public function Category2(){
        $data = CurrentNewsCategory::whereIn('id',$this->category_id)->get();
        $liste = [];
        foreach($data as $item){
            array_push($liste,$item->title);
        }
        return $liste;
    }

    public function Author()
    {
        return $this->hasOne(UserModel::class, 'id', 'author_id');
    }

    public function Tags()
    {
        return json_decode($this->tags);
    }

    public function CommentCount()
    {
        return Comment::where('is_post', 1)
            ->where('post_id', $this->id)
            ->where('status', 1)
            ->count();
    }

    public function AdminCommentCount()
    {
        return Comment::where('is_post', 1)
            ->where('post_id', $this->id)
            ->count();
    }

    public function comments()
    {
        return Comment::where('is_post', 1)
            ->where('post_id', $this->id)
            ->where('status', 1)
            ->get();
    }


    public function getKeys(){
        return explode(',', $this->seo_key);
    }
}
