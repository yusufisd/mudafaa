<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'seo_key' => 'array',
    ];

    public function CategoryProduct()
    {
        $lang = session('applocale') ?? config('app.fallback_locale');
        if ($lang == 'tr') {
            $data = Video::where('category_id', $this->id)->get();
        } else {
            $data = Video::where('category_id', $this->id)->get();
        }
        return $data;
    }
}
