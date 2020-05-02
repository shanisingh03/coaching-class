<?php

namespace App\Http\Controllers\SuperAdmin\Institute;

use DB;
use App\User;
use Illuminate\Http\Request;
use App\Models\InstituteUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\InstituteAdmin\StoreAdminRequest;

class InstituteAdminController extends Controller
{
    /**
     * Institute Admin Store
     * @param StoreAdminRequest $_REQUEST
     * @return object $institute_admin
     * @author: Shani Singh
     */
    public function storeAdmin(StoreAdminRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['password']  = Hash::make($request->first_name."@123");
            $input['role_id']   = 2; //2 for Institute Admin
            // Create User
            $user = User::create($input);
            

            // Create Institute User
            $institute_user = InstituteUser::create([
                'institute_id' => $request->institute_id,
                'user_id' => $user->id,
                'role_id' => $user->role_id
            ]);
            // dd($institute_user);
            // Commit and Return
            DB::commit();

            return redirect()->route('superadmin.institute.details',['institute_id'=>$request->institute_id])->with('success','Institute Admin created successfully.');
            
        } catch (\Exception $e) {
            // Exception Ocurred
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
