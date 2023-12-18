<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\InterviewComment;
use App\Models\VideoComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function list($id){
        $data = Comment::where('post_id',$id)->get();
        return view('backend.currentNews.comments.list',compact('data'));
    }

    public function interviewsComments(){
        $data = InterviewComment::get();
        return view('backend.comments.interview.list',compact('data'));
    }

    public function videosComments(){
        $data = VideoComment::get();
        return view('backend.comments.video.list',compact('data'));
    }

    // YORUMLAR KISMI FONKSİYONLARI
    public function NewsComment(){
        $data = Comment::where('is_post',1)->latest()->get();
        return view('backend.comments.currentNews.list',compact('data'));
    }
}
