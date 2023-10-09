<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function add()
    {
        return view('backend.role.add');
    }

    public function list()
    {
        $data = Role::latest()->get();
        return view('backend.role.list',compact('data'));
    }

    public function store(Request $request)
    {
        $permissions = [];
        $islemler = ['list', 'add', 'edit', 'delete'];

        foreach ($islemler as $islem) {
            $name = 'currentNewsCategory_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'currentNews_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'defenseIndustry_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'defenseIndustryCategory_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'defenseIndustryContent_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'defenseIndustryCountry_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'defenseIndustryCompany_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'activityCategory_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'activity_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'interview_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'dictionary_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'video_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'videoCategory_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'company_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'companyCategory_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'page_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }
        
        $role = new Role();
        $role->name = $request->role;
        $role->permissions = $permissions; 
        $role->save();

        Alert::success('Rol Başarıyla Eklendi');
        return redirect()->route('admin.role.list');
    }

    public function edit($id){
        $data = Role::findOrFail($id);
        return view('backend.role.edit',compact('data'));
    }

    public function update(Request $request,$id){
        


        $permissions = [];
        $islemler = ['list', 'add', 'edit', 'delete'];

        foreach ($islemler as $islem) {
            $name = 'currentNewsCategory_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'currentNews_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'defenseIndustry_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'defenseIndustryCategory_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'defenseIndustryContent_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'defenseIndustryCountry_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'defenseIndustryCompany_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'activityCategory_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'activity_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'interview_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'dictionary_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'video_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'videoCategory_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'company_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'companyCategory_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }

        foreach ($islemler as $islem) {
            $name = 'page_' . $islem;
            if(isset($request->$name)){
                array_push($permissions,$name);
            }
        }
        
        $role = Role::findOrFail($id);
        $role->name = $request->role;
        $role->permissions = $permissions; 
        $role->save();

        Alert::success('Rol Başarıyla Güncellendi');
        return redirect()->route('admin.role.list');
    }

}
