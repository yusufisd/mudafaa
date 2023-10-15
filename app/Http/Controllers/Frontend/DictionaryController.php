<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use App\Models\EnDictionary;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function index(Request $request)
    {
        $letter = $request->id;
        $local = \Session::get('applocale') ?? config('app.fallback_locale');

        $alphabets = [
            "A",
            "B",
            "C-Ç",
            "D",
            "E",
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
            $local = \Session::get('applocale');
            if ($local == null) {
                $local = config('app.fallback_locale');
            }

            if ($local == 'tr') {
                $data = Dictionary::where('title', 'like', "%".$request->search."%")->paginate(6);
            } elseif ($local == 'en') {
                $data = EnDictionary::where('title', 'like', "%".$request->search."%")->paginate(6);
            }
        }else {
            if ($local == 'tr') {
                if ($letter != null) {
                    $data = Dictionary::where('title', 'LIKE', $letter . '%')->paginate(6);
                } else {
                    $data = Dictionary::orderBy('title','asc')->paginate(12);
                }
            } elseif ($local == 'en') {
                if ($letter != null) {
                    $data = EnDictionary::where('title', 'LIKE', $letter . '%')->paginate(6);
                } else {
                    $data = EnDictionary::orderBy('title','asc')->paginate(12);
                }
            }
        }
        return view('frontend.dictionary.list', compact('data', 'letter','alphabets'));
    }

    public function detail($id)
    {
        if (!$id) return abort(404);
        $local = \Session::get('applocale') ?? config('app.fallback_locale');
        if ($local == "tr"){
            $other = Dictionary::inRandomOrder()->paginate(6);
            $data = Dictionary::where('link', $id)->first();
            if (!$data) abort(404);
        }else{
            $other = EnDictionary::inRandomOrder()->paginate(6);
            $data = EnDictionary::where('link', $id)->first();
            if (!$data) abort(404);
        }


        return view('frontend.dictionary.detail', compact('data', 'other'));
    }

    public function searchPost(Request $request)
    {

        dd($request->all());
    }

    public function tag_list($title){

        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }
        if ($local == 'tr') {
            $data = Dictionary::where('seo_key', 'LIKE' , '%'.$title.'%')->get();
            
        } elseif ($local == 'en') {
            $data = EnDictionary::where('seo_key', 'LIKE' , '%'.$title.'%')->get();
        }


        return view('frontend.dictionary.tag_list',compact('data'));
    }
}
