<?php

namespace App\Imports;

use App\Models\EnInterview;
use App\Models\Interview;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;


class InterviewImport implements ToCollection, WithStartRow
{
    /**
     * @param Collection $collection
     */
    public function startRow(): int
    {
        return 2;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row[0] != null) {
                if ($row->filter()->isNotEmpty()) {

                    $slug_tr = Str::slug($row[0]);
                    $slug_en = Str::slug($row[1]);

                    $read_time_tr = (int)(round((str_word_count($row[4]))/200));
                    $read_time_en = (int)(round((str_word_count($row[5]))/200));

                    $keys_tr = trim($row[38]);
                    $keys_en = trim($row[39]);


                    $interview = new Interview();
                    $interview->author = 1;
                    $interview->title = $row[0];
                    $interview->short_description = $row[2];
                    $interview->description = $row[4];
                    $interview->seo_title = $row[0];
                    $interview->seo_description = $row[2];
                    $interview->seo_key = $keys_tr;
                    $interview->read_time = $read_time_tr;
                    $interview->link = $slug_tr;
                    $interview->live_time = date('Y-m-d', strtotime($row[40]));
                    $interview->image = 'assets/uploads/interview/roportaj/'.$row[41];
                    $interview->save();


                    $interview_en = new EnInterview();
                    $interview_en->author = 1;
                    $interview_en->title = $row[1];
                    $interview_en->short_description = $row[3];
                    $interview_en->description = $row[5];
                    $interview_en->seo_title = $row[1];
                    $interview_en->seo_description = $row[3];
                    $interview_en->seo_key = $keys_en;
                    $interview_en->read_time = $read_time_en;
                    $interview_en->link = $slug_en;
                    $interview_en->interview_id = $interview->id;
                    $interview_en->live_time = date('Y-m-d', strtotime($row[40]));
                    $interview_en->image = 'assets/uploads/interview/roportaj/'.$row[41];
                    $interview_en->save();



                }
            }
        }
    }
}
