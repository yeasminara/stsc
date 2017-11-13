<?php namespace App\Http\Controllers;



use Input;
use Auth;
use App\Classe;
use App\User;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
        $this->middleware('auth');
        $id = Auth::id();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

      // echo 'test';
        $class = Classe::orderBy('id', 'asc')->get(); // get data
       // print_r($class);
        //die();
        return view('class.class_list',compact('class')); // view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('class.addClass');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),['class_name'=>'required']);
        if($validator->fails()){
            return redirect('/add-class')
                ->withInput()
                ->withErrors($validator);

        }
        $class = new Classe;
        $class->class_name = $request->class_name;
        $class->create_date = date('Y-m-d');
        $class->status = $request->status;
        $class->save();
        Session::flash('flash_message', 'Class successfully added!');
        return redirect('/class-list');
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
        $classe = Classe::findOrFail($id);
        return view('class.addClass')->withClasse($classe);
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
        $class = Classe::findOrFail($id);
        $this->validate($request, [
            'class_name' => 'required'
        ]);
        $class->class_name = $request->class_name;
        $class->updated_at = date('Y-m-d');
        $class->status = $request->status;
        $class->save();
        Session::flash('flash_message', 'Class successfully updated!');
        return redirect('/class-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Classe::findOrFail($id)->delete();
        Session::flash('flash_message', 'Class successfully deleted!');
        return redirect('/class-list');
    }
}
