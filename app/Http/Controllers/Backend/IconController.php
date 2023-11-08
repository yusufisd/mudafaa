<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanySubTitle;
use App\Models\CompanyTitle;
use App\Models\Icon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $data = Icon::latest()->get();
        return view('backend.companyIcon.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.companyIcon.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            "icon" => "required"
        ],[
            "icon.required" => "İcon boş bırakılamaz"
        ]);


        Icon::create([
            "icon" => $request->icon,
        ]);

        Alert::success('Başarıyla Eklendi');
        return redirect()->route('admin.companyIcon.list');
    }

    
    public function edit($id)
    {
        $data = Icon::findOrFail($id);
        return view('backend.companyIcon.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        $data = Icon::findOrFail($id);
        $data->icon = $request->icon;
        $data->save();

        Alert::success('Başarıyla Eklendi');
        return redirect()->route('admin.companyIcon.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Icon::find($id);
        $data->delete();

        Alert::success('Silme İşlemi Başarılı');
        return redirect()->route('admin.companyIcon.list');
    }
}
