<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

enum PostType : int
{
    case NEWS = 0;
    case DEFENSE_INDUSTRY = 1;
    case INTERVIEWS = 2;
    case VIDEOS = 3;
}
