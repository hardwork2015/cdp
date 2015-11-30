<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
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
        return redirect()->action("ProjectController@projectList");
		//return view('home');
	}
}