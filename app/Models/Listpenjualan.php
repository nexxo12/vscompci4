<?php

namespace App\Models;

use CodeIgniter\Model;

class Listpenjualan extends Model
{
    protected $table      = 'list_penjualan';
    protected $primaryKey = 'ID_PENJUALAN';
    protected $allowedFields = [
        'ID_PENJUALAN',
        'INV_PENJUALAN',
        'ID_BARANG',
        'ID_PELANGGAN',
        'TANGGAL_TRANSAKSI',
        'NAMACUST',
        'ALAMAT',
        'REFMP',
        'CATATAN',
        'JUMLAH_BELI',
        'HARGA_AWAL',
        'HARGA_JL',
        'DP',
        'DISKON',
        'TOTAL_HARGA',
        'LABA',
    ];

    public function showlistpenjualan()
    {
        return $this->table('list_penjualan')->select('*')
            ->join('master_barang', 'master_barang.ID_BARANG = list_penjualan.ID_BARANG')->findAll();
    }

    public function deletelist($id)
    {
        return $this->where('ID_PENJUALAN', $id)->delete();
    }

    public function TotalPJ($id)
    {
        return $this->selectSum('TOTAL_HARGA')->where('INV_PENJUALAN', $id)->findAll();
    }

    public function GetCatatan($id)
    {
        return $this->selectMAX('CATATAN')->where('INV_PENJUALAN', $id)->findAll();
    }

    public function GetNamaCustomer($id)
    {
        return $this->select('*')->join('pelanggan', 'pelanggan.ID_PELANGGAN = list_penjualan.ID_PELANGGAN')->where('INV_PENJUALAN', $id)->findAll();
    }

    public function ClearListPenjualan()
    {
        return $this->truncate();
    }
}
