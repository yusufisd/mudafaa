<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnActivity extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        "start_time" => 'datetime',
        "finish_time" => 'datetime',
    ];

    public function Category()
    {
        $local = \Session::get('applocale');
        if ($local == null) {
            $local = config('app.fallback_locale');
        }

        if ($local == 'tr') {
            return $this->hasOne(ActivityCategory::class, 'id', 'category');
        } elseif ($local == 'en') {
            return $this->hasOne(EnActivityCategory::class, 'id', 'category');
        }
    }

    public function getKeys(){
        return explode(',', $this->seo_key);
    }

    

    public function Country()
    {
        return $this->hasOne(CountryList::class, 'id', 'country_id');
    }

    public function Author(){
        return $this->hasOne(UserModel::class,'id','author');
    }

    public function sayac_yil()
    {
        $now = Carbon::now();
        $say = Carbon::parse($this->start_time->format('Y-m-d'));
        if ($say > $now) {
            $fark = date_diff($say, $now);

            if ($fark->y > 0) {
                return $fark->format('%y yıl');
            }
        }
    }

    public function sayac_ay()
    {
        $now = Carbon::now();
        $say = Carbon::parse($this->start_time->format('Y-m-d'));
        if ($say > $now) {
            $fark = date_diff($say, $now);
            if ($fark->m > 0) {
                return $fark->format('%m ay');
            }
        }
    }

    public function sayac_gun()
    {
        $now = Carbon::now();
        $say = Carbon::parse($this->start_time->format('Y-m-d'));
        if ($say > $now) {
            $fark = date_diff($say, $now);
            if ($fark->d > 0) {
                return $fark->format('%d gün');
            }
        }
    }

   

}
