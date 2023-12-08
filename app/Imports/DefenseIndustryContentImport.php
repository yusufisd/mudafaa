<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\CountryList;
use App\Models\DefenseIndustryCategory;
use App\Models\DefenseIndustryContent;
use App\Models\EnDefenseIndustryContent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class DefenseIndustryContentImport implements ToCollection, WithStartRow
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
                    $sub_cat_tr = DefenseIndustryCategory::where('link',Str::slug($row[4]))->first();
                    $countries = explode(',', $row[5]);
                    $liste = [];
                    foreach ($countries as $country) {
                        $data = CountryList::where('name', '%' . $country . '%')->first();
                        if ($data != null) {
                            array_push($liste, $data->id);
                        }
                    }

                    $mensei = explode(',', $row[6]);
                    $liste2 = [];
                    foreach ($mensei as $men) {
                        $data = CountryList::where('name', '%' . $men . '%')->first();
                        if ($data != null) {
                            array_push($liste2, $data->id);
                        }
                    }

                    $companies = explode(',', $row[7]);
                    $liste3 = [];
                    foreach ($companies as $company) {
                        $data = Company::where('title', '%' . $company . '%')->first();
                        if ($data != null) {
                            array_push($liste3, $data->id);
                        }
                    }

                    if($sub_cat_tr == null){
                        dd('k');
                        Alert::error('Kategorinin olduğundan emin olun');
                        return back();
                    }

                    $data = new DefenseIndustryContent();
                    $data->title = $row[0];
                    $data->image = 'assets/uploads/defenseIndustryContent/savunma-sanayi/' . $row[10];
                    $data->image = $row[12];
                    $data->category_id = $sub_cat_tr->id;
                    $data->defense_id = $sub_cat_tr->defense_id;
                    $data->link = Str::slug($row[0]);
                    $data->read_time = (int) round(str_word_count($row[6]) / 200);
                    $data->author = 1;
                    $data->countries = $liste;
                    $data->origin = $liste2;
                    $data->companies = $liste3;
                    $data->short_description = Str::words($row[0], 15, '...');
                    $data->description = $row[1];
                    $data->seo_title = $row[8];
                    $data->seo_description = $row[9];
                    $data->seo_key = $row[10];
                    $data->save();

                    $data_en = new EnDefenseIndustryContent();
                    $data_en->title = $row[0];
                    $data_en->image = 'assets/uploads/defenseIndustryContent/savunma-sanayi/' . $row[10];
                    $data_en->image = $row[12];
                    $data_en->category_id = $sub_cat_tr->id;
                    $data_en->defense_id = $sub_cat_tr->defense_id;
                    $data_en->link = Str::slug($row[0]);
                    $data_en->read_time = (int) round(str_word_count($row[6]) / 200);
                    $data_en->author = 1;
                    $data_en->countries = $liste;
                    $data_en->origin = $liste2;
                    $data_en->companies = $liste3;
                    $data_en->short_description = Str::words($row[0], 15, '...');
                    $data_en->description = $row[1];
                    $data_en->seo_title = $row[8];
                    $data_en->seo_description = $row[9];
                    $data_en->seo_key = $row[10];
                    $data_en->save();
                }
            }
        }
    }
}
