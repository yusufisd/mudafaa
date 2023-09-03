<?php

use App\Models\LogModel;
use Illuminate\Support\Facades\Auth;

function logKayit($id)
{
    $auth = Auth::guard('admin')->user();
    $log = new LogModel();
    $log->title = $id[0];
    $log->description = $id[1];
    $log->user = $auth->name . " " . $auth->surname;
    if (isset($id[2])) {
        $log->success = 0;
    }
    $log->save();
}
