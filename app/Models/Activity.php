<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'seo_key' => 'array',
        'start_time' => 'datetime'
    ];

    public function Category()
    {
        return $this->hasOne(ActivityCategory::class, 'id', 'category');
    }

    public function Country()
    {
        return $this->hasOne(CountryList::class, 'id', 'country_id');
    }

    public function Author(){
        return $this->hasOne(UserModel::class,'id','author');
    }


}
