<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnAbout extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'seo_key' => 'array',
    ];

    public function getKeys(){
        return explode(',', $this->seo_key);
    }
}
