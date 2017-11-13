<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class InnerController extends Controller
{
   public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$users = User::orderBy('id', 'asc')->published()->get(); // get data
		return view('inner');
	}
}
