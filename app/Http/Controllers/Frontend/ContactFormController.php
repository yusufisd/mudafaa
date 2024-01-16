<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactFormController extends Controller
{
    public function formPost(Request $request){

        $request->validate([
            "name" => "required|string|max:30",
            "email" => "required|email|max:30",
            "message" => "required|max:100",
            "phone" => "required|max:11|min:10",
        ],[
            "name.max" => "İsim en fazla 30 karakter içermeli",
            "name.string" => "İsim string tipinde olmalıdır",
            "name.required" => "İsim boş bırakılmamalı",
            "email.required" => "Email boş bırakılmamalı",
            "email.email" => "Email girdiğinize emin olun",
            "email.max" => "Email en fazla 30 karakter alabilir",
            "message.required" => "Mesaj boş bırakılamaz",
            "message.max" => "Mesaj maksimum 100 karakter içermelidir",
            "phone.required" => "Telefon boş bırakılmamalıdır",
            "phone.max" => "Telefon maksimum 11 karakter içermelidir",
            "phone.min" => "Telefon minimum 10 karakter içermelidir",

        ]);

        $data = new ContactForm();
        $data->fullname = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->message = $request->message;
        $data->save();

        Alert::success('Form Gönderildi');
        return back();
    }
}
