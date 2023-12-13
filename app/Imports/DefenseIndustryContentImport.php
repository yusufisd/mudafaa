<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\CompanyModel;
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

            if ($row[0] != null) {
                if ($row->filter()->isNotEmpty()) {
                    
                    $sub_cat_tr = DefenseIndustryCategory::where('link',Str::slug($row[4]))->first();
                    if($sub_cat_tr == null){
                        continue;
                    }

                    $liste = [];
                    if($row[5] != null){
                        $countries = explode(',', $row[5]);
                        foreach ($countries as $country) {
                            $data = CountryList::where('name','LIKE',$country)->first();
                            if ($data != null) {
                                array_push($liste, $data->id);
                            }
                        }
                    }

                    $liste2 = [];
                    if($row[6] != null){
                        $mensei = explode(',', $row[6]);
                        foreach ($mensei as $men) {
                            $data = CountryList::where('name',$men)->first();
                            if ($data != null) {
                                array_push($liste2, $data->id);
                            }
                        }
                    }

                    $liste3 = [];
                    if($row[7] != null){
                        $companies = explode(',', $row[7]);
                        foreach ($companies as $company) {
                            $data = Company::where('title','LIKE',$company)->first();
                            if ($data != null) {
                                array_push($liste3, $data->id);
                            }
                        }
                    }

                    

                    $data = new DefenseIndustryContent();
                    $data->title = $row[0];
                    $data->image = 'assets/uploads/defenceIndustryContent/savunma-sanayi/' . $row[12];
                    $data->category_id = $sub_cat_tr->id;
                    $data->defense_id = $sub_cat_tr->defense_id;
                    $data->link = Str::slug($row[0]);
                    $data->read_time = (int) round(str_word_count($row[6]) / 200);
                    $data->author = 1;
                    $data->live_time = date("Y-m-d H:i:s", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->getTimestamp());
                    $data->countries = $liste;
                    $data->origin = $liste2;
                    $data->companies = $liste3;
                    $data->short_description = Str::words($row[0], 15, '...');
                    $data->description = $row[1];
                    $data->seo_title = $row[8];
                    $data->seo_description = $row[9] ?? 'Seo açıklaması';
                    $data->seo_key = $row[10] ?? 'Seo';
                    $data->save();


                    $data_en = new EnDefenseIndustryContent();
                    $data_en->title = $row[0];
                    $data_en->image = 'assets/uploads/defenceIndustryContent/savunma-sanayi/' . $row[12];
                    $data_en->category_id = $sub_cat_tr->id;
                    $data_en->defense_id = $sub_cat_tr->defense_id;
                    $data_en->link = Str::slug($row[0]);
                    $data_en->read_time = (int) round(str_word_count($row[6]) / 200);
                    $data_en->author = 1;
                    $data_en->live_time = date("Y-m-d H:i:s", \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->getTimestamp());
                    $data_en->content_id = $data->id;
                    $data_en->countries = $liste;
                    $data_en->origin = $liste2;
                    $data_en->companies = $liste3;
                    $data_en->short_description = Str::words($row[0], 15, '...');
                    $data_en->description = $row[1];
                    $data_en->seo_title = $row[8];
                    $data_en->seo_description = $row[9] ?? 'Seo description';
                    $data_en->seo_key = $row[10] ?? 'Seo';
                    $data_en->save();

                }
            }else{
                continue;
            }
        }
    }
}
