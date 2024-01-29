<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class SubscribersController extends Controller
{
    public function subscribe(Request $request)
    {
        try {
            DB::beginTransaction();
            $request->validate(
                [
                    'email' => 'required|max:30',
                    'accept' => 'required',
                    'g-recaptcha-response' => 'required',
                ],
                [
                    'email.required' => 'E-mail boş bırakılamaz',
                    'email.max' => 'E-mail maksimum 30 karakter olmalıdır',
                    'accept.required' => 'Kullanım koşulları onaylanmalıdır',
                    'g-recaptcha-response.required' => 'Robot olmadığınızı onaylayın',
                ],
            );

            $new = new Subscriber();
            $new->email = $request->email;
            $new->save();

            Alert::success('Abone Olundu');
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Alert::error('Robot olmadığınızı onaylayın');
        }
        return back();

    }

    public function inActiveSubscribe($email)
    {
        $data = Subscriber::where('email', $email)->first();

        if ($data != null) {
            $data->status = 0;
            $data->save();
        }
        Alert::success('Abonelik İptal Edildi');
        return redirect()->route('front.home');
    }
}
