<?php

namespace App\Models;

use CodeIgniter\Model;

class Login extends Model
{
    protected $table      = 'login';
    protected $primaryKey = 'ID_LOGIN';
    protected $allowedFields = ['USERNAME', 'PASSWORD', 'NAMA_LOGIN', 'LEVEL'];
    protected $useTimestamps = true;

    public function LoginUser(mixed $username)
    {
        return $this->where('USERNAME', $username)->first();
    }
}
