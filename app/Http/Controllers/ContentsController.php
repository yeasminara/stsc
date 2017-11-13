<?php

namespace App\Http\Controllers;


use Input;
use Auth;
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
class ContentsController extends Controller
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
        $lessons = Lesson::orderBy('id', 'asc')->get(); // get data
        $contents = Content::
             join('classes', 'contents.class_id', '=', 'classes.id')
            ->join('subjects', 'contents.subject_id', '=', 'subjects.id')
            ->leftJoin('chapters', 'contents.chapter_id', '=', 'chapters.id')
            ->leftJoin('lessons', 'contents.lesson_id', '=', 'lessons.id')
            ->select('contents.*', 'classes.class_name', 'subjects.subject_name', 'chapters.chapter_name', 'lessons.lesson_name')
            ->orderBy('contents.class_id','asc')
            ->orderBy('contents.subject_id','asc')
            ->orderBy('contents.chapter_id','asc')
            ->orderBy('contents.lesson_id','asc')
            ->paginate(15);
        //->get();

        //print_r($subjects);
        return view('content.contentList',compact('chapters','classes','subjects','lessons','contents')); // view
    }

    public function create()
    {
        $classes = Classe::orderBy('id', 'asc')->get(); // get data
        $subjects = Subject::orderBy('id', 'asc')->get(); // get data
        $chapters = Chapter::orderBy('id', 'asc')->get(); // get data
        $lessons = Lesson::orderBy('id', 'asc')->get(); // get data
        $content_types = ContentType::orderBy('id', 'asc')->get(); // get data
        return view('content.addContent',compact('classes','subjects','chapters','lessons','content_types'));
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
            'class_id' => 'required',
            'subject_id' => 'required',
            'title'=>'required',

        ]);
      if($validator->fails()){
            return redirect('/add-content')
                ->withInput()
                ->withErrors($validator);

        }

        /* flash file upload*/
        $flashFile = $request->file('flash_file');
        $flahNameOrginal = $request->file('flash_file')->getClientOriginalName();
        $extension = $flashFile->getClientOriginalExtension();
        $path = base_path() . '/public/uploads/content/';
        $flahNameOrginal = $path.$flahNameOrginal;
        $flashFile->move($path , $flahNameOrginal);

        /* content file upload*/
        $contentFile = $request->file('content_file');
        $fileNameOrginal = $request->file('content_file')->getClientOriginalName();
        $extension = $contentFile->getClientOriginalExtension();
        $fileNameOrginal = $path.$fileNameOrginal;
        $contentFile->move($path , $fileNameOrginal);

        /* image file upload*/
        $image = $request->file('image');
        $imageNameOrginal = $request->file('image')->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $imageNameOrginal = $path.$imageNameOrginal;
        $image->move($path , $imageNameOrginal);

        /* image file upload*/
        $lessonPlan = $request->file('lesson_plan');
        $lessonPlanNameOrginal = $request->file('lesson_plan')->getClientOriginalName();
        $extension = $lessonPlan->getClientOriginalExtension();
        $lessonPlanNameOrginal = $path.$lessonPlanNameOrginal;
        $lessonPlan->move($path , $lessonPlanNameOrginal);

        $content= new Content;
        //print_r($request->file('flash_file'));
        //die();
        $content->lesson_id = $request->lesson_id;
        $content->chapter_id = $request->chapter_id;
        $content->class_id = $request->class_id;
        $content->subject_id = $request->subject_id;
        $content->title = $request->title;
        $content->description = $request->description;
        $content->audio_file = $request->audio_file;
        $content->vedio_link = $request->vedio_link;


        $content->content_type_id = $request->content_type_id;
        $content->created_at = date('Y-m-d');
        $content->status = $request->status;
        $content->image = $imageNameOrginal;
        $content->file =$fileNameOrginal;
        $content->lesson_plan = $lessonPlanNameOrginal;
        $content->flash_file =$flahNameOrginal;


        $content->save();
        Session::flash('flash_message', 'Lesson successfully added!');
      return redirect('/content-list');
    }


    public function edit($id)
    {


        $content = Content::findOrFail($id);
        /*$subjects = Subject::orderBy('id', 'asc')->select(Classe::raw('count(*) as user_count, status'))->get(); */// get data
        $classes = Classe::orderBy('id', 'asc')->get(); // get data
        $subjects = Subject::where('class_id', '=', $content->class_id)->orderBy('id', 'asc')->get(); // get data
        $chapters = Chapter::where('class_id', '=', $content->class_id)->where('subject_id', '=', $content->subject_id)->orderBy('id', 'asc')->get(); // get data
        $lessons = Lesson::where('class_id', '=', $content->class_id)->where('subject_id', '=', $content->subject_id)->where('chapter_id', '=', $content->chapter_id)->orderBy('id', 'asc')->get(); // get data
        $content_types = ContentType::orderBy('id', 'asc')->get(); // get data




        //print_r($subjects);
        return view('content.addContent',compact('classes','subjects','chapters','lessons','content_types','content'));

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
        $path = base_path() . '/public/uploads/content/';
        $path1 = '/public/uploads/content/';
        $content = Content::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'class_id' => 'required',
            'subject_id' => 'required',
            'title'=>'required',

        ]);
        if($validator->fails()){
            return redirect('/add-content')
                ->withInput()
                ->withErrors($validator);

        }

        /* flash file upload*/
        if($request->file('flash_file')){
            $flashFile = $request->file('flash_file');
            $flahNameOrginal = $request->file('flash_file')->getClientOriginalName();
            $extension = $flashFile->getClientOriginalExtension();

            $flahNameOrginal = $path1.$flahNameOrginal;
            $flashFile->move($path , $flahNameOrginal);
        }else{
            $flahNameOrginal = $request->input('old_flash_file');
        }


        /* content file upload*/
        if($request->file('content_file')){
            $contentFile = $request->file('content_file');
            $fileNameOrginal = $request->file('content_file')->getClientOriginalName();
            $extension = $contentFile->getClientOriginalExtension();
            $fileNameOrginal = $path1.$fileNameOrginal;
            $contentFile->move($path , $fileNameOrginal);
        }else{
            $fileNameOrginal = $request->input('old_content_file');
        }


        /* image file upload*/
        if($request->file('image')) {
            $image = $request->file('image');
            $imageNameOrginal = $request->file('image')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $imageNameOrginal = $path1 . $imageNameOrginal;
            $image->move($path, $imageNameOrginal);
        }else{
            $imageNameOrginal = $request->input('old_image');
        }
        /* image file upload*/
        if($request->file('lesson_plan')) {
            $lessonPlan = $request->file('lesson_plan');
            $lessonPlanNameOrginal = $request->file('lesson_plan')->getClientOriginalName();
            $extension = $lessonPlan->getClientOriginalExtension();
            $lessonPlanNameOrginal = $path1 . $lessonPlanNameOrginal;
            $lessonPlan->move($path, $lessonPlanNameOrginal);
        }else{
            $lessonPlanNameOrginal = $request->input('old_lesson_plan');
        }
        //print_r($request->file('flash_file'));
        //die();
        $content->lesson_id = $request->lesson_id;
        $content->chapter_id = $request->chapter_id;
        $content->class_id = $request->class_id;
        $content->subject_id = $request->subject_id;
        $content->title = $request->title;
        $content->description = $request->description;
        $content->audio_file = $request->audio_file;
        $content->vedio_link = $request->vedio_link;


        $content->content_type_id = $request->content_type_id;
        $content->created_at = date('Y-m-d');
        $content->status = $request->status;
        $content->image = $imageNameOrginal;
        $content->file =$fileNameOrginal;
        $content->lesson_plan = $lessonPlanNameOrginal;
        $content->flash_file =$flahNameOrginal;


        $content->save();
        Session::flash('flash_message', 'Lesson successfully added!');
        return redirect('/content-list');
    }

    public function destroy($id)
    {
        Content::findOrFail($id)->delete();
        Session::flash('flash_message', 'Content successfully deleted!');
        return redirect('/content-list');
    }


    public function searchContent(Request $request){

        $classId = $request->class_id;
        $subjectId = $request->subject_id;
        $chapterId = $request->chapter_id;
        $lessonId = $request->lesson_id;


       /*

            ->get();*/
        $contents = Content::
        join('classes', 'contents.class_id', '=', 'classes.id')
            ->join('subjects', 'contents.subject_id', '=', 'subjects.id')
            ->leftJoin('chapters', 'contents.chapter_id', '=', 'chapters.id')
            ->leftJoin('lessons', 'contents.lesson_id', '=', 'lessons.id')
            ->select('contents.*', 'classes.class_name', 'subjects.subject_name', 'chapters.chapter_name', 'lessons.lesson_name')
            ->where('contents.class_id', '=', $classId)
            ->where('contents.subject_id', '=', $subjectId)
            ->orWhere('contents.chapter_id', '=', $chapterId)
            ->orWhere('contents.lesson_id', '=', $lessonId)
            ->orderBy('contents.class_id','asc')
            ->orderBy('contents.subject_id','asc')
            ->orderBy('contents.chapter_id','asc')
            ->orderBy('contents.lesson_id','asc')
            ->get();
       // print_r($contents);
      return view('content.searchContent',compact('contents'));
        echo 'sdjhsjdh';
    }
}
