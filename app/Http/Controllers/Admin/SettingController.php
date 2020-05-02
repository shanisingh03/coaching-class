<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Institutes\UpdateInstitute;
use DB;
use Carbon\Carbon;
use App\Models\Institute;

class SettingController extends Controller
{
    /**
     * Get Settings of Institute
     * @param Nill
     * @return Get All Settings 
     * @author Shani Singh
     */
    public function getSettings()
    {
        $institute = auth()->user()->institute->institute;
        return view('admin.settings')->with(['institute'=>$institute]);
    }

    /**
     * Update Institute Settings
     * @param UpdateInstituteRequest $_REQUEST
     * @return Update Settings
     * @author Shani Singh
     */
    public function updateInstituteSetting(UpdateInstitute $request)
    {
        try {
            DB::beginTransaction();

            // Upload File
            if($request->file('logo')){
                $fileName = time().'.'.$request->logo->extension();  

                $file_upload = $request->logo->move(public_path('uploads/institutes/logo'), $fileName);

                if(!$file_upload){
                    DB::rollback();
                    return back()->withInput()->with('error', 'Failed to upload logo image.');
                }
            }else{
                $fileName = NULL;
            }
            // Change Date Format And Add Logo
            $input = $request->all();
            $input['registered_at'] = Carbon::createFromFormat('d/m/Y', $request->registered_at)->format('Y-m-d');
            if(!empty($fileName)){

                $input['logo'] = $fileName;
            }
            unset($input['id']);
            // Create Institute
            $institute = Institute::find($request->id)->update($input);

            // Commit and Return
            DB::commit();

            return redirect()->route('admin.setting.details')->with('success','Institute Settings updated successfully.');
            
        } catch (\Exception $e) {
            // Exception Ocurred
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
