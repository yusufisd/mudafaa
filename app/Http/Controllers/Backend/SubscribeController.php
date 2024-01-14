<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubscribeController extends Controller
{
    public function index(){
        $subscribers = Subscriber::latest()->get();
        return view('backend.subscribers.index',compact('subscribers'));
    }

    public function change_status($id){
        $data = Subscriber::findOrFail($id);
        $data->status = !$data->status;
        $data->save();

        Alert::success('Kullanıcı Durumu Değiştirildi');
        return back();
    }
}
