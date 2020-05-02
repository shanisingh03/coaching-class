<?php

namespace App\Http\Controllers\Superadmin;

use DB;
use Carbon\Carbon;
use App\Models\Institute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Requests\Institutes\StoreInstitutes;
use App\Http\Requests\Requests\Institutes\UpdateInstitute;
use App\Interfaces\Institute\InstituteRepositoryInterface;

class InstituteController extends Controller
{
    private $instituteRepository;
    public function __construct(InstituteRepositoryInterface $instituteRepository)
    {
        $this->instituteRepository = $instituteRepository;
    }
    /**
     * Get view of List Institute
     * @author: Shani Singh
     */
    public function index()
    {
        $institutes =  $this->instituteRepository->all();
        return view('superadmin.institute.list')->with(['institutes'=>$institutes]);
    }

    /**
     * Get view of Create Institute
     * @author: Shani Singh
     */
    public function create()
    {
       
        return view('superadmin.institute.add');
    }

    /**
     * Get Json List Data
     * @author Shani Singh
     */
    public function getListData()
    {
        $institutes = Institute::all();
        return response()->json([
            'institutes' => $institutes,
            'status'     => true,
            'status-code'=> 200
        ],200);
    }

    /**
     * Store New Institute
     * @param StoreInstitutes $request
     * @author Shani Singh
     */
    public function store(StoreInstitutes $request)
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
            $input['logo'] = $fileName;
            
            // Create Institute
            $institute  = $this->instituteRepository->store($input);
            // $institute = Institute::create($input);

            // Commit and Return
            DB::commit();

            return redirect()->route('superadmin.institute.list')->with('success','Institute created successfully.');
            
        } catch (\Exception $e) {
            // Exception Ocurred
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Edit Institutes
     * @param integer $institute_id
     * @return $institute_details
     * @author Shani Singh
     */
    public function edit($institute_id)
    {
        try {
            $institute_details = $this->instituteRepository->details($institute_id);

            // If Nothing Found
            if(empty($institute_details)){
                return back()->withInput()->with('error', "No institute found.");
            }

            return view('superadmin.institute.edit')->with('institute',$institute_details);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Update Institute
     * @param UpdateInstitute $request
     * @author Shani Singh
     */
    public function update(UpdateInstitute $request)
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
            $input['logo'] = $fileName;
            $institute_id = $input['id'];

            unset($input['id']);
            // Create Institute
            $institute = $this->instituteRepository->update($institute_id,$input);

            // Commit and Return
            DB::commit();

            return redirect()->route('superadmin.institute.list')->with('success','Institute updated successfully.');
            
        } catch (\Exception $e) {
            // Exception Ocurred
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Get Details Of Institutes
     * @param $institute_id
     * @return $institute_details
     * @author: Shani Singh
     */
    public function getDetails($institute_id)
    {
        try {
            $institute_details = $this->instituteRepository->details($institute_id);
            // If Nothing Found
            if(empty($institute_details)){
                return back()->withInput()->with('error', "No institute found.");
            }

            return view('superadmin.institute.details')->with('institute',$institute_details);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
