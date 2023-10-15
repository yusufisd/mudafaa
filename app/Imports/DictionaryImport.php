<?php

namespace App\Imports;

use App\Models\Dictionary;
use App\Models\EnDictionary;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class DictionaryImport implements ToCollection, WithStartRow
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
                    $read_time_tr = (int)round(str_word_count($row[2]) / 200);
                    $read_time_en = (int)round(str_word_count($row[3]) / 200);

                    $now = Carbon::now()->format('Y-m-d');
                    $link_tr = Str::slug($row[0]);
                    $link_en = Str::slug($row[1]);

                    $keys_tr = trim($row[4]);
                    $keys_en = trim($row[5]);

                    

                    $dict = new Dictionary();
                    $dict->title = $row[0];
                    $dict->description = $row[2];
                    $dict->link = $link_tr;
                    $dict->read_time = $read_time_tr;
                    $dict->seo_key = $keys_tr;
                    $dict->seo_title = $row[0];
                    $dict->seo_description = $row[0];
                    $dict->live_date = $now;
                    $dict->author = 1;
                    $dict->save();

                    $dict_en = new EnDictionary();
                    $dict_en->title = $row[1];
                    $dict_en->description = $row[3];
                    $dict_en->link = $link_en;
                    $dict_en->read_time = $read_time_en;
                    $dict_en->seo_key = $keys_en;
                    $dict_en->seo_title = $row[1];
                    $dict_en->seo_description = $row[1];
                    $dict_en->live_date = $now;
                    $dict_en->author = 1;
                    $dict_en->dictionary_id = $dict->id;
                    $dict_en->save();
                }
            }
        }
    }
}
