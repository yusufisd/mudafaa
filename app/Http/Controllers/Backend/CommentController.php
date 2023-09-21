<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function list($id){
        $data = Comment::where('post_id',$id)->get();
        return view('backend.currentNews.comments.list',compact('data'));
    }
}
