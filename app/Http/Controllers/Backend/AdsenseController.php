<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdsenseModel;
use App\Models\Reklam;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class AdsenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $data = AdsenseModel::latest()->get();
        return view('backend.adsense.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.adsense.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'ad_name' => 'required',
                'ad_explanation' => 'required',
                'start_date' => 'required',
                'finish_date' => 'required',
            ],
            [
                'ad_name' => 'başlık boş bırakılamaz',
                'ad_explanation' => 'açıklama boş bırakılamaz',
                'start_date' => 'başlangıç tarihi boş bırakılamaz',
                'finish_date' => 'bitiş tarihi boş bırakılamaz',
            ],
        );

        $data = new AdsenseModel();
        $data->title = $request->ad_name;
        $data->description = $request->ad_explanation;
        $data->type = $request->type;
        $data->start = $request->start_date;
        $data->finish = $request->finish_date;

        if ($request->type == 0) {
            $data->adsense_url = $request->ad_google_adsense_code;
        }
        if ($data->type == 1) {
            $data->adsense_url = $request->ad_url;
        }
        if (isset($request->href_tab)) {
            $data->href_tab = 1;
        }
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/adsense/' . $image_name;
            Image::make($image)->save($save_url);
            $data->image = $save_url;
        }
        $data->save();

        if ($request->reklam != null) {
            foreach ($request->reklam as $reklam) {
                if (Reklam::where('alan_id', $reklam)->first() != null) {
                    Reklam::where('alan_id', $reklam)->update([
                        'reklam_id' => $data->id,
                    ]);
                } else {
                    Reklam::create([
                        'reklam_id' => $data->id,
                        'alan_id' => $reklam,
                    ]);
                }
            }
        }

        Alert::success('Reklam başarıyla eklendi');
        return redirect()->route('admin.adsense.list');
    }

    public function edit($id)
    {
        $data = AdsenseModel::findOrFail($id);
        return view('backend.adsense.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'ad_name' => 'required',
                'ad_explanation' => 'required',
                'start_date' => 'required',
                'finish_date' => 'required',
            ],
            [
                'ad_name' => 'başlık boş bırakılamaz',
                'ad_explanation' => 'açıklama boş bırakılamaz',
                'start_date' => 'başlangıç tarihi boş bırakılamaz',
                'finish_date' => 'bitiş tarihi boş bırakılamaz',
            ],
        );

        $data = AdsenseModel::find($id);
        $data->title = $request->ad_name;
        $data->description = $request->ad_explanation;
        $data->type = $request->type;
        $data->start = $request->start_date;
        $data->finish = $request->finish_date;

        if ($request->type == 0) {
            $data->adsense_url = $request->ad_google_adsense_code;
        }
        if ($data->type == 1) {
            $data->adsense_url = $request->ad_url;
        }
        if (isset($request->href_tab)) {
            $data->href_tab = 1;
        }
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = public_path('assets/uploads/anket/' . $image_name);
            Image::make($image)
                ->resize(492, 340)
                ->save($save_url);
            $data->image = $save_url;
        }
        $data->update();

        Reklam::where('reklam_id', $data->id)->delete();
        if ($request->reklam != null) {
            foreach ($request->reklam as $reklam) {
                if (Reklam::where('alan_id', $reklam)->first()) {
                    Reklam::where('alan_id', $reklam)->update([
                        'reklam_id' => $data->id,
                    ]);
                } else {
                    Reklam::create([
                        'reklam_id' => $data->id,
                        'alan_id' => $reklam,
                    ]);
                }
            }
        }

        Alert::success('Reklam başarıyla düzenlendi');
        return redirect()->route('admin.adsense.list');
    }

    public function destroy($id)
    {
        AdsenseModel::where('id', $id)->delete();
        Alert::success('Reklam Başarıyla Silindi');
        return redirect()->route('admin.adsense.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = AdsenseModel::findOrFail($id);
            $data->status = !$data->status;
            $data->save();

            logKayit(['Reklam Yönetimi', 'Reklam durumu değiştirildi']);
            Alert::success('Reklam Durumu Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Reklam Yönetimi ', 'Reklam durumu değiştirilemedi', 0]);
            Alert::error('Reklam durum değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.adsense.list');
    }
}
