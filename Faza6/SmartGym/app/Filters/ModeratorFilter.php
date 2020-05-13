<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ModeratorFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
       $session=session();
        if(!$session->has('Moderator')) {
            return redirect()->to(site_url('Guest'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}