<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori extends Model
{
    protected $table      = 'kategori';
    protected $primaryKey = 'ID_KATEGORI';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['KATEGORI'];


    public function showkategori()
    {
        return $this->select('*')->findAll();
    }
}
