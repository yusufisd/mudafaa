<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentEmojiModel extends Model
{
    use HasFactory;
    protected $table = "content_emoji";
    protected $guarded = [];
}
