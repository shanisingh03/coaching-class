<?php

namespace App\Http\Controllers\SuperAdmin\Profile;

use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SuperAdmin\Profile\UpdateProfileRequest;
use App\Http\Requests\SuperAdmin\Profile\ChangePasswordRequest;

class ProfileController extends Controller
{
    /**
     * Get Profile Details
     * @param Nill
     * @return $profile
     * @author Shani Singh
     */
    public function getProfileDetail()
    {
        $user = Auth::user();
        $activeTab = 'profile';
        return view('superadmin.profile.profile')->with(['user'=>$user,'activeTab'=>$activeTab]);
    }

    /**
     * Update Profile
     * @param UpdateProfileRequest $_REQUEST
     * @return update and return back to profile with success messages
     * @author Shani Singh
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $activeTab = 'profile';
        try {
            DB::beginTransaction();

            $input = $request->all();
            unset($input['_token']);
            $update_user = User::whereId($request->id)->update($input);

            $user = Auth::user();
            DB::commit();
            return redirect()->route('superadmin.profile.details')->with(['user'=>$user,'activeTab'=>$activeTab,'success'=>'Profile Data updated successfully.']);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with(['activeTab'=>$activeTab,'error'=>$e->getMessage()]);
        }
    }

    /**
     * Change Password
     * @param ChangePasswordRequest
     * @return change password and return
     * @author Shani Singh
     */
    public function resetPassword(ChangePasswordRequest $request)
    {
        $activeTab = 'change-password';
        try {
            DB::beginTransaction();

            $update_user = User::whereId($request->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            $user = Auth::user();
            DB::commit();
            return redirect()->route('superadmin.profile.details')->with(['user'=>$user,'activeTab'=>$activeTab,'success'=>'Password Changed successfully.']);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with(['activeTab'=>$activeTab,'error'=>$e->getMessage()]);
        }
    }
}
