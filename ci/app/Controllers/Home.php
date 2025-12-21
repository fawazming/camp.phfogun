<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
	use ResponseTrait;

    private $categories = [
        12100 => 'professionals',
        10101 => 'undergraduate',
        10100 => 'school_leaver',
        8600 => 'secondary_school_student',
        6000 => 'tfl',
        15100 => 'professionals',
        12101 => 'undergraduate',
        12100 => 'school_leaver',
        10099 => 'secondary_school_student',
    ];

    /**
     * Determine category based on amount
     *
     * @param int|float $amount
     * @return string
     */
    public function getCategoryByAmount($amount)
    {
        foreach ($this->categories as $price => $category) {
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
        echo view('new/oldRegister');
        echo view('new/footer');
    }
    
    public function bRegister()
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
            $ik = $pgtrans->insert(['business_id'=>$_ENV['bid'],'access_code'=>$result->data->access_code, 'customer_phone'=>$result->data->reference, 'callback_url'=>$data['callback'], 'amount'=>$data['amount']]);
            // dd($ik);
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

    public function pBulkRegister()
    {
        $incoming = $this->request->getPost();
        $client = \Config\Services::curlrequest();

        $url = $_ENV['gateway'].'/api/authorize';
        // $amount = explode('|',$incoming['category'])[1];
        $bulk = json_decode($incoming['bulk'], true);
        $amount = 0;
        $processedBulk = [];
        $tickets = 0;

        foreach ($bulk as $item) {
            $itemAmount = $item['price'] * $item['qty'];
            $amount += $itemAmount;
            $item['tickets'] = [];
            
            for ($i = 0; $i < $item['qty']; $i++) {
                $tickets++;
                $item['tickets'][] = [
                    'id' => strtoupper(bin2hex(random_bytes(2))),
                    'used' => false,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            }
            
            $processedBulk[] = $item;
        }

        $incoming['bulk'] = json_encode($processedBulk);
        $headers = [
            'Authorization' => 'Bearer '.$_ENV['st'],
            'api-key' => $_ENV['ak'],
            'Content-Type' => 'application/json',
        ];
        //Collect b stored posted data in related_transaction_id
        //amount to be updated if b isset
        $data = [
            'email' => $incoming['email'],
            'amount' => $amount,
            'callback' => $_ENV['callback'],
            'tickets' => $tickets,
        ];
        // dd($headers,$data, $incoming['bulk']);

        try {
            $response = $client->post($url, [
                'headers' => $headers,
                'json' => $data,
            ]);

            $body = $response->getBody();
            $result = json_decode($body);
            // dd($body);
            //insert data in DB
            $pgtrans = new \App\Models\PgtransactionsModel();
            $ik = $pgtrans->insert(['business_id'=>$_ENV['bid'],'access_code'=>$result->data->access_code, 'customer_phone'=>$result->data->reference, 'callback_url'=>$data['callback'], 'amount'=>$data['amount'], 'related_transaction'=> $incoming['bulk']]);
            // dd($ik);
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
            // check if related_transaction_id isset in $existingTransaction. If yes, create a new logic else use existing logic. New logic will compare amount, access_code, business_id, update the transaction with incoming data from verifyData, then show another list of links for registeration based on data in related_transaction_id. Data in related_transaction_id is json encoded array of objects with number of ticket bought per category, 3 digit unique id code per ticket, used boolean and other neccesary data in order to ease bulk order
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

    public function creg() {
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


            if (!empty($existingTransaction['related_transaction'])) {
                // Bulk order logic
                $relatedTransactions = json_decode($existingTransaction['related_transaction'], true);

                $data = [
                    'email' => $verifyData['email'],
                    'ref' => $ref1,
                    'tickets' => $relatedTransactions,
                ];

                if ($verifyData['amount'] != $verifyData['currency']) {
                    return redirect()->to('/notification')->with('error', 'Expecting ₦'.$verifyData['amount'].' but got ₦'.$verifyData['currency']);
                }

                // var_dump($data); exit;
                
                echo view("new/header");
                echo view("new/bulk", ['data'=>$data]);
                echo view("new/footer");
                return;
            }

            $existingTXN = $Delegates23->where('txn',$ref1)->first();

            if ($existingTXN) {
                return redirect()->to('/notification')->with('error', 'This paid ticket is already used by '.$existingTXN['fname']);
            }

            // Determine category for registration completion form
            // Assuming category is part of verifyData or you can set default

            $category = $this->getCategoryByAmount($verifyData['currency']);
            
            if (!$category) {
                return redirect()->to('/notification')->with('error', 'Payment of '.$verifyData['currency'].' does not match any category');
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
            dd($e->getMessage());
            log_message('error', 'Payment confirmation error: ' . $e->getMessage());
            return redirect()->to('/notification')->with('error', 'An error occurred during payment confirmation.');
        }
        
    }

    public function reg($tranx, $ticket) {
        // 
        $pgModel = new \App\Models\PgtransactionsModel();
        $Delegates23 = new \App\Models\Delegates23();
        $ref = substr($tranx, 3);
        $existingTXN = $Delegates23->where('txn', $tranx.'-'.$ticket)->first();

        if ($existingTXN) {
            return redirect()->to('/notification')->with('error', 'This paid ticket is already used by '.$existingTXN['fname']);
        }

        $pgtransaction = $pgModel->where('customer_phone', $ref)->first();
        if (!$pgtransaction) {
            return redirect()->to('/notification')->with('error', 'Transaction not found');
        }

        $client = \Config\Services::curlrequest();
        $verifyUrl = $_ENV['gateway'] . "/verifypro/" . $tranx;

        try {
            $response = $client->get($verifyUrl);
            if ($response->getStatusCode() !== 200) {
                return redirect()->to('/notification')->with('error', 'Verification failed.');
            }

            $verifyBody = json_decode($response->getBody(), true);
            $verifyData = $verifyBody['data'] ?? null;
            if (!$verifyData) {
                return redirect()->to('/notification')->with('error', 'Invalid verification response.');
            }

            // Compare amount, access_code, business_id
            if (
                floatval($pgtransaction['amount']) !== floatval($verifyData['amount']) ||
                $pgtransaction['access_code'] !== $verifyData['access_code'] ||
                $pgtransaction['business_id'] !== $verifyData['business_id']
            ) {
                return redirect()->to('/notification')->with('error', 'Transaction data mismatch.');
            }

            // Decode related_transaction and validate tickets / compute total
            $related = json_decode($pgtransaction['related_transaction'], true);
            if (!is_array($related)) {
                return redirect()->to('/notification')->with('error', 'No related transaction data found.');
            }

            $computedAmount = 0;
            $selectedTicket = null;

            foreach ($related as $item) {
                $price = isset($item['price']) ? floatval($item['price']) : 0;
                $qty = isset($item['qty']) ? intval($item['qty']) : 0;
                $computedAmount += $price * $qty;

                if (!empty($item['tickets']) && is_array($item['tickets'])) {
                    foreach ($item['tickets'] as $t) {
                        if ((string)$t['id'] === (string)$ticket) {
                            $selectedTicket = [
                                'category'    => $item['catName'] ?? ($item['category'] ?? null),
                                'amount'       => $price,
                                'qty'         => $qty,
                                'id'          => $t['id'],
                                'used'        => !empty($t['used']),
                                'created_at'  => $t['created_at'] ?? null,
                            ];
                            break 2;
                        }
                    }
                }
            }

            // Confirm overall amount matches paid amount
            // if (floatval($computedAmount) !== floatval($verifyData['amount'])) {
            //     return redirect()->to('/notification')->with('error', 'Computed bulk amount (' . $computedAmount . ') does not match paid amount (' . $verifyData['amount'] . ').');
            // }

            if (!$selectedTicket) {
                return redirect()->to('/notification')->with('error', 'Ticket ' . $ticket . ' not found in related transactions.');
            }

            if ($selectedTicket['used']) {
                return redirect()->to('/notification')->with('error', 'This ticket (' . $ticket . ') has already been used.');
            }

            // Attach selected ticket info to verifyData for later use (views / saving)
            $verifyData = $selectedTicket;

        } catch (\Exception $e) {
            log_message('error', 'Reg verification error: ' . $e->getMessage());
            return redirect()->to('/notification')->with('error', 'An error occurred during verification.');
        }
        
        // Determine category for registration completion form
        // Assuming category is part of verifyData or you can set default
        $category = $this->getCategoryByAmount($verifyData['amount']);
            
        if (!$category) {
            return redirect()->to('/notification')->with('error', 'Payment of '.$verifyData['amount'].' does not match any category');
        }

        // Load the registration completion form view based on category
        // Pass any data needed to the view

        echo view("new/header");
        echo view("new/cregB", [
            'email' => $pgtransaction['email'],
            'category' => $category,
            'ref' => $tranx,
            'ticket' => $ticket
        ]);
        echo view("new/footer");

        // dd($verifyData);
    }
    
	public function registration()
	{
		$incoming = $this->request->getPost();
        $Delegates23 = new \App\Models\Delegates23();
        
        $house = $this->generateHouse($incoming['gender']);
        $incoming['house'] = $house;
        $id = $Delegates23->insert($incoming);
        $pgModel = new \App\Models\PgtransactionsModel();

        $ticketId = isset($incoming['ticket']) ? (string)$incoming['ticket'] : null;

        if ($ticketId) {
            // find a transaction whose related_transaction JSON contains this ticket id
            // $txn = $pgModel->like('related_transaction', $ticketId)->first();
            $txn = $pgModel->like('related_transaction', $ticketId)->where('customer_phone', substr($incoming['txn'], 3, 11))->first();
            // dd($txn);
            if ($txn && !empty($txn['related_transaction'])) {
                $related = json_decode($txn['related_transaction'], true);

                $found = false;
                if (is_array($related)) {
                    foreach ($related as &$item) {
                        if (!empty($item['tickets']) && is_array($item['tickets'])) {
                            foreach ($item['tickets'] as &$t) {
                                if ((string)($t['id'] ?? '') === $ticketId) {
                                    // mark ticket used
                                    $t['used'] = true;
                                    $found = true;
                                    break 2;
                                }
                            }
                        }
                    }
                }

                if ($found) {
                    // prepare update payload: update the related_transaction JSON and, if present, mark transaction-level used flag
                    $updatePayload = [
                        'related_transaction' => json_encode($related),
                    ];

                    // if the transaction row already has a 'used' field, set it to true as well
                    if (array_key_exists('used', $txn)) {
                        $updatePayload['used'] = 1;
                    }

                    $pgModel->update($txn['id'], $updatePayload);
                }
            }
        }
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
