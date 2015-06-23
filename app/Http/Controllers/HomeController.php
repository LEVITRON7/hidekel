<?php namespace Conquis\Http\Controllers;

use Conquis\Slide;
use Conquis\Club;

use Illuminate\Support\Facades\Session;
use Conquis\Http\Requests\ContactRequest;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('home');
	}

	public function app()
	{	
		$clubs = club::all();
		$slides = Slide::all();
		return view('app.home.index', compact('slides', 'clubs'));
	}

	public function clubs()
	{	
		$clubs = club::all();
		return view('app.home.clubs.all',compact('clubs'));
	}

	public function show_club($id)
	{	
		$club = club::findOrFail($id);
		return view('app.home.clubs.show',compact('club'));
	}

	public function hidekel()
	{	
		return view('app.home.hidekel');
	}

	public function contact()
	{	
		return view('app.home.contact');
	}

	public function send_mail(ContactRequest $request)
	{	
		$array = $request->all();
		// I'm creating an array with user's info but most likely you can use $user->email or pass $user object to closure later
		$form = array(
			'name'		=> 	$array['name'],
			'email'		=> 	$array['email'],
			'title'		=> 	$array['title'],
			'to_email'	=>	'yonny90_15@hotmail.com'
		);
		$data = array(
			'message_content'	=>	$array['message'],
			'title'				=>	$array['title']
		); 		
		//dd($data);
		
		\Mail::send('emails.emailmessage', $data, function($message) use ($form)
		{
		    $message->from($form['email'], $form['name']);
		    $message->subject($form['title']);
		    $message->to($form['to_email']);
		});
			Session::flash('message', 'El mensaje se ha enviado correctamente');
			return redirect('home/contact');
	}
}
