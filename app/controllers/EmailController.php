<?php

class EmailController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function sendEmail()
	{
		$rules = [
			'email' => 'required|email',
		];

		$input = Input::only('email');

		$validator = Validator::make($input, $rules);

		if ($validator->fails())
		{
			// Or Redirect::back()->withInput()->withErrors($validator);
			return View::make("mailisnotsend");
		}

        $names = [ "Tim", "Tom", "James Bond", "Peter Pan" ];
        $name = $names[ rand( 0, count( $names ) - 1 )];
        $data = [
            "name" => $name
        ];


        \Mailgun::send( "emails.hello", $data, function($message)
        {
            $message->to(Input::get("email"), "hurr")
                    ->subject("hi")
                    //->cc(Input::get("email"))
                    ;
        });

        return View::make("mailissend", $data );
	}

}
