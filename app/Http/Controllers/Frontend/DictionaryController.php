<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use App\Models\EnDictionary;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public function index()
    {
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }

        if ($local == 'tr') {
            if (request()->id != null) {
                if (request()->id == 0) {
                    $data = Dictionary::where('title', 'LIKE', 'A%')->paginate(6);
                }
                if (request()->id == 1) {
                    $data = Dictionary::where('title', 'LIKE', 'b%')->paginate(6);
                }
                if (request()->id == 2) {
                    $data = Dictionary::where('title', 'LIKE', 'C%')
                        ->where('title', 'LIKE', 'Ç%')
                        ->paginate(6);
                }
                if (request()->id == 3) {
                    $data = Dictionary::where('title', 'LIKE', 'd%')->paginate(6);
                }
                if (request()->id == 4) {
                    $data = Dictionary::where('title', 'LIKE', 'e%')->paginate(6);
                }
                if (request()->id == 5) {
                    $data = Dictionary::where('title', 'LIKE', 'f%')->paginate(6);
                }
                if (request()->id == 6) {
                    $data = Dictionary::where('title', 'LIKE', 'g%')->paginate(6);
                }
                if (request()->id == 7) {
                    $data = Dictionary::where('title', 'LIKE', 'h%')->paginate(6);
                }
                if (request()->id == 8) {
                    $data = Dictionary::where('title', 'LIKE', 'ı%')
                        ->where('title', 'LIKE', 'i%')
                        ->paginate(6);
                }
                if (request()->id == 9) {
                    $data = Dictionary::where('title', 'LIKE', 'j%')->paginate(6);
                }
                if (request()->id == 10) {
                    $data = Dictionary::where('title', 'LIKE', 'k%')->paginate(6);
                }
                if (request()->id == 11) {
                    $data = Dictionary::where('title', 'LIKE', 'l%')->paginate(6);
                }
                if (request()->id == 12) {
                    $data = Dictionary::where('title', 'LIKE', 'm%')->paginate(6);
                }
                if (request()->id == 13) {
                    $data = Dictionary::where('title', 'LIKE', 'n%')->paginate(6);
                }
                if (request()->id == 14) {
                    $data = Dictionary::where('title', 'LIKE', 'o%')
                        ->where('title', 'LIKE', 'ö%')
                        ->paginate(6);
                }
                if (request()->id == 15) {
                    $data = Dictionary::where('title', 'LIKE', 'p%')->paginate(6);
                }
                if (request()->id == 16) {
                    $data = Dictionary::where('title', 'LIKE', 'r%')->paginate(6);
                }
                if (request()->id == 17) {
                    $data = Dictionary::where('title', 'LIKE', 's%')
                        ->where('title', 'LIKE', 'ş%')
                        ->paginate(6);
                }
                if (request()->id == 18) {
                    $data = Dictionary::where('title', 'LIKE', 't%')->paginate(6);
                }
                if (request()->id == 19) {
                    $data = Dictionary::where('title', 'LIKE', 'u%')
                        ->where('title', 'LIKE', 'ü%')
                        ->paginate(6);
                }
                if (request()->id == 20) {
                    $data = Dictionary::where('title', 'LIKE', 'v%')->paginate(6);
                }
                if (request()->id == 21) {
                    $data = Dictionary::where('title', 'LIKE', 'y%')->paginate(6);
                }
                if (request()->id == 22) {
                    $data = Dictionary::where('title', 'LIKE', 'z%')->paginate(6);
                }
            } else {
                $data = Dictionary::latest()->paginate(6);
            }
        } elseif ($local == 'en') {
            if (request()->id != null) {
                if (request()->id == 1) {
                    $data = EnDictionary::where('title', 'LIKE', 'A%')->paginate(6);
                } else {
                    $data = EnDictionary::latest()->paginate(6);
                }
            } else {
                $data = EnDictionary::latest()->paginate(6);
            }
        }
        return view('frontend.dictionary.list', compact('data'));
    }

    public function detail($id)
    {
        $other = Dictionary::inRandomOrder()->paginate(6);
        $data = Dictionary::findOrFail($id);
        return view('frontend.dictionary.detail', compact('data', 'other'));
    }

    public function searchPost(Request $request)
    {
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }

        if ($local == 'tr') {
            $data = Dictionary::where('title', 'like', "%".$request->search."%")->paginate(6);
        } elseif ($local == 'en') {
            $data = EnDictionary::where('title', 'like', "%".$request->search."%")->paginate(6);
        }
        return view('frontend.dictionary.list', compact('data'));
        dd($request->all());
    }
}
