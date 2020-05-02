<?php

namespace App\Http\Controllers\Admin\Subject;

use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Course,Subject,CourseSubject};
use App\Http\Requests\Admin\Subject\StoreSubjectRequest;
use App\Http\Requests\Admin\Subject\UpdateSubjectRequest;

class SubjectController extends Controller
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
     * List of Subjects Available
     * @param Nill
     * @return array $subjects
     * @author Shani Singh
     */
    public function getSubjectList()
    {
        // $subjects = Subject::join('course_subjects','course_subjects.subject_id','=','subjects.id')
        //             ->leftjoin('courses','course_subjects.course_id','=','courses.id')
        //             ->where('subjects.institute_id',$this->institute_id)
        //             ->select('subjects.id','subjects.subject_name',\DB::raw("GROUP_CONCAT(courses.course_name) as course_name"),'subjects.image','subjects.created_at')
        //             ->groupBy('subjects.id','subjects.subject_name','subjects.image','subjects.created_at')
        //             ->get();
        $subjects = Subject::where('institute_id',$this->institute_id)
                    ->with('courses.course')
                    ->get();
        // dd($subjects);
        return view('admin.subject.list')->with(['subjects'=>$subjects]);
    }

    /**
     * Create Subject 
     * @param Nill
     * @return Array $courses
     * @author Shani Singh
     */
    public function createSubject()
    {
        $courses = Course::whereInstituteId($this->institute_id)->get();

        return view('admin.subject.add')->with(['courses'=>$courses]);
    }

    /**
     * Subjects Store
     * @param SubjectStoreRequest $request
     * @return $list of Subjects
     * @author Shani Singh
     */
    public function storeSubject(StoreSubjectRequest $request)
    {
        try {
            DB::beginTransaction();

            // Upload File
            if($request->file('image')){
                $fileName = time().'.'.$request->image->extension();  

                $file_upload = $request->image->move(public_path('uploads/institutes/'.$this->institute_id.'/subjects'), $fileName);

                if(!$file_upload){
                    DB::rollback();
                    return back()->withInput()->with('error', 'Failed to upload Subject image.');
                }
            }else{
                $fileName = NULL;
            }
            // Change Date Format And Add Logo
            $input = $request->all();
            $input['image'] = $fileName;
            $input['institute_id'] = $this->institute_id;
            
            // Create Subject
            $subject = Subject::create($input);

            // Create Relation b/w Subject and Course
            foreach($request->course_name as $course_id){
                CourseSubject::create([
                    'course_id'     => $course_id,
                    'subject_id'    => $subject->id
                ]);
            }

            // Commit and Return
            DB::commit();

            return redirect()->route('admin.subject.list')->with('success','Subject created successfully.');
            
        } catch (\Exception $e) {
            // Exception Ocurred
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Edit Subject
     * @param $subject_id
     * @return Subject Details
     * @author Shani Singh
     */
    public function editSubject($subject_id)
    {
        try {

            $subject = Subject::where('id',$subject_id)->with('courses')->first();

            if(empty($subject)){
                return back()->withInput()->with('error', 'Invalid Subject selected.');
            }

            $courses = Course::whereInstituteId($this->institute_id)->get();
            // dd($subject->courses->pluck('course_id')->toArray());
            return view('admin.subject.edit')->with(['subject'=>$subject,'courses'=>$courses,'selected_courses'=>$subject->courses->pluck('course_id')->toArray()]);

        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Subjects Update
     * @param UpdateSubjectRequest $request
     * @param integer $subject_id
     * @return $list of Subjects
     * @author Shani Singh
     */
    public function updateSubject(UpdateSubjectRequest $request, $subject_id)
    {
        try {
            DB::beginTransaction();
            $subject = Subject::where('id',$subject_id)->with('courses')->first();
            // If Invalid Subject ID
            if(empty($subject)){
                return back()->withInput()->with('error', 'Invalid Subject selected.');
            }

            // Get Old Courses of Subject
            $old_courses = $subject->courses->pluck('course_id')->toArray();

            // Deleted Courses
            $deleted_courses = array_diff($old_courses,$request->course_name);

            // Upload File
            if($request->file('image')){
                $fileName = time().'.'.$request->image->extension();  

                $file_upload = $request->image->move(public_path('uploads/institutes/'.$this->institute_id.'/subjects'), $fileName);

                if(!$file_upload){
                    DB::rollback();
                    return back()->withInput()->with('error', 'Failed to upload Subject image.');
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
            
            // Update Subject
            $subject->update($input);
            // dd($request->course_name);
            // Create Relation b/w Subject and Course
            foreach($request->course_name as $course_id){
                CourseSubject::firstOrCreate([
                    'course_id'     => $course_id,
                    'subject_id'    => $subject->id
                ]);
            }

            // If Deleted Column
            if(count($deleted_courses) > 0){
                foreach($deleted_courses as $d_course){
                    CourseSubject::where('course_id',$d_course)->where('subject_id',$subject_id)->delete();
                }
            }

            // Commit and Return
            DB::commit();

            return redirect()->route('admin.subject.list')->with('success','Subject Updated successfully.');
            
        } catch (\Exception $e) {
            // Exception Ocurred
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

}
