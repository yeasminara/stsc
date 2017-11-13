<?php
namespace App\Http\Controllers;

use Input;
use Auth;
use App\Subject;
use App\User;
use App\Classe;
use App\Chapter;
use App\Lesson;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;

class LessonsController extends Controller
{

    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
        $this->middleware('auth');
    }

    public function index()
    {
        /*$subjects = Subject::orderBy('id', 'asc')->select(Classe::raw('count(*) as user_count, status'))->get(); */// get data
        $classes = Classe::orderBy('id', 'asc')->get(); // get data
        $subjects = Subject::orderBy('id', 'asc')->get(); // get data
        $chapters = Chapter::orderBy('id', 'asc')->get(); // get data
        $lessons = Lesson::
            join('classes', 'lessons.class_id', '=', 'classes.id')
            ->join('subjects', 'lessons.subject_id', '=', 'subjects.id')
            ->join('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->select('lessons.*', 'classes.class_name', 'subjects.subject_name', 'chapters.chapter_name')
            ->orderBy('lessons.class_id','asc')
            ->orderBy('lessons.subject_id','asc')
            ->orderBy('lessons.chapter_id','asc')
            ->orderBy('lessons.id','asc')

            ->paginate(15);
        //->get();

        //print_r($subjects);


        return view('lesson.lessonList',compact('chapters','classes','subjects','lessons')); // view
    }

    /**
     * Show the form for creating a new resource.subject
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classe::orderBy('id', 'asc')->get(); // get data
        $subjects = Subject::orderBy('id', 'asc')->get(); // get data
        $chapters = Chapter::orderBy('id', 'asc')->get(); // get data
        return view('lesson.addLesson',compact('classes','subjects','chapters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'lesson_name'=>'required',
            'chapter_id'=>'required',
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);
        if($validator->fails()){
            return redirect('/lesson-list')
                ->withInput()
                ->withErrors($validator);

        }
        $lesson = new Lesson;
        $lesson->lesson_name = $request->lesson_name;
        $lesson->chapter_id = $request->chapter_id;
        $lesson->class_id = $request->class_id;
        $lesson->subject_id = $request->subject_id;
        $lesson->created_at = date('Y-m-d');
        $lesson->status = $request->status;
        $lesson->save();
        Session::flash('flash_message', 'Lesson successfully added!');
        return redirect('/lesson-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        // print_r($chapter);
        $classes = Classe::orderBy('id', 'asc')->get(); // get data
        $subjects = Subject::orderBy('id', 'asc')->get(); // get data
        $chapters = Chapter::orderBy('id', 'asc')->get(); // get data
        return view('lesson.addLesson',compact('classes','subjects','chapters'))->withLesson($lesson);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $this->validate($request, [
            'lesson_name'=>'required',
            'chapter_id'=>'required',
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);
        $lesson->lesson_name = $request->lesson_name;
        $lesson->chapter_id = $request->chapter_id;
        $lesson->class_id = $request->class_id;
        $lesson->subject_id = $request->subject_id;
        $lesson->created_at = date('Y-m-d');
        $lesson->status = $request->status;
        $lesson->save();
        Session::flash('flash_message', 'Lesson successfully updated!');
        return redirect('/lesson-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Lesson::findOrFail($id)->delete();
        Session::flash('flash_message', 'Lesson successfully deleted!');
        return redirect('/lesson-list');
    }

    public function searchLesson(Request $request)
    {
        $classId = $request->class_id;
        $subjectId = $request->subject_id;
        $chapterId = $request->chapter_id;
        $query = Lesson::
            join('classes', 'lessons.class_id', '=', 'classes.id')
            ->join('subjects', 'lessons.subject_id', '=', 'subjects.id')
            ->join('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->select('lessons.*', 'classes.class_name', 'subjects.subject_name', 'chapters.chapter_name')
            ->where('lessons.class_id', '=', $classId);
        if(!empty($subjectId)){
            $query->where('lessons.subject_id', '=', $subjectId);
        }
        if(!empty($chapterId)){
            $query->where('lessons.chapter_id', '=', $chapterId);
        }
        $query->orderBy('lessons.class_id','asc');
        $query->orderBy('lessons.subject_id','asc');
        $query ->orderBy('lessons.chapter_id','asc');
        $query ->orderBy('lessons.id','asc');
        $lessons = $query->get();

//$lessons
        // echo 'test';
        return view('lesson.searchLesson',compact('lessons'));
        //return view('chapter.searchChapter', compact('chapters')); // view
    }
}
