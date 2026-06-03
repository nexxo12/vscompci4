<?php

namespace App\Models;

use CodeIgniter\Model;

class Garansi extends Model
{
    protected $table      = 'garansi';
    protected $primaryKey = 'ID_PENJUALAN';
    protected $allowedFields = ['ID_PENJUALAN', 'INV_PENJUALAN', 'ID_BARANG', 'TGL_BELI', 'TGL_HABIS', 'STATUS'];


    public function delete_garansi(int $id)
    {
        return $this->where('ID_PENJUALAN', $id)->delete();
    }

    public function show_garansi(mixed $id)
    {
        return $this->select('*')->join('master_barang', 'garansi.ID_BARANG = master_barang.ID_BARANG')
            ->where('INV_PENJUALAN', $id)->findAll();
    }
}
