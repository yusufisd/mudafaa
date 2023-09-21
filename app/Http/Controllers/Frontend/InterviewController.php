<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Dialog;
use App\Models\Interview;
use App\Models\InterviewComment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class InterviewController extends Controller
{
    public function index()
    {
        $data = Interview::latest()->get();
        $populer_interview = Interview::inRandomOrder()
            ->take(4)
            ->get();
        return view('frontend.interview.list', compact('data', 'populer_interview'));
    }

    public function detail($id)
    {
        $data = Interview::findOrFail($id);
        $dialogs = Dialog::where('interview_id', $id)->get();
        $next_data = Interview::find($id + 1);
        $previous_data = Interview::find($id - 1);
        $other_interview = Interview::inRandomOrder()->get();
        return view('frontend.interview.detail', compact('data', 'dialogs', 'next_data', 'previous_data', 'other_interview'));
    }

    public function addComment(Request $request, $id)
    {
        $new = new InterviewComment();
        $new->full_name = $request->full_name;
        $new->email = $request->email;
        $new->comment = $request->comment;
        $new->post_id = $id;
        $new->save();
        Alert::success('Başarılı','Yorumunuz onaylandıktan sonra görünecektir.');
        return back();
    }
}
