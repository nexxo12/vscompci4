<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika session 'isLoggedIn' tidak ada, lempar ke halaman login
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Silahkan login terlebih dahulu.');
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Biasanya dibiarkan kosong
    }
}
