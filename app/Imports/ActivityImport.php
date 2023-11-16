<?php

namespace App\Imports;

use App\Models\Activity;
use App\Models\ActivityCategory;
use App\Models\CountryList;
use App\Models\EnActivity;
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

                    $link_tr = Str::slug($row[10]);
                    $link_en = Str::slug($row[11]);
                    $cat_tr_slug = Str::slug($row[0]);
                    $cat_tr = ActivityCategory::where('link','like','%'.$cat_tr_slug.'%')->first();
                    $country = CountryList::where('name','like','%'.$row[6].'%')->first();
                    $keys_tr = trim($row[16]);
                    $keys_en = trim($row[17]);

                    if($cat_tr == null){
                        continue;
                    }
                    if(Activity::where('link',$link_tr)->first() != null){
                        continue;
                    }
                    $activity = new Activity();
                    $activity->website = $row[1] ?? '';
                    $activity->ticket_link = $row[2] ?? '';
                    $activity->subscribe_form = $row[3] ?? '';
                    $activity->start_time = date("Y-m-d H:i:s", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->getTimestamp());
                    $activity->finish_time = date("Y-m-d H:i:s", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])->getTimestamp());
                    $activity->country_id = $country->id ?? '1';
                    $activity->city = $row[7];
                    $activity->email = $row[8] ?? '';
                    $activity->phone = $row[9] ?? '';
                    $activity->title = $row[10];
                    $activity->link = $link_tr;
                    $activity->start_clock = '09:00';
                    $activity->finish_clock = '21:00';
                    $activity->category = $cat_tr->id;
                    $activity->author = 1;
                    $activity->short_description = $row[12];
                    $activity->description = $row[14];
                    $activity->seo_title = $row[10];
                    $activity->seo_description = $row[12];
                    $activity->seo_key = $keys_tr;
                    $activity->save();

                    $activity_en = new EnActivity();
                    $activity_en->website = $row[1] ?? '';
                    $activity_en->ticket_link = $row[2] ?? '';
                    $activity_en->subscribe_form = $row[3] ?? '';
                    $activity_en->start_time = date("Y-m-d H:i:s", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->getTimestamp());
                    $activity_en->finish_time = date("Y-m-d H:i:s", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5])->getTimestamp());
                    $activity_en->country_id = $country->id ?? '1';
                    $activity_en->city = $row[7];
                    $activity_en->email = $row[8] ?? '';
                    $activity_en->phone = $row[9] ?? '';
                    $activity_en->title = $row[11];
                    $activity_en->link = $link_en;
                    $activity_en->start_clock = '09:00';
                    $activity_en->finish_clock = '21:00';
                    $activity_en->category = $cat_tr->id;
                    $activity_en->author = 1;
                    $activity_en->short_description = $row[13];
                    $activity_en->description = $row[15];
                    $activity_en->seo_title = $row[11];
                    $activity_en->seo_description = $row[13];
                    $activity_en->seo_key = $keys_en;
                    $activity_en->activity_id = $activity->id;
                    $activity_en->save();
                }
            }
        }
    }
}
