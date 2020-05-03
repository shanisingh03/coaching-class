<?php
namespace App\Interfaces\Chapter;

interface ChapterRepositoryInterface
{
    //List All Chapter
    public function getChapterList(int $institute_id);

    /**
     * Create Chapter
     * @param integer $institute_id
     * @param array $params
     */
    public function storeChapter(int $institute_id, array $params);
    
    /**
     * Update Chapter
     * @param integer $chapter_id
     * @param array $params
     */
    public function updateChapter(int $chapter_id, array $params);
    
}