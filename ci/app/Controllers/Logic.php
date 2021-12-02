<?php namespace App\Controllers;

class Logic extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function sms()
	{
		$incoming = $this->request->getJSON();
		// $jsonObject = json_decode(implode('', $incoming));
		// do_anything($jsonObject->subject, $jsonObject->message) // do_anything - function anything doing

		// var_dump($jsonObject->subject, $jsonObject->message);
		// print_r($jsonObject->message);
		echo('done '.$incoming->subject.' ');
		print_r($incoming);
	}
	//--------------------------------------------------------------------

}