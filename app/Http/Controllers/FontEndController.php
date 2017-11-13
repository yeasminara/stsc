<?php
namespace App\Http\Controllers;

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

class FontEndController extends Controller
{
    public function index(){
        $classes = Classe::orderBy('id', 'asc')->get(); // get data
        $subjects = Subject::orderBy('id', 'asc')->get(); // get data
        $chapters = Chapter::orderBy('id', 'asc')->get(); // get data
        $lessons = Lesson::orderBy('id', 'asc')->get(); // get data
        $content_types = ContentType::orderBy('id', 'asc')->get(); // get data
        return view('home',compact('chapters','classes','subjects','lessons','content_types'));
    }
}
