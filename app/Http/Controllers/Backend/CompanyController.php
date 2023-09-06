<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\EnCompany;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Company::orderBy('name', 'asc')->get();
        return view('backend.company.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.company.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name_tr' => 'required',
                'name_en' => 'required',
                'image' => 'required',
            ]);
            $com = new Company();
            $com->name = $request->name_tr;
            if ($request->file('image') != null) {
                $image = $request->file('image');
                $image_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $save_url = 'assets/uploads/company/' . $image_name;
                Image::make($image)->resize(300, 300)->save($save_url);
                $com->image = $save_url;
            }
            $com->save();

            $com_en = new EnCompany();
            $com_en->name = $request->name_en;
            $com_en->company_id = $com->id;
            $com_en->save();

            logKayit(['Firma Yönetimi ', 'Firma eklendi']);
            Alert::success('Firma Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Firma Yönetimi ', 'Firma eklemede hata', 0]);
            Alert::error('Firma Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.company.list');
    }

    public function edit($id)
    {
        $data_tr = Company::findOrFail($id);
        $data_en = Company::findOrFail($id);
        return view('backend.company.edit', compact('data_tr', 'data_en'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'name' => 'required',
            ]);
            Company::where('id', $id)->update([
                "name" => $request->name
            ]);
            logKayit(['Firma Yönetimi ', 'Firma düzenlendi']);
            Alert::success('Firma Başarıyla Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Firma Yönetimi ', 'Firma düzenlemede hata', 0]);
            Alert::error('Firma Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.company.list');
    }


    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = Company::findOrFail($id);
            $data->delete();
            logKayit(['Firma Yönetimi ', 'Firma silindi']);
            Alert::success('Firma Başarıyla Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Firma Yönetimi ', 'Firma silmede hata', 0]);
            Alert::error('Firma Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.company.list');
    }
}
