<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use App\Models\EnDictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DictionaryController extends Controller
{
    public function index(Request $request)
    {
        $letter = $request->id;
        $local = Session::get('applocale') ?? config('app.fallback_locale');

        $alphabets = [
            "A",
            "B",
            "C-Ç",
            "D",
            "E",
            "F",
            "G - Ğ",
            "I - İ",
            "J",
            "K",
            "L",
            "M",
            "N",
            "O-Ö",
            "P",
            "R",
            "S-Ş",
            "T",
            "U-Ü",
            "V",
            "W",
            "Y",
            "Z"
        ];

        if (isset($request->search)){
            $local = Session::get('applocale');
            if ($local == null) {
                $local = config('app.fallback_locale');
            }

            if ($local == 'tr') {
                $data = Dictionary::where('status',1)->where('title', 'like', "%".$request->search."%")->paginate(18);
            } elseif ($local == 'en') {
                $data = EnDictionary::where('status',1)->where('title', 'like', "%".$request->search."%")->paginate(18);
            }
        }else {
            if ($local == 'tr') {
                if ($letter != null) {
                    $data = Dictionary::where('status',1)->where('title', 'LIKE', $letter . '%')->paginate(18);
                } else {
                    $data = Dictionary::where('status',1)->orderBy('id','desc')->paginate(18);
                }
            } elseif ($local == 'en') {
                if ($letter != null) {
                    $data = EnDictionary::where('status',1)->where('title', 'LIKE', $letter . '%')->paginate(18);
                } else {
                    $data = EnDictionary::where('status',1)->orderBy('id','desc')->paginate(18);
                }
            }
        }
        return view('frontend.dictionary.list', compact('data', 'letter','alphabets'));
    }

    public function detail($id)
    {
        if (!$id) return abort(404);
        $local = Session::get('applocale') ?? config('app.fallback_locale');

        if ($local == "tr"){

            $data = Dictionary::where('status',1)->where('link', $id)->first();
            if (!$data) return abort(404);
            $other = Dictionary::select('title','image','author','live_date','link')->where('status',1)->inRandomOrder()->take(8)->get();
            if (!$data) abort(404);
        }else{
            $data = EnDictionary::where('status',1)->where('link', $id)->first();
            if (!$data) return abort(404);
            $other = EnDictionary::select('title','image','author','live_date','link')->where('status',1)->inRandomOrder()->take(8)->get();
            if (!$data) abort(404);
        }


        return view('frontend.dictionary.detail', compact('data', 'other'));
    }

    public function searchPost(Request $request)
    {

        dd($request->all());
    }

    public function tag_list($title){
        $local = Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $data = Dictionary::where('status',1)->where('seo_key', 'LIKE' , '%'.$title.'%')->get();
        } elseif ($local == 'en') {
            $data = EnDictionary::where('status',1)->where('seo_key', 'LIKE' , '%'.$title.'%')->get();
        }
        return view('frontend.dictionary.tag_list',compact('data'));
    }
}
