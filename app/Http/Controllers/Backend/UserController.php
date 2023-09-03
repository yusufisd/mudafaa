<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = UserModel::latest()->get();
        return view('backend.user.list', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.user.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                "user_name" => "required",
                "user_surname" => "required",
                "user_no" => "required",
                "user_email" => "required|email",
                "user_category" => "required",
                "user_password" => "required",
                "user_password_again" => "required|same:user_password",
            ]);

            $user = new UserModel();
            $user->name = $request->user_name;
            $user->surname = $request->user_surname;
            $user->phone = $request->user_no;
            $user->email = $request->user_email;
            $user->password = Hash::make($request->user_password);
            $user->save();

            logKayit(['Kullanıcı İşlemi', 'Yeni kullanıcı eklendi']);
            Alert::success('Kullanıcı Eklendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Kullanıcı İşlemi', 'Kullanıcı eklemede hata', 0]);
            Alert::error('Kullanıcı Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.user.list');
    }


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = UserModel::findOrFail($id);
            $data->delete();
            logKayit(['Kullanıcı İşlemi', 'Kullanıcı silindi']);
            Alert::success('Kullanıcı silindi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Kullanıcı İşlemi', 'Kullanıcı silmede hata', 0]);
            Alert::error('Kullanıcı Eklemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Böyle bir kullanıcı yok.'
            ]);
        }
        return redirect()->route('admin.user.list');
    }
}
