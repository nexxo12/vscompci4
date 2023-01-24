<?php

namespace App\Models;

use CodeIgniter\Model;

class Masterbarang extends Model
{
    protected $table      = 'master_barang';
    protected $allowedFields = ['ID_BARANG', 'ID_KATEGORI', 'NAMA_BARANG', 'STOK', 'SATUAN', 'HARGA_JUAL', 'G_TOTAL'];


    public function ShowBarang()
    {
        return $this->select('*')->orderBy('NAMA_BARANG', 'ASC')->findAll();
    }
}
