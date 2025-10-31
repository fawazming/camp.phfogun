<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
	use ResponseTrait;

    private $categories = [
        'professionals' => 12100,
        'undergraduate' => 10101,
        'school_leaver' => 10100,
        'secondary_school_student' => 8600,
        // 'test' => 100,
    ];

    /**
     * Determine category based on amount
     *
     * @param int|float $amount
     * @return string
     */
    public function getCategoryByAmount($amount)
    {
        foreach ($this->categories as $category => $price) {
            if ($price == $amount) {
                return $category;
            }
        }

        return null;
    }

    public function index()
    {
        echo view('new/header');
        echo view('new/home');
        echo view('new/footer');
    }

    public function register()
    {
        echo view('new/header');
        echo view('new/register');
        echo view('new/footer');
    }

    public function pregister()
    {
        $incoming = $this->request->getPost();
        $client = \Config\Services::curlrequest();

        $url = $_ENV['gateway'].'/api/authorize';
        $amount = explode('|',$incoming['category'])[1];
        $headers = [
            'Authorization' => 'Bearer '.$_ENV['st'],
            'api-key' => $_ENV['ak'],
            'Content-Type' => 'application/json',
        ];

        $data = [
            'email' => $incoming['email'],
            'amount' => $amount,
            'callback' => $_ENV['callback'],
        ];
        // dd($headers,$data);

        try {
            $response = $client->post($url, [
                'headers' => $headers,
                'json' => $data,
            ]);

            $body = $response->getBody();
            $result = json_decode($body);
            // dd($body);
            #insert data in DB
            $pgtrans = new \App\Models\PgtransactionsModel();
            dd($pgtrans);
            $ik = $pgtrans->insert(['business_id'=>$_ENV['bid'],'access_code'=>$result->data->access_code, 'customer_phone'=>$result->data->reference, 'callback_url'=>$data['callback'], 'amount'=>$data['amount']]);
            if (isset($result->data->authorization_url)) {
                // Redirect to the authorization_url
                return redirect()->to($result->data->authorization_url);
            } else {
                // Handle missing authorization_url
                return $this->response->setStatusCode(400)->setJSON([
                    'error' => 'Authorization URL not found in response',
                ]);
            }

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function cregister() {
        $ref1 = $this->request->getGet()['ref'];
        $ref = substr($ref1, 3);

        $pgModel = new \App\Models\PgtransactionsModel();
        $Delegates23 = new \App\Models\Delegates23();

        // Call the /verifypro/$ref endpoint to get verification data
        $verifyUrl = $_ENV['gateway']."/verifypro/".$ref1;

        // Use CodeIgniter HTTP client to call the verifypro endpoint
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->get($verifyUrl);

            if ($response->getStatusCode() !== 200) {
                return redirect()->to('/notification')->with('error', 'Verification failed.');
            }

            $verifyData = json_decode($response->getBody(), true)['data'];


            if (!$verifyData) {
                return redirect()->to('/notification')->with('error', 'Invalid verification response.');
            }

            // Fetch existing transaction by transaction_id (assuming $ref is transaction_id)
            $existingTransaction = $pgModel->where('customer_phone',$ref)->first();

            if (!$existingTransaction) {
                return redirect()->to('/notification')->with('error', 'Transaction not found.');
            }

            $existingTXN = $Delegates23->where('txn',$ref1)->first();

            if ($existingTXN) {
                return redirect()->to('/notification')->with('error', 'This paid ticket is already used by '.$existingTXN['fname']);
            }

            // Compare amount, access_code, business_id
            if (
                floatval($existingTransaction['amount']) !== floatval($verifyData['amount']) ||
                $existingTransaction['access_code'] !== $verifyData['access_code'] ||
                $existingTransaction['business_id'] !== $verifyData['business_id']
            ) {
                return redirect()->to('/notification')->with('error', 'Transaction data mismatch.');
            }

            // Update the transaction with incoming data from verifyData
            // Filter only allowed fields to update
            $updateData = [];

            $allowedFields = $pgModel->allowedFields;

            foreach ($allowedFields as $field) {
                if (isset($verifyData[$field])) {
                    $updateData[$field] = $verifyData[$field];
                }
            }

            $rr = $pgModel->set($updateData)->where('customer_phone',$ref)->update();

            // Determine category for registration completion form
            // Assuming category is part of verifyData or you can set default

            $category = $this->getCategoryByAmount($verifyData['amount']);
            
            if (!$category) {
                return redirect()->to('/notification')->with('error', 'Payment of '.$verifyData['amount'].' does not match any category');
            }

            // Load the registration completion form view based on category
            // Pass any data needed to the view

            echo view("new/header");
            echo view("new/creg", [
                'email' => $verifyData['email'],
                'category' => $category,
                'ref' => $ref1,
            ]);
            echo view("new/footer");
        } catch (\Exception $e) {
            // Log error if needed
            log_message('error', 'Payment confirmation error: ' . $e->getMessage());
            return redirect()->to('/notification')->with('error', 'An error occurred during payment confirmation.');
        }
        
    }
    
	public function registration()
	{
		$incoming = $this->request->getPost();
        $Delegates23 = new \App\Models\Delegates23();
        
        $house = $this->generateHouse($incoming['gender']);
        $incoming['house'] = $house;
        $id = $Delegates23->insert($incoming);
        // $Pins->update($pin['id'],['used'=>'1']); Update the transaction ID as used
        return redirect()->to('/notification')->with('success', 'Congratulations! Your registration was successful with Registration No: '.$id.' & Your house is '.$house);
    		
	}

    
    public function generateHouse($gender)
    {
        $mHouses = ['Abu Bakr', 'Umar', 'Uthman', 'Alli'];
        $fHouses = ['Khadijah', 'Aishah', 'Ummu Khultum', 'Ummu Salamah'];
        if($gender=='male'){
            $key = array_rand($mHouses);
            return $mHouses[$key];
        }else{
            $key = array_rand($fHouses);
            return $fHouses[$key];
        }
    }
    // ONCE redirected successfully, the redirected URL with $ref should confirm payment from /verifypro/$ref by comparing the existing data(amount with amount,access_code with access_code, business_id with business_id ) in the table after which then update the pgtransactions Table data with incoming data, then show registeration completion form based on category selected
}
