<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\CompanyModel;
use App\Models\CurrentNews;
use App\Models\DefenseIndustry;
use App\Models\DefenseIndustryContent;
use App\Models\Dictionary;
use App\Models\LoginLog;
use App\Models\LogModel;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentNewsCount = CurrentNews::where('status',1)->count();
        $defenseIndustryCount = DefenseIndustryContent::where('status',1)->count();
        $companyCount = CompanyModel::count();
        $videoCount = Video::where('status',1)->count();
        $activityCount = Activity::where('status',1)->count();
        $dictionaryCount = Dictionary::where('status',1)->count();
        $loginLogs = LoginLog::latest()->take(5)->get();
        $logs = LogModel::orderBy('id','desc')->get();
        $comments = Comment::latest()->get();
        return view('backend.index',compact('loginLogs','logs','comments','currentNewsCount','defenseIndustryCount','companyCount','dictionaryCount','videoCount','activityCount'));
    }

    public function unauthorizedPage(){
        return view('backend.unauthorized');
    }

    
}
