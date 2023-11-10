<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdsenseModel;
use Illuminate\Http\Request;
use Intervention\Image\Image;

class AdsenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $data = AdsenseModel::latest()->get();
        return view('backend.adsense.list',compact('data'));
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
        dd($request->all());

        $request->validate([
            "ad_name" => "required",
            "ad_url" => "required",
        ]);


        $data = new AdsenseModel();
        $data->title = $request->ad_name;
        $data->description = $request->ad_explanation;
        $data->type = $request->type;
        if($request->type == 0 ){
            $data->adsense_url = $request->ad_google_adsense_code;
        }if($data-> type == 1 ){
            $data->adsense_url = $request->ad_url;
        }if(isset($request->href_tab)){
            $data->href_tab = 1;
        }if ($request->file('image') != null) {
            $image = $request->file('image');
            $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = public_path('assets/uploads/anket/' . $image_name);
            Image::make($image)
                ->resize(492, 340)
                ->save($save_url);
            $data->image = $save_url;
        }
        $data->start = $request->start_time;
        $data->finish = $request->finish_time;
        


        
    }

    
    public function edit($id)
    {
        dd($id);
    }

   
    public function update(Request $request, $id)
    {
        dd($request->all());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        dd($id);
        
    }
}
