<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\InterviewImport;
use App\Models\Dialog;
use App\Models\EnDialog;
use App\Models\Interview;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Models\EnInterview;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Interview::latest()->get();
        return view('backend.interview.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = UserModel::latest()->get();
        $now = Carbon::now();
        return view('backend.interview.add', compact('users','now'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'soran_tr' => 'required',
            'cevaplayan_tr' => 'required',
            'soru_tr' => 'required',
            'cevap_tr' => 'required',
            'soran_en' => 'required',
            'cevaplayan_en' => 'required',
            'soru_en' => 'required',
            'cevap_en' => 'required',
        ]);


        $veri = json_decode(json_decode(json_encode($request->seo_key_tr[0])));
        $merge = [];
        foreach ($veri as $v) {
            $merge[] = $v->value;
        }
        $merge = implode(',', $merge);


        $veri_en = json_decode(json_decode(json_encode($request->seo_key_en[0])));
        $merge_en = [];
        foreach ($veri_en as $v) {
            $merge_en[] = $v->value;
        }
        $merge_en = implode(',', $merge_en);


        $read_time_tr = (int)(round((str_word_count($request->description_tr))/200));
        $read_time_en = (int)(round((str_word_count($request->description_en))/200));


        $new_interview = new Interview();
        $new_interview->title = $request->name_tr;
        $new_interview->link = $request->link_tr;
        $new_interview->live_time = $request->live_time;
        $new_interview->youtube = $request->youtube;
        $new_interview->author = $request->author;
        $new_interview->read_time = $read_time_tr;
        $new_interview->short_description = $request->short_description_tr;
        $new_interview->description = $request->description_tr;
        $new_interview->seo_title = $request->seo_title_tr;
        $new_interview->seo_description = $request->seo_description_tr;
        $new_interview->seo_key = $merge;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/interview/' . $image_name;
            Image::make($image)
                ->resize(960, 520)
                ->save($save_url);
            $new_interview->image = $save_url;
        }
        if (!isset($request->status_tr)) {
            $new_interview->status = 0;
        }
        $new_interview->save();


        if(count($request->soran_tr) > 0) {
            for ($i = 0; $i < count($request->soran_tr); $i++) {
                $new_dialog = new Dialog();
                $new_dialog->soran = $request->soran_tr[$i];
                $new_dialog->cevaplayan = $request->cevaplayan_tr[$i];
                $new_dialog->soru = $request->soru_tr[$i];
                $new_dialog->cevap = $request->cevap_tr[$i];
                $new_dialog->interview_id = $new_interview->id;
                $new_dialog->save();
            }
        }



        $interview_en = new EnInterview();
        $interview_en->title = $request->name_en;
        $interview_en->author = $request->author;
        $interview_en->link = $request->link_en;
        $interview_en->read_time = $read_time_en;
        $interview_en->short_description = $request->short_description_en;
        $interview_en->description = $request->description_en;
        $interview_en->interview_id = $new_interview->id;
        $interview_en->seo_title = $request->seo_title_en;
        $interview_en->seo_description = $request->seo_description_en;
        $interview_en->seo_key = $merge_en;
        $interview_en->live_time = $request->live_time;

        if ($request->file('image') != null) {
            $interview_en->image = $save_url;
        }
        if (!isset($request->status_en)) {
            $interview_en->status = 0;
        }
        $interview_en->save();

        if(count($request->soran_en) > 0) {
            for ($i = 0; $i < count($request->soran_en); $i++) {
                $new_dialog_en = new EnDialog();
                $new_dialog_en->soran = $request->soran_en[$i];
                $new_dialog_en->cevaplayan = $request->cevaplayan_en[$i];
                $new_dialog_en->soru = $request->soru_en[$i];
                $new_dialog_en->cevap = $request->cevap_en[$i];
                $new_dialog_en->interview_id = $interview_en->id;
                $new_dialog_en->dialog_id = $new_dialog->id;
                $new_dialog_en->save();
            }
        }


        Alert::success('Röportaj eklendi');
        return redirect()->route('admin.interview.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $dialog_tr = Dialog::where('interview_id',$id)->get();
        $data_tr = Interview::findOrFail($id);
        $data_en = EnInterview::where('interview_id',$id)->first();
        $dialog_en = EnDialog::where('interview_id',$data_en->id)->get();
        $users = UserModel::latest()->get();
        $now = Carbon::now();
        return view('backend.interview.edit',compact('data_tr','data_en','users','now','dialog_tr','dialog_en'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $new_interview  = Interview::findOrFail($id);
        $interview_en   = EnInterview::findOrFail($request->enInt);

        $request->validate([

            'soran_tr' => 'required',
            'cevaplayan_tr' => 'required',
            'soru_tr' => 'required',
            'cevap_tr' => 'required',
            'soran_en' => 'required',
            'cevaplayan_en' => 'required',
            'soru_en' => 'required',
            'cevap_en' => 'required',
        ]);


        $veri = json_decode(json_decode(json_encode($request->seo_key_tr[0])));
        $merge = [];
        foreach ($veri as $v) {
            $merge[] = $v->value;
        }
        $merge = implode(',', $merge);


        $veri_en = json_decode(json_decode(json_encode($request->seo_key_en[0])));
        $merge_en = [];
        foreach ($veri_en as $v) {
            $merge_en[] = $v->value;
        }
        $merge_en = implode(',', $merge_en);

        $read_time_tr = (int)(round((str_word_count($request->description_tr))/200));
        $read_time_en = (int)(round((str_word_count($request->description_en))/200));


        $new_interview->title = $request->name_tr;
        $new_interview->link = $request->link_tr;
        $new_interview->live_time = $request->live_time;
        $new_interview->youtube = $request->youtube;
        $new_interview->author = $request->author;
        $new_interview->read_time = $read_time_tr;
        $new_interview->short_description = $request->short_description_tr;
        $new_interview->description = $request->description_tr;
        $new_interview->seo_title = $request->seo_title_tr;
        $new_interview->seo_description = $request->seo_description_tr;
        $new_interview->seo_key = $merge;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/interview/' . $image_name;
            Image::make($image)
                ->resize(960, 520)
                ->save($save_url);
            $new_interview->image = $save_url;
        }
        if (!isset($request->status_tr)) {
            $new_interview->status = 0;
        }
        $new_interview->save();


        if(count($request->soran_tr) > 0) {
            Dialog::where('interview_id', $id)->delete();
            for ($i = 0; $i < count($request->soran_tr); $i++) {
                $new_dialog = new Dialog();
                $new_dialog->soran = $request->soran_tr[$i];
                $new_dialog->cevaplayan = $request->cevaplayan_tr[$i];
                $new_dialog->soru = $request->soru_tr[$i];
                $new_dialog->cevap = $request->cevap_tr[$i];
                $new_dialog->interview_id = $new_interview->id;
                $new_dialog->save();
            }
        }

        $interview_en->title = $request->name_en;
        $interview_en->author = $request->author;
        $interview_en->link = $request->link_en;
        $interview_en->read_time = $read_time_en;
        $interview_en->short_description = $request->short_description_en;
        $interview_en->description = $request->description_en;
        $interview_en->interview_id = $new_interview->id;
        $interview_en->seo_title = $request->seo_title_en;
        $interview_en->seo_description = $request->seo_description_en;
        $interview_en->seo_key = $merge_en;
        $interview_en->live_time = $request->live_time;

        if ($request->file('image') != null) {
            $interview_en->image = $save_url;
        }
        if (!isset($request->status_en)) {
            $interview_en->status = 0;
        }
        $interview_en->save();

        if(count($request->soran_en) > 0) {
            EnDialog::where('interview_id', $request->enInt)->delete();
            for ($i = 0; $i < count($request->soran_en); $i++) {
                $new_dialog_en = new EnDialog();
                $new_dialog_en->soran = $request->soran_en[$i];
                $new_dialog_en->cevaplayan = $request->cevaplayan_en[$i];
                $new_dialog_en->soru = $request->soru_en[$i];
                $new_dialog_en->cevap = $request->cevap_en[$i];
                $new_dialog_en->interview_id = $interview_en->id;
                $new_dialog_en->dialog_id = $new_dialog->id;
                $new_dialog_en->save();
            }
        }

        Alert::success('Röportaj eklendi');
        return redirect()->route('admin.interview.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Interview::findOrFail($id);
        Dialog::where('interview_id',$id)->delete();
        $data->delete();
        Alert::success('Röportaj Silindi');
        return redirect()->route('admin.interview.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = Interview::findOrFail($id);
            $data->status = !$data->status;
            $data->save();

            logKayit(['Röportaj Yönetimi ', 'Röportaj durumu değiştirildi']);
            Alert::success('Röportaj Durumu Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Röportaj Yönetimi ', 'Röportaj durumu değiştirilemedi', 0]);
            Alert::error('Röportaj durum değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.'
            ]);
        }
        return redirect()->route('admin.interview.list');
    }

    public function ice_aktar(Request $request){
        Excel::import(new InterviewImport, $request->file('ice_aktar')->store('temp'));

        Alert::success('Başarılı');
        return back();
    }
}
