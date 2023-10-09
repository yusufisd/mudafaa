<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\DefenseIndustryCategoryImport;
use App\Models\DefenseIndustry;
use App\Models\EnDefenseIndustry;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class DefenseIndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DefenseIndustry::orderBy('queue','asc')->get();
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
        return view('backend.defenseIndustry.add', compact('no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_tr' => 'required',
            'name_en' => 'required',
            'link_tr' => 'required',
            'link_en' => 'required',
            'queue' => 'required',
        ],[
            'name_tr.required' => 'Başlık (TR) boş bırakılamaz',
            'name_en.required' => 'Başlık (EN) boş bırakılamaz',
            'link_tr.required' => 'Link (TR) boş bırakılamaz',
            'link_en.required' => 'Link (EN) boş bırakılamaz',
            'queue.required' => 'Sıralama boş bırakılamaz',
        ]);
        try {
            DB::beginTransaction();
            
            $defense = DefenseIndustry::create([
                'title' => $request->name_tr,
                'queue' => $request->queue,
                'link' => $request->link_tr,
            ]);

            EnDefenseIndustry::create([
                'title' => $request->name_en,
                'link' => $request->link_en,
                'queue' => $request->queue,
                'defense_id' => $defense->id,
            ]);

            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi eklendi']);
            Alert::success('Savunma Sanayi Başarıyla Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi eklemede hata', 0]);
            Alert::error('Firma Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.defenseIndustry.list');
    }

    public function edit($id)
    {
        $data_tr = DefenseIndustry::findOrFail($id);
        $data_en = EnDefenseIndustry::where('defense_id', $id)->first();
        return view('backend.defenseIndustry.edit', compact('data_tr', 'data_en'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_tr' => 'required',
            'name_en' => 'required',
            'link_tr' => 'required',
            'link_en' => 'required',
            'queue' => 'required',
        ],[
            'name_tr.required' => 'Başlık (TR) boş bırakılamaz',
            'name_en.required' => 'Başlık (EN) boş bırakılamaz',
            'link_tr.required' => 'Link (TR) boş bırakılamaz',
            'link_en.required' => 'Link (EN) boş bırakılamaz',
            'queue.required' => 'Sıralama boş bırakılamaz',
        ]);
        try {
            DB::beginTransaction();
            
            $defense = DefenseIndustry::where('id', $id)->update([
                'title' => $request->name_tr,
                'queue' => $request->queue,
                'link' => $request->link_tr,
            ]);

            EnDefenseIndustry::where('defense_id', $id)->update([
                'title' => $request->name_en,
                'queue' => $request->queue,
                'link' => $request->link_en,
            ]);

            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi düzenlendi']);
            Alert::success('Savunma Sanayi Başarıyla Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi düzenlemede hata', 0]);
            Alert::error('Firma Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
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
            $data = DefenseIndustry::findOrFail($id);
            $son_id = DefenseIndustry::orderBy('queue', 'desc')->first()->queue;
            for ($i = $data->queue + 1; $i <= $son_id; $i++) {
                $item = DefenseIndustry::where('queue', $i)->first();
                $item->queue = $item->queue - 1;
                $item->save();
            }
            EnDefenseIndustry::where('defense_id', $id)->delete();
            $data->delete();
            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi silindi']);
            Alert::success('Savunma Sanayi Başarıyla Silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Savunma Sanayi Kategorisi ', 'Savunma sanayi kategorisi silmede hata', 0]);
            Alert::error('Firma Silmede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.',
            ]);
        }
        return redirect()->route('admin.defenseIndustry.list');
    }

    public function ice_aktar(Request $request){
        Excel::import(new DefenseIndustryCategoryImport, $request->file('ice_aktar')->store('temp'));

        Alert::success('Başarılı');
        return back();
    }
}
