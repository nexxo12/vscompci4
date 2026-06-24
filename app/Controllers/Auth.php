<?php

namespace App\Controllers;

use App\Models\Login;

class Auth extends BaseController
{
    protected Login $loginuser;
    protected \CodeIgniter\Session\Session $session;

    public function __construct()
    {
        $this->loginuser = new Login();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = [
            'tittle' => 'Login - VSKomputer'
        ];
        return view('login/login', $data);
    }

    public function proses_login()
    {
        $username = $this->request->getPost('username');
        $password = sha1($this->request->getPost('password'));
        $session = session();
        $user = $this->loginuser->LoginUser($username);
        if ($user) {
            // Verifikasi password yang di-hash
            if (hash_equals($password, $user['PASSWORD'])) {
                $session->set([
                    'ID_LOGIN' => $user['ID_LOGIN'],
                    'USERNAME' => $user['USERNAME'],
                    'NAMA_LOGIN' => $user['NAMA_LOGIN'],
                    'LEVEL' => $user['LEVEL'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('/');
            } else {
                $session->setFlashdata('error', 'Password salah.');
                $session->setFlashdata('username', $username);
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan.');
            $session->setFlashdata('username', $username);
            return redirect()->to('/login');
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
