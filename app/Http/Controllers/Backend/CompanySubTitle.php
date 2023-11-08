<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CompanySubTitle as ModelsCompanySubTitle;
use App\Models\EnCompanySubTitle;
use App\Models\EnCompanyTitle;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CompanySubTitle extends Controller
{
    public function list()
    {
        $data = ModelsCompanySubTitle::latest()->get();
        return view('backend.companySubTitle.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.companySubTitle.add');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title_tr' => 'required',
                'title_en' => 'required',
            ],
            [
                'title_tr.required' => 'Başlık (TR) boş bırakılamaz',
                'title_en.required' => 'Başlık (EN) boş bırakılamaz',
            ],
        );

        $data = ModelsCompanySubTitle::create([
            'title' => $request->title_tr,
        ]);

        EnCompanySubTitle::create([
            'title' => $request->title_en,
            'sub_title_id' => $data->id,
        ]);

        Alert::success('Başarıyla Eklendi');
        return redirect()->route('admin.companySubTitle.list');
    }

    public function edit($id)
    {
        $data_tr = ModelsCompanySubTitle::findOrFail($id);
        $data_en = EnCompanySubTitle::where('sub_title_id', $id)->first();

        return view('backend.companySubTitle.edit', compact('data_tr','data_en'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title_tr' => 'required',
                'title_en' => 'required',
            ],
            [
                'title_tr.required' => 'Başlık (TR) boş bırakılamaz',
                'title_en.required' => 'Başlık (EN) boş bırakılamaz',
            ],
        );
        $data = ModelsCompanySubTitle::findOrFail($id);
        $data->title = $request->title_tr;
        $data->save();

        $data_en = EnCompanySubTitle::where('sub_title_id', $id)->first();
        $data_en->title = $request->title_en;
        $data_en->save();

        Alert::success('Başarıyla Eklendi');
        return redirect()->route('admin.companySubTitle.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = ModelsCompanySubTitle::find($id);
        $data_en = EnCompanySubTitle::where('sub_title_id', $id)->first();

        $data->delete();
        $data_en->delete();

        Alert::success('Silme İşlemi Başarılı');
        return redirect()->route('admin.companySubTitle.list');
    }
}
