<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuthFilter implements FilterInterface
{
    /**
     * Do whatever is necessary before the controller's action is executed.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('admin_logged_in')) {
            // User is not logged in or session has expired.
            // Redirect the user to the admin login page.
            return redirect()->to(base_url('admin/login'))
                ->with('error', 'You must be logged in as an administrator to access this area.');
        }

        // If the session variable is set, allow the request to proceed.
    }

    /**
     * We don't need to do anything after the controller's action.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action required after the controller executes
    }
}
