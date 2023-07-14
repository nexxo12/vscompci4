<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table      = 'penjualan';
    protected $primaryKey = 'ID_PENJUALAN';
    protected $allowedFields = ['ID_PENJUALAN', 'INV_PENJUALAN', 'ID_BARANG', 'ID_PELANGGAN', 'ID_LOGIN', 'TANGGAL_TRANSAKSI', 'JUMLAH_BELI', 'HARGA_AWAL', 'HARGA_JL', 'TOTAL_HARGA'];

    public function AutonumIDPJ()
    {
        return $this->selectMAX('ID_PENJUALAN')->findAll();
        // $id = $this->selectMAX('ID_PENJUALAN')->findAll();
        // foreach ($id as $key) {
        //     $id_n = $key['ID_PENJUALAN'] + 1;
        // }
        // return $id_n;
    }
}
