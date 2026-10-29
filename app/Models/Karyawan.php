<?php

namespace App\Models;

use CodeIgniter\Model;

class Karyawan extends Model
{
    protected $table      = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $allowedFields = ['id_jabatan', 'nik_karyawan', 'nama_karyawan', 'email_karyawan', 'hp_karyawan', 'ttl_karyawan', 'jenkel_karyawan', 'alamat_karyawan', 'tglmasuk_karyawan', 'status_karyawan'];


    // public function showcustomer()
    // {
    //     return $this->select('*')->findAll();
    // }
}
