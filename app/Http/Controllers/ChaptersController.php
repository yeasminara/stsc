<?php namespace App\Http\Controllers;



use Input;
use Auth;
use App\Subject;
use App\User;
use App\Classe;
use App\Chapter;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;

class ChaptersController extends Controller
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
        $chapters = Chapter::
        join('classes', 'chapters.class_id', '=', 'classes.id')
            ->join('subjects', 'chapters.subject_id', '=', 'subjects.id')
            ->select('chapters.*', 'classes.class_name', 'subjects.subject_name')
            ->orderBy('chapters.class_id', 'asc')
            ->orderBy('chapters.subject_id', 'asc')
            ->orderBy('chapters.id', 'asc')
            ->paginate(15);
        //->get();

        //print_r($subjects);
        return view('chapter.chapterList', compact('chapters', 'classes', 'subjects')); // view
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

        return view('chapter.addChapter', compact('classes', 'subjects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'chapter_name' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/chapter-list')
                ->withInput()
                ->withErrors($validator);

        }
        $chapter = new Chapter;
        $chapter->chapter_name = $request->chapter_name;
        $chapter->class_id = $request->class_id;
        $chapter->subject_id = $request->subject_id;
        $chapter->created_at = date('Y-m-d');
        $chapter->status = $request->status;
        $chapter->save();
        Session::flash('flash_message', 'Chapter successfully added!');
        return redirect('/chapter-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chapter = Chapter::findOrFail($id);
        // print_r($chapter);
        $classes = Classe::orderBy('id', 'asc')->get(); // get data
        $subjects = Subject::orderBy('id', 'asc')->get(); // get data
        return view('chapter.addChapter', compact('classes', 'subjects'))->withChapter($chapter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $chapter = Chapter::findOrFail($id);
        $this->validate($request, [
            'chapter_name' => 'required',
            'class_id' => 'required',
            'subject_id' => 'required',
        ]);
        $chapter->chapter_name = $request->chapter_name;
        $chapter->class_id = $request->class_id;
        $chapter->subject_id = $request->subject_id;
        $chapter->created_at = date('Y-m-d');
        $chapter->status = $request->status;
        $chapter->save();
        Session::flash('flash_message', 'Chapter successfully updated!');
        return redirect('/chapter-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Chapter::findOrFail($id)->delete();
        Session::flash('flash_message', 'Chapter successfully deleted!');
        return redirect('/chapter-list');
    }



    public function searchChapter(Request $request)
    {
        $classId = $request->class_id;
        $subjectId = $request->subject_id;

        $chapters = Chapter::
                join('classes', 'chapters.class_id', '=', 'classes.id')
                ->join('subjects', 'chapters.subject_id', '=', 'subjects.id')
                ->select('chapters.*', 'classes.class_name', 'subjects.subject_name')
                ->where('chapters.class_id', '=', $classId)
                ->where('chapters.subject_id', '=', $subjectId)
                ->orderBy('chapters.class_id', 'asc')
                ->orderBy('chapters.subject_id', 'asc')
                ->orderBy('chapters.id', 'asc')->get(); // get data

       // echo 'test';
        return view('chapter.searchChapter',compact('chapters'));
        //return view('chapter.searchChapter', compact('chapters')); // view
    }
}
