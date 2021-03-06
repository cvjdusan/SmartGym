<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class PremiumFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
       $session=session();
       $type = $session->get('type');
       if ($type == null) {
           $type = "Guest";
       }
       if($type != 'Premium') {
            return redirect()->to(site_url("$type"));
       }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {

    }
}

