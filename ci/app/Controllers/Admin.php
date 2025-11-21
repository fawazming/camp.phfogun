<?php

namespace App\Controllers;

class Admin extends BaseController
{
	public function index()
	{
		// $session = session();
		// $logged_in = $session->get('admin_logged_in');
		// if ($logged_in) {
		// 	return redirect()->to(base_url('admin/dashboard'));
		// } else {
			echo view('admin/login');
		// }
	}

	public function login()
	{
			echo view('admin/login');
	}

	public function auth()
	{
		$session = session();
		$uname = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		$year = $this->request->getPost('year');

		if ($uname == 'phfogun' && $password == 'pmc2022') {
			$newdata = array(
				'admin' => $uname,
				'year' => $year,
				'admin_logged_in' => TRUE
			);
			$session->set($newdata);
			return redirect()->to(base_url('admin/dashboard'));
		} else {
			return redirect()->to(base_url('admin/'));
		}
	}

	public function logout()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			session()->destroy();
			return redirect()->to(base_url('admin/'));
		} else {
			echo view('admin/login');
		}
	}

	public function dashboard()
	{
		// echo('dashboard');	
		$logged_in = session()->get('admin_logged_in');
		
		$ManualDel = new \App\Models\ManualDel();
		if ($logged_in) {
			$year = session()->get('year');
			if($year == 'current'){
				$Delegates = new \App\Models\Delegates();
			}else{
				$Delegates = new \App\Models\DelegatesOld();
			}

			$data = [
				'total_del' => $Delegates->countAllResults(),
				'remo' => $Delegates->where('lb', 'Remo')->countAllResults(),
				'egba' => $Delegates->where('lb', 'Egba')->countAllResults(),
				'ijebu' => $Delegates->where('lb', 'Ijebu')->countAllResults(),
				'aoo' => $Delegates->where('lb', 'Adoodo')->countAllResults(),
				'yewa' => $Delegates->where('lb', 'Yewa')->countAllResults(),
				'others' => $Delegates->where('lb', 'others')->countAllResults(),
				'male' => $Delegates->where('gender', 'male')->countAllResults(),
				'female' => $Delegates->where('gender', 'female')->countAllResults(),
				'damale' => $Delegates->where(['gender'=>'male','lb'=>'Egba'])->countAllResults() + $Delegates->where(['gender'=>'male','lb'=>'Adoodo'])->countAllResults() + $Delegates->where(['gender'=>'male','lb'=>'Yewa'])->countAllResults() + $Delegates->where(['gender'=>'male','lb'=>'others'])->countAllResults(),
				'dafemale' => $Delegates->where(['gender'=>'female','lb'=>'Egba'])->countAllResults() + $Delegates->where(['gender'=>'female','lb'=>'Adoodo'])->countAllResults() + $Delegates->where(['gender'=>'female','lb'=>'Yewa'])->countAllResults() + $Delegates->where(['gender'=>'female','lb'=>'others'])->countAllResults(),
				'dbmale' => $Delegates->where(['gender'=>'male','lb'=>'Remo'])->countAllResults() + $Delegates->where(['gender'=>'male','lb'=>'Ijebu'])->countAllResults(),
				'dbfemale' => $Delegates->where(['gender'=>'female','lb'=>'Remo'])->countAllResults() + $Delegates->where(['gender'=>'female','lb'=>'Ijebu'])->countAllResults(),
				'psec' => $Delegates->where('category', 'primary')->countAllResults(),
				'dapsec' => $Delegates->where(['category'=>'primary','lb'=>'Egba'])->countAllResults() + $Delegates->where(['category'=>'primary','lb'=>'Adoodo'])->countAllResults() + $Delegates->where(['category'=>'primary','lb'=>'others'])->countAllResults(),
				'dbpsec' => $Delegates->where(['category'=>'primary','lb'=>'Remo'])->countAllResults() + $Delegates->where(['category'=>'primary','lb'=>'Ijebu'])->countAllResults(),
				'jsec' => $Delegates->where('category', 'jsec')->countAllResults(),
				'dajsec' => $Delegates->where(['category'=>'jsec','lb'=>'Egba'])->countAllResults() + $Delegates->where(['category'=>'jsec','lb'=>'Adoodo'])->countAllResults() + $Delegates->where(['category'=>'jsec','lb'=>'others'])->countAllResults(),
				'dbjsec' => $Delegates->where(['category'=>'jsec','lb'=>'Remo'])->countAllResults() + $Delegates->where(['category'=>'jsec','lb'=>'Ijebu'])->countAllResults(),
				'ssec' => $Delegates->where('category', 'ssec')->countAllResults(),
				'dassec' => $Delegates->where(['category'=>'ssec','lb'=>'Egba'])->countAllResults() + $Delegates->where(['category'=>'ssec','lb'=>'Adoodo'])->countAllResults() + $Delegates->where(['category'=>'ssec','lb'=>'others'])->countAllResults(),
				'dbssec' => $Delegates->where(['category'=>'ssec','lb'=>'Remo'])->countAllResults() + $Delegates->where(['category'=>'ssec','lb'=>'Ijebu'])->countAllResults(),
				'hi' => $Delegates->where('category', 'undergraduate')->countAllResults(),
				'dahi' => $Delegates->where(['category'=>'undergraduate','lb'=>'Egba'])->countAllResults() + $Delegates->where(['category'=>'undergraduate','lb'=>'Adoodo'])->countAllResults() + $Delegates->where(['category'=>'undergraduate','lb'=>'others'])->countAllResults(),
				'dbhi' => $Delegates->where(['category'=>'undergraduate','lb'=>'Remo'])->countAllResults() + $Delegates->where(['category'=>'undergraduate','lb'=>'Ijebu'])->countAllResults(),
				'workers' => $Delegates->where('category', 'professionals')->countAllResults(),
				'daworkers' => $Delegates->where(['category'=>'professionals','lb'=>'Egba'])->countAllResults() + $Delegates->where(['category'=>'professionals','lb'=>'Adoodo'])->countAllResults() + $Delegates->where(['category'=>'professionals','lb'=>'others'])->countAllResults(),
				'dbworkers' => $Delegates->where(['category'=>'professionals','lb'=>'Remo'])->countAllResults() + $Delegates->where(['category'=>'professionals','lb'=>'Ijebu'])->countAllResults(),
				'sch_leaver' => $Delegates->where('category', 'sch_leaver')->countAllResults(),
				'dasch_leaver' => $Delegates->where(['category'=>'sch_leaver','lb'=>'Egba'])->countAllResults() + $Delegates->where(['category'=>'sch_leaver','lb'=>'Adoodo'])->countAllResults() + $Delegates->where(['category'=>'sch_leaver','lb'=>'others'])->countAllResults(),
				'dbsch_leaver' => $Delegates->where(['category'=>'sch_leaver','lb'=>'Remo'])->countAllResults() + $Delegates->where(['category'=>'sch_leaver','lb'=>'Ijebu'])->countAllResults(),
				'official' => $Delegates->where('category', 'Camp_Official')->countAllResults(),
				'daofficial' => $Delegates->where(['category'=>'Camp_Official','lb'=>'Egba'])->countAllResults() + $Delegates->where(['category'=>'Camp_Official','lb'=>'Adoodo'])->countAllResults() + $Delegates->where(['category'=>'Camp_Official','lb'=>'others'])->countAllResults(),
				'dbofficial' => $Delegates->where(['category'=>'Camp_Official','lb'=>'Remo'])->countAllResults() + $Delegates->where(['category'=>'Camp_Official','lb'=>'Ijebu'])->countAllResults(),
				'manual' => [
					'total_del' => $Delegates->where('paid', 'm')->countAllResults(),
					'remo' => $Delegates->where(['paid'=>'m','lb'=>'Remo'])->countAllResults(),
					'egba' => $Delegates->where(['paid'=>'m','lb'=>'Egba'])->countAllResults(),
					'ijebu' => $Delegates->where(['paid'=>'m','lb'=>'Ijebu'])->countAllResults(),
					'aoo' => $Delegates->where(['paid'=>'m','lb'=>'Adoodo'])->countAllResults(),
					'others' => $Delegates->where(['paid'=>'m','lb'=>'others'])->countAllResults(),
                    'male' => $Delegates->where(['paid'=>'m','gender'=>'male'])->countAllResults(),
					'female' => $Delegates->where(['paid'=>'m','gender'=>'female'])->countAllResults(),
                    'psec' => $Delegates->where(['paid'=>'m','category'=>'primary'])->countAllResults(),
                    'jsec' => $Delegates->where(['paid'=>'m','category'=>'jsec'])->countAllResults(),
                    'ssec' => $Delegates->where(['paid'=>'m','category'=>'ssec'])->countAllResults(),
                    'hi' => $Delegates->where(['paid'=>'m','category'=>'undergraduate'])->countAllResults(),
                    'workers' => $Delegates->where(['paid'=>'m','category'=>'professionals'])->countAllResults(),
					'sch_leaver' => $Delegates->where(['paid'=>'m','category'=>'sch_leaver'])->countAllResults(),
				]
			];

			echo view('admin/header');
			echo view('admin/dashboard', $data);
			echo view('admin/footer');
		} else {
			echo view('admin/login');
		}
	}

	public function stats()
	{
		// echo('dashboard');	
		$logged_in = session()->get('admin_logged_in');
		// $Delegates = new \App\Models\Delegates();
		// $ManualDel = new \App\Models\ManualDel();
		if ($logged_in) {
			$year = session()->get('year');
			if($year == 'current'){
				$Delegates = new \App\Models\Delegates();
			}else{
				$Delegates = new \App\Models\DelegatesOld();
			}

			// Get counts for the 'tc' field
			$tcCounts = $Delegates
						   ->select('lb, COUNT(*) as count')
						   ->groupBy('lb')
						   ->get()
						   ->getResultArray();
	
			// Get counts for the 'gender' field
			$genderCounts = $Delegates
							   ->select('gender, COUNT(*) as count')
							   ->groupBy('gender')
							   ->get()
							   ->getResultArray();
	
			// Get counts for the 'category' field
			$categoryCounts = $Delegates
								 ->select('category, COUNT(*) as count')
								 ->groupBy('category')
								 ->get()
								 ->getResultArray();

			// Get counts for the 'category' field
			$genderTCCounts = $Delegates
								->getDCbTG();

			// Get counts for the 'category' field
			$AGCounts = $Delegates
								->getDCbAG();
	
			// Prepare the data to be sent to the view
			$data = [
				'tcCounts'       => $tcCounts,
				'genderCounts'   => $genderCounts,
				'categoryCounts' => $categoryCounts,
				'genderTcCounts' => $genderTCCounts,
				'AgeGenderCounts' => $AGCounts,
			];
			// dd($genderTCCounts);
			return view('admin/stats', $data);
			// echo view('header', ['zone' => $_ENV['zone']]);
			// echo view('dashboard', $data);
			// echo view('footer');
		} else {
			echo view('admin/login');
		}
	}


	public function manual()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {

			echo view('admin/header');
			echo view('admin/manualUpload');
			echo view('admin/footer');
		} else {
			echo view('admin/login');
		}
	}

	public function manual1()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {

			echo view('admin/header');
			echo view('admin/manualUpload1', $this->request->getGet());
			echo view('admin/footer');
		} else {
			echo view('admin/login');
		}
	}

	public function manual2()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {

			$manual = new \App\Models\ManualDel();
			$incoming = $this->request->getPost();
			$res = $manual->insert($incoming);

			return redirect()->back();
		} else {
			echo view('admin/login');
		}
	}


	public function printe()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			$year = session()->get('year');
			if($year == 'current'){
				$Delegates = new \App\Models\Delegates();
			}else{
				$Delegates = new \App\Models\DelegatesOld();
			}

			$data = array(
				'delegates' => $Delegates->findAll(),
				'type' => 'Electronic'
			);

			echo view('admin/header');
			echo view('admin/print', $data);
			echo view('admin/footer');
		} else {
			echo view('admin/login');
		}
	}

	public function printo()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			$year = session()->get('year');
			if($year == 'current'){
				$Delegates = new \App\Models\Delegates();
			}else{
				$Delegates = new \App\Models\DelegatesOld();
			}

			$data = array(
				'delegates' => $Delegates->where('category','Camp_Official')->find(),
				'type' => 'Electronic'
			);

			echo view('admin/header');
			echo view('admin/printo', $data);
			echo view('admin/footer');
		} else {
			echo view('admin/login');
		}
	}

	public function printm()
	{
		$logged_in = session()->get('admin_logged_in');
		if ($logged_in) {
			$Delegates = new \App\Models\ManualDel();

			$data = array(
				'delegates' => $Delegates->findAll(),
				'type' => 'Electronic'
			);

			echo view('admin/header');
			echo view('admin/print', $data);
			echo view('admin/footer');
		} else {
			echo view('admin/login');
		}
	}

    public function cert($name)
    {
        // var_dump($name);
        echo view('admin/cert', ['name'=>$name]);
    }

	//--------------------------------------------------------------------

}
