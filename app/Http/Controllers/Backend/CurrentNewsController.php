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
        $categories = CurrentNewsCategory::latest()->get();
        $users = UserModel::latest()->get();
        return view('backend.currentNews.add', compact('now', 'categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.   
     */
    public function store(Request $request)
    {
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

        Alert::success('Haber Başarıyla Eklendi');
        return redirect()->route('admin.currentNews.list');
    }


    public function edit($id)
    {
        $categories = CurrentNewsCategory::latest()->get();
        $users = UserModel::latest()->get();
        $data_tr = CurrentNews::findOrFail($id);
        $data_en = EnCurrentNews::where('currentNews_id',$id)->first();
        return view('backend.currentNews.edit',compact('data_tr','data_en','categories','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
