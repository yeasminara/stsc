<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;


use Input;
use App\Subject;
use App\User;
use App\Classe;
use App\Chapter;
use App\Lesson;
use App\ContentType;
use App\Content;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class LoadingController extends Controller
{
    public function searchSubject(Request $request){
        $classId = $request->id;
        $subjects = Subject:: where('class_id', '=', $classId)->orderBy('id', 'asc')->get(); // get data
        $select = '<select id="subject_id" name="subject_id"  onchange="load_chapter()" style="margin-bottom: 0rem;"><option value="">Select</option> ';
        foreach ($subjects as $subject) {
            $select .='<option value="'.$subject->id.'">'.$subject->subject_name.'</option>';
        }
        echo $select .='</select>';
    }

    public function searchChapter(Request $request){
        $classId = $request->class_id;
        $subjectId = $request->subject_id;
        $chapters = Chapter:: where('class_id', '=', $classId)->where('subject_id', '=', $subjectId)->orderBy('id', 'asc')->get(); // get data
        if(count($chapters)>0){
            $select1 = '<select id="chapter_id" name="chapter_id"  onchange="load_lesson()" style="margin-bottom: 0rem;"><option value="">Select</option>';
            foreach ($chapters as $chapter) {
                $select1 .='<option value="'.$chapter->id.'">'.$chapter->chapter_name.'</option>';
            }
            echo $select1 .='</select>';
        }else{
            echo '<div class="success button">No chapter found</div>';
        }


    }
    public  function searchLesson(Request $request){
        $classId = $request->class_id;
        $subjectId = $request->subject_id;
        $chapterId = $request->chapter_id;
        $lessons = Lesson:: where('class_id', '=', $classId)
            ->where('subject_id', '=', $subjectId)
            ->where('chapter_id', '=', $chapterId)
            ->orderBy('id', 'asc')->get(); // get data
        if(count($lessons)>0) {
            $select2 = '<select id="lesson_id" name="lesson_id" style="margin-bottom: 0rem;"><option value="">Select</option>';
            foreach ($lessons as $lesson) {
                $select2 .='<option value="'.$lesson->id.'">'.$lesson->lesson_name.'</option>';
            }
            echo $select2 .='</select>';
        }else{
            echo '<div class="success button">No lesson found</div>';
        }

    }
}
