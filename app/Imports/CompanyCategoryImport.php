<?php

namespace App\Imports;

use App\Models\CompanyCategory;
use App\Models\EnCompanyCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class CompanyCategoryImport implements ToCollection, WithStartRow
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
                    $keys = $row[3];
                    $keys_tr = $row[4];

                    $tr = CompanyCategory::create([
                        'name' => $row[1],
                        'link' => Str::slug($row[1]),
                        'queue' => $row[0],
                        'seo_title' => $row[1],
                        'seo_description' => $row[1],
                        'seo_key' => $keys,
                        'image' => 'assets/uploads/companyCategory/firma-kategori/' . $row[6],
                    ]);

                    EnCompanyCategory::create([
                        'category_id' => $tr->id,
                        'name' => $row[2],
                        'link' => Str::slug($row[2]),
                        'queue' => $row[0],
                        'seo_title' => $row[2],
                        'seo_description' => $row[2],
                        'seo_key' => $keys_tr,
                        'image' => 'assets/uploads/companyCategory/firma-kategori/' . $row[6],
                    ]);
                }
            } else {
                break;
            }
        }
    }
}
