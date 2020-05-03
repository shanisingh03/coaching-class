<?php

namespace App\Repositories\Chapter;

use App\Models\Chapter;
use App\Interfaces\Chapter\ChapterRepositoryInterface;

class ChapterRepository implements ChapterRepositoryInterface
{
    /**
     * Get List of Chapters
     */
    public function getChapterList(int $institute_id)
    {
        return Chapter::where('institute_id',$institute_id)->get();
    }

    /**
     * Create Chapter
     * @param integer $institute_id
     * @param array $params
     */
    public function storeChapter(int $institute_id, array $params){
        // dd($params);
        $params['institute_id'] = $institute_id;
        $params['course_id'] = $params['course'];
        $params['subject_id'] = $params['subject'];
        $params['institute_id'] = $institute_id;
        return Chapter::create($params);
    }

     /**
     * Update Chapter
     * @param integer $chapter_id
     * @param array $params
     */
    public function updateChapter(int $chapter_id, array $params){
        // If No Image Then Unset it
        if(empty($params['image'])){
            unset($params['image']);
        }

        $params['course_id']  = $params['course'];
        $params['subject_id']  = $params['subject'];

        return Chapter::findOrFail($chapter_id)
            ->update($params);
    }
}