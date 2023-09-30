<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    public function store(Request $request,$id){
        $request->validate([
            "full_name" => "required",
            "email" => "required",
            "comment" => "required",
        ],[
            "full_name.required" => "İsim soyisim boş bırakılamaz",
            "email.required" => "Email alanı boş bırakılamaz",
            "comment.required" => "Yorum alanı boş bırakılamaz",
        ]);

        $new = new Comment();
        $new->full_name = $request->full_name;
        $new->email = $request->email;
        $new->comment = $request->comment;
        $new->post_id = $id;
        $new->save();
        Alert::success('Başarılı','Yorumunuz onaylandıktan sonra görünecektir.');
        return redirect()->back();
    }

    public function storeComment(Request $request,$test){
        $request->validate([
            "full_name" => "required",
            "email" => "required",
            "comment" => "required",
        ],[
            "full_name.required" => "İsim soyisim boş bırakılamaz",
            "email.required" => "Email alanı boş bırakılamaz",
            "comment.required" => "Yorum alanı boş bırakılamaz",
        ]);

        $new = new Comment();
        $new->full_name = $request->full_name;
        $new->email = $request->email;
        $new->comment = $request->comment;
        $new->comment = $request->comment;
        $new->post_id = $test;
        $new->is_post = 0;
        $new->save();

        Alert::success('Başarılı','Yorumunuz onaylandıktan sonra görünecektir.');
        return redirect()->back();
    }
            

}
