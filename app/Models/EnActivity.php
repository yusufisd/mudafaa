<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnActivity extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        "start_time" => 'datetime'
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

   

}
