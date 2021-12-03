<?php

namespace App\Controllers;

use App\Models\Alerts;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Model;

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
		$Alerts = new \App\Models\Alerts();
		$res = $Alerts->insert(['message' => $incoming->message]);

		$data = [
			'message' => 'created' . $res
		];
		if ($res) {
			return $this->respond($data, 200);
		} else {
			return $this->respond(['message' => 'Not Added'], 400);
		}
	}
	//--------------------------------------------------------------------

}
