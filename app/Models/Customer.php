<?php

namespace App\Models;

use CodeIgniter\Model;

class Customer extends Model
{
    protected $table      = 'pelanggan';
    protected $primaryKey = 'ID_PELANGGAN';
    // protected $allowedFields = ['ID_SUPP', 'NAMA', 'ALAMAT', 'NO_HP'];


    public function showcustomer()
    {
        return $this->select('*')->findAll();
    }
}
