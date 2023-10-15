<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnActivity extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function Category()
    {
        return $this->hasOne(ActivityCategory::class, 'id', 'category');
    }

    public function getKeys(){
        return explode(',', $this->seo_key);
    }

}
