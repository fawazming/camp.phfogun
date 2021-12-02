<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function sms()
	{
		$incoming = $this->request->getPost();
		$jsonObject = json_decode(implode('', $incoming));
		// do_anything($jsonObject->subject, $jsonObject->message) // do_anything - function anything doing

		// var_dump($jsonObject->subject, $jsonObject->message);
		echo($jsonObject->message);
		echo('done');
	}
	//--------------------------------------------------------------------

}