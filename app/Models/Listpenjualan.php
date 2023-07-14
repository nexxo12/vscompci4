<?php

namespace App\Models;

use CodeIgniter\Model;

class Listpenjualan extends Model
{
    protected $table      = 'list_penjualan';
    protected $primaryKey = 'ID_PENJUALAN';
    protected $allowedFields = ['ID_PENJUALAN', 'INV_PENJUALAN', 'ID_BARANG', 'ID_PELANGGAN', 'ID_LOGIN', 'TANGGAL_TRANSAKSI', 'JUMLAH_BELI', 'HARGA_AWAL', 'HARGA_JL', 'TOTAL_HARGA'];

    public function showlistpenjualan()
    {
        return $this->table('list_penjualan')->select('*')
            ->join('master_barang', 'master_barang.ID_BARANG = list_penjualan.ID_BARANG')->findAll();
    }
}
