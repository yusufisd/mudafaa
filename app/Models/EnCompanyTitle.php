<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnCompanyTitle extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function TitleIcon(){
        return Title_Icon::where('id',$this->icon_title_id)->first();
    }
}
