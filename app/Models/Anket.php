<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anket extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cevaplar(){
        $data = Answer::where('question_id',$this->id)->orderBy('id','asc')->get();
        return $data;
    }
}
