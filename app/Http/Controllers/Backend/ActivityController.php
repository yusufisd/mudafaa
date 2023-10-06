<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;
use App\Models\ActivityCategory;
use App\Models\CountryList;
use App\Models\EnActivity;
use App\Models\EnActivityCategory;
use App\Models\UserModel;

class ActivityController extends Controller
{
    public function index()
    {
        $data = Activity::latest()->get();
        return view('backend.activity.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countrylist = CountryList::orderBy('id', 'asc')->get();
        $users = UserModel::latest()->get();
        $categories = ActivityCategory::latest()->get();
        if (ActivityCategory::latest()->first() == null) {
            $no = 1;
        } else {
            $no = ActivityCategory::orderBy('queue', 'desc')->first();
            $no = $no->queue + 1;
        }
        return view('backend.activity.add', compact('no', 'users', 'categories', 'countrylist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'category' => 'required',
                'author' => 'required',
                'website' => 'required',
                'ticket' => 'required',
                'user_form' => 'required',
                'start_date' => 'required',
                'finish_date' => 'required',
                'adres' => 'required',
                'map' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'name_tr' => 'required',
                'short_description_tr' => 'required',
                'description_tr' => 'required',
                'link_tr' => 'required',
                'name_en' => 'required',
                'country' => 'required',
                'city' => 'required',
                'short_description_en' => 'required',
                'description_en' => 'required',
                'link_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_description_en' => 'required',
                'seo_key_en' => 'required',
                'image' => 'required',
            ],
            [
                'category.required' => 'category required',
                'author.required' => 'author required',
                'website.required' => 'website required',
                'ticket.required' => 'ticket required',
                'user_form.required' => 'user_form required',
                'start_date.required' => 'start_date required',
                'finish_date.required' => 'finish_date required',
                'adres.required' => 'adres required',
                'map.required' => 'map required',
                'email.required' => 'email required',
                'phone.required' => 'phone required',
                'name_tr.required' => 'name_tr required',
                'short_description_tr.required' => 'short_description_tr required',
                'description_tr.required' => 'description_tr required',
                'link_tr.required' => 'link_tr required',
                'name_en.required' => 'name_en required',
                'country.required' => 'country required',
                'city.required' => 'city required',
                'short_description_en.required' => 'short_description_en required',
                'description_en.required' => 'description_en required',
                'link_en.required' => 'link_en required',
                'seo_title_tr.required' => 'seo_title_tr required',
                'seo_description_tr.required' => 'seo_description_tr required',
                'seo_key_tr.required' => 'seo_key_tr required',
                'seo_title_en.required' => 'seo_title_en required',
                'seo_description_en.required' => 'seo_description_en required',
                'seo_key_en.required' => 'seo_key_en required',
                'image.required' => 'image required',
            ],
        );
        try {
            DB::beginTransaction();

            $veri = json_decode(json_decode(json_encode($request->seo_key_tr[0])));
            $merge = [];
            foreach ($veri as $v) {
                $merge[] = $v->value;
            }

            $veri_en = json_decode(json_decode(json_encode($request->seo_key_en[0])));
            $merge_en = [];
            foreach ($veri_en as $v) {
                $merge_en[] = $v->value;
            }

            $new = new Activity();
            $new->category = $request->category;
            $new->author = $request->author;
            $new->website = $request->website;
            $new->ticket_link = $request->ticket;
            $new->subscribe_form = $request->user_form;
            $new->start_time = $request->start_date;
            $new->finish_time = $request->finish_date;
            $new->country_id = $request->country;
            $new->city = $request->city;
            $new->address = $request->adres;
            $new->phone = $request->phone;
            $new->email = $request->email;
            $new->map = $request->map;
            $new->website = $request->website;
            $new->title = $request->name_tr;
            $new->short_description = $request->short_description_tr;
            $new->description = $request->description_tr;
            $new->link = $request->link_tr;
            $new->seo_title = $request->seo_title_tr;
            $new->seo_description = $request->seo_description_tr;
            $new->seo_key = $merge;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/activity/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $new->image = $save_url;
            }
            if (!isset($request->status_tr)) {
                $new->status = 0;
            }
            $new->save();

            $new_en = new EnActivity();
            $new_en->title = $request->name_en;
            $new_en->category = $request->category;
            $new_en->author = $request->author;
            $new_en->short_description = $request->short_description_en;
            $new_en->description = $request->description_en;
            $new_en->link = $request->link_en;
            $new_en->seo_title = $request->seo_title_en;
            $new_en->seo_description = $request->seo_description_en;
            $new_en->seo_key = $merge_en;
            $new_en->activity_id = $new->id;

            $new_en->website = $request->website;
            $new_en->ticket_link = $request->ticket;
            $new_en->subscribe_form = $request->user_form;
            $new_en->start_time = $request->start_date;
            $new_en->finish_time = $request->finish_date;
            $new_en->country_id = $request->country;
            $new_en->city = $request->city;
            $new_en->address = $request->adres;
            $new_en->phone = $request->phone;
            $new_en->email = $request->email;
            $new_en->map = $request->map;
            $new_en->website = $request->website;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/activity/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $new_en->image = $save_url;
            }
            if (!isset($request->status_en)) {
                $new->status = 0;
            }
            $new_en->save();

            logKayit(['Etkinlik Yönetimi', 'Etkinlik başarıyla eklendi']);
            Alert::success('Etkinlik Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            logKayit(['Etkinlik Yönetimi', 'Etkinlik eklemede hata', 0]);
            Alert::error('Etkinlik Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.activity.list');
    }

    public function edit($id)
    {
        $countrylist = CountryList::orderBy('id', 'asc')->get();
        $users = UserModel::latest()->get();
        $categories = ActivityCategory::latest()->get();
        $data_tr = Activity::findOrFail($id);
        $data_en = EnActivity::where('activity_id', $id)->first();
        return view('backend.activity.edit', compact('data_tr', 'data_en', 'countrylist', 'users', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'category' => 'required',
                'author' => 'required',
                'website' => 'required',
                'ticket' => 'required',
                'user_form' => 'required',
                'start_date' => 'required',
                'finish_date' => 'required',
                'adres' => 'required',
                'map' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'name_tr' => 'required',
                'short_description_tr' => 'required',
                'description_tr' => 'required',
                'link_tr' => 'required',
                'name_en' => 'required',
                'country' => 'required',
                'city' => 'required',
                'short_description_en' => 'required',
                'description_en' => 'required',
                'link_en' => 'required',
                'seo_title_tr' => 'required',
                'seo_description_tr' => 'required',
                'seo_key_tr' => 'required',
                'seo_title_en' => 'required',
                'seo_description_en' => 'required',
                'seo_key_en' => 'required',
            ],
            [
                'category.required' => 'category required',
                'author.required' => 'author required',
                'website.required' => 'website required',
                'ticket.required' => 'ticket required',
                'user_form.required' => 'user_form required',
                'start_date.required' => 'start_date required',
                'finish_date.required' => 'finish_date required',
                'adres.required' => 'adres required',
                'map.required' => 'map required',
                'email.required' => 'email required',
                'phone.required' => 'phone required',
                'name_tr.required' => 'name_tr required',
                'short_description_tr.required' => 'short_description_tr required',
                'description_tr.required' => 'description_tr required',
                'link_tr.required' => 'link_tr required',
                'name_en.required' => 'name_en required',
                'country.required' => 'country required',
                'city.required' => 'city required',
                'short_description_en.required' => 'short_description_en required',
                'description_en.required' => 'description_en required',
                'link_en.required' => 'link_en required',
                'seo_title_tr.required' => 'seo_title_tr required',
                'seo_description_tr.required' => 'seo_description_tr required',
                'seo_key_tr.required' => 'seo_key_tr required',
                'seo_title_en.required' => 'seo_title_en required',
                'seo_description_en.required' => 'seo_description_en required',
                'seo_key_en.required' => 'seo_key_en required',
            ],
        );
        try {
            DB::beginTransaction();

            $veri = json_decode(json_decode(json_encode($request->seo_key_tr[0])));
            $merge = [];
            foreach ($veri as $v) {
                $merge[] = $v->value;
            }

            $veri_en = json_decode(json_decode(json_encode($request->seo_key_en[0])));
            $merge_en = [];
            foreach ($veri_en as $v) {
                $merge_en[] = $v->value;
            }

            $new = Activity::findOrFail($id);
            $new->category = $request->category;
            $new->author = $request->author;
            $new->website = $request->website;
            $new->ticket_link = $request->ticket;
            $new->subscribe_form = $request->user_form;
            $new->start_time = $request->start_date;
            $new->finish_time = $request->finish_date;
            $new->country_id = $request->country;
            $new->city = $request->city;
            $new->address = $request->adres;
            $new->phone = $request->phone;
            $new->email = $request->email;
            $new->map = $request->map;
            $new->website = $request->website;
            $new->title = $request->name_tr;
            $new->short_description = $request->short_description_tr;
            $new->description = $request->description_tr;
            $new->link = $request->link_tr;
            $new->seo_title = $request->seo_title_tr;
            $new->seo_description = $request->seo_description_tr;
            $new->seo_key = $merge;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/activity/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $new->image = $save_url;
            }
            if (!isset($request->status_tr)) {
                $new->status = 0;
            }
            $new->save();

            $new_en = EnActivity::where('activity_id',$id)->first();
            $new_en->title = $request->name_en;
            $new_en->category = $request->category;
            $new_en->author = $request->author;
            $new_en->short_description = $request->short_description_en;
            $new_en->description = $request->description_en;
            $new_en->link = $request->link_en;
            $new_en->seo_title = $request->seo_title_en;
            $new_en->seo_description = $request->seo_description_en;
            $new_en->seo_key = $merge_en;
            $new_en->activity_id = $new->id;

            $new_en->website = $request->website;
            $new_en->ticket_link = $request->ticket;
            $new_en->subscribe_form = $request->user_form;
            $new_en->start_time = $request->start_date;
            $new_en->finish_time = $request->finish_date;
            $new_en->country_id = $request->country;
            $new_en->city = $request->city;
            $new_en->address = $request->adres;
            $new_en->phone = $request->phone;
            $new_en->email = $request->email;
            $new_en->map = $request->map;
            $new_en->website = $request->website;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/activity/' . $image_name;
                Image::make($image)
                    ->resize(960, 520)
                    ->save($save_url);
                $new_en->image = $save_url;
            }
            if (!isset($request->status_en)) {
                $new->status = 0;
            }
            $new_en->save();

            logKayit(['Etkinlik Yönetimi', 'Etkinlik düzenlendi']);
            Alert::success('Etkinlik Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            logKayit(['Etkinlik Yönetimi', 'Etkinlik düzenlemede hata', 0]);
            Alert::error('Etkinlik Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Bir hata oluştu. Lütfen daha sonra tekrar deneyin.',
            ]);
        }
        return redirect()->route('admin.activity.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = Activity::findOrFail($id);
            
            EnActivity::where('activity_id', $id)->delete();
            $data->delete();

            logKayit(['Etkinlik Yönetimi', 'Etkinlik başarıyla silindi']);
            Alert::success('Etkinlik Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Etkinlik Yönetimi', 'Etkinlik silmede hata', 0]);
            Alert::error('Etkinlik Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.activity.list');
    }

    public function change_status($id)
    {
        try {
            DB::beginTransaction();
            $data = Activity::findOrFail($id);
            $data_en = EnActivity::where('activity_id', $id)->first();
            $data_en->status = !$data->status;
            $data_en->save();
            $data->status = !$data->status;
            $data->save();
            logKayit(['Etkinlik Yönetimi', 'Etkinlik durumu değiştirildi']);
            Alert::success('Durum Başarıyla Değiştirildi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Etkinlik Yönetimi', 'Etkinlik durumu değiştirmede hata', 0]);
            Alert::error('Durum Değiştirmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.activity.list');
    }
}
