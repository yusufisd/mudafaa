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
            if ($row[0] != null) {
                if ($row->filter()->isNotEmpty()) {
                    $link_tr = Str::slug($row[2]);
                    $link_en = Str::slug($row[3]);

                    $keys_tr = explode(',', trim($row[10]));
                    $keys_en = explode(',', trim($row[11]));
                    
                    $slug_cat = Str::slug($row[1]);
                    $cat_tr = CurrentNewsCategory::where('link', 'like' , "%".$slug_cat."%" )->first();

                    $news = new CurrentNews();
                    $news->category_id = $cat_tr->id;
                    $news->author_id = 1;
                    $news->live_time = date('Y-m-d', strtotime($row[8]));
                    $news->title = $row[2];
                    $news->tags = $keys_tr;
                    $news->short_description = $row[4];
                    $news->description = implode('<br>',explode('\n',$row[6]));
                    $news->link = $link_tr;
                    $news->image = 'assets/uploads/currentNews/haber-gorsel/'.$row[12];
                    $news->seo_title = $row[2];
                    $news->seo_description = trim($row[4]);
                    $news->seo_key = $keys_tr;
                    $news->save();

                    $news_en = new EnCurrentNews();
                    $news_en->category_id = $cat_tr->id;
                    $news_en->author_id = 1;
                    $news_en->currentNews_id = $news->id;
                    $news_en->title = $row[3];
                    $news_en->tags = $keys_en;
                    $news_en->short_description = $row[5];
                    $news_en->description = $row[6];
                    $news_en->link = $link_en;
                    $news_en->image = 'assets/uploads/currentNews/haber-gorsel/'.$row[12];
                    $news_en->seo_title = $row[3];
                    $news_en->seo_description = trim($row[5]);
                    $news_en->seo_key = $keys_tr;
                    $news_en->save();

                    
                }
            }
        }
    }
}
