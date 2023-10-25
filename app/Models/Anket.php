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

    public function isVoted(){
        $ip = 0;
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return AnketPivot::where('ip', $ip)->where('question_id', $this->id)->first();
    }
}
