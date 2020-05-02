<?php

namespace App\Http\Controllers\Admin\Course;

use DB;
use Auth;
use App\Models\{Course};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\StoreCourseRequest;
use App\Http\Requests\Admin\Course\UpdateCourseRequest;

class CourseController extends Controller
{
    protected $institute_id;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Set Institute ID
        $this->middleware(function ($request, $next) {
            $this->institute_id = auth()->user()->institute->institute_id;
    
            return $next($request);
        });
        
    }

    /**
     * Get Course List
     * @param   Nill
     * @return List of Courses
     * @author Shani Singh
     */
    public function getCourseList()
    {
        // dd($this->institute_id);
        $courses = Course::where('institute_id',$this->institute_id)->get();

        return view('admin.courses.list')->with(['courses' => $courses]);
    }

    /**
     * Get Create Institute View
     * @param Nill
     * @return To View of Add Course
     * @author Shani singh
     */
    public function createCourse()
    {
        return view('admin.courses.add');
    }

    /**
     * Store Course 
     * @param StoreCourseRequest $request
     * @return Save and return
     * @author Shani Singh
     */
    public function storeCourse(StoreCourseRequest $request)
    {
        try {
            DB::beginTransaction();

            // Upload File
            if($request->file('image')){
                $fileName = time().'.'.$request->image->extension();  

                $file_upload = $request->image->move(public_path('uploads/institutes/'.$this->institute_id.'/courses'), $fileName);

                if(!$file_upload){
                    DB::rollback();
                    return back()->withInput()->with('error', 'Failed to upload Course image.');
                }
            }else{
                $fileName = NULL;
            }
            // Change Date Format And Add Logo
            $input = $request->all();
            $input['image'] = $fileName;
            $input['institute_id'] = $this->institute_id;
            
            // Create Institute
            $course = Course::create($input);

            // Commit and Return
            DB::commit();

            return redirect()->route('admin.course.list')->with('success','Course created successfully.');
            
        } catch (\Exception $e) {
            // Exception Ocurred
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Edit Course
     * @param $courses_id
     * @return to Edit Page with Course Data
     * @author Shani Singh
     */
    public function editCourse($course_id)
    {
        $course_details = Course::find($course_id);

        if(empty($course_details)){
            abort(404);
        }

        return view('admin.courses.edit')->with(['course'=>$course_details]);
    }

    /**
     * Update Course 
     * @param UpdateCourseRequest $request
     * @return Update and return
     * @author Shani Singh
     */
    public function updateCourse(UpdateCourseRequest $request, $course_id)
    {
        try {
            DB::beginTransaction();

            // Upload File
            if($request->file('image')){
                $fileName = time().'.'.$request->image->extension();  

                $file_upload = $request->image->move(public_path('uploads/institutes/'.$this->institute_id.'/courses'), $fileName);

                if(!$file_upload){
                    DB::rollback();
                    return back()->withInput()->with('error', 'Failed to upload Course image.');
                }
            }else{
                $fileName = NULL;
            }
            // Change Date Format And Add Logo
            $input = $request->all();
            unset($input['_token']);
            if(!empty($fileName)){

                $input['image'] = $fileName;
            }
            
            // Create Institute
            $course = Course::find($course_id)->update($input);

            // Commit and Return
            DB::commit();

            return redirect()->route('admin.course.list')->with('success','Course Updated successfully.');
            
        } catch (\Exception $e) {
            // Exception Ocurred
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
