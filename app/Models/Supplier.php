<?php

namespace App\Models;

use CodeIgniter\Model;

class Supplier extends Model
{
    protected $table      = 'supplier';
    protected $allowedFields = ['ID_SUPP', 'NAMA', 'ALAMAT', 'NO_HP'];


    public function ShowSupplier()
    {
        return $this->select('*')->findAll();
    }
}
