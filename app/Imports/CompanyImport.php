<?php

namespace App\Imports;

use App\Models\CompanyModel;
use App\Models\EnCompanyModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CompanyImport implements ToCollection, WithStartRow
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
                    dd($row[4]);

                    $company = new CompanyModel();
                    $company->title = $row[0];
                    $company->description = $row[5];




                    $company_en = new EnCompanyModel();
                    $company_en->description = $row[6];

                }
            } else {
                break;
            }
        }
    }
}
