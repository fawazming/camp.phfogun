<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Logic extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		echo view('options');
	}

	public function buypin()
	{
		echo view('buypin');
	}

	public function register()
	{
		echo view('pin');
	}

	public function pinstatus()
	{
		echo view('pinstatus');
	}

	public function vendors()
	{
		echo view('vendors');
	}

	public function msg($mg = "Hello")
	{
		echo view('msg', ['mg' => $mg]);
	}

	public function pin()
	{
		$incoming = $this->request->getGet();
		$Pins = new \App\Models\Pins();

		if($value = $Pins->where(['pin'=>$incoming['pin'],'used !='=>'yes'])->find()){
			$Pins->update($value[0]['id'],['used'=>'using']);
			echo view('home',['ref'=>$incoming['pin']]);
		}else{
			$this->msg("The pin you entered is invalid");
		}
	}

	public function pinstat()
	{
		$incoming = $this->request->getGet();
		$Pins = new \App\Models\Pins();

		$value = $Pins->where(['pin'=>$incoming['pin']])->find();
		$this->msg("Is the pin used? ". strtoupper($value[0]['used']));
		
	}

	public function registration()
	{
		$incoming = $this->request->getPost();
		$Pins = new \App\Models\Pins();
		$Delegates = new \App\Models\Delegates();
		$pin_id = $Pins->where('pin',$incoming['ref'])->find()[0]['id'];
		if($value = $Pins->where(['id'=>$pin_id,'used'=>'yes'])->find()){
			$this->msg('Sorry, this pin has been used.');
		}else{
		$Pins->update($pin_id,['used'=>'yes']);
		$Delegates->insert($incoming);
		$this->msg('Congratulations! You will be sent an SMS once confirmed');
		}
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

		
	public function samp()
	{
		echo ($this->uniqidReal(8));
		
	}
	//--------------------------------------------------------------------

}
