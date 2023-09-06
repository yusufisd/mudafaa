<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DefenseIndustry;
use App\Models\EnDefenseIndustry;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;

class DefenseIndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DefenseIndustry::latest()->get();
        return view('backend.defenseIndustry.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (DefenseIndustry::latest()->first() == null) {
            $no = 1;
        } else {
            $no = DefenseIndustry::orderBy('queue', 'desc')->first();
            $no = $no->queue + 1;
        }
        return view('backend.defenseIndustry.add',compact('no'));
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
                'link_tr' => 'required',
                'link_en' => 'required',
                'queue' => 'required',
            ]);
            $defense = DefenseIndustry::create([
                "title" => $request->name_tr,
                "queue" => $request->queue,
                "link" => $request->link_tr,
            ]);

            EnDefenseIndustry::create([
                "title" => $request->name_en,
                "link" => $request->link_en,
                "defense_id" => $defense->id,
            ]);

            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi eklendi']);
            Alert::success('Savunma Sanayi Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi eklemede hata', 0]);
            Alert::error('Firma Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.defenseIndustry.list');
    }


    public function edit($id)
    {
        $data_tr = DefenseIndustry::findOrFail($id);
        $data_en = EnDefenseIndustry::where('defense_id', $id)->first();
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
                'name_tr' => 'required',
                'name_en' => 'required',
                'link_tr' => 'required',
                'link_en' => 'required',
                'queue' => 'required',
            ]);
            $defense = DefenseIndustry::where('id', $id)->update([
                "title" => $request->name_tr,
                "queue" => $request->queue,
                "link" => $request->link_tr,
            ]);

            EnDefenseIndustry::where('defense_id', $id)->update([
                "title" => $request->name_en,
                "link" => $request->link_en,
            ]);

            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi düzenlendi']);
            Alert::success('Savunma Sanayi Başarıyla Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi düzenlemede hata', 0]);
            Alert::error('Firma Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.defenseIndustry.list');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $data = DefenseIndustry::findOrFail($id);
            $data->delete();
            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi silindi']);
            Alert::success('Savunma Sanayi Başarıyla Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi silmede hata', 0]);
            Alert::error('Firma Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.defenseIndustry.list');
    }
}
