<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Anket;
use App\Models\Answer;
use App\Models\EnAnket;
use App\Models\EnAnswer;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;


class AnketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $data = Anket::latest()->get();
        return view('backend.anket.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.anket.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $question_tr = new Anket();
        $question_tr->question = $request->question_tr;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/anket/' . $image_name;
            Image::make($image)
                ->resize(492, 340)
                ->save($save_url);
            $question_tr->image = $save_url;
        }
        $question_tr->save();


        $list = ['a','b','c','d','e'];
        foreach($list as $key){
            $answer = 'answer_tr_'.$key;
            if($request->is_true == $key){
                $is_true = 1;
            }else{
                $is_true = 0;
            }
            Answer::create([
                "answer" => $request->$answer,
                "is_true" => $is_true,
                "question_id" => $question_tr->id,
            ]);
        }

        $question_en = new EnAnket();
        $question_en->question = $request->question_en;
        $question_en->anket_id = $question_tr->id;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/anket/' . $image_name;
            Image::make($image)
                ->resize(492, 340)
                ->save($save_url);
            $question_en->image = $save_url;
        }
        $question_en->save();

        foreach($list as $key){
            $answer = 'answer_en_'.$key;
            if($request->is_true == $key){
                $is_true = 1;
            }else{
                $is_true = 0;
            }
            EnAnswer::create([
                "answer" => $request->$answer,
                "is_true" => $is_true,
                "question_id" => $question_en->id,
            ]);
        }

        Alert::success('Anket Başarıyla Eklendi');
        return redirect()->route('admin.anket.list');
    }

    
    public function edit($id)
    {
        $data_tr = Anket::findOrFail($id);
        $cevaplar_tr = Answer::where('question_id',$id)->orderBy('id','asc')->get();

        $data_en = EnAnket::where('anket_id',$id)->first();
        $cevaplar_en = EnAnswer::where('question_id',$data_en->id)->orderBy('id','asc')->get();
        return view('backend.anket.edit', compact('data_tr','data_en','cevaplar_tr','cevaplar_en'));
        
    }

    public function update(Request $request,$id)
    {
        $question_tr = Anket::findOrFail($id);
        $question_tr->question = $request->question_tr;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/anket/' . $image_name;
            Image::make($image)
                ->resize(492, 340)
                ->save($save_url);
            $question_tr->image = $save_url;
        }
        $question_tr->save();

        Answer::where('question_id',$id)->delete();


        $list = ['a','b','c','d','e'];
        foreach($list as $key){
            $answer = 'answer_tr_'.$key;
            if($request->is_true == $key){
                $is_true = 1;
            }else{
                $is_true = 0;
            }
            Answer::create([
                "answer" => $request->$answer,
                "is_true" => $is_true,
                "question_id" => $question_tr->id,
            ]);
        }

        $question_en = EnAnket::where('anket_id',$id)->first();
        $question_en->question = $request->question_en;
        $question_en->anket_id = $question_tr->id;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/anket/' . $image_name;
            Image::make($image)
                ->resize(492, 340)
                ->save($save_url);
            $question_en->image = $save_url;
        }
        $question_en->save();

        EnAnswer::where('question_id',$question_en->id)->delete();

        foreach($list as $key){
            $answer = 'answer_en_'.$key;
            if($request->is_true == $key){
                $is_true = 1;
            }else{
                $is_true = 0;
            }
            EnAnswer::create([
                "answer" => $request->$answer,
                "is_true" => $is_true,
                "question_id" => $question_en->id,
            ]);
        }

        Alert::success('Anket Başarıyla Düzenlendi');
        return redirect()->route('admin.anket.list');
    }

    public function destroy(string $id)
    {
        //
    }
}
