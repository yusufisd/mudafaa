<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

enum EmojiType : int
{
    case LOVE = 0;
    case DISLIKE = 1;
    case CLAP = 2;
    case SAD = 3;
    case ANGRY = 4;
    case SHOCKED = 5;
}
