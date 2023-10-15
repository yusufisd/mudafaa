<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnCompanyCategory extends Model
{
    use HasFactory,SoftDeletes;
    protected $casts = [
        'seo_key' => 'array',
    ];
    protected $guarded = [];

    public function getKeys(){
        return explode(',', $this->seo_key);
    }
}
