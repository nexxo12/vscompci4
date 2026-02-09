<?php

namespace App\Models;

use CodeIgniter\Model;

class Garansi extends Model
{
    protected $table      = 'garansi';
    protected $primaryKey = 'ID_PENJUALAN';
    protected $allowedFields = ['ID_PENJUALAN', 'INV_PENJUALAN', 'ID_BARANG', 'TGL_BELI', 'TGL_HABIS', 'STATUS'];


    public function delete_garansi($id)
    {
        return $this->where('ID_PENJUALAN', $id)->delete();
    }
}
