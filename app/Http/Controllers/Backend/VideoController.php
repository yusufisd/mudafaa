<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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

class VideoController extends Controller
{
    public function index()
    {
        $data = CurrentNews::latest()->get();
        return view('backend.video.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $now = Carbon::now();
        $categories = CurrentNewsCategory::latest()->get();
        $users = UserModel::latest()->get();
        return view('backend.video.add', compact('now', 'categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.   
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'activity_name_en' => 'required',
                'activity_summary_en' => 'required',
                'tinymce_activity_detail_en' => 'required',
                'etiket_en' => 'required',
                'activity_url_en' => 'required',
                'activity_seo_title_en' => 'required',
                'activity_seo_description_en' => 'required',
                'activity_seo_keywords_en' => 'required',
                'category' => 'required',
                'author' => 'required',
                'activity_on_location_tr' => 'required',
                'activity_name_tr' => 'required',
                'etiket_tr' => 'required',
                'activity_summary_tr' => 'required',
                'tinymce_activity_detail_tr' => 'required',
                'etiket_tr' => 'required',
                'activity_url_tr' => 'required',
                'activity_seo_title_tr' => 'required',
                'activity_seo_description_tr' => 'required',
                'activity_seo_keywords_tr' => 'required',
            ]);


            $news = new CurrentNews();
            $news->category_id = $request->category;
            $news->author_id = $request->author;
            $news->live_time = $request->activity_on_location_tr;
            $news->title = $request->activity_name_tr;
            $news->tags = $request->etiket_tr;
            $news->short_description = $request->activity_summary_tr;
            $news->description = $request->tinymce_activity_detail_tr;
            $news->tags = $request->etiket_tr;
            $news->link = $request->activity_url_tr;
            $news->seo_title = $request->activity_seo_title_tr;
            $news->seo_description = $request->activity_seo_description_tr;
            $news->seo_key = $request->activity_seo_keywords_tr;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/currentNews/' . $image_name;
                Image::make($image)->resize(960, 520)->save($save_url);
                $news->image = $save_url;
            }
            if (!isset($request->manset_tr)) {
                $news->headline = 0;
            }
            if (!isset($request->status_tr)) {
                $news->status = 0;
            }
            if (!isset($request->seo_statu)) {
                $news->seo_statu = 0;
            }

            $news->save();

            $news_en = new EnCurrentNews();
            $news_en->title = $request->activity_name_en;
            $news_en->short_description = $request->activity_summary_en;
            $news_en->description = $request->tinymce_activity_detail_en;
            $news_en->tags = $request->etiket_en;
            $news_en->tags = $request->etiket_en;
            $news_en->currentNews_id = $news->id;
            $news_en->link = $request->activity_url_en;
            $news_en->seo_title = $request->activity_seo_title_en;
            $news_en->seo_description = $request->activity_seo_description_en;
            $news_en->seo_key = $request->activity_seo_keywords_en;
            if (!isset($request->seo_statu_en)) {
                $news_en->seo_statu = 0;
            }
            if (!isset($request->manset_en)) {
                $news_en->headline = 0;
            }
            if (!isset($request->status)) {
                $news_en->status = 0;
            }
            $news_en->save();

            logKayit(['Haber Yönetimi ', 'Haber eklendi']);
            Alert::success('Haber Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Haber Yönetimi ', 'Haber eklemede hata', 0]);
            Alert::error('Haber Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.currentNews.list');
    }


    public function edit($id)
    {
        $categories = CurrentNewsCategory::latest()->get();
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
        try {
            DB::beginTransaction();

            $request->validate([
                "category" => "required",
                "author" => "required",
                "activity_on_location_tr" => "required",
                "activity_name_tr" => "required",
                "etiket_tr" => "required",
                "activity_summary_tr" => "required",
                "tinymce_activity_detail_tr" => "required",
                "etiket_tr" => "required",
                "activity_url_tr" => "required",
                "activity_seo_title_tr" => "required",
                "activity_seo_description_tr" => "required",
                "activity_seo_keywords_tr" => "required",
            ]);

            $news = CurrentNews::findOrFail($id);

            $news->category_id = $request->category;
            $news->author_id = $request->author;
            $news->live_time = $request->activity_on_location_tr;
            $news->title = $request->activity_name_tr;
            $news->tags = $request->etiket_tr;
            $news->short_description = $request->activity_summary_tr;
            $news->description = $request->tinymce_activity_detail_tr;
            $news->tags = $request->etiket_tr;
            $news->link = $request->activity_url_tr;
            $news->seo_title = $request->activity_seo_title_tr;
            $news->seo_description = $request->activity_seo_description_tr;
            $news->seo_key = $request->activity_seo_keywords_tr;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/currentNews/' . $image_name;
                Image::make($image)->resize(960, 520)->save($save_url);
                $news->image = $save_url;
            }
            if (!isset($request->manset_tr)) {
                $news->headline = 0;
            }
            if (!isset($request->status_tr)) {
                $news->status = 0;
            }
            if (!isset($request->seo_statu)) {
                $news->seo_statu = 0;
            }

            $news->save();

            $news_en = EnCurrentNews::where('currentNews_id', $id)->first();
            $news_en->title = $request->activity_name_en;
            $news_en->short_description = $request->activity_summary_en;
            $news_en->description = $request->tinymce_activity_detail_en;
            $news_en->tags = $request->etiket_en;
            $news_en->currentNews_id = $news->id;
            $news_en->link = $request->activity_url_en;
            $news_en->seo_title = $request->activity_seo_title_en;
            $news_en->seo_description = $request->activity_seo_description_en;
            $news_en->seo_key = $request->activity_seo_keywords_en;
            if (!isset($request->seo_statu_en)) {
                $news_en->seo_statu = 0;
            }
            if (!isset($request->manset_en)) {
                $news_en->headline = 0;
            }
            if (!isset($request->status)) {
                $news_en->status = 0;
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
                'error' => 'Tüm alanların doldurulması zorunludur.'
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
                'error' => 'Bir hatayla karşılaşıldı.'
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
                'error' => 'Bir hatayla karşılaşıldı.'
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
                'error' => 'Bir hatayla karşılaşıldı.'
            ]);
        }
        return redirect()->route('admin.currentNews.list');
    }
}
