<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class ActivityCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
  

    public function getKeys(){
        return explode(',', $this->seo_key);
    }

    public function hasActivity(){
        $now = Carbon::now();

        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }

        if ($local == 'tr') {
            $data = Activity::where('category',$this->id)->where('status',1)->orderBy('start_time','desc')->take(6)->get();

        } elseif ($local == 'en') {
            $data = EnActivity::where('category',$this->id)->where('status',1)->orderBy('start_time','desc')->take(6)->get();

        }
        return $data;
    }
}
