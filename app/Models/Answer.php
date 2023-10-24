<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function katilim()
    {
        $soru = Anket::where('id', $this->question_id)->first();
        $cevaplar = Answer::where('question_id', $soru->id)
            ->orderBy('id', 'asc')
            ->get();
        $katilim_sayisi = 0;
        foreach ($cevaplar as $cevap) {
            $adet = AnketPivot::where('answer_id', $cevap->id)->count();
            $katilim_sayisi += $adet;
        }
        if ($katilim_sayisi != 0) {
            $birincil_katilim = AnketPivot::where('answer_id', $this->id)->count();
            if ($birincil_katilim != 0) {
                $oran = $birincil_katilim * (100 / $katilim_sayisi);
            } else {
                $oran = 0;
            }
        } else {
            $oran = 0;
        }
        return $oran;
    }
}
