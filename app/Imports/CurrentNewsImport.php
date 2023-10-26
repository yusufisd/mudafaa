<?php

namespace App\Imports;

use App\Models\CurrentNews;
use App\Models\CurrentNewsCategory;
use App\Models\EnCurrentNews;
use App\Models\EnCurrentNewsCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;


class CurrentNewsImport implements ToCollection, WithStartRow
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
            if ($row[0] != null && $row[2] != null) {
                if ($row->filter()->isNotEmpty()) {
                    $link_tr = Str::slug($row[2]);
                    $link_en = Str::slug($row[3]);

                    $keys_tr = trim($row[10]);
                    $keys_en = trim($row[11]);

                    $list = [];
                    $test = explode(',', $row[1]);
                    foreach ($test as $te) {
                        $link = Str::slug($te);
                        $cat = CurrentNewsCategory::where('link', 'like', '%' . $link . '%')->first();
                        if ($cat != null) {
                            array_push($list, $cat->id);
                        }
                    }

                    $slug_cat = Str::slug($row[1]);
                    $cat_tr = CurrentNewsCategory::where('link', 'like', '%' . $slug_cat . '%')->first();

                    $read_time_tr = (int) round(str_word_count($row[6]) / 200);
                    $read_time_en = (int) round(str_word_count($row[7]) / 200);

                    $news = new CurrentNews();
                    $news->category_id = $list;
                    $news->author_id = 1;
                    $news->live_time = date("Y-m-d H:i:s", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8])->getTimestamp());
                    $news->title = $row[2] ?? '-';
                    $news->read_time = $read_time_tr;
                    $news->short_description = $row[4] ?? '-';
                    $news->description = $row[6] ?? '-';
                    $news->link = $link_tr;
                    $news->image = 'assets/uploads/currentNews/haber-gorsel/' . $row[12];
                    $news->seo_title = $row[2];
                    $news->seo_description = trim($row[4]);
                    $news->seo_key = $keys_tr;
                    $news->save();

                    $news_en = new EnCurrentNews();
                    $news_en->category_id = $list;
                    $news_en->author_id = 1;
                    $news_en->currentNews_id = $news->id;
                    $news_en->title = $row[3];
                    $news_en->read_time = $read_time_en;
                    $news_en->short_description = $row[5];
                    $news_en->description = $row[7];
                    $news_en->link = $link_en;
                    $news_en->live_time = date("Y-m-d H:i:s", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8])->getTimestamp());
                    $news_en->image = 'assets/uploads/currentNews/haber-gorsel/' . $row[12];
                    $news_en->seo_title = $row[3];
                    $news_en->seo_description = trim($row[5]);
                    $news_en->seo_key = $keys_en;
                    $news_en->save();
                }
            }
        }
    }
}
