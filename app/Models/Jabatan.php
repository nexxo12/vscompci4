<?php

namespace App\Models;

use CodeIgniter\Model;

class Jabatan extends Model
{
    protected $table      = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $allowedFields = ['departement_jabatan', 'nama_jabatan', 'gaji_jabatan'];


    public function showjabatan()
    {
        return $this->select('*')->findAll();
    }
}
