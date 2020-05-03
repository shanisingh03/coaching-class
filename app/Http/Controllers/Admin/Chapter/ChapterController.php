<?php

namespace App\Http\Controllers\Admin\Chapter;

use DB;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Subject;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Chapter\ChapterRepositoryInterface;
use App\Http\Requests\Admin\Chapter\StoreChapterRequest;
use App\Http\Requests\Admin\Chapter\UpdateChapterRequest;

class ChapterController extends Controller
{
    use UploadAble;
    /**
     * Initiate Chapter Repository && institute ID
     */
    private $chapterRepository;

    protected $institute_id;

    public function __construct(ChapterRepositoryInterface $chapterRepository)
    {
        $this->chapterRepository = $chapterRepository;

        // Set Institute ID
        $this->middleware(function ($request, $next) {
            $this->institute_id = auth()->user()->institute->institute_id;
            return $next($request);
        });
    }

    /**
     * Get List of chapters
     * @param Nill
     * @return List view
     * @author Shani Singh
     */
    public function getChapterList()
    {
        $chapters = $this->chapterRepository->getChapterList($this->institute_id);

        return view('admin.chapter.list')->with(['chapters'=>$chapters]);
    }

    /**
     * Add Chapters
     * @param Nill
     * @return return to Add Page
     * @author Shani Singh
     */
    public function createChapter()
    {
        $courses = Course::where('institute_id',$this->institute_id)->select('id','course_name')->get();

        return view('admin.chapter.add')->with(['courses'=>$courses]);
    }

    /**
     * Store Chapter
     * @param StoreChapterRequest $request
     * @return Store and return
     * @author Shani Singh
     */
    public function storeChapter(StoreChapterRequest $request)
    {
        try {
            DB::beginTransaction();
            
            // Requested Params
            $params = $request->except('_token');

            if ($request->has('image')) {

                $image = $this->uploadOne($request->image, 'uploads/institutes/'.$this->institute_id.'/chapter');
    
                $params['image'] = $image;
            }

            $chapter = $this->chapterRepository->storeChapter($this->institute_id, $params);
            // Commit and Return
            DB::commit();

            return redirect()->route('admin.chapter.list')->with('success','Chapter created successfully.');
            
        } catch (\Exception $e) {
            // Exception Ocurred
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Edit Chapter 
     * @param $chapter_id
     * @return Chapter Details
     * @author Shani Singh
     */
    public function editChapter($chapter_id)
    {
        $chapter = Chapter::where('institute_id',$this->institute_id)->whereId($chapter_id)->first();
        $courses = Course::where('institute_id',$this->institute_id)->select('id','course_name')->get();
        $subjects = Subject::where('institute_id',$this->institute_id)
                    ->whereHas('courses.course',function($q) use($chapter){
                        $q->where('course_id',$chapter->course_id);
                    })->select('id','subject_name')
                    ->get();

        return view('admin.chapter.edit')->with([
            'chapter' => $chapter,
            'courses' => $courses,
            'subjects' => $subjects,
        ]);
    }

    /**
     * Update Chapter
     * @param $chapter_id
     * @param updateChapterRequest $request
     * @author Shani Singh
     */
    public function updateChapter(UpdateChapterRequest $request, $chapter_id)
    {
        try {
            DB::beginTransaction();
            
            // Requested Params
            $params = $request->except('_token');

            if ($request->has('image')) {

                $image = $this->uploadOne($request->image, 'uploads/institutes/'.$this->institute_id.'/chapter');
    
                $params['image'] = $image;
            }

            $chapter = $this->chapterRepository->updateChapter($chapter_id, $params);
            // Commit and Return
            DB::commit();

            return redirect()->route('admin.chapter.list')->with('success','Chapter Updated successfully.');
            
        } catch (\Exception $e) {
            // Exception Ocurred
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
