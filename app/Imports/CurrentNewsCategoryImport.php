<?php

namespace App\Imports;

use App\Models\CurrentNewsCategory;
use App\Models\EnCurrentNewsCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;


class CurrentNewsCategoryImport implements ToCollection, WithStartRow
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
                    $keys = ($row[3]);
                    $keys_tr = ($row[4]);

                    if(CurrentNewsCategory::where('link',Str::slug($row[1]))->first() != null){
                        continue;
                    }


                    $tr = CurrentNewsCategory::create([
                        'title' => $row[1],
                        'link' => Str::slug($row[1]),
                        'queue' => $row[0],
                        'seo_title' => $row[1],
                        'seo_description' => $row[1],
                        'seo_key' => $keys,
                        'image' => 'assets/uploads/currentNewsCategory/haber-kategori/'.$row[5],
                    ]);

                    EnCurrentNewsCategory::create([
                        'category_id' => $tr->id,
                        'title' => $row[2],
                        'link' => Str::slug($row[2]),
                        'queue' => $row[0],
                        'seo_title' => $row[2],
                        'seo_description' => $row[2],
                        'seo_key' => $keys_tr,
                        'image' => 'assets/uploads/currentNewsCategory/haber-kategori/'.$row[5],

                    ]);
                }
            } else {
                break;
            }
        }
    }
}
