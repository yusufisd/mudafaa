<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AnketPivot;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnketController extends Controller
{
    public function anketStore($request)
    {
        $cevap = Answer::where('question_id',$request->question_id)->where('answer',$request->cevap)->first();
        $ip = 0;
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $pivot = AnketPivot::create([
            "question_id" => $request->question_id,
            "answer_id" => $cevap->id,
            "ip" => $ip,
        ]);

        return $pivot;
    }
}
