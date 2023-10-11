<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\CurrentNewsImport;
use App\Models\Comment;
use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\EnCurrentNews;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class CurrentNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CurrentNews::latest()->get();
        return view('backend.currentNews.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = Carbon::now();
        $categories = CurrentNewsCategory::where('status', 1)->orderBy('queue', 'asc')->get();
        $users = UserModel::latest()->get();
        return view('backend.currentNews.add', compact('now', 'categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'required',
                'mobil_image' => 'required',
                'activity_name_en' => 'required',
                'activity_summary_en' => 'required',
                'tinymce_activity_detail_en' => 'required',
                'activity_url_en' => 'required',
                'activity_seo_title_en' => 'required',
                'activity_seo_description_en' => 'required',
                'activity_seo_keywords_en' => 'required',
                'category' => 'required',
                'author' => 'required',
                'activity_on_location_tr' => 'required',
                'activity_name_tr' => 'required',
                'activity_summary_tr' => 'required',
                'tinymce_activity_detail_tr' => 'required',
                'activity_url_tr' => 'required',
                'activity_seo_title_tr' => 'required',
                'activity_seo_description_tr' => 'required',
                'activity_seo_keywords_tr' => 'required',
            ],
            [
                'image.required' => 'Görsel boş bırakılamaz',
                'mobil_image.required' => 'Hikaye görseli boş bırakılamaz',
                'activity_name_en' => 'Başlık (İNGİLİZCE) boş bırakılamaz',
                'activity_summary_en' => 'Kısa açıklama (İNGİLİZCE) boş bırakılamaz',
                'tinymce_activity_detail_en' => 'İçerik (İNGİLİZCE) boş bırakılamaz',
                'activity_url_en' => 'Link (İNGİLİZCE) boş bırakılamaz',
                'activity_seo_title_en' => 'Seo başlığı (İNGİLİZCE) boş bırakılamaz',
                'activity_seo_description_en' => 'Seo açıklaması (İNGİLİZCE) boş bırakılamaz',
                'activity_seo_keywords_en' => 'Seo anahtarı (İNGİLİZCE) boş bırakılamaz',
                'category' => 'Kategori boş bırakılamaz',
                'author' => 'Yazar boş bırakılamaz',
                'activity_on_location_tr' => 'Yayın tarihi boş bırakılamaz',
                'activity_name_tr' => 'Başlık (TÜRKÇE) boş bırakılamaz',
                'activity_summary_tr' => 'Kısa açıklama (TÜRKÇE) boş bırakılamaz',
                'tinymce_activity_detail_tr' => 'İçerik (TÜRKÇE) boş bırakılamaz',
                'activity_url_tr' => 'Link (TÜRKÇE) boş bırakılamaz',
                'activity_seo_title_tr' => 'Seo başlığı (TÜRKÇE) boş bırakılamaz',
                'activity_seo_description_tr' => 'Seo açıklaması (TÜRKÇE) boş bırakılamaz',
                'activity_seo_keywords_tr' => 'Seo anahtarı (TÜRKÇE) boş bırakılamaz',
            ],
        );

        $veri = json_decode(json_decode(json_encode($request->activity_seo_keywords_tr[0])));
        $merge = [];
        foreach ($veri as $v) {
            $merge[] = $v->value;
        }

        $veri_en = json_decode(json_decode(json_encode($request->activity_seo_keywords_en[0])));
        $merge_en = [];
        foreach ($veri_en as $v) {
            $merge_en[] = $v->value;
        }

        $read_time_tr = (int) round(str_word_count($request->tinymce_activity_detail_tr) / 200);
        $read_time_en = (int) round(str_word_count($request->tinymce_activity_detail_en) / 200);

        $news = new CurrentNews();
        $news->category_id = $request->category;
        $news->author_id = $request->author;
        $news->live_time = $request->activity_on_location_tr;
        $news->title = $request->activity_name_tr;
        $news->short_description = $request->activity_summary_tr;
        $news->description = $request->tinymce_activity_detail_tr;
        $news->read_time = $read_time_tr;
        $news->link = $request->activity_url_tr;
        $news->seo_title = $request->activity_seo_title_tr;
        $news->seo_description = $request->activity_seo_description_tr;
        $news->seo_key = $merge;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/currentNews/' . $image_name;
            Image::make($image)
                ->resize(960, 520)
                ->save($save_url);
            $news->image = $save_url;
        }
        if ($request->file('mobil_image') != null) {
            $image = $request->file('mobil_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/currentNews/' . $image_name;
            Image::make($image)
                ->resize(97, 123)
                ->save($save_url);
            $news->mobil_image = $save_url;
        }
        if (!isset($request->manset_tr)) {
            $news->headline = 0;
        }
        if (!isset($request->status_tr)) {
            $news->status = 0;
        }

        $news->save();

        $news_en = new EnCurrentNews();
        $news_en->author_id = $request->author;
        $news_en->category_id = $request->category;
        $news_en->title = $request->activity_name_en;
        $news_en->short_description = $request->activity_summary_en;
        $news_en->description = $request->tinymce_activity_detail_en;
        $news_en->read_time = $read_time_en;
        $news_en->currentNews_id = $news->id;
        $news_en->link = $request->activity_url_en;
        $news_en->seo_title = $request->activity_seo_title_en;
        $news_en->seo_description = $request->activity_seo_description_en;
        $news_en->seo_key = $merge_en;
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/currentNews/' . $image_name;
            Image::make($image)
                ->resize(960, 520)
                ->save($save_url);
            $news_en->image = $save_url;
        }
        if ($request->file('mobil_image') != null) {
            $image = $request->file('mobil_image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'assets/uploads/currentNews/' . $image_name;
            Image::make($image)
                ->resize(97, 123)
                ->save($save_url);
            $news_en->mobil_image = $save_url;
        }
        if (!isset($request->manset_en)) {
            $news_en->headline = 0;
        }
        if (!isset($request->status_en)) {
            $news_en->status = 0;
        }
        $news_en->save();

        logKayit(['Haber Yönetimi ', 'Haber eklendi']);
        Alert::success('Haber Başarıyla Eklendi');
        DB::commit();

        return redirect()->route('admin.currentNews.list');
    }

    public function edit($id)
    {
        $categories = CurrentNewsCategory::where('status', 1)->latest()->get();
        $users = UserModel::latest()->get();
        $data_tr = CurrentNews::findOrFail($id);
        $data_en = EnCurrentNews::where('currentNews_id', $id)->first();
        return view('backend.currentNews.edit', compact('data_tr', 'data_en', 'categories', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'activity_name_en' => 'required',
                'activity_summary_en' => 'required',
                'tinymce_activity_detail_en' => 'required',
                'activity_url_en' => 'required',
                'activity_seo_title_en' => 'required',
                'activity_seo_description_en' => 'required',
                'activity_seo_keywords_en' => 'required',
                'category' => 'required',
                'author' => 'required',
                'activity_on_location_tr' => 'required',
                'activity_name_tr' => 'required',
                'activity_summary_tr' => 'required',
                'tinymce_activity_detail_tr' => 'required',
                'activity_url_tr' => 'required',
                'activity_seo_title_tr' => 'required',
                'activity_seo_description_tr' => 'required',
                'activity_seo_keywords_tr' => 'required',
            ],
            [
                'activity_name_en' => 'Başlık (İNGİLİZCE) boş bırakılamaz',
                'activity_summary_en' => 'Kısa açıklama (İNGİLİZCE) boş bırakılamaz',
                'tinymce_activity_detail_en' => 'İçerik (İNGİLİZCE) boş bırakılamaz',
                'activity_url_en' => 'Link (İNGİLİZCE) boş bırakılamaz',
                'activity_seo_title_en' => 'Seo başlığı (İNGİLİZCE) boş bırakılamaz',
                'activity_seo_description_en' => 'Seo açıklaması (İNGİLİZCE) boş bırakılamaz',
                'activity_seo_keywords_en' => 'Seo anahtarı (İNGİLİZCE) boş bırakılamaz',
                'category' => 'Kategori boş bırakılamaz',
                'author' => 'Yazar boş bırakılamaz',
                'activity_on_location_tr' => 'Yayın tarihi boş bırakılamaz',
                'activity_name_tr' => 'Başlık (TÜRKÇE) boş bırakılamaz',
                'activity_summary_tr' => 'Kısa açıklama (TÜRKÇE) boş bırakılamaz',
                'tinymce_activity_detail_tr' => 'İçerik (TÜRKÇE) boş bırakılamaz',
                'activity_url_tr' => 'Link (TÜRKÇE) boş bırakılamaz',
                'activity_seo_title_tr' => 'Seo başlığı (TÜRKÇE) boş bırakılamaz',
                'activity_seo_description_tr' => 'Seo açıklaması (TÜRKÇE) boş bırakılamaz',
                'activity_seo_keywords_tr' => 'Seo anahtarı (TÜRKÇE) boş bırakılamaz',
            ],
        );
        try {
            DB::beginTransaction();

            $veri = json_decode(json_decode(json_encode($request->activity_seo_keywords_tr[0])));
            $merge = [];
            foreach ($veri as $v) {
                $merge[] = $v->value;
            }

            $veri_en = json_decode(json_decode(json_encode($request->activity_seo_keywords_en[0])));
            $merge_en = [];
            foreach ($veri_en as $v) {
                $merge_en[] = $v->value;
            }

            $read_time_tr = (int) round(str_word_count($request->tinymce_activity_detail_tr) / 200);
            $read_time_en = (int) round(str_word_count($request->tinymce_activity_detail_en) / 200);

            $news = CurrentNews::findOrFail($id);

            $news->category_id = $request->category;
            $news->author_id = $request->author;
            $news->live_time = $request->activity_on_location_tr;
            $news->title = $request->activity_name_tr;
            $news->short_description = $request->activity_summary_tr;
            $news->description = $request->tinymce_activity_detail_tr;
            $news->read_time = $read_time_tr;
            $news->link = $request->activity_url_tr;
            $news->seo_title = $request->activity_seo_title_tr;
            $news->seo_description = $request->activity_seo_description_tr;
            $news->seo_key = $merge;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/currentNews/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $news->image = $save_url;
            }
            if ($request->file('mobil_image') != null) {
                $image = $request->file('mobil_image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/currentNews/' . $image_name;
                Image::make($image)
                    ->resize(97, 123)
                    ->save($save_url);
                $news->mobil_image = $save_url;
            }
            if (!isset($request->manset_tr)) {
                $news->headline = 0;
            }else{
                $news->headline = 1;
            }
            if (!isset($request->status_tr)) {
                $news->status = 0;
            }else{
                $news->status = 1;
            }

            $news->save();

            $news_en = EnCurrentNews::where('currentNews_id', $id)->first();
            $news_en->author_id = $request->author;
            $news_en->category_id = $request->category;
            $news_en->title = $request->activity_name_en;
            $news_en->short_description = $request->activity_summary_en;
            $news_en->description = $request->tinymce_activity_detail_en;
            $news_en->read_time = $read_time_en;
            $news_en->currentNews_id = $news->id;
            $news_en->link = $request->activity_url_en;
            $news_en->seo_title = $request->activity_seo_title_en;
            $news_en->seo_description = $request->activity_seo_description_en;
            $news_en->seo_key = $merge_en;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/currentNews/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $news_en->image = $save_url;
            }
            if ($request->file('mobil_image') != null) {
                $image = $request->file('mobil_image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/currentNews/' . $image_name;
                Image::make($image)
                    ->resize(97, 123)
                    ->save($save_url);
                $news_en->mobil_image = $save_url;
            }
            if (!isset($request->manset_en)) {
                $news_en->headline = 0;
            }else{
                $news_en->headline = 1;
            }
            if (!isset($request->status_en)) {
                $news_en->status = 0;
            }else{
                $news_en->status = 1;
            }
            $news_en->save();

            logKayit(['Haber Yönetimi ', 'Haber düzenlendi']);
            Alert::success('Haber Başarıyla Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Haber Yönetimi ', 'Haber düzenlemede hata', 0]);
            Alert::error('Haber Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.currentNews.list');
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = CurrentNews::findOrFail($id);
            EnCurrentNews::where('currentNews_id', $id)->delete();
            $data->delete();

            logKayit(['Haber Yönetimi ', 'Haber silindi']);
            Alert::success('Haber Başarıyla Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Haber Yönetimi ', 'Haber silmede hata', 0]);
            Alert::error('Haber Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.currentNews.list');
    }

    public function change_headline($id)
    {
        try {
            DB::beginTransaction();
            $data = CurrentNews::findOrFail($id);
            $data->headline = !$data->headline;
            $data->save();

            logKayit(['Haber Yönetimi ', 'Manşet durumu değiştirildi']);
            Alert::success('Haber Manşet Durumu Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Haber Yönetimi ', 'Manşet durumu değiştirilemedi', 0]);
            Alert::error('Manşet değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.currentNews.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = CurrentNews::findOrFail($id);
            $data->status = !$data->status;
            $data->save();

            logKayit(['Haber Yönetimi ', 'Haber durumu değiştirildi']);
            Alert::success('Haber Durumu Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Haber Yönetimi ', 'Haber durumu değiştirilemedi', 0]);
            Alert::error('Haber durum değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hatayla karşılaşıldı.',
            ]);
        }
        return redirect()->route('admin.currentNews.list');
    }

    public function commentList($id)
    {
        $data = Comment::where('post_id', $id)->get();
        return view('backend.currentNews.comments.list', compact('data'));
    }

    public function changeCommentStatus($id)
    {
        $data = Comment::findOrFail($id);
        $data->update([
            'status' => !$data->status,
        ]);
        Alert::success('Yorum Statüsü Değiştirildi');
        return redirect()->back();
    }

    public function commentDestroy($id)
    {
        $data = Comment::findOrFail($id);
        $data->delete();
        Alert::success('Yorum Silindi');
        return redirect()->back();
    }

    public function ice_aktar(Request $request)
    {
        Excel::import(new CurrentNewsImport(), $request->file('ice_aktar')->store('temp'));

        Alert::success('Başarılı');
        return back();
    }
}
