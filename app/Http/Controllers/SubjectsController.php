<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Input;
use Auth;
use App\Subject;
use App\User;
use App\Classe;


use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Session;


class SubjectsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
        $this->middleware('auth');
    }

    public function index()
    {
        /*$subjects = Subject::orderBy('id', 'asc')->select(Classe::raw('count(*) as user_count, status'))->get(); */// get data


        $subjects = Subject::
        join('classes', 'subjects.class_id', '=', 'classes.id')
            ->select('subjects.*', 'classes.class_name')
            ->orderBy('subjects.class_id','asc')
            ->orderBy('subjects.id','asc')

            ->paginate(15);
        //->get();

        //print_r($subjects);
        return view('subject.subjectList',compact('subjects')); // view
    }

    /**
     * Show the form for creating a new resource.subject
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classe::orderBy('id', 'asc')->get(); // get data

        return view('subject.addSubject',compact('classes'));
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
            'subject_name'=>'required',
            'class_id' => 'required',
        ]);
        if($validator->fails()){
            return redirect('/subject-list')
                ->withInput()
                ->withErrors($validator);

        }
        $subject = new Subject;
        $subject->subject_name = $request->subject_name;
        $subject->class_id = $request->class_id;
        $subject->created_at = date('Y-m-d');
        $subject->status = $request->status;
        $subject->save();
        Session::flash('flash_message', 'Subject successfully added!');
        return redirect('/subject-list');
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
        $subject = Subject::findOrFail($id);
        $classes = Classe::orderBy('id', 'asc')->get(); // get data
        return view('subject.addSubject',compact('classes'))->withSubject($subject);
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
        $subject = Subject::findOrFail($id);
        $this->validate($request, [
            'subject_name'=>'required',
            'class_id' => 'required',
        ]);
        $subject->subject_name = $request->subject_name;
        $subject->class_id = $request->class_id;
        $subject->updated_at = date('Y-m-d');
        $subject->status = $request->status;
        $subject->save();
        Session::flash('flash_message', 'Subject successfully updated!');
        return redirect('/subject-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subject::findOrFail($id)->delete();
        Session::flash('flash_message', 'Subject successfully deleted!');
        return redirect('/subject-list');
    }
}
