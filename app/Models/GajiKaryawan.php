<?php

namespace App\Models;

use CodeIgniter\Model;

class GajiKaryawan extends Model
{
    protected $table      = 'gaji_karyawan';
    protected $primaryKey = 'id_gaji';
    protected $allowedFields = ['id_karyawan', 'periode_gaji', 'tunjangan_gaji', 'potongan_gaji', 'total_gaji', 'payment_gaji'];


    // public function showcustomer()
    // {
    //     return $this->select('*')->findAll();
    // }
}
