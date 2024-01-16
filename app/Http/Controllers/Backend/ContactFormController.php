<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ContactFormController extends Controller
{
    public function index(){
        $data = ContactForm::latest()->get();
        return view('backend.contactForm.index',compact('data'));
    }

    public function delete($id){
        $data = ContactForm::findOrFail($id);
        $data->delete();
        Alert::success('Başarıyla Silindi');
        return redirect()->route('admin.contactForm.index');
    }
}
