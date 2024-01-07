<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EnTopbar;
use App\Models\Topbar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class TopbarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $data = Topbar::latest()->get();
        return view('backend.topbar.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = Carbon::now();
        return view('backend.topbar.add', compact('now'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'start' => 'required',
                'finish' => 'required',
                'name_tr' => 'required',
                'name_en' => 'required',
                'color_code' => 'required',
            ],
            [
                'start.required' => 'Başlangıç tarihi boş bırakılamaz',
                'finish.required' => 'Bitiş tarihi boş bırakılamaz',
                'name_tr.required' => 'Başlık (TR) boş bırakılamaz',
                'name_en.required' => 'Başlık (EN) boş bırakılamaz',
                'color_code.required' => 'Arkaplan rengi boş bırakılamaz',
            ],
        );

        $data = new Topbar();
        $data->title = $request->name_tr;
        $data->color_code = $request->color_code;
        $data->start_time = $request->start;
        $data->finish_time = $request->finish;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/topbar/' . $image_name;
            Image::make($image)
                ->resize(50, 50)
                ->save($save_url);
            $data->image = $save_url;
        }
        $data->save();

        $data_en = new EnTopbar();
        $data_en->title = $request->name_en;
        $data_en->color_code = $request->color_code;
        $data_en->start_time = $request->start;
        $data_en->finish_time = $request->finish;
        $data_en->topbar_id = $data->id;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/topbar/' . $image_name;
            Image::make($image)
                ->resize(50, 50)
                ->save($save_url);
            $data_en->image = $save_url;
        }
        $data_en->save();

        Alert::success('Başarıyla Eklendi');
        return redirect()->route('admin.topbar.list');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data_tr = Topbar::findOrFail($id);
        $data_en = EnTopbar::where('topbar_id', $id)->first();
        return view('backend.topbar.edit', compact('data_tr', 'data_en'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'start' => 'required',
                'finish' => 'required',
                'name_tr' => 'required',
                'name_en' => 'required',
                'color_code' => 'required',
            ],
            [
                'start.required' => 'Başlangıç tarihi boş bırakılamaz',
                'finish.required' => 'Bitiş tarihi boş bırakılamaz',
                'name_tr.required' => 'Başlık (TR) boş bırakılamaz',
                'name_en.required' => 'Başlık (EN) boş bırakılamaz',
                'color_code.required' => 'Arkaplan rengi boş bırakılamaz',
            ],
        );

        $data = Topbar::find($id);
        $data->title = $request->name_tr;
        $data->color_code = $request->color_code;
        $data->start_time = $request->start;
        $data->finish_time = $request->finish;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/topbar/' . $image_name;
            Image::make($image)
                ->resize(50, 50)
                ->save($save_url);
            $data->image = $save_url;
        }
        $data->save();

        $data_en = EnTopbar::where('topbar_id', $id)->first();
        $data_en->title = $request->name_en;
        $data_en->color_code = $request->color_code;
        $data_en->start_time = $request->start;
        $data_en->finish_time = $request->finish;
        $data_en->topbar_id = $data->id;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/topbar/' . $image_name;
            Image::make($image)
                ->resize(50, 50)
                ->save($save_url);
            $data_en->image = $save_url;
        }
        $data_en->save();

        Alert::success('Güncelleme Başarılı');
        return redirect()->route('admin.topbar.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Topbar::findOrFail($id);
        $data_en = EnTopbar::where('topbar_id', $id)->first();
        if ($data != null) {
            $data->delete();
        }
        if ($data_en != null) {
            $data_en->delete();
        }
        Alert::success('Güncelleme Başarılı');
        return redirect()->route('admin.topbar.list');
    }

    public function imageDestroy($id)
    {
        $data = Topbar::findOrFail($id);
        $data_en = EnTopbar::where('topbar_id', $id)->first();
        if ($data != null) {
            $data->image = "";
            $data->save();
        }
        if ($data_en != null) {
            $data_en->image = "";
            $data_en->save();
        }
        Alert::success('Güncelleme Başarılı');
        return redirect()->route('admin.topbar.list');
    }
}
