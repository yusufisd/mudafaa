<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reklam extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Adsense(){
        if (Reklam::where('alan_id',$this->alan_id)->first() != null){
            $data = Reklam::where('alan_id',$this->alan_id)->first();
            $data2 = AdsenseModel::where('id',$data->id)->first();
            return $data2;
        }else{
            return 0;
        }
    }
}
