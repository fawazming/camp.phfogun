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
		echo view('home',['ref'=>$this->uniqidReal(5)]);
	}

	public function registration()
	{
		$incoming = $this->request->getPost();
		$Delegates = new \App\Models\Delegates();
		$Delegates->insert($incoming);
		echo('Congratulations! You will be sent an SMS once confirmed');
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

	public function uniqidReal($lenght = 4) {
		// uniqid gives 13 chars, but you could adjust it to your needs.
		if (function_exists("random_bytes")) {
			$bytes = random_bytes(ceil($lenght / 2));
		} elseif (function_exists("openssl_random_pseudo_bytes")) {
			$bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
		} else {
			echo("no cryptographically secure random function available");
		}
		return substr(bin2hex($bytes), 0, $lenght);
	}
	//--------------------------------------------------------------------

}
