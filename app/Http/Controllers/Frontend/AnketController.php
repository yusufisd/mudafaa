<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Anket;
use App\Models\AnketPivot;
use App\Models\Answer;
use App\Models\EnAnket;
use App\Models\EnAnswer;
use Illuminate\Http\Request;

class AnketController extends Controller
{
    public function anketStore(Request $request)
    {
        $locale = session('applocale') ?? config('app.fallback_locale');
        if ($locale == "tr"){
            $check = Anket::find($request->question_id);
            $cevap = Answer::find($request->cevap);
            $cevaplar = Answer::where('question_id', $request->question_id)->get();
            $true_answer = Answer::where('question_id', $request->question_id)->where('is_true', 1)->first();
        }else{
            $check = EnAnket::find($request->question_id);
            $cevap = EnAnswer::find($request->cevap);
            $cevaplar = EnAnswer::where('question_id', $request->question_id)->get();
            $true_answer = EnAnswer::where('question_id', $request->question_id)->where('is_true', 1)->first();
        }

        if(!$check){
            return response()->json(["status" => "error", "message" => "Anket bulunamadı"]);
        }
        if (!$cevap){
            return response()->json(["status" => "error", "message" => "Cevap bulunumadı"]);
        }
        if (!$true_answer){
            return response()->json(["status" => "error", "message" => "Doğru cevap bulunumadı"]);
        }


        $ip = 0;
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $pivotCheck = AnketPivot::where('question_id', $request->question_id)
            ->where('ip', $ip)->first();

        
        

        if (!$pivotCheck){
            $pivot = AnketPivot::create([
                "question_id" => $request->question_id,
                "answer_id" => $cevap->id,
                "ip" => $ip,
            ]);

            // katılımlar tekrar hesaplanıyor
            $rate = [];
            foreach($cevaplar as $cevap){
                $rate[] = [ "id" => $cevap->id, "rate" => $cevap->katilim()];
            }

            return response()->json(["status" => "success", "true_answer" => $true_answer->id, 'rate' => $rate]);
        }

        return response()->json(["status" => "error", "message" => "zaten cevapladınız", 'rate' => $rate]);
    }
}
