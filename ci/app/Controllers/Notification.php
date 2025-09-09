<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Notification extends BaseController
{
	use ResponseTrait;

    public function index()
    {
        echo view('new/header');
        echo view('notification');
        echo view('new/footer');
    }
}