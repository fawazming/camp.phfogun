<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


class MaintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if the application is in maintenance mode
        $isMaintenanceMode = $_ENV['reg'];

        if ($isMaintenanceMode == 'true') {
            // Send a 503 response and display a maintenance message
            // return view('notavail');
            return service('response')->setStatusCode(503);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}