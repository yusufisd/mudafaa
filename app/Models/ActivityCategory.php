<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
  

    public function getKeys(){
        return explode(',', $this->seo_key);
    }

    public function hasActivity(){
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }

        if ($local == 'tr') {
            $data = Activity::where('category',$this->id)->take(4)->get();

        } elseif ($local == 'en') {
            $data = EnActivity::where('category',$this->id)->take(4)->get();

        }
        return $data;
    }
}
