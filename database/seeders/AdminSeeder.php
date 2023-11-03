<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Role;
use App\Models\UserModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $per = [
            'currentNewsCategory_add',
            'currentNewsCategory_edit',
            'currentNewsCategory_delete',
            'currentNewsCategory_list',
            'currentNews_add',
            'currentNews_edit',
            'currentNews_delete',
            'currentNews_list',
            'defenseIndustry_add',
            'defenseIndustry_edit',
            'defenseIndustry_delete',
            'defenseIndustry_list',
            'defenseIndustryCategory_add',
            'defenseIndustryCategory_edit',
            'defenseIndustryCategory_delete',
            'defenseIndustryCategory_list',
            'defenseIndustryContent_add',
            'defenseIndustryContent_edit',
            'defenseIndustryContent_delete',
            'defenseIndustryContent_list',
            'defenseIndustryCountry_add',
            'defenseIndustryCountry_edit',
            'defenseIndustryCountry_delete',
            'defenseIndustryCountry_list',
            'defenseIndustryCompany_add',
            'defenseIndustryCompany_edit',
            'defenseIndustryCompany_delete',
            'defenseIndustryCompany_list',
            'activityCategory_add',
            'activityCategory_list',
            'activityCategory_delete',
            'activityCategory_edit',
            'activity_add',
            'activity_list',
            'activity_delete',
            'activity_edit',
            'interview_add',
            'interview_edit',
            'interview_delete',
            'interview_list',
            'dictionary_add',
            'dictionary_edit',
            'dictionary_delete',
            'dictionary_list',
            'video_add',
            'video_edit',
            'video_delete',
            'video_list',
            'videoCategory_add',
            'videoCategory_edit',
            'videoCategory_delete',
            'videoCategory_list',
            'company_add',
            'company_edit',
            'company_delete',
            'company_list',
            'companyCategory_add',
            'companyCategory_edit',
            'companyCategory_delete',
            'companyCategory_list',
            'page_add',
            'page_edit',
            'page_delete',
            'page_list',
            'anket_add',
            'anket_edit',
            'anket_delete',
            'kunye_list',
            'kunye_add',
            'kunye_edit',
            'kunye_delete',
            'kunye_list',
        ];

        $role_name = 'ADMIN';

        $role = new Role();
        $role->name = $role_name;
        $role->permissions = $per;
        $role->save();

        $admin = new Admin();
        $admin->name = 'Süper';
        $admin->surname = 'Admin';
        $admin->email = 'admin@mudafaa.com';
        $admin->password = Hash::make('123123');
        $admin->role = 1;
        $admin->save();

        $user = new UserModel();
        $user->name = 'yusuf';
        $user->surname = 'damar';
        $user->phone = '5456110790';
        $user->description = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Molestias error itaque quas adipisci beatae possimus, quaerat temporibus mollitia non ex consectetur facere sed nobis sunt illum eos reiciendis! Obcaecati, praesentium?';
        $user->email = 'yusuf@gmail.com';
        $user->password = Hash::make('123123');
        $user->role = 1;
        $user->save();
    }
}
