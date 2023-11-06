<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\LoginLog;
use App\Models\LogModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loginLogs = LoginLog::latest()->take(5)->get();
        $logs = LogModel::orderBy('id','desc')->get();
        $comments = Comment::latest()->get();
        return view('backend.index',compact('loginLogs','logs','comments'));
    }

    
}
