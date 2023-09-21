<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CommentController extends Controller
{
    public function store(Request $request,$id){
        $new = new Comment();
        $new->full_name = $request->full_name;
        $new->email = $request->email;
        $new->comment = $request->comment;
        $new->post_id = $id;
        $new->save();
        Alert::success('Yorumunuz onaylandıktan sonra görünecektir.');
        return redirect()->back();

    }
}
