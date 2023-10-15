<?php

namespace App\Imports;

use App\Models\ActivityCategory;
use App\Models\EnActivityCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ActivityCategoryImport implements ToCollection, WithStartRow
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



                    $tr = ActivityCategory::create([
                        'title' => $row[1],
                        'link' => Str::slug($row[1]),
                        'queue' => $row[0],
                        'color_code' => $row[5],
                        'seo_title' => $row[1],
                        'seo_description' => $row[1],
                        'seo_key' => $keys,
                    ]);

                    EnActivityCategory::create([
                        'activity_id' => $tr->id,
                        'title' => $row[2],
                        'link' => Str::slug($row[2]),
                        'queue' => $row[0],
                        'color_code' => $row[5],
                        'seo_title' => $row[2],
                        'seo_description' => $row[2],
                        'seo_key' => $keys_tr,
                    ]);
                }
            } else {
                break;
            }
        }
    }
}
