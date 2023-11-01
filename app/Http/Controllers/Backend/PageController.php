<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EnPage;
use App\Models\Page;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;

class PageController extends Controller
{
    public function list()
    {
        $data = Page::latest()->get();
        return view('backend.page.list', compact('data'));
    }

    public function add()
    {
        return view('backend.page.add');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'queue' => 'required',
                'name_tr' => 'required',
                'description_tr' => 'required',
                'link_tr' => 'required',
                'name_en' => 'required',
                'description_en' => 'required',
                'link_en' => 'required',
            ],
            [
                'queue.required' => 'Sıralama boş bırakılamaz',
                'name_tr.required' => 'Başlık (TR) boş bırakılamaz',
                'description_tr.required' => 'İçerik (TR) boş bırakılamaz',
                'link_tr.required' => 'Link (TR) boş bırakılamaz',
                'name_en.required' => 'Başlık (EN) boş bırakılamaz',
                'description_en.required' => 'İçerik (EN) boş bırakılamaz',
                'link_en.required' => 'Link (EN) boş bırakılamaz',
            ],
        );

        $data = new Page();
        $data->queue = $request->queue;
        $data->title = $request->name_tr;
        $data->description = $request->description_tr;
        $data->link = $request->link_tr;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/pages/' . $image_name;
            Image::make($image)
                ->save($save_url);
            $data->image = $save_url;
        }
        if (!isset($request->status_tr)) {
            $data->status = 0;
        }
        $data->save();

        $data_en = new EnPage();
        $data_en->queue = $request->queue;
        $data_en->title = $request->name_en;
        $data_en->page_id = $data->id;
        $data_en->description = $request->description_en;
        $data_en->link = $request->link_en;
        if ($request->file('image_en') != null) {
            $image = $request->file('image_en');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/pages/' . $image_name;
            Image::make($image)
                ->save($save_url);
            $data_en->image = $save_url;
        }
        if (!isset($request->status_en)) {
            $data_en->status = 0;
        }
        $data_en->save();

        Alert::success('Sayfa Başarıyla Eklendi');
        return redirect()->route('admin.page.list');
    }

    public function edit($id)
    {
        $data_tr = Page::findOrFail($id);
        $data_en = EnPage::where('page_id', $id)->first();

        return view('backend.page.edit', compact('data_tr', 'data_en'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'queue' => 'required',
                'name_tr' => 'required',
                'description_tr' => 'required',
                'link_tr' => 'required',
                'name_en' => 'required',
                'description_en' => 'required',
                'link_en' => 'required',
            ],
            [
                'queue.required' => 'Sıralama boş bırakılamaz',
                'name_tr.required' => 'Başlık (TR) boş bırakılamaz',
                'description_tr.required' => 'İçerik (TR) boş bırakılamaz',
                'link_tr.required' => 'Link (TR) boş bırakılamaz',
                'name_en.required' => 'Başlık (EN) boş bırakılamaz',
                'description_en.required' => 'İçerik (EN) boş bırakılamaz',
                'link_en.required' => 'Link (EN) boş bırakılamaz',
            ],
        );

        $data = Page::findOrFail($id);
        $data->queue = $request->queue;
        $data->title = $request->name_tr;
        $data->description = $request->description_tr;
        $data->link = $request->link_tr;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/pages/' . $image_name;
            Image::make($image)
                ->save($save_url);
            $data->image = $save_url;
        }
        if (!isset($request->status_tr)) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->save();

        $data_en = EnPage::where('page_id', $id)->first();
        $data_en->queue = $request->queue;
        $data_en->title = $request->name_en;
        $data_en->page_id = $data->id;
        $data_en->description = $request->description_en;
        $data_en->link = $request->link_en;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/pages/' . $image_name;
            Image::make($image)
                ->save($save_url);
            $data_en->image = $save_url;
        }
        if (!isset($request->status_en)) {
            $data_en->status = 0;
        } else {
            $data_en->status = 1;
        }
        $data_en->save();

        Alert::success('Sayfa Başarıyla Düzenlendi');
        return redirect()->route('admin.page.list');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = Page::findOrFail($id);
            $son_id = Page::orderBy('queue', 'desc')->first()->queue;
            for ($i = $data->queue + 1; $i <= $son_id; $i++) {
                $item = Page::where('queue', $i)->first();
                $item->queue = $item->queue - 1;
                $item->save();
            }
            EnPage::where('page_id', $id)->delete();
            $data->delete();

            logKayit(['Sayfa Yönetimi', 'Sayfa silindi']);
            Alert::success('Sayfa Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Sayfa Yönetimi', 'Sayfa silmede hata', 0]);
            Alert::error('Sayfa Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.page.list');
    }
}
