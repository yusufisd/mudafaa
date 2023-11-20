<?php

namespace App\Imports;

use App\Models\CompanyAddress;
use App\Models\CompanyCategory;
use App\Models\CompanyModel;
use App\Models\CompanyTitle;
use App\Models\EnCompanyAddress;
use App\Models\EnCompanyCategory;
use App\Models\EnCompanyModel;
use App\Models\EnCompanyTitle;
use App\Models\Title_Icon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;

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

                    $title_tr = Title_Icon::where('title_tr','Kuruluş Tarihi')->first();
                    $title_tr_2 = Title_Icon::where('title_tr','Genel Merkez')->first();
                    $title_tr_3 = Title_Icon::where('title_tr','Çalışan Sayısı')->first();
                    $cat_link = Str::slug($row[49]);
                    $cat = CompanyCategory::where('link',$cat_link)->first();
                    $def_cat = CompanyCategory::orderBy('id','asc')->first();
                    $def_cat_en = EnCompanyCategory::where('category_id',$def_cat->id)->first();

                    if($cat == null){
                        $cat_en = EnCompanyCategory::where('category_id',$def_cat->id)->first();
                    }else{
                        $cat_en = EnCompanyCategory::where('category_id',$cat->id)->first();
                    }
                    $link_tr = Str::slug($row[0]);
                    
                    $company = new CompanyModel();
                    $company->title = $row[0];
                    $company->description = $row[5] ?? 'Açıklama';
                    $company->category = $cat->id ?? $def_cat->id;
                    $company->image = 'assets/uploads/companyModel/firma-logolar/'.$row[48];
                    $company->seo_title = $row[0];
                    $company->seo_description = $row[0];
                    $company->seo_key = $row[0];
                    $company->link = $link_tr;
                    $company->save();

                    $company_en = new EnCompanyModel();
                    $company_en->title = $row[0];
                    $company_en->description = $row[6] ?? 'Description';
                    $company_en->company_id = $company->id;
                    $company_en->category = $cat_en->id ?? $def_cat_en->id;
                    $company_en->seo_title = $row[0];
                    $company_en->seo_description = $row[0];
                    $company_en->seo_key = $row[0];
                    $company_en->link = $link_tr;
                    $company_en->image = 'assets/uploads/companyModel/firma-logolar/'.$row[48];
                    $company_en->save();


                    $company_title = new CompanyTitle();
                    $company_title->icon_title_id = $title_tr->id;
                    $company_title->description = $row[1];
                    $company_title->company_id = $company->id;
                    $company_title->save();

                    $company_title_en = new EnCompanyTitle();
                    $company_title_en->icon_title_id = $title_tr->id;
                    $company_title_en->description = $row[1];
                    $company_title_en->company_id = $company->id;
                    $company_title_en->save();

                    $company_title2 = new CompanyTitle();
                    $company_title2->icon_title_id = $title_tr_2->id;
                    $company_title2->description = $row[2];
                    $company_title2->company_id = $company->id;
                    $company_title2->save();

                    $company_title2_en = new EnCompanyTitle();
                    $company_title2_en->icon_title_id = $title_tr_2->id;
                    $company_title2_en->description = $row[2];
                    $company_title2_en->company_id = $company->id;
                    $company_title2_en->save();

                    $company_title3 = new CompanyTitle();
                    $company_title3->icon_title_id = $title_tr_3->id;
                    $company_title3->description = $row[3];
                    $company_title3->company_id = $company->id;
                    $company_title3->save();

                    $company_title3_en = new EnCompanyTitle();
                    $company_title3_en->icon_title_id = $title_tr_3->id;
                    $company_title3_en->description = $row[3];
                    $company_title3_en->company_id = $company->id;
                    $company_title3_en->save();

                    $company_address = new CompanyAddress();
                    $company_address->title = $row[7] ?? 'Merkez';
                    $company_address->address = $row[9] ?? 'Adres';
                    $company_address->company_id = $company->id;
                    $company_address->phone = $row[11];
                    $company_address->email = $row[13];
                    $company_address->website = $row[47];
                    $company_address->save();


                    $company_address_en = new EnCompanyAddress();
                    $company_address_en->title = $row[8] ?? 'Center';
                    $company_address_en->address = $row[10] ?? 'Address';
                    $company_address_en->phone = $row[11];
                    $company_address_en->company_id = $company->id;
                    $company_address_en->email = $row[13];
                    $company_address_en->website = $row[47];
                    $company_address_en->save();


                    if($row[15] != null){
                        $company_address2 = new CompanyAddress();
                        $company_address2->title = $row[15];
                        $company_address2->address = $row[17];
                        $company_address2->phone = $row[19];
                        $company_address2->email = $row[21];
                        $company_address2->website = $row[47];
                        $company_address2->company_id = $company->id;
                        $company_address2->save();


                        $company_address_en2 = new EnCompanyAddress();
                        $company_address_en2->title = $row[16];
                        $company_address_en2->address = $row[18];
                        $company_address_en2->phone = $row[19];
                        $company_address_en2->email = $row[21];
                        $company_address_en2->website = $row[47];
                        $company_address_en2->company_id = $company->id;
                        $company_address_en2->save();

                    }



                }
            } else {
                break;
            }
        }
    }
}
