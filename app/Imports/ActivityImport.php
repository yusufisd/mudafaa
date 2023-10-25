<?php

namespace App\Imports;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\CountryList;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;


class ActivityImport implements ToCollection, WithStartRow
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

                    $link_tr_slug = Str::slug($row[0]);
                    $link_tr = ActivityCategory::where('link','like','%'.$link_tr_slug.'%')->first();
                    $country = CountryList::where('name','like','%'.$row[6].'%')->first();
                    $keys_tr = trim($row[16]);
                    dd($row[16]);

                    $activity = new Activity();
                    $activity->website = $row[1] ?? '';
                    $activity->ticket_link = $row[2] ?? '';
                    $activity->subscribe_form = $row[3] ?? '';
                    $activity->start_time = date("Y-m-d H:i:s", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->getTimestamp());
                    $activity->finish_time = date("Y-m-d H:i:s", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])->getTimestamp());
                    $activity->country_id = $country->id ?? '';
                    $activity->city = $row[7];
                    $activity->email = $row[8] ?? '';
                    $activity->phone = $row[9] ?? '';
                    $activity->title = $row[10];
                    $activity->short_description = $row[12];
                    $activity->description = $row[14];


                    
        
                }
            }
        }
    }
}
