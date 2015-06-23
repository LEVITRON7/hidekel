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
		$data = array(
			'email'=>'yonny90_15@hotmail.com',
			'name'=>'Info Hidekel',
			'Detalles'	=>	$array['message'],
			'Nombre'	=> $array['name']
		);
		//dd($data);
		/* use Mail::send function to send email passing the data and using the $user variable in the closure
		\Mail::send(['emails.emailmessage'], $data, function($message) use ($user)
		{
		  //$message->from($array['email'], $array['title']);
		  $message->to($user['email'], $user['name'])->subject('nada');
		});*/

            \Mail::send('emails.emailmessage', $data, function($message) use ($data)
            {
                $message->from('info@hidekel.org', "Site name");
                $message->subject("Welcome to site name");
                $message->to($data['email']);
            });
			Session::flash('message', 'El mensaje se ha enviado correctamente');
			return redirect('home/contact');
	}
}
