<?php

namespace App\Imports;

use App\Models\DefenseIndustry;
use App\Models\DefenseIndustryCategory;
use App\Models\DefenseIndustryContent;
use App\Models\EnDefenseIndustry;
use App\Models\EnDefenseIndustryCategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

class DefenseIndustryCategoryImport implements ToCollection, WithStartRow
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
                    $defense_link_tr = Str::slug($row[1]);
                    $defense_link_en = Str::slug($row[2]);

                    $defense_cat_link_tr = Str::slug($row[3]);
                    $defense_cat_link_en = Str::slug($row[4]);

                    $last_defense = DefenseIndustry::orderBy('queue', 'desc')->first();
                    if ($last_defense != null) {
                        $queue_tr = $last_defense->queue + 1;
                    } else {
                        $queue_tr = 1;
                    }
                    $last_defense_en = EnDefenseIndustry::orderBy('queue', 'desc')->first();
                    if ($last_defense_en != null) {
                        $queue_en = $last_defense_en->queue + 1;
                    } else {
                        $queue_en = 1;
                    }

                    $last_def_cat = DefenseIndustryCategory::orderBy('queue', 'desc')->first();
                    if ($last_def_cat != null) {
                        $cat_queue_tr = $last_def_cat->queue + 1;
                    } else {
                        $cat_queue_tr = 1;
                    }
                    $last_def_cat_en = EnDefenseIndustryCategory::orderBy('queue', 'desc')->first();
                    if ($last_def_cat_en != null) {
                        $cat_queue_en = $last_def_cat_en->queue + 1;
                    } else {
                        $cat_queue_en = 1;
                    }

                    if (DefenseIndustry::where('title', $row[1])->first() == null) {
                        $new_defense = new DefenseIndustry();
                        $new_defense->title = $row[1];
                        $new_defense->link = $defense_link_tr;
                        $new_defense->queue = $queue_tr;
                        $new_defense->save();
                    }

                    if (EnDefenseIndustry::where('title', $row[2])->first() == null) {
                        $new_defense_en = new EnDefenseIndustry();
                        $new_defense_en->title = $row[2];
                        $new_defense_en->defense_id = $new_defense->id;
                        $new_defense_en->link = $defense_link_en;
                        $new_defense_en->queue = $queue_en;
                        $new_defense_en->save();
                    }

                    $def_id_tr = DefenseIndustry::where('link', $defense_link_tr)->first();
                    $def_id_en = EnDefenseIndustry::where('link', $defense_link_en)->first();

                    $new_defense_cat = new DefenseIndustryCategory();
                    $new_defense_cat->defense_id = $def_id_tr->id;
                    $new_defense_cat->title = $row[3];
                    $new_defense_cat->link = $defense_cat_link_tr;
                    $new_defense_cat->queue = $cat_queue_tr;
                    $new_defense_cat->seo_title = $row[3];
                    $new_defense_cat->seo_description = $row[3];
                    $new_defense_cat->seo_key = $row[3];
                    $new_defense_cat->save();


                    $new_defense_cat_en = new EnDefenseIndustryCategory();
                    $new_defense_cat_en->defense_id = $def_id_en->id;
                    $new_defense_cat_en->defense_category_id = $new_defense_cat->id;
                    $new_defense_cat_en->title = $row[4];
                    $new_defense_cat_en->link = $defense_cat_link_en;
                    $new_defense_cat_en->queue = $cat_queue_en;
                    $new_defense_cat_en->seo_title = $row[4];
                    $new_defense_cat_en->seo_description = $row[4];
                    $new_defense_cat_en->seo_key = $row[4];
                    $new_defense_cat_en->save();
                }
            } else {
                break;
            }
        }
    }
}
