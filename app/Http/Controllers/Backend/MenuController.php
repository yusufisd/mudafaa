<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\MenuModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
    public function edit(){
        $data = MenuModel::orderBy('menu_id','asc')->get();
        return view('backend.menu.edit',compact('data'));
    }


    public function ekle(){
        if(MenuModel::latest()->first() != null){
            return "başarılı2";
        }
        else{
            for($i = 1; $i<=7; $i++){
                MenuModel::create([
                    "menu_id" => $i
                ]);
            }
            return "başarılı";
        }
    }

    public function change_status($id)
    {
        $data = MenuModel::where('menu_id',$id)->first();
        $data->status = !$data->status;
        $data->save();

        Alert::success('Statü Başarıyla Değiştirildi');
        return redirect()->route('admin.menu.edit');
    }
}
