<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
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
        $roles = Role::latest()->get();
        return view('backend.user.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "user_name" => "required",
            "user_surname" => "required",
            "user_email" => "required|email",
            "role" => "required",
            "user_password" => "required",
            "user_password_again" => "required|same:user_password",
        ],[
            "user_name.required" => "İsim boş bırakılamaz",
            "user_surname.required" => "Soyisim boş bırakılamaz",
            "user_email.required" => "Email boş bırakılamaz",
            "user_email.email" => "Email tipi doğru girilmelidir",
            "role.required" => "Kullanıcı grubu boş bırakılamaz",
            "user_password.required" => "Şifre boş bırakılamaz",
            "user_password_again.required" => "Şifre tekrarı boş bırakılamaz",
            "user_password_again.same" => "Şifreler eşleşmiyor",
        ]);
        try {
            DB::beginTransaction();
            $user = new UserModel();
            $user->name = $request->user_name;
            $user->surname = $request->user_surname;
            $user->phone = $request->user_no;
            $user->email = $request->user_email;
            $user->role = $request->role;
            $user->twitter = $request->twitter;
            $user->instagram = $request->instagram;
            $user->facebook = $request->facebook;
            $user->description = $request->description;
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

        $roles = Role::latest()->get();
        $data = UserModel::findOrFail($id);
        return view('backend.user.edit',compact('data','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            "user_name" => "required",
            "user_surname" => "required",
            "user_email" => "required|email",
            "role" => "required",
        ],[
            "user_name.required" => "İsim boş bırakılamaz",
            "user_surname.required" => "Soyisim boş bırakılamaz",
            "user_email.required" => "Email boş bırakılamaz",
            "user_email.email" => "Email tipi doğru girilmelidir",
            "role.required" => "Kullanıcı grubu boş bırakılamaz",
        ]);
        try {
            DB::beginTransaction();
            $user = UserModel::findOrFail($id);
            $user->name = $request->user_name;
            $user->surname = $request->user_surname;
            $user->phone = $request->user_no;
            $user->email = $request->user_email;
            $user->role = $request->role;
            $user->twitter = $request->twitter;
            $user->instagram = $request->instagram;
            $user->facebook = $request->facebook;
            $user->description = $request->description;
            $user->save();

            logKayit(['Kullanıcı İşlemi', 'Kullanıcı düzenlendi']);
            Alert::success('Kullanıcı Düzenlendi');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            logKayit(['Kullanıcı İşlemi', 'Kullanıcı düzenlemede hata', 0]);
            Alert::error('Kullanıcı Düzenlemede Hata');
            throw ValidationException::withMessages([
                'error' => 'Tüm alanların doldurulması zorunludur.'
            ]);
        }
        return redirect()->route('admin.user.list');
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
