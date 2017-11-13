<?php
namespace App\Http\Controllers;

use Input;
use Auth;
use App\ContentType;
use App\User;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;


class ContentTypesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'logout']);
        $this->middleware('auth');
    }

    public function index()
    {

        // echo 'test';
        $content_types = ContentType::orderBy('id', 'asc')->get(); // get data
        // print_r($class);
        //die();
        return view('content_type.content_type_list',compact('content_types')); // view
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content_type.addContentType');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),['content_type_name'=>'required']);
        if($validator->fails()){
            return redirect('/add-content-type')
                ->withInput()
                ->withErrors($validator);

        }
        $contentType = new ContentType;
        $contentType->content_type_name = $request->content_type_name;
        $contentType->created_at = date('Y-m-d');
        $contentType->status = $request->status;
        $contentType->save();
        Session::flash('flash_message', 'Content Type successfully added!');
        return redirect('/content-type-list');
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
        $contentType = ContentType::findOrFail($id);

        return view('content_type.addContentType',compact('contentType'));
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
        $contentType = ContentType::findOrFail($id);
        $this->validate($request, [
            'content_type_name'=>'required'
        ]);
        $contentType->content_type_name = $request->content_type_name;
        $contentType->updated_at = date('Y-m-d');
        $contentType->status = $request->status;
        $contentType->save();
        Session::flash('flash_message', 'Content Type successfully updated!');
        return redirect('/content-type-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ContentType::findOrFail($id)->delete();
        Session::flash('flash_message', 'Content Type successfully deleted!');
        return redirect('/content-type-list');
    }
}
