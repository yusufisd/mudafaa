<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurrentNewsCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $casts = [];

    public function adet(){
        return CurrentNews::where('status', 1)->where('category_id',$this->id)->count();
    }
    
    public function getKeys(){
        return explode(',', $this->seo_key);
    }
}
