<?php namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;

class Logic extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		echo view('home');
	}

	public function sms()
	{
		$incoming = $this->request->getJSON();
		$data = [
			'message'=> 'created'
		];
		return $this->respond($data, 200);
	}
	//--------------------------------------------------------------------

}